
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_checklists', function (Blueprint $table) {
            $table->id();

            // Guru yang menginput checklist
            $table->foreignId('teacher_id')
                ->constrained('teachers')
                ->cascadeOnDelete();

            // Anak yang diamati
            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            // Kelas anak
            $table->foreignId('school_class_id')
                ->constrained('school_classes')
                ->cascadeOnDelete();

            $table->date('date');

            // Tema kegiatan
            $table->string('theme');

            // Konteks kegiatan per anak
            $table->text('context');

            // Hasil pengamatan
            $table->text('observation')
                ->nullable();

            // Status perkembangan
            $table->enum('status', ['SM', 'BM'])
                ->nullable();

            // Keterangan tambahan
            $table->text('notes')
                ->nullable();

            // Dokumentasi
            $table->string('evidence')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_checklists');
    }
};