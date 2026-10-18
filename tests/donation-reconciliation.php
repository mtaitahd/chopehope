<?php
// Run: php tests/donation-reconciliation.php (uses a rolled-back local transaction).
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
use App\Models\Donation;
use App\Services\AblinerClient;
use App\Http\Controllers\DonationPaymentController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
DB::beginTransaction();
try {
$client = new class extends AblinerClient {
 public ?array $result = null;
 public int $calls = 0;
 public function findByIdempotencyKey(string $key): ?array { $this->calls++; return $this->result; }
};
$record = Donation::create(['public_id'=>(string) Illuminate\Support\Str::ulid(), 'donor_name'=>'Reconciliation test', 'amount'=>666, 'phone'=>'255622351639', 'status'=>'pending', 'customer_reference'=>'TEST-REF', 'idempotency_key'=>(string) Illuminate\Support\Str::uuid(), 'provider_transaction_id'=>'test-provider-id']);
$record->created_at = now()->subMinutes(2); $record->save();
$request = Request::create('/status'); $request->setLaravelSession(app('session.store'));
$base = ['id'=>'test-provider-id', 'customer_reference'=>'TEST-REF', 'amount'=>666, 'type'=>'deposit', 'method'=>'mobile', 'currency'=>'TZS'];
$cases = [
 ['processing', $base + ['status'=>'processing'], 'pending'],
 ['unavailable', null, 'pending'],
 ['empty known transaction', [], 'pending'],
 ['wrong reference', array_replace($base,['customer_reference'=>'OTHER','status'=>'completed']), 'pending'],
 ['wrong amount', array_replace($base,['amount'=>667,'status'=>'completed']), 'pending'],
 ['wrong currency', array_replace($base,['currency'=>'USD','status'=>'completed']), 'pending'],
 ['completed', $base + ['status'=>'completed'], 'completed'],
 ['failed', $base + ['status'=>'failed'], 'failed'],
];
foreach ($cases as [$label,$response,$expected]) {
$record->refresh()->update(['status'=>'pending','provider_checked_at'=>null,'completed_at'=>null]);
$client->result=$response;
$data=app(DonationPaymentController::class)->status($request,$record->public_id,$client)->getData(true);
if ($data['status']!==$expected || $data['bank_transfer_available']!==($expected==='failed')) throw new Exception($label.' failed');
echo "PASS: $label\n";
}
$record->refresh()->update(['status'=>'pending','provider_checked_at'=>now()]);
$before=$client->calls;
app(DonationPaymentController::class)->status($request,$record->public_id,$client);
if ($before!==$client->calls) throw new Exception('Throttle failed');
echo "PASS: provider checks throttled; no live payment sent\n";
} finally { DB::rollBack(); }
