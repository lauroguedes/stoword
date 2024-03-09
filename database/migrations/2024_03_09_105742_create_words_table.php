<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ipa')->nullable();
            $table->string('translate');
            $table->json('meaning');
            $table->string('part_of_speech')->nullable();
            $table->string('plural')->nullable();
            $table->string('synonyms')->nullable();
            $table->string('forms')->nullable();
            $table->json('sentences');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('words');
    }
};
