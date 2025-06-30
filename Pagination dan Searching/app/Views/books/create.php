<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <h2><?= $title; ?></h2>

    <form action="/books/save" method="post" enctype="multipart/form-data" id="bookForm">
        <?= csrf_field(); ?>

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" value="<?= old('judul'); ?>"
                class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback"><?= $validation->getError('judul'); ?></div>
        </div>

        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" name="penulis" id="penulis" value="<?= old('penulis'); ?>"
                class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback"><?= $validation->getError('penulis'); ?></div>
        </div>

        <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" name="penerbit" id="penerbit" value="<?= old('penerbit'); ?>"
                class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback"><?= $validation->getError('penerbit'); ?></div>
        </div>

        <div class="input-group mb-3">
            <input type="file" class="form-control <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>"
                id="sampul" name="sampul" onchange="previewImg()">
            <div class="invalid-feedback">
                <?= $validation->getError('sampul'); ?>
            </div>
            <label class="input-group-text" for="sampul">Upload</label>
        </div>

        <!-- Preview gambar -->
        <img src="/img/no-cover.jpg" class="img-thumbnail img-preview" width="100">

        <div class="d-flex gap-2 mt-3">
            <button onclick="history.back()" class="btn btn-secondary">Kembali</button>
            <button type="submit" class="btn btn-primary mt-3">Tambah Buku</button>
           
        </div>

    </form>
</div>

<!-- Validasi JavaScript -->
<script>
    document.getElementById('bookForm').addEventListener('submit', function (event) {
        let isValid = true;
        const fields = ['judul', 'penulis', 'penerbit', 'sampul'];

        fields.forEach(field => {
            const input = document.getElementById(field);
            if (input.type === 'file') {
                // Cek apakah pengguna telah memilih file
                if (input.files.length === 0) {
                    isValid = false;
                    input.classList.add('is-invalid');
                    input.nextElementSibling.textContent = "Gambar sampul harus diunggah";
                } else {
                    input.classList.remove('is-invalid');
                }
            } else {
                // Validasi input teks biasa
                if (input.value.trim() === '') {
                    isValid = false;
                    input.classList.add('is-invalid');
                    input.nextElementSibling.textContent = field.charAt(0).toUpperCase() + field.slice(1) + " tidak boleh kosong";
                } else {
                    input.classList.remove('is-invalid');
                }
            }
        });

        if (!isValid) {
            event.preventDefault();
        }
    });

    // Preview gambar sebelum diunggah
    function previewImg() {
        const sampul = document.querySelector('#sampul');
        const sampulLabel = document.querySelector('.input-group-text');
        const imgPreview = document.querySelector('.img-preview');

        if (sampul.files.length > 0) {
            sampulLabel.textContent = sampul.files[0].name;

            const fileReader = new FileReader();
            fileReader.readAsDataURL(sampul.files[0]);

            fileReader.onload = function (e) {
                imgPreview.src = e.target.result;
            }
        }
    }
</script>

<?= $this->endSection(); ?>