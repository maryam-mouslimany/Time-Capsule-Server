<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('capsules', function (Blueprint $table) {
        $table->string('identifier')->after('audio_path')->nullable()->unique();
    });
    }

    
    public function down(): void
    {
        //
    }
};
