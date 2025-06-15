<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
    <h2><?= $title; ?></h2>

    <form action="/books/save" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" value="<?= old('judul'); ?>"
                class="form-control <?= (isset($validation) && $validation->hasError('judul')) ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback">
                <?= (isset($validation)) ? $validation->getError('judul') : ''; ?>
            </div>
        </div>

        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" name="penulis" value="<?= old('penulis'); ?>"
                class="form-control <?= (isset($validation) && $validation->hasError('penulis')) ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback">
                <?= (isset($validation)) ? $validation->getError('penulis') : ''; ?>
            </div>
        </div>

        <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" name="penerbit" value="<?= old('penerbit'); ?>"
                class="form-control <?= (isset($validation) && $validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback">
                <?= (isset($validation)) ? $validation->getError('penerbit') : ''; ?>
            </div>
        </div>

        <div class="mb-3">
            <label for="sampul" class="form-label">Sampul</label>
            <div class="input-group mb-3">
                <input type="file" class="form-control <?= (isset($validation) && $validation->hasError('sampul')) ? 'is-invalid' : ''; ?>"
                    id="sampul" name="sampul" onchange="previewImg()">
                <label class="input-group-text custom-file-label" for="sampul">Pilih gambar...</label>
                <?php if (isset($validation) && $validation->hasError('sampul')) : ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('sampul'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <img src="/img/default.jpg" class="img-thumbnail img-preview mt-2" style="width: 100px; height: 100px; object-fit: cover;">
        </div>

        <button type="submit" class="btn btn-primary">Tambah Data</button>
    </form>
</div>

<?= $this->endSection(); ?>