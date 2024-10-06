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
        Schema::create('generals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->text('footer_text');
            $table->text('light_logo')->nullable();
            $table->text('dark_logo')->nullable();
            $table->text('favicon');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->string('keywords');
            $table->string('primary_color')->nullable();
            $table->string('dashboard_primary_color')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generals');
    }
};
