
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });

        // Cocokkan akun orang tua menggunakan NISN siswa.
        // Akun yang tidak ditemukan akan dibiarkan tanpa relasi.
        DB::statement("
            UPDATE students s
            LEFT JOIN users u
                ON u.username = s.nisn
                AND u.role = 'parent'
            SET s.parent_id = u.id
        ");

        Schema::table('students', function (Blueprint $table) {
            $table->foreign('parent_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });

        // Kembalikan relasi berdasarkan NISN ke parent_accounts.
        DB::statement("
            UPDATE students s
            LEFT JOIN parent_accounts pa
                ON pa.nisn = s.nisn
            SET s.parent_id = pa.id
        ");

        Schema::table('students', function (Blueprint $table) {
            $table->foreign('parent_id')
                ->references('id')
                ->on('parent_accounts')
                ->cascadeOnDelete();
        });
    }
};
