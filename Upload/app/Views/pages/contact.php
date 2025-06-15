<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            <h2 class="text-primary">Hubungi Kami</h2>
            <p class="lead">Anda Punya saran, pertanyaan, atau ingin kerja sama seputar pengelolaan Kedai Kopi ?
                Kami siap membantu membuat kedai anda BERKEMBANG PESAT!</p>

            <ul class="list-unstyled">
                <li><strong>Email:</strong> lumiere.team@gmail.com</li>
                <li><strong>WhatsApp:</strong> +62 831-1775-2518</li>
                <li><strong>Instagram:</strong> @lumiere.caffe</li>
            </ul>

            <p>Jangan ragu untuk menghubungi kami kapan saja. Kami terbuka untuk kerjasama kapan saja, 
                atau hanya untuk diskusi santai !</p>
        </div>


        <div class="col-md-6">
            <h4 class="mb-3">Kirim Pesan</h4>
            <form>
                <div class="form-group mb-3">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" placeholder="Nama lengkap">
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Alamat email">
                </div>
                <div class="form-group mb-3">
                    <label for="message">Pesan</label>
                    <textarea class="form-control" id="message" rows="4"
                        placeholder="Tuliskan pesan Anda..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>