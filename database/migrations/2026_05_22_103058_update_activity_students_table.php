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
        Schema::table('activity_students', function (Blueprint $table) {

            if (Schema::hasColumn('activity_students', 'artwork')) {
                $table->dropColumn('artwork');
            }

            if (Schema::hasColumn('activity_students', 'note')) {
                $table->dropColumn('note');
            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};