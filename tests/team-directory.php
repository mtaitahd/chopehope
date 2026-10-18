<?php
require __DIR__.'/../vendor/autoload.php';
$app=require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
use App\Models\TeamMember;
use App\Http\Controllers\Admin\TeamMemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
DB::beginTransaction();
try {
$c=app(TeamMemberController::class);
$r=Request::create('/admin/team','POST',['name'=>'TEAM TEST <script>','role'=>'Coordinator','bio'=>'Test biography','sort_order'=>2,'is_published'=>0]);
$r->setLaravelSession(app('session.store'));
$c->store($r);
$m=TeamMember::where('name','TEAM TEST <script>')->firstOrFail();
$render=fn()=>view('team',['members'=>TeamMember::where('is_published',true)->orderBy('sort_order')->orderBy('name')->get()])->render();
if(str_contains($render(),'TEAM TEST')) throw new Exception('Draft leaked');
$r->merge(['is_published'=>1]); $c->update($r,$m);
$html=$render();
if(!str_contains($html,'TEAM TEST &lt;script&gt;') || str_contains($html,'TEAM TEST <script>')) throw new Exception('Published content/escaping failed');
$r->merge(['photo'=>Illuminate\Http\UploadedFile::fake()->create('bad.svg',1,'image/svg+xml')]);
$r->files->set('photo',$r->input('photo'));
try { $c->store($r); throw new Exception('Invalid upload accepted'); } catch (Illuminate\Validation\ValidationException $e) {}
$c->destroy($m);
if(TeamMember::find($m->id)) throw new Exception('Deletion failed');
foreach(['admin.team.store','admin.team.update','admin.team.destroy'] as $route) {
 if(!in_array('staff:admin',app('router')->getRoutes()->getByName($route)->gatherMiddleware())) throw new Exception('Missing admin protection');
}
echo "PASS: create, draft privacy, publish, escaped content, invalid upload rejection, delete, admin-only routes\n";
} finally { DB::rollBack(); }
