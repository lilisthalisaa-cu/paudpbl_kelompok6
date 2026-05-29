<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('development_notes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();

            $table->string('month');
            $table->integer('year');

            // 🔥 langsung sekalian aspek (biar ga perlu migration tambahan lagi)
            $table->string('motorik')->nullable();
            $table->string('kognitif')->nullable();
            $table->string('sosial')->nullable();

            $table->text('description');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('development_notes');
    }
};