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

        DB::table('page_heroes')->where('key', 'about')->update([
            'image_path' => 'images/abaut.png',
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        if (! Schema::hasTable('page_heroes')) {
            return;
        }

        DB::table('page_heroes')
            ->where('key', 'about')
            ->where('image_path', 'images/abaut.png')
            ->update([
                'image_path' => 'images/chf-children-art-activities.jpeg',
                'updated_at' => now(),
            ]);
    }
};
