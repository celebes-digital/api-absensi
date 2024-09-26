<?php

namespace App\Services;

use App\Models\Payroll;
use App\Models\Pegawai;

class PayrollService
{
    protected PegawaiService $pegawaiService;

    public function __construct(PegawaiService $pegawaiService)
    {
        $this->pegawaiService = $pegawaiService;
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

        if(!$pegawai) {
            throw new \Exception('Gagal menambahkan data payroll, pegawai tidak ditemukan');
        }    
        
        $data['periode']            = date('Y-m-d');    
        $data['total_pembayaran']   = $pegawai->gaji->gaji_pokok;
        $data['tanggal_bayar']      = date('Y-m-d');

        $payroll = Payroll::create($data);
        $payroll->load('pegawai');
        
        return $data;
    }

    public function updatePayroll($id, $data)
    {
        $payroll = $this->getPayrollById($id);
        $payroll->update($data);
        $payroll->load('pegawai');
        
        return $payroll;
    }

    public function deletePayroll($id)
    {
        $payroll = $this->getPayrollById($id);
        $payroll->delete();
    }
}