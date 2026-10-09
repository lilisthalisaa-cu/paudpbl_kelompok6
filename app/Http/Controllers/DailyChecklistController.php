<?php

namespace App\Http\Controllers;

use App\Models\DailyChecklist;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DailyChecklistController extends Controller
{
    private function teacherData()
    {
        return Teacher::where(
            'user_id',
            Auth::id()
        )->firstOrFail();
    }

    // Data checklist statis Kelas A berdasarkan Day 1 - Day 5
    private function checklistKelasA()
    {
        return [
            1 => [
                'theme' => 'REKREASI (1)',
                'learning_objectives' => [
                    'Anak mengenal doa sebelum bepergian',
                    'Anak berhitung sederhana jumlah benda/objek di tempat rekreasi (jumlah pohon, hewan).',
                    'Anak percaya diri menceritakan pengalaman rekreasinya',
                    'Anak mencoba aktivitas seni seperti menggambar atau mewarnai tempat rekreasi',
                ],
                'contexts' => [
                    'Mengajak anak membaca doa sebelum bepergian bersama-sama',
                    'Menunjukkan gambar atau mainan hewan dan menyebutkan namanya',
                    'Membacakan buku cerita “Pergi ke Kebun Binatang” dengan gambar menarik',
                    'Anak mewarnai gambar hewan favorit mereka, seperti gajah atau singa',
                ],
            ],

            2 => [
                'theme' => 'REKREASI (1)',
                'learning_objectives' => [
                    'Anak memahami pentingnya menjaga kebersihan di tempat rekreasi',
                    'Anak belajar berbagi kebahagiaan dengan teman',
                    'Anak mengenal berbagai bentuk (lingkaran, persegi, dll) dari benda di tempat rekreasi',
                    'Anak mencoba aktivitas seni seperti menggambar atau mewarnai tempat rekreasi',
                ],
                'contexts' => [
                    'Tanya jawab “Bagaimana cara menjaga taman bermain tetap bersih?”',
                    'Menyanyikan lagu anak-anak tentang bermain, seperti “Naik-naik ke Puncak Gunung”.',
                    'Bermain pura-pura di taman bermain (ayunan, perosotan dari kardus atau kursi).',
                    'Membuat miniatur taman bermain menggunakan kertas atau balok mainan',
                ],
            ],

            3 => [
                'theme' => 'REKREASI (1)',
                'learning_objectives' => [
                    'Anak mampu mengenal tempat rekreasi favoritnya',
                    'Anak mengenal berbagai bentuk (lingkaran, persegi, dll) dari benda di tempat rekreasi',
                    'Anak berhitung sederhana jumlah benda/objek di tempat rekreasi (jumlah pohon, hewan).',
                    'Anak mencoba aktivitas seni seperti menggambar atau mewarnai tempat rekreasi',
                ],
                'contexts' => [
                    'Membacakan cerita “Bermain Pasir di Pantai” sambil menunjuk gambar',
                    'Bermain pasir kering dan basah dalam wadah kecil untuk mengenali teksturnya',
                    'Berhitung benda dalam gambar pantai, seperti jumlah kerang atau pohon kelapa',
                    'Anak mewarnai gambar pemandangan pantai',
                ],
            ],

            4 => [
                'theme' => 'REKREASI (1)',
                'learning_objectives' => [
                    'Anak mampu menyampaikan pendapat tentang tempat yang ingin dikunjungi',
                    'Anak percaya diri menceritakan pengalaman rekreasinya',
                    'Anak mengenal berbagai bentuk (lingkaran, persegi, dll) dari benda di tempat rekreasi',
                    'Anak membuat prakarya sederhana seperti topi atau tiket mainan',
                ],
                'contexts' => [
                    'Bermain peran berbagi mainan atau tempat bermain bersama teman',
                    'Anak bercerita tentang bagian taman kota yang mereka sukai',
                    'Menggunting dan menghias “tiket masuk taman” dari kertas',
                    'Berpura-pura membeli tiket taman dan bermain di dalamnya',
                ],
            ],

            5 => [
                'theme' => 'REKREASI (1)',
                'learning_objectives' => [
                    'Anak belajar berbagi kebahagiaan dengan teman',
                    'Anak mengenal berbagai bentuk (lingkaran, persegi, dll) dari benda di tempat rekreasi',
                    'Anak berhitung sederhana jumlah benda/objek di tempat rekreasi (jumlah pohon, hewan).',
                    'Anak mencoba aktivitas seni seperti menggambar atau mewarnai tempat rekreasi',
                ],
                'contexts' => [
                    'Mengajarkan aturan bermain di playground, seperti tidak berebut mainan',
                    'Mengenali bentuk-bentuk (lingkaran, kotak) dari mainan di playground',
                    'Anak menyusun kalimat sederhana, contohnya “Aku suka bermain perosotan.”',
                    'Bermain pura” playground menggunakan benda di sekitar (kursi untuk perosotan/terowongan).',
                ],
            ],
        ];
    }

    private function checklistKelasB()
{
    return [
        1 => [
            'theme' => 'REKREASI (1)',
            'learning_objectives' => [
                'Anak mengenal doa sebelum bepergian',
                'Anak berhitung sederhana jumlah benda/objek di tempat rekreasi (jumlah pohon, hewan).',
                'Anak percaya diri menceritakan pengalaman rekreasinya',
                'Anak mencoba aktivitas seni seperti menggambar atau mewarnai tempat rekreasi',
            ],
            'contexts' => [
                'Mengajak anak membaca doa sebelum bepergian bersama-sama',
                'Menunjukkan gambar atau mainan hewan dan menyebutkan namanya',
                'Membacakan buku cerita “Pergi ke Kebun Binatang” dengan gambar menarik',
                'Anak mewarnai gambar hewan favorit mereka, seperti gajah atau singa',
            ],
        ],

        2 => [
            'theme' => 'REKREASI (1)',
            'learning_objectives' => [
                'Anak memahami pentingnya menjaga kebersihan di tempat rekreasi',
                'Anak belajar berbagi kebahagiaan dengan teman',
                'Anak mengenal berbagai bentuk (lingkaran, persegi, dll) dari benda di tempat rekreasi',
                'Anak mencoba aktivitas seni seperti menggambar atau mewarnai tempat rekreasi',
            ],
            'contexts' => [
                'Tanya jawab “Bagaimana cara menjaga taman bermain tetap bersih?”',
                'Menyanyikan lagu anak-anak tentang bermain, seperti “Naik-naik ke Puncak Gunung”.',
                'Bermain pura-pura di taman bermain (ayunan, perosotan dari kardus atau kursi).',
                'Membuat miniatur taman bermain menggunakan kertas atau balok mainan',
            ],
        ],

        3 => [
            'theme' => 'REKREASI (1)',
            'learning_objectives' => [
                'Anak mampu mengenal tempat rekreasi favoritnya',
                'Anak mengenal berbagai bentuk (lingkaran, persegi, dll) dari benda di tempat rekreasi',
                'Anak berhitung sederhana jumlah benda/objek di tempat rekreasi (jumlah pohon, hewan).',
                'Anak mencoba aktivitas seni seperti menggambar atau mewarnai tempat rekreasi',
            ],
            'contexts' => [
                'Membacakan cerita “Bermain Pasir di Pantai” sambil menunjuk gambar',
                'Bermain pasir kering dan basah dalam wadah kecil untuk mengenali teksturnya',
                'Berhitung benda dalam gambar pantai, seperti jumlah kerang atau pohon kelapa',
                'Anak mewarnai gambar pemandangan pantai',
            ],
        ],

        4 => [
            'theme' => 'REKREASI (1)',
            'learning_objectives' => [
                'Anak mampu menyampaikan pendapat tentang tempat yang ingin dikunjungi',
                'Anak percaya diri menceritakan pengalaman rekreasinya',
                'Anak mengenal berbagai bentuk (lingkaran, persegi, dll) dari benda di tempat rekreasi',
                'Anak membuat prakarya sederhana seperti topi atau tiket mainan',
            ],
            'contexts' => [
                'Bermain peran berbagi mainan atau tempat bermain bersama teman',
                'Anak bercerita tentang bagian taman kota yang mereka sukai',
                'Menggunting dan menghias “tiket masuk taman” dari kertas',
                'Berpura-pura membeli tiket taman dan bermain di dalamnya',
            ],
        ],

        5 => [
            'theme' => 'REKREASI (1)',
            'learning_objectives' => [
                'Anak belajar berbagi kebahagiaan dengan teman',
                'Anak mengenal berbagai bentuk (lingkaran, persegi, dll) dari benda di tempat rekreasi',
                'Anak berhitung sederhana jumlah benda/objek di tempat rekreasi (jumlah pohon, hewan).',
                'Anak mencoba aktivitas seni seperti menggambar atau mewarnai tempat rekreasi',
            ],
            'contexts' => [
                'Mengajarkan aturan bermain di playground, seperti tidak berebut mainan',
                'Mengenali bentuk-bentuk (lingkaran, kotak) dari mainan di playground',
                'Anak menyusun kalimat sederhana, contohnya “Aku suka bermain perosotan.”',
                'Bermain pura” playground menggunakan benda di sekitar (kursi untuk perosotan/terowongan).',
            ],
        ],
    ];
}

    public function index(Request $request)
    {
        $teacher = $this->teacherData();

        $students = Student::where(
            'school_class_id',
            $teacher->school_class_id
        )
        ->orderBy('name')
        ->get();

        $checklists = DailyChecklist::query()
            ->join(
                'school_classes',
                'daily_checklists.school_class_id',
                '=',
                'school_classes.id'
            )
            ->where(
                'daily_checklists.teacher_id',
                $teacher->id
            )

            // Filter tanggal
            ->when($request->date, function ($query) use ($request) {
                $query->whereDate(
                    'daily_checklists.date',
                    $request->date
                );
            })

            // Filter tema
            ->when($request->theme, function ($query) use ($request) {
                $query->where(
                    'daily_checklists.theme',
                    'like',
                    '%' . $request->theme . '%'
                );
            })

            // Filter siswa
            ->when($request->student, function ($query) use ($request) {
                $query->whereHas('student', function ($studentQuery) use ($request) {
                    $studentQuery->where(
                        'name',
                        'like',
                        '%' . $request->student . '%'
                    );
                });
            })

            ->select([
                'daily_checklists.date',
                'daily_checklists.school_class_id',
                'school_classes.name as class_name',
                'daily_checklists.theme',
            ])

            // ID salah satu checklist untuk tombol Lihat
            ->selectRaw(
                'MIN(daily_checklists.id) as checklist_id'
            )

            // Jumlah siswa
            ->selectRaw(
                'COUNT(DISTINCT daily_checklists.student_id) as student_count'
            )

            // Jumlah SM
            ->selectRaw(
                "SUM(CASE WHEN daily_checklists.status = 'SM' THEN 1 ELSE 0 END) as sm_count"
            )

            // Jumlah BM
            ->selectRaw(
                "SUM(CASE WHEN daily_checklists.status = 'BM' THEN 1 ELSE 0 END) as bm_count"
            )

            ->groupBy(
                'daily_checklists.date',
                'daily_checklists.school_class_id',
                'school_classes.name',
                'daily_checklists.theme'
            )

            ->orderByDesc('daily_checklists.date')

            ->paginate(10)

            ->withQueryString();

        return view(
            'teacher.checklist.index',
            compact(
                'teacher',
                'students',
                'checklists'
            )
        );
    }

    public function create()
    {
        $teacher = $this->teacherData();

        $students = Student::where(
            'school_class_id',
            $teacher->school_class_id
        )
        ->orderBy('name')
        ->get();

        // Menentukan Day berdasarkan hari
        $dayMap = [
            1 => 1, // Senin
            2 => 2, // Selasa
            3 => 3, // Rabu
            4 => 4, // Kamis
            5 => 5, // Jumat
        ];

        $dayNumber = 1;

        $checklistData = null;

        if ($dayNumber !== null) {

            if ($teacher->school_class_id == 1) {
                $checklistData = $this->checklistKelasA()[$dayNumber];
            }

            if ($teacher->school_class_id == 2) {
                $checklistData = $this->checklistKelasB()[$dayNumber];
            }
        }

        $today = now()->toDateString();

        return view(
            'teacher.checklist.create',
            compact(
                'teacher',
                'students',
                'checklistData',
                'today'
            )
        );
    }

    public function store(Request $request)
{
    $teacher = $this->teacherData();

    // Tanggal otomatis sesuai tanggal saat checklist disimpan
    $today = now()->toDateString();

    // Menentukan Day berdasarkan hari
    $dayNumber = 1;

    // Hanya Senin - Jumat
    if ($dayNumber < 1 || $dayNumber > 5) {
        return back()->with(
            'error',
            'Checklist hanya dapat diinput pada hari Senin sampai Jumat.'
        );
    }

    /*
     * Menentukan data checklist berdasarkan kelas guru.
     * ID 1 = Kelas A
     * ID 2 = Kelas B
     */
    if ($teacher->school_class_id == 1) {
        $checklistData = $this->checklistKelasA()[$dayNumber];
    } elseif ($teacher->school_class_id == 2) {
        $checklistData = $this->checklistKelasB()[$dayNumber];
    } else {
        return back()->with(
            'error',
            'Kelas guru tidak ditemukan.'
        );
    }

    $request->validate([
        'checklists' => [
            'required',
            'array'
        ],

        'checklists.*.students' => [
            'required',
            'array'
        ],

        'checklists.*.students.*.status' => [
            'required',
            'in:SM,BM'
        ],

        'checklists.*.notes' => [
            'nullable',
            'string',
            'max:500'
        ],
    ]);

    /*
     * Simpan checklist untuk setiap tujuan pembelajaran
     * dan setiap siswa di kelas guru.
     */
    foreach ($checklistData['learning_objectives'] as $index => $objective) {

        $context = $checklistData['contexts'][$index] ?? null;

        $notes = $request->checklists[$index]['notes'] ?? null;

        $students = $request->checklists[$index]['students'] ?? [];

        foreach ($students as $studentId => $studentData) {

            // Pastikan siswa memang berada di kelas guru
            $student = Student::where(
                'school_class_id',
                $teacher->school_class_id
            )
            ->find($studentId);

            if (!$student) {
                continue;
            }

            /*
             * Jika checklist pada tanggal yang sama sudah pernah
             * disimpan, data diperbarui.
             *
             * Jika tanggal berbeda, data lama tetap tersimpan.
             */
            DailyChecklist::updateOrCreate(
                [
                    'teacher_id' => $teacher->id,
                    'student_id' => $student->id,
                    'school_class_id' => $teacher->school_class_id,
                    'date' => $today,
                    'learning_objective' => $objective,
                ],
                [
                    'theme' => $checklistData['theme'],
                    'context' => $context,
                    'observation' => null,
                    'status' => $studentData['status'],
                    'notes' => $notes,
                ]
            );
        }
    }

    return redirect()
        ->route('teacher.checklist.index')
        ->with(
            'success',
            'Checklist harian berhasil disimpan.'
        );
    }

    public function show($id)
{
    $teacher = $this->teacherData();

    // Ambil satu data sebagai acuan tanggal dan kelas
    $firstChecklist = DailyChecklist::where(
        'teacher_id',
        $teacher->id
    )->findOrFail($id);

    // Ambil seluruh checklist pada tanggal dan kelas yang sama
    $checklists = DailyChecklist::with([
        'student',
        'teacher',
        'schoolClass'
    ])
    ->where(
        'teacher_id',
        $teacher->id
    )
    ->whereDate(
        'date',
        $firstChecklist->date
    )
    ->where(
        'school_class_id',
        $firstChecklist->school_class_id
    )
    ->orderBy('id')
    ->get();

    // Ambil seluruh siswa pada kelas tersebut
    $students = Student::where(
        'school_class_id',
        $firstChecklist->school_class_id
    )
    ->orderBy('name')
    ->get();

    // Kelompokkan berdasarkan tujuan pembelajaran
    $objectives = $checklists->groupBy('learning_objective');

    return view(
        'teacher.checklist.show',
        compact(
            'teacher',
            'firstChecklist',
            'checklists',
            'students',
            'objectives'
        )
    )->with('checklist', $firstChecklist);
}
}