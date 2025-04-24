<?php

namespace App\Models;

class MataKuliahModel
{
    private $data = [
        [
            'kode' => 'MKD123',
            'nama' => 'Matematika Diskrit',
            'sks' => 3,
            'dosen' => 'Nisa Ayunda S.Si., M.Si',
            'deskripsi' => 'Matematika Diskrit membahas logika matematika, relasi, dan teori graf.'
        ],
        [
            'kode' => 'PW456',
            'nama' => 'Pemrograman Web',
            'sks' => 4,
            'dosen' => 'Muhammad Miftakhul Syaikhuddin S.Kom, M.Kom',
            'deskripsi' => 'Pemrograman Web mencakup HTML, CSS, PHP, dan framework MVC.'
        ]
    ];

    public function findAll()
    {
        return $this->data;
    }

    public function find($kode)
    {
        foreach ($this->data as $item) {
            if ($item['kode'] === $kode) {
                return $item;
            }
        }
        return null;
    }
}
