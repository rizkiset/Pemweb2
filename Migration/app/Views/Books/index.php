<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">Daftar SOP kedai</h1>

            <!-- Tombol tambah data buku -->
            <a href="/books/create" class="btn btn-primary mb-3">Tambah SOP kedai</a>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sampul SOP</th>
                        <th scope="col">Judul SOP</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($buku as $b): ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= esc($b['sampul']); ?>" alt="" width="100"></td>
                            <td><?= esc($b['judul']); ?></td>
                            <td>
                                <a href="/books/<?= esc($b['slug']); ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>