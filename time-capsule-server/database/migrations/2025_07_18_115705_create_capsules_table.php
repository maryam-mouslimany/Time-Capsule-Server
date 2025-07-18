<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('capsules', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->string("title");
            $table->text('description');
            $table->longText('message');
            $table->string('status');
            $table->boolean('surprise_mode')->default(false);
            $table->string('color');
            $table->date('reveal_date');
            $table->string('ip_address');
            $table->string('country');
            $table->boolean('revealed')->default(false);
            $table->string('image_path')->nullable(); 
            $table->string('audio_path')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capsules');
    }
};
