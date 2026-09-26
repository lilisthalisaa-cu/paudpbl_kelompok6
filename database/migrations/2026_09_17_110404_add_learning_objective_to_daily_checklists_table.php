<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('daily_checklists', function (Blueprint $table) {
            $table->text('learning_objective')
                ->after('theme');
        });
    }

    public function down(): void
    {
        Schema::table('daily_checklists', function (Blueprint $table) {
            $table->dropColumn('learning_objective');
        });
    }
};