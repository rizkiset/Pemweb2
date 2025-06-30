<?php

namespace App\Controllers;

use App\Models\PenulisModel;
use CodeIgniter\Controller;
use PSpell\Config;

class Penulis extends BaseController
{
    protected $penulisModel;

    public function __construct()
    {
        // Inisialisasi model PenulisModel
        $this->penulisModel = new PenulisModel();
    }

    public function index()
{
    $keyword = $this->request->getVar('keyword');
    $pageSekarang = $this->request->getVar('page_penulis') ?? 1;

    if ($keyword) {
        $penulis = $this->penulisModel->search($keyword);
    } else {
        $penulis = $this->penulisModel;
    }

    $data = [
        'title'        => 'Daftar Penulis',
        'penulis'      => $penulis->paginate(10, 'penulis'),
        'pager'        => $this->penulisModel->pager,
        'pageSekarang' => $pageSekarang,
        'keyword'      => $keyword,
    ];

    return view('penulis/index', $data);
}
}