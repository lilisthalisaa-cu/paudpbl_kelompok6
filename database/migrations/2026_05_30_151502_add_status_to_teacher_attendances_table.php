<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teacher_attendances', function (Blueprint $table) {

            $table->string('status')
                  ->default('HADIR')
                  ->after('date');

            $table->text('note')
                  ->nullable()
                  ->after('status');

            $table->string('surat')
                  ->nullable()
                  ->after('note');
        });
    }

    public function down(): void
    {
        Schema::table('teacher_attendances', function (Blueprint $table) {

            $table->dropColumn([
                'status',
                'note',
                'surat'
            ]);

        });
    }
};