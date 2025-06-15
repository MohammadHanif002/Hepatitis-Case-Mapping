<?php

namespace App\Entities;

class KasusEntity
{
    private string $kecamatan;
    private int $jumlahKasus;
    private int $tahun;

    public function __construct(string $kecamatan, int $jumlahKasus, int $tahun)
    {
        $this->setKecamatan($kecamatan);
        $this->setJumlahKasus($jumlahKasus);
        $this->setTahun($tahun);
    }

    // Getter & Setter
    public function getKecamatan(): string
    {
        return $this->kecamatan;
    }

    public function setKecamatan(string $kecamatan): void
    {
        $this->kecamatan = $kecamatan;
    }

    public function getJumlahKasus(): int
    {
        return $this->jumlahKasus;
    }

    public function setJumlahKasus(int $jumlahKasus): void
    {
        $this->jumlahKasus = max(0, $jumlahKasus); // Enkapsulasi dengan validasi
    }

    public function getTahun(): int
    {
        return $this->tahun;
    }

    public function setTahun(int $tahun): void
    {
        $this->tahun = $tahun;
    }

    public function getZona(): string
    {
        return match (true) {
            $this->jumlahKasus >= 10 => 'Merah',
            $this->jumlahKasus >= 5 => 'Kuning',
            default => 'Hijau'
        };
    }
}
