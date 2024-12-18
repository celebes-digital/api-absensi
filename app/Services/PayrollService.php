<?php

namespace App\Services;

use App\Models\Payroll;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Auth;

class PayrollService
{
    protected PegawaiService $pegawaiService;

    public function __construct(PegawaiService $pegawaiService)
    {
        $this->pegawaiService = $pegawaiService;
    }

    public function getPayrollByUser()
    {
        $pegawai = Pegawai::where('id_user', Auth::id())->firstOrFail();
        $payroll = Payroll::where('id_pegawai', $pegawai->id_pegawai)->get();
        $payroll->load('pegawai');

        return $payroll;
    }

    public function getAllPayroll()
    {
        $payroll = Payroll::all();
        $payroll->load('pegawai');

        return $payroll;
    }

    public function getPayrollById($id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->load('pegawai');
        $payroll->pegawai->load('gaji');

        return $payroll;
    }

    public function createPayroll($data)
    {
        $pegawai = $this->pegawaiService->getPegawaiById($data['id_pegawai']);
        $pegawai->load('gaji');

        if (!$pegawai) {
            throw new \Exception('Gagal menambahkan data payroll, pegawai tidak ditemukan');
        }

        $data['periode']            = date('Y-m-d');
        $data['total_pembayaran']   = $pegawai->gaji->gaji_pokok - $data['potongan'];
        $data['tanggal_bayar']      = date('Y-m-d');

        $payroll = Payroll::create($data);
        $payroll->load('pegawai');

        return $payroll;
    }

    public function updatePayroll($id, $data)
    {
        $payroll = $this->getPayrollById($id);
        $pegawai = $this->pegawaiService->getPegawaiById($data['id_pegawai']);
        $pegawai->load('gaji');

        $payroll->update([
            'total_pembayaran' => $pegawai->gaji->gaji_pokok - $data['potongan'],
            'potongan' => $data['potongan']
        ]);

        $payroll->load('pegawai');
        return $payroll;
    }

    public function deletePayroll($id)
    {
        $payroll = $this->getPayrollById($id);
        $payroll->delete();
    }
}
