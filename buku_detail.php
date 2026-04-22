<?php
session_start();
require 'config.php';

// Validasi ID buku
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);

// Query detail buku
$query = "SELECT * FROM buku WHERE id_buku = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: index.php');
    exit;
}

$buku = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($buku['judul']); ?> - Perpustakaan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; margin: 0 0 15px 0; }
        @media (max-width: 600px) {
            .book-detail {
                flex-direction: column;
                align-items: center;
            }
            .book-cover {
                width: 100%;
                max-width: 200px;
            }
            .book-info {
                text-align: center;
            }
        }
        p { color: #666; line-height: 1.6; margin: 10px 0; }
        a { color: #007bff; }
        .container { max-width: 800px; margin: 0 auto; }
        .book-detail { display: flex; gap: 20px; }
        .book-cover { width: 200px; }
        .book-cover img { width: 100%; }
        .book-info { flex: 1; }
        .btn { padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php">← Kembali</a>
        
        <div class="book-detail">
            <div class="book-cover">
                <img src="<?php echo htmlspecialchars($buku['gambar']); ?>" alt="<?php echo htmlspecialchars($buku['judul']); ?>">
            </div>
            
            <div class="book-info">
                <h1><?php echo htmlspecialchars($buku['judul']); ?></h1>
                <p><strong>Penulis:</strong> <?php echo htmlspecialchars($buku['penulis']); ?></p>
                <p><strong>Kategori:</strong> <?php echo htmlspecialchars($buku['kategori']); ?></p>
                <p><strong>Penerbit:</strong> <?php echo htmlspecialchars($buku['penerbit']); ?></p>
                <p><strong>ISBN:</strong> <?php echo htmlspecialchars($buku['isbn']); ?></p>
                <p><strong>Tahun:</strong> <?php echo $buku['tahun_terbit']; ?></p>
                <p><?php echo nl2br(htmlspecialchars($buku['sinopsis'])); ?></p>
                
                <a href="#" class="btn">Pinjam Buku</a>
            </div>
        </div>
    </div>
</body>
</html>