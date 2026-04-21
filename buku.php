<div class="w-100">
    <h2 class="mb-2 text-gray-800">Daftar Buku</h2>
           
    <?php  if($_SESSION['user']['level'] !='peminjam') : ?>
        <div class="mb-3">
            <a href="?page=buku_tambah_tes" class="btn btn-primary">Tambah Data</a>
        </div>   
     <?php endif;?>

     <div class="card shadow-sm border-0 mb-4">
        <div class="card-body bg-white rounded">
            <form action="" method="get" class="row g-3">
                <input type="hidden" name="page" value="buku">
                <div class="col-md-3">
                    <input type="text" name="judul" class="form-control" placeholder="Nama Buku">
                </div>
                <div class="col-md-3">
                    <input type="text" name="tahun" class="form-control" placeholder="Tahun Terbit">
                </div>
                <div class="col-md-3">
                    <input type="text" name="penulis" class="form-control" placeholder="Penulis">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100 fw-bold">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <!-- table kategori -->
    <div class="clearfix">
        <table class="table table-bordered" id="datatable" width = "100%" cellspasing>
            <thead>
                <th>No.</th>
                <th>Judul</th>
                <th>Nama Kategori</th>
                <th>Gambar</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Sinopis</th>
                <th>Jumlah</th>
                <th>ISBN</th>
            <?php  if($_SESSION['user']['level'] !='peminjam') : ?>
                <th>Aksi</th>
            <?php endif;?>
            </thead>
            <tbody>
                <?php 
                    $query = mysqli_query($koneksi, "SELECT buku.*, kategori.kategori AS nama_kategori 
                                 FROM buku 
                                 JOIN kategori ON buku.id_kategori = kategori.id_kategori");
                    $no = 1;
                    while($data = mysqli_fetch_array($query)):
                 ?>
                <tr> 
                    <td><?=$no++; ?></td>
                    <td><?= $data['judul']; ?></td>
                    <td><?= $data['nama_kategori'] ?></td>
                    <td><img src="image/<?= $data['gambar']; ?>" alt="<?= $data['judul']; ?>" width="100px"></td>
                    <td><?= $data['penulis'] ?></td>
                    <td><?= $data['penerbit'] ?></td>
                    <td><?= $data['tahun_terbit'] ?></td>
                    <td><?= $data['sinopsis']; ?></td>
                    <td><?= $data['jumlah'] ?></td>
                    <td><?= $data['isbn'] ?></td>

                    <!-- Hanya bisa di buka oleh admin -->
                    <?php  if($_SESSION['user']['level'] !='peminjam') : ?>
                    <td>
                        <a href="?page=buku_detail&&id=<?= $data['id_buku'];?>" class="btn btn-sm btn-primary">Detail</a>
                        <a href="?page=buku_ubah&&id=<?= $data['id_buku'];?>" class="btn btn-sm btn-info">Ubah</a>
                        <a href="?page=buku_hapus&&id=<?= $data['id_buku']; ?>" class="btn btn-sm btn-danger btn-action" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                            Hapus
                        </a>
                    </td>
                    <?php endif;?>
                </tr>
                <?php
                endwhile;
                ?>
            </tbody>
        </table>
    </div>
</div>