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
        Schema::create('temporary_files', function (Blueprint $table) {
            $table->id();
            $table->string('folder',  255);
            $table->string('file',  255)->default(null)->nullable();
            $table->string('filename',  255);
            $table->string('original', 255)->default(null)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporary_files');
    }
};
