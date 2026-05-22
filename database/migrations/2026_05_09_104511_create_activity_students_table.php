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
        Schema::create('activity_students', function (Blueprint $table) {

            $table->id();

            $table->foreignId('activity_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->text('desc_1')
                ->nullable();

            $table->text('desc_2')
                ->nullable();

            $table->text('desc_3')
                ->nullable();

            $table->string('photo')
                ->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_students');
    }
};