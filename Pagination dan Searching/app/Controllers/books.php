<?php

namespace App\Controllers;

use App\Models\BookModel;

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
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Judul buku '$slug' tidak ditemukan.");
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
        if (
            !$this->validate([
                'judul' => 'required|is_unique[books.judul]',
                'penulis' => 'required',
                'penerbit' => 'required',
                'sampul' => [
                    'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran file terlalu besar',
                        'is_image' => 'File bukan gambar',
                        'mime_in' => 'Format tidak didukung'
                    ]
                ]
            ])
        ) {
            return redirect()->to('/books/create')->withInput()->with('validation', $this->validator);
        }

        $fileSampul = $this->request->getFile('sampul');
        $namaSampul = ($fileSampul->getError() == 4) ? 'no-cover.jpg' : $fileSampul->getRandomName();

        if ($fileSampul->isValid() && !$fileSampul->hasMoved()) {
            $fileSampul->move('img', $namaSampul);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->bukuModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data buku berhasil ditambahkan.');
        return redirect()->to('/books');
    }

    public function delete($id)
    {
        $buku = $this->bukuModel->find($id);

        if ($buku['sampul'] != 'no-cover.jpg') {
            $path = FCPATH . 'img/' . $buku['sampul'];
            if (is_file($path)) {
                @unlink($path);
            }
        }

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
        $bukuLama = $this->bukuModel->getBuku($this->request->getVar('slug'));

        $judulRule = ($bukuLama['judul'] == $this->request->getVar('judul')) ? 'required' : 'required|is_unique[books.judul]';

        if (
            !$this->validate([
                'judul' => $judulRule,
                'penulis' => 'required',
                'penerbit' => 'required',
                'sampul' => [
                    'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran file terlalu besar',
                        'is_image' => 'File bukan gambar',
                        'mime_in' => 'Format tidak didukung'
                    ]
                ]
            ])
        ) {
            return redirect()->to('/books/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $this->validator);
        }

        $fileSampul = $this->request->getFile('sampul');
        if ($fileSampul->getError() == 4) {
            $namaSampul = $bukuLama['sampul'];
        } else {
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('img', $namaSampul);

            if ($bukuLama['sampul'] != 'no-cover.jpg') {
                @unlink(FCPATH . 'img/' . $bukuLama['sampul']);
            }
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
