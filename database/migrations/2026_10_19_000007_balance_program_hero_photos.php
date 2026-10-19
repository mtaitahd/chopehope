<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $images = [
        'program-accommodation' => 'images/chf-program-accommodation-balanced.jpg',
        'program-transport' => 'images/chf-program-transport-balanced.jpg',
        'program-emotional-support' => 'images/chf-program-emotional-support-balanced.jpg',
        'program-practical-support' => 'images/chf-program-practical-support-balanced.jpg',
        'program-awareness-education' => 'images/chf-program-awareness-education-balanced.jpg',
        'program-advocacy-collaboration' => 'images/chf-program-advocacy-collaboration-balanced.jpg',
        'program-additional-programmes' => 'images/chf-program-additional-programmes-balanced.jpg',
        'program-education-support' => 'images/chf-program-education-support-balanced.jpg',
    ];

    private array $previousImages = [
        'program-accommodation' => 'images/chf-accommodation-bunks.jpg',
        'program-transport' => 'images/chf-transport-vehicle.jpg',
        'program-emotional-support' => 'images/chf-hero-program-emotional-support.jpeg',
        'program-practical-support' => 'images/chf-hero-program-practical-support.jpeg',
        'program-awareness-education' => 'images/chf-hero-program-awareness-education.jpeg',
        'program-advocacy-collaboration' => 'images/chf-hero-program-advocacy-collaboration.jpeg',
        'program-additional-programmes' => 'images/chf-hero-program-additional-programmes.jpeg',
        'program-education-support' => 'images/chf-hero-program-education-support.jpeg',
    ];

    public function up(): void
    {
        if (! Schema::hasTable('page_heroes')) {
            return;
        }

        foreach ($this->images as $key => $path) {
            DB::table('page_heroes')->where('key', $key)->update([
                'image_path' => $path,
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('page_heroes')) {
            return;
        }

        foreach ($this->previousImages as $key => $path) {
            DB::table('page_heroes')
                ->where('key', $key)
                ->where('image_path', $this->images[$key])
                ->update([
                'image_path' => $path,
                'updated_at' => now(),
            ]);
        }
    }
};
