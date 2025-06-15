<?php

namespace App\Controllers;

use App\Models\BookModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Books extends BaseController
{
    protected $bukuModel;

    public function __construct()
    {
        $this->bukuModel = new BookModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Buku',
            'buku' => $this->bukuModel->findAll()
        ];

        return view('books/index', $data);
    }

    public function detail($slug)
    {
        $buku = $this->bukuModel->getBuku($slug);
        if (empty($buku)) {
            throw new PageNotFoundException("Judul buku '$slug' tidak ditemukan.");
        }

        $data = [
            'title' => 'Detail Buku',
            'buku' => $buku
        ];

        return view('books/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Buku',
            'validation' => \Config\Services::validation()
        ];
        return view('books/create', $data);
    }

    public function save()
    {
        // Aturan validasi untuk input buku.
        $rules = [
            'judul' => [
                'rules' => 'required|is_unique[books.judul]',
                'errors' => [
                    'required' => 'Kolom {field} buku harus diisi.',
                    'is_unique' => 'Judul buku ini sudah ada, gunakan judul lain.'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi.'
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi.'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar sampul terlalu besar, maksimal 1MB.',
                    'is_image' => 'File yang Anda pilih bukan gambar.',
                    'mime_in' => 'Format gambar sampul tidak valid, hanya JPG, JPEG, atau PNG yang diizinkan.'
                ]
            ]
        ];

        // Jalankan validasi
        if (!$this->validate($rules)) {
            return redirect()->to('/books/create')->withInput()->with('validation', $this->validator);
        }

        // Ambil file gambar dari request
        $fileSampul = $this->request->getFile('sampul');

        // Cek apakah tidak ada file yang diunggah (error 4 = UPLOAD_ERR_NO_FILE)
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg'; // Gunakan nama file gambar default
        } else {
            // Generate nama gambar unik
            $namaSampul = $fileSampul->getRandomName();

            // Pindahkan file gambar ke folder img
            // Pastikan folder 'img' ada di public/
            $fileSampul->move('img', $namaSampul);
        }

        // Siapkan data untuk disimpan ke database
        $slug = url_title($this->request->getVar('judul'), '-', true);

        $data = [
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ];

        $this->bukuModel->save($data);
        session()->setFlashdata('pesan', 'Data buku berhasil ditambahkan.');
        return redirect()->to('/books');
    }

    public function delete($id)
    {
        // Cari data buku berdasarkan ID
        $buku = $this->bukuModel->find($id);

        // Hapus file sampul fisik jika bukan 'default.jpg'
        if ($buku['sampul'] != 'default.jpg') {
            $path = FCPATH . 'img/' . $buku['sampul'];
            if (is_file($path)) {
                @unlink($path);
            }
        }

        // Hapus data buku dari database
        $this->bukuModel->delete($id);

        session()->setFlashdata('pesan', 'Data buku berhasil dihapus.');
        return redirect()->to('/books');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Buku',
            'validation' => \Config\Services::validation(),
            'buku' => $this->bukuModel->getBuku($slug)
        ];
        return view('books/edit', $data);
    }

    public function update($id)
    {
        $bukuLama = $this->bukuModel->find($id);

        $judulRule = ($bukuLama['judul'] == $this->request->getVar('judul')) ? 'required' : 'required|is_unique[books.judul]';

        $fileSampulBaru = $this->request->getFile('sampul');

        // Definisikan aturan dasar untuk validasi
        $rules = [
            'judul' => [
                'rules' => $judulRule,
                'errors' => [
                    'required' => 'Kolom {field} buku harus diisi.',
                    'is_unique' => 'Judul buku ini sudah ada, gunakan judul lain.'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi.'
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} harus diisi.'
                ]
            ]
        ];

        // Hanya tambahkan aturan validasi sampul jika ada file baru yang diunggah
        if ($fileSampulBaru->getError() !== 4) {
            $rules['sampul'] = [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar sampul terlalu besar, maksimal 1MB.',
                    'is_image' => 'File yang Anda pilih bukan gambar.',
                    'mime_in' => 'Format gambar sampul tidak valid, hanya JPG, JPEG, atau PNG yang diizinkan.'
                ]
            ];
        }

        // Jalankan validasi
        if (!$this->validate($rules)) {
            return redirect()->to('/books/edit/' . $bukuLama['slug'])->withInput()->with('validation', $this->validator);
        }

        $namaSampul = $this->request->getVar('sampulLama');

        if ($fileSampulBaru->getError() !== 4) {
            // Hapus file sampul lama jika bukan 'default.jpg'
            if ($bukuLama['sampul'] != 'default.jpg') {
                $pathLama = FCPATH . 'img/' . $bukuLama['sampul'];
                if (is_file($pathLama)) {
                    @unlink($pathLama);
                }
            }
            // Generate nama gambar baru dan pindahkan
            $namaSampul = $fileSampulBaru->getRandomName();
            $fileSampulBaru->move('img', $namaSampul);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->bukuModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data buku berhasil diubah.');
        return redirect()->to('/books');
    }
}
