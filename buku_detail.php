<?php
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT buku.*, kategori.kategori FROM buku JOIN kategori ON buku.id_kategori = kategori.id_kategori WHERE id_buku='$id'");
    $dta = mysqli_fetch_array($query);
?>
<div class="card shadow">
    <div class="card-header">
        <h3>Detail Buku</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 text-center">
                <?php if($dta['gambar']): ?>
                    <img src="uploads/<?= $dta['gambar']; ?>" alt="Gambar Buku" class="img-fluid rounded">
                <?php else: ?>
                    <div class="bg-light p-4 rounded">
                        <p class="text-muted">No image available</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-8">
                <h4 class="mb-3"><?= $dta['judul']; ?></h4>
                <p><strong>Kategori:</strong> <span class="badge badge-primary"><?= $dta['kategori']; ?></span></p>
                <p><strong>Penulis:</strong> <?= $dta['penulis']; ?></p>
                <p><strong>Penerbit:</strong> <?= $dta['penerbit']; ?></p>
                <p><strong>Tahun Terbit:</strong> <?= $dta['tahun_terbit']; ?></p>
                <p><strong>ISBN:</strong> <?= $dta['isbn']; ?></p>
                <p><strong>Jumlah:</strong> <?= $dta['jumlah']; ?></p>
                <hr>
                <h5>Sinopsis</h5>
                <div class="alert alert-light">
                    <?= nl2br($dta['sinopsis']); ?>
                </div>
                <a href="?page=buku" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
</div>