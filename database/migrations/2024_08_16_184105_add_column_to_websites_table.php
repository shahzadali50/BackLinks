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
        Schema::table('websites', function (Blueprint $table) {
            $table->integer('da')->nullable()->after('diffusion_price');
            $table->integer('dr')->nullable()->after('da');
            $table->integer('pa')->nullable()->after('dr');
            $table->integer('cf')->nullable()->after('pa');
            $table->integer('tf')->nullable()->after('cf');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('websites', function (Blueprint $table) {
            $table->dropColumn(['da', 'dr', 'pa', 'cf', 'tf']);
        });
    }
};
