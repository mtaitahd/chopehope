<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::table('page_heroes')->where('key', 'news-updates')->update([
            'title' => 'News and',
            'highlight' => 'Updates',
            'intro' => 'Read the latest news about our activities and support for children with cancer and their families.',
        ]);
    }

    public function down(): void
    {
        // Preserve published copy and any subsequent staff edits.
    }
};
