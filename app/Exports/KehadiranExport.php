<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KehadiranExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithCustomStartCell
{
	public  function __construct(public $tahun, public $bulan)
	{
	}

    public function collection()
    {
        $data = \App\Models\Kehadiran::with('pegawai:id_pegawai,nama_lengkap')
            ->select(
                'id_pegawai',
                'tgl_kehadiran',
                'jam_masuk',
                'jam_keluar',
                DB::raw("TIME_TO_SEC(TIMEDIFF(jam_masuk, '08:30:00'))/60 AS menit_keterlambatan")
            )
			->whereYear('tgl_kehadiran', $this->tahun)
			->whereMonth('tgl_kehadiran', $this->bulan)
            ->get()
            ->map(function ($item) {
                return [
                    'nama_lengkap' => $item->pegawai->nama_lengkap,
                    'tgl_kehadiran' => $item->tgl_kehadiran,
                    'jam_masuk' => $item->jam_masuk,
                    'jam_keluar' => $item->jam_keluar,
                    'menit_keterlambatan' => $item->menit_keterlambatan > 0 ?
                        round($item->menit_keterlambatan) : '-'
                ];
            });

        return $data;
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            'Nama Lengkap',
            'Tanggal Kehadiran',
            'Jam Masuk',
            'Jam Keluar',
            'Menit Keterlambatan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // TODO: Implement styles() method.
        return [
            2 => ['font' => ['bold' => true, 'size' => 14]],
        ];
    }

    public function startCell(): string
    {
        // TODO: Implement startCell() method.
        return 'B2';
    }
}
