<?php

namespace App\Http\Controllers;

use App\Models\DailyChecklist;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;


class DailyChecklistController extends Controller
{
    private function teacherData()
    {
        return Teacher::where('user_id', Auth::id())->firstOrFail();
    }

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
                    'Bermain pura-pura playground menggunakan benda di sekitar (kursi untuk perosotan/terowongan).',
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


        return $this->checklistKelasA();
    }


    public function index(Request $request)
    {
        $teacher = $this->teacherData();
        $dayNumber = 1;


        $records = DailyChecklist::with('student')
            ->where('teacher_id', $teacher->id)

            ->when($request->date, function ($query) use ($request) {
                $query->whereDate('date', $request->date);
            })

            ->when($request->theme, function ($query) use ($request) {
                $query->where(
                    'theme',
                    'like',
                    '%' . $request->theme . '%'
                );
            })

            ->when($request->student, function ($query) use ($request) {
=======
        if ($teacher->school_class_id == 1) {
            $checklistData = $this->checklistKelasA()[$dayNumber];
        } elseif ($teacher->school_class_id == 2) {
            $checklistData = $this->checklistKelasB()[$dayNumber];
        } else {
            abort(404, 'Kelas guru tidak ditemukan.');
        }

        $objectives = $checklistData['learning_objectives'];

        $records = DailyChecklist::with('student')
            ->where('teacher_id', $teacher->id)
            ->where('school_class_id', $teacher->school_class_id)
            ->when($request->filled('date'), function ($query) use ($request) {
                $query->whereDate('date', $request->date);
            })
            ->when($request->filled('theme'), function ($query) use ($request) {
                $query->where('theme', 'like', '%' . $request->theme . '%');
            })
            ->when($request->filled('student'), function ($query) use ($request) {

                $query->whereHas('student', function ($studentQuery) use ($request) {
                    $studentQuery->where('name', 'like', '%' . $request->student . '%');
                });
            })


            ->orderByDesc('date')
            ->orderBy('student_id')
            ->orderBy('id')
            ->get();


        // Kelompokkan berdasarkan tanggal, kelas, dan tema
        $groups = $records->groupBy(function ($record) {
            return $record->date . '|' .
                $record->school_class_id . '|' .
                $record->theme;
        });

        // Ambil kelompok checklist terbaru saja
        $groups = $groups->take(1);

        $displayRows = collect();

        foreach ($groups as $group) {

            // Kelompokkan lagi berdasarkan siswa
            $studentGroups = $group->groupBy('student_id');

            foreach ($studentGroups as $studentRecords) {

                // Urutkan data sesuai urutan tujuan pembelajaran
                $studentRecords = $studentRecords
                    ->sortBy('id')
                    ->values();

                $first = $studentRecords->first();

                $row = (object) [
                    'checklist_id' => $first->id,

        $grouped = $records
            ->groupBy(function ($item) {
                return $item->date . '|'
                    . $item->school_class_id . '|'
                    . $item->theme . '|'
                    . $item->student_id;
            })
            ->map(function ($items) use ($objectives) {
                $first = $items->first();

                $row = (object) [
                    'checklist_id' => $first->id,
                    'date' => $first->date,
                    'school_class_id' => $first->school_class_id,
                    'theme' => $first->theme,
                    'student_id' => $first->student_id,

                    'student' => $first->student,
                    'notes' => $first->notes,
                ];


                // Siapkan empat tujuan pembelajaran
                for ($i = 0; $i < 4; $i++) {

                    $item = $studentRecords->get($i);

                    $number = $i + 1;

                    $row->{'objective' . $number . '_context'} =
                        $item->context ?? '-';

                    $row->{'objective' . $number . '_status'} =
                        $item->status ?? '-';
                }

                $displayRows->push($row);
            }
        }

        // Pagination hasil yang sudah dikelompokkan
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $currentItems = $displayRows
            ->forPage($currentPage, $perPage)
            ->values();

        $checklists = new LengthAwarePaginator(
            $currentItems,
            $displayRows->count(),
            $perPage,
            $currentPage,

                foreach ($objectives as $index => $objective) {
                    $number = $index + 1;
                    $record = $items->firstWhere('learning_objective', $objective);

                    $row->{'objective_' . $number . '_context'} =
                        $record?->context ?? '-';

                    $row->{'objective_' . $number . '_status'} =
                        $record?->status ?? '-';

                    if ($record && $record->notes) {
                        $row->notes = $record->notes;
                    }
                }

                return $row;
            })
            ->values();

        $perPage = 10;
        $page = LengthAwarePaginator::resolveCurrentPage();

        $checklists = new LengthAwarePaginator(
            $grouped->forPage($page, $perPage)->values(),
            $grouped->count(),
            $perPage,
            $page,

            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );


        $students = Student::where(
            'school_class_id',
            $teacher->school_class_id
        )
            ->orderBy('name')
            ->get();


        return view(
            'teacher.checklist.index',
            compact('teacher', 'checklists')
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

        $students = Student::where('school_class_id', $teacher->school_class_id)
            ->orderBy('name')
            ->get();


        $dayNumber = 1;

        if ($teacher->school_class_id == 1) {
            $checklistData = $this->checklistKelasA()[$dayNumber];
        } elseif ($teacher->school_class_id == 2) {
            $checklistData = $this->checklistKelasB()[$dayNumber];
        } else {
            abort(404, 'Kelas guru tidak ditemukan.');
        }

        $today = now()->toDateString();

        return view(
            'teacher.checklist.create',
            compact('teacher', 'students', 'checklistData', 'today')
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

            'notes' => [
                'nullable',
                'string',
                'max:500'
            ],
        ]);

        /*
     * Simpan checklist untuk setiap tujuan pembelajaran
     * dan setiap siswa di kelas guru.
     */
        $notes = $request->input('notes');

        foreach ($checklistData['learning_objectives'] as $index => $objective) {

            $context = $checklistData['contexts'][$index] ?? null;

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

    public function show(int $id)
    {
        $teacher = $this->teacherData();

        // Ambil satu data sebagai acuan
        $firstChecklist = DailyChecklist::where(
            'teacher_id',
            $teacher->id
        )->findOrFail($id);

        // Ambil seluruh checklist pada tanggal, kelas, dan tema yang sama
        $checklists = DailyChecklist::with([
            'student',
            'teacher',
            'schoolClass'
        ])
            ->where('teacher_id', $teacher->id)
            ->whereDate('date', $firstChecklist->date)
            ->where('school_class_id', $firstChecklist->school_class_id)
            ->where('theme', $firstChecklist->theme)
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

        $today = now()->toDateString();
        $dayNumber = 1;

        if ($teacher->school_class_id == 1) {
            $checklistData = $this->checklistKelasA()[$dayNumber];
        } elseif ($teacher->school_class_id == 2) {
            $checklistData = $this->checklistKelasB()[$dayNumber];
        } else {
            return back()->with('error', 'Kelas guru tidak ditemukan.');
        }

        $request->validate([
            'checklists' => ['required', 'array'],
            'checklists.*.students' => ['required', 'array'],
            'checklists.*.students.*.status' => ['required', 'in:SM,BM'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $notes = $request->input('notes');

        DB::beginTransaction();

        try {
            foreach ($checklistData['learning_objectives'] as $index => $objective) {
                $context = $checklistData['contexts'][$index] ?? null;

                $students = $request->input(
                    "checklists.{$index}.students",
                    []
                );

                foreach ($students as $studentId => $studentData) {
                    $student = Student::where(
                        'school_class_id',
                        $teacher->school_class_id
                    )->find($studentId);

                    if (!$student) {
                        continue;
                    }

                    $status = $studentData['status'] ?? null;

                    if (!in_array($status, ['SM', 'BM'], true)) {
                        continue;
                    }

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
                            'status' => $status,
                            'notes' => $notes,
                        ]
                    );
                }
            }

            DB::commit();

            return redirect()
                ->route('teacher.checklist.index')
                ->with('success', 'Checklist harian berhasil disimpan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()
                ->withInput()
                ->with('error', 'Checklist gagal disimpan. Periksa kembali data dan coba lagi.');
        }
    }

    public function show($id)
    {
        $teacher = $this->teacherData();

        $firstChecklist = DailyChecklist::where('teacher_id', $teacher->id)
            ->findOrFail($id);

        $checklists = DailyChecklist::with([
            'student',
            'teacher',
            'schoolClass',
        ])
            ->where('teacher_id', $teacher->id)
            ->whereDate('date', $firstChecklist->date)
            ->where('school_class_id', $firstChecklist->school_class_id)
            ->where('theme', $firstChecklist->theme)
            ->orderBy('id')
            ->get();

        $students = Student::where(
            'school_class_id',
            $firstChecklist->school_class_id
        )
            ->orderBy('name')
            ->get();

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
