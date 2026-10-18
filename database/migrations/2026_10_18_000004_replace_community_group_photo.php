<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::table('page_heroes')->whereIn('image_path', [
            'images/chf-community-group.jpeg',
            'images/chf-community-group-enhanced.png',
            'images/chf-community-group-cropped.png',
        ])->update(['image_path' => 'images/abaut.png']);
    }

    public function down(): void
    {
        // Do not restore a photo withdrawn from publication.
    }
};
