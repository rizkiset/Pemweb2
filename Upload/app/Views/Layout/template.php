<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/style.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <div class="container">
      <a class="navbar-brand" href="/">SOP Kedai Kopi</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/about">Tentang</a></li>
          <li class="nav-item"><a class="nav-link" href="/books">Daftar Buku SOP</a></li>
          <li class="nav-item"><a class="nav-link" href="/contact">Kontak</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <?= $this->rendersection('content'); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <script>
    function previewImg() {
      const sampul = document.querySelector('#sampul'); // Mengambil elemen input file dengan ID 'sampul'
      const sampulLabel = document.querySelector('.custom-file-label'); // Mengambil elemen label untuk menampilkan nama file
      const imgPreview = document.querySelector('.img-preview'); // Mengambil elemen <img> untuk menampilkan preview

      // Memastikan ada file yang dipilih
      if (sampul.files.length > 0) {
        // Mengubah teks label menjadi nama file yang dipilih
        sampulLabel.textContent = sampul.files[0].name;

        // Membuat objek FileReader untuk membaca konten file
        const fileSampul = new FileReader();
        // Membaca file yang dipilih sebagai Data URL (base64 encoded string)
        fileSampul.readAsDataURL(sampul.files[0]);

        // Ketika FileReader selesai membaca file (onload event)
        fileSampul.onload = function(e) {
          // Mengatur atribut 'src' dari elemen imgPreview dengan hasil pembacaan file
          imgPreview.src = e.target.result;
        }
      } else {
        // Jika tidak ada file yang dipilih (misal, user membatalkan pilihan di dialog file)
        // Kembalikan teks label ke default
        sampulLabel.textContent = 'Pilih gambar...';
        // Kembalikan gambar preview ke gambar default.jpg
        imgPreview.src = '/img/default.jpg';
      }
    }
  </script>

</body>

</html>