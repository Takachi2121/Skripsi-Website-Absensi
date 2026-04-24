<?php

namespace App\Exports;

use App\Models\Absensi;
use App\Models\jadwal;
use App\Models\Jurusan;
use App\Models\kelas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AbsensiExport implements FromView, WithEvents, ShouldAutoSize
{
    protected $tgl;

    public function __construct($tgl)
    {
        $this->tgl = $tgl;
    }

    public function view(): View
    {
        // Mengubah format tanggal menjadi format yang diterima oleh database
        $tgl = date('d-m-Y', strtotime($this->tgl));

        // Menambahkan filter berdasarkan tanggal ke dalam query
        $report_info = Absensi::groupBy('kelas')->where('tgl_absen', $tgl)->first();
        $report = Absensi::where('tgl_absen', $tgl)
            ->where('kelas', $report_info->kelas)
            ->get();
        $kelas = kelas::where('kelas', $report_info->kelas)->first();
        $jurusan = Jurusan::where('jur_id', $kelas->jur_id)->first();
        $matkul = jadwal::where('matkul', $report_info->mataKuliah)->pluck('jam_mulai');

        return view('Absensi.report', compact('report', 'report_info', 'jurusan', 'matkul'));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:Z100')->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

                // Mendapatkan semua sel yang memiliki teks
                $nonEmptyCells = $event->sheet->getDelegate()->getCellCollection()->getCoordinates();

                // Menghilangkan border pada sel-sel yang berisi teks tertentu
                foreach ($nonEmptyCells as $cell) {
                    $value = $event->sheet->getDelegate()->getCell($cell)->getValue();

                    // Cek apakah sel memiliki teks dan bukan teks berikut atau value tertentu
                    if ($value !== null && !in_array($value, ['JURUSAN', 'KELAS', 'HARI', 'TANGGAL LAPORAN'])) {
                        $event->sheet->getDelegate()->getStyle($cell)->applyFromArray([
                            'borders' => [
                                'outline' => [
                                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                    'color' => ['argb' => '000000'],
                                ],
                            ],
                        ]);
                    }
                }
            },
        ];
    }
}
