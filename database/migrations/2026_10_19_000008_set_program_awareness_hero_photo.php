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

        DB::table('page_heroes')->where('key', 'program-awareness-education')->update([
            'image_path' => 'images/chf-program-awareness-education-board.jpg',
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        if (! Schema::hasTable('page_heroes')) {
            return;
        }

        DB::table('page_heroes')
            ->where('key', 'program-awareness-education')
            ->where('image_path', 'images/chf-program-awareness-education-board.jpg')
            ->update([
                'image_path' => 'images/chf-program-awareness-education-balanced.jpg',
                'updated_at' => now(),
            ]);
    }
};
