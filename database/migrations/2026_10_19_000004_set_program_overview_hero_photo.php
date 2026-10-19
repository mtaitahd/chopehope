<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('page_heroes')) {
            return;
        }

        DB::table('page_heroes')->where('key', 'programs')->update([
            'image_path' => 'images/chf-program-overview-garden.jpg',
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        if (! Schema::hasTable('page_heroes')) {
            return;
        }

        DB::table('page_heroes')
            ->where('key', 'programs')
            ->where('image_path', 'images/chf-program-overview-garden.jpg')
            ->update([
                'image_path' => 'images/chf-creative-play.jpeg',
                'updated_at' => now(),
            ]);
    }
};
