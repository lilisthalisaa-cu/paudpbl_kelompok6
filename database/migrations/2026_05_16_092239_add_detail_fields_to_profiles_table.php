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
        Schema::table('profiles', function (Blueprint $table) {

            $table->string('npsn')->nullable();

            $table->string('address')->nullable();

            $table->string('email')->nullable();

            $table->string('phone')->nullable();

            $table->string('principal')->nullable();

            $table->string('established')->nullable();

            $table->text('vision')->nullable();

            $table->text('mission')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {

            $table->dropColumn([
                'npsn',
                'address',
                'email',
                'phone',
                'principal',
                'established',
                'vision',
                'mission'
            ]);

        });
    }
};