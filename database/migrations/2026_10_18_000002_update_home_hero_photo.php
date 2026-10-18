<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Apply the approved homepage photo even when the hero was saved in the CMS.
        DB::table('page_heroes')->where('key', 'home')->update([
            'image_path' => 'images/chf-community-group.jpeg',
        ]);
    }

    public function down(): void
    {
        // Retain content so rollback cannot overwrite a later staff photo selection.
    }
};
