<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
<form action="" method="get" class="mb-3">
    <div class="input-group">
        <input type="text" class="form-control" name="keyword" placeholder="Cari nama penulis..." value="<?= esc($keyword ?? '') ?>">
        <button class="btn btn-primary" type="submit">Cari</button>
    </div>
</form>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1 + (10 * ($pageSekarang - 1)); 
                    foreach ($penulis as $p) : 
                    ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= esc($p['name']); ?></td>
                            <td><?= esc($p['address']); ?></td>
                            <td>
                                <a href="#" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            

<?= $pager->links('penulis', 'penulis_pager'); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
