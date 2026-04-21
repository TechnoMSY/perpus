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
$query = "SELECT * FROM books WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: index.php');
    exit;
}

$book = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($book['title']); ?> - Perpustakaan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
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
                <img src="<?php echo htmlspecialchars($book['cover']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
            </div>
            
            <div class="book-info">
                <h1><?php echo htmlspecialchars($book['title']); ?></h1>
                <p><strong>Penulis:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                <p><strong>Penerbit:</strong> <?php echo htmlspecialchars($book['publisher']); ?></p>
                <p><strong>ISBN:</strong> <?php echo htmlspecialchars($book['isbn']); ?></p>
                <p><strong>Tahun:</strong> <?php echo $book['year']; ?></p>
                <p><strong>Deskripsi:</strong></p>
                <p><?php echo nl2br(htmlspecialchars($book['description'])); ?></p>
                
                <a href="#" class="btn">Pinjam Buku</a>
            </div>
        </div>
    </div>
</body>
</html>