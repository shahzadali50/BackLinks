<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('web_url')->unique();
            $table->text('web_description');
            $table->string('audience');
            $table->integer('images_per_post');
            $table->string('post_link');
            $table->string('link_type');
            $table->json('categories');
            $table->json('delicated_topics');
            $table->string('sponsorship');
            $table->boolean('publish_web')->default(0);
            $table->boolean('publish_categories')->default(0);
            $table->decimal('normal_price', 8, 2)->nullable();
            $table->decimal('dedicated_price', 8, 2)->nullable();
            $table->decimal('800_words',8, 2)->nullable();
            $table->decimal('1000_words',8, 2)->nullable();
            $table->decimal('1200_words',8, 2)->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('x_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->decimal('diffusion_price', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('websites');
    }
};
