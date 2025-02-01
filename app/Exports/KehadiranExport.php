<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KehadiranExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithCustomStartCell
{
    public function collection()
    {
        $data = \App\Models\Kehadiran::with('pegawai:id_pegawai,nama_lengkap')
            ->select(
                'id_pegawai',
                'tgl_kehadiran',
                'jam_masuk',
                'jam_keluar',
                DB::raw("IF(TIMESTAMPDIFF(MINUTE, '08:30:00', jam_masuk) > 0, TIMESTAMPDIFF(MINUTE, '08:30:00', jam_masuk), '-') AS menit_keterlambatan")
            )
            ->get()
            ->map(function ($item) {
                return [
                    'nama_lengkap' => $item->pegawai->nama_lengkap,
                    'tgl_kehadiran' => $item->tgl_kehadiran,
                    'jam_masuk' => $item->jam_masuk,
                    'jam_keluar' => $item->jam_keluar,
                    'menit_keterlambatan' => $item->menit_keterlambatan,
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
