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

        DB::table('page_heroes')->where('key', 'service-play-and-recreation-therapy')->update([
            'image_path' => 'images/chf-service-play-recreation-swing-care.jpg',
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        if (! Schema::hasTable('page_heroes')) {
            return;
        }

        DB::table('page_heroes')
            ->where('key', 'service-play-and-recreation-therapy')
            ->where('image_path', 'images/chf-service-play-recreation-swing-care.jpg')
            ->update([
                'image_path' => 'images/chf-hero-service-play-recreation.jpeg',
                'updated_at' => now(),
            ]);
    }
};
