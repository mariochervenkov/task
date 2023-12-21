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
        Schema::create('hotpoints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->string('name', 255)->unique();
            $table->unsignedInteger('position_x');
            $table->unsignedInteger('position_y');
            $table->unsignedInteger('activity');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotpoints');
    }
};
