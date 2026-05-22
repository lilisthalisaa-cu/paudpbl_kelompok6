<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activity_students', function (Blueprint $table) {

            // hapus kolom lama
            $table->dropColumn([
                'artwork',
                'note'
            ]);

            // tambah kolom baru
            $table->text('desc_1')
                ->nullable();

            $table->text('desc_2')
                ->nullable();

            $table->text('desc_3')
                ->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('activity_students', function (Blueprint $table) {

            $table->dropColumn([
                'desc_1',
                'desc_2',
                'desc_3'
            ]);

            $table->text('artwork')
                ->nullable();

            $table->text('note')
                ->nullable();

        });
    }
};