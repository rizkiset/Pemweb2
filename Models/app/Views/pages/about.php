<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-6 mb-4">
            <img src="/img/about.jpg" alt="Komik Shelf" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6">
            <h1 class="display-5 text-danger mb-3">SOP KEDAI KOPI</h1>
            <p class="lead">Selamat datang di <strong>Website SOP KEDAI KOPI </strong>, Sebuah panduan 
            sederhana untuk mengelola operasional kedai kopi, mulai dari penyajian menu hingga pelayanan
             pelanggan secara konsisten dan profesional. Oleh owner LUMIERE CAFFE</p>
            <p>Website ini dibuat dengan <strong>CodeIgniter 4</strong> dan menyediakan fitur CRUD lengkap, di
                antaranya:</p>
            <ul>
                <li> Tambahkan SOP menu baru lengkap dengan foto sajian, barista/Cooker yang meracik, dan asal bahan baku.</li>
                <li> Lihat detail SOP yang mudah dipahami</li>
                <li> Edit informasi SOP apa saja dan kapan saja</li>
                <li> Hapus SOP yang tidak dibutuhkan</li>
            </ul>
            <p>"Panduan ini cocok digunakan untuk pelatihan barista, 
                keperluan operasional harian, atau bahkan sebagai sistem katalog resep
                dan menu khas bagi pemilik kedai kopi.</p>
            <a href="/books" class="btn btn-danger mt-3">Lihat Koleksi SOP Kami</a>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>