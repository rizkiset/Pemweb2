<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
    <h2><?= $title; ?></h2>

    <form action="/books/update/<?= $buku['id']; ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <input type="hidden" name="slug" value="<?= $buku['slug']; ?>">

        <input type="hidden" name="sampulNama" value="<?= $buku['sampul']?>">

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" value="<?= old('judul', $buku['judul']); ?>"
                class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback"><?= $validation->getError('judul'); ?></div>
        </div>

        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" name="penulis" value="<?= old('penulis', $buku['penulis']); ?>"
                class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback"><?= $validation->getError('penulis'); ?></div>
        </div>

        <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" name="penerbit" value="<?= old('penerbit', $buku['penerbit']); ?>"
                class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback"><?= $validation->getError('penerbit'); ?></div>
        </div>

        <div class="mb-3">
            <label for="sampul" class="form-label">Sampul</label>
            <input type="file" name="sampul"
                class="form-control <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback"><?= $validation->getError('sampul'); ?></div>

            <img src="/img/<?= $buku['sampul']; ?>" alt="Sampul lama" width="100" class="mt-2">
            <p class="text-muted">Kosongkan jika tidak ingin mengganti sampul</p>
        </div>

        <button type="submit" class="btn btn-warning">Ubah Data</button>

        <div class="d-flex gap-2 mt-3">
            <button onclick="history.back()" class="btn btn-secondary">Kembali</button>
            
        </div>

    </form>
</div>

<?= $this->endSection(); ?>