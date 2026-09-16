
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teacher_attendances', function (Blueprint $table) {

            if (!Schema::hasColumn('teacher_attendances', 'status')) {
                $table->enum('status', [
                    'HADIR',
                    'IZIN',
                    'CUTI',
                    'SAKIT'
                ])->default('HADIR');
            }

            if (!Schema::hasColumn('teacher_attendances', 'note')) {
                $table->text('note')
                    ->nullable();
            }

            if (!Schema::hasColumn('teacher_attendances', 'surat')) {
                $table->string('surat')
                    ->nullable();
            }

        });
    }

    public function down(): void
    {
        Schema::table('teacher_attendances', function (Blueprint $table) {

            $columns = [];

            if (Schema::hasColumn('teacher_attendances', 'status')) {
                $columns[] = 'status';
            }

            if (Schema::hasColumn('teacher_attendances', 'note')) {
                $columns[] = 'note';
            }

            if (Schema::hasColumn('teacher_attendances', 'surat')) {
                $columns[] = 'surat';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }

        });
    }
};