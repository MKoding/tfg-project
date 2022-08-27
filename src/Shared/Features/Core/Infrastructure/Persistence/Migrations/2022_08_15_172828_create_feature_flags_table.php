<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feature_flags', function (Blueprint $table) {
            $table->string('name', 200)->primary();
            $table->boolean('is_enabled')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feature_flags');
    }
};
