<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('capsules', function (Blueprint $table) {
            $table->string('ip_address')->nullable()->change();
            $table->string('country')->nullable()->change();
        });
    }

    public function down(): void {}
};
