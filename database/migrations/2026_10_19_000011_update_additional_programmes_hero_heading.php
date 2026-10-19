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

        DB::table('page_heroes')->where('key', 'program-additional-programmes')->update([
            'title' => 'Play brings joy,',
            'highlight' => 'even during treatment.',
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        if (! Schema::hasTable('page_heroes')) {
            return;
        }

        DB::table('page_heroes')
            ->where('key', 'program-additional-programmes')
            ->where('title', 'Play brings joy,')
            ->where('highlight', 'even during treatment.')
            ->update([
                'title' => 'Space to be a child,',
                'highlight' => 'even during treatment.',
                'updated_at' => now(),
            ]);
    }
};
