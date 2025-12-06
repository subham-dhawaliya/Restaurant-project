<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            
            // Header Settings
            $table->string('site_name')->default('Yummy');
            $table->string('logo')->nullable();
            $table->string('header_phone')->nullable();
            $table->string('header_email')->nullable();
            $table->string('book_table_link')->default('#book-a-table');
            
            // Footer Settings
            $table->text('footer_about')->nullable();
            $table->string('footer_address')->nullable();
            $table->string('footer_phone')->nullable();
            $table->string('footer_email')->nullable();
            $table->string('footer_timing')->nullable();
            
            // Social Links
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();
            
            // Copyright
            $table->string('copyright_text')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
