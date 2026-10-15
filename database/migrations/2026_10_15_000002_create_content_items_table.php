<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('content_items', function (Blueprint $table) {
            $table->id();
            $table->string('type', 20)->index();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('summary', 500);
            $table->longText('body');
            $table->string('hero_image')->nullable();
            $table->string('status', 20)->default('draft')->index();
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamp('event_starts_at')->nullable();
            $table->timestamp('event_ends_at')->nullable();
            $table->string('location')->nullable();
            $table->date('closes_at')->nullable();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_items');
    }
};
