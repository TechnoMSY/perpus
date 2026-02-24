<div class="w-100">
    <h2 class="mb-2 text-gray-800">Kategori Buku</h2>
           
    <?php  if($_SESSION['user']['level'] !='peminjam') : ?>
        <div class="mb-3">
            <a href="?page=kategori_tambah" class="btn btn-primary">Tambah Data</a>
        </div>   
     <?php endif;?>


    <!-- table kategori -->
    <div class="clearfix">
        <table class="table table-bordered" id="datatable" width = "100%" cellspasing>
            <thead>
                <th>NO</th>
                <th>Nama Kategori</th>
            <?php  if($_SESSION['user']['level'] !='peminjam') : ?>
                <th>Aksi</th>
            <?php endif;?>
            </thead>
            <tbody>
                <?php 
                    $query = mysqli_query($koneksi, "SELECT * FROM kategori");
                    $no = 1;
                    while($data = mysqli_fetch_array($query)):
                 ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['kategori']; ?></td>

                    <!-- Hanya bisa di buka oleh admin -->
                    <?php  if($_SESSION['user']['level'] !='peminjam') : ?>
                    <td>
                        <a href="?page=kategori_ubah&&id=<?= $data['id_kategori'];?>" class="btn btn-sm btn-info">Ubah</a>
                        <a href="?page=kategori_hapus&&id=<?php echo $data['id_kategori']; ?>" 
                            class="btn btn-danger"
                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                Hapus
                        </a>
                </tr>
                <?php
                endif;
                endwhile;
                ?>
            </tbody>
        </table>
    </div>
</div>