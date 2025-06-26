<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Ubah Data Buku</h2>

            <form action="/books/update/<?= $buku['id']; ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $buku['slug']; ?>">

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="<?= $buku['judul']; ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" class="form-control" id="penulis" name="penulis" value="<?= $buku['penulis']; ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" id="penerbit" name="penerbit"
                        value="<?= $buku['penerbit']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="sampul" class="form-label">Nama File Sampul (contoh: buku1.jpg)</label>
                    <input type="text" class="form-control" id="sampul" name="sampul" value="<?= $buku['sampul']; ?>"
                        required>
                </div>

                <button type="submit" class="btn btn-primary">Ubah Data</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>