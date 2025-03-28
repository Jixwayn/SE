<?php
include 'username.php';  // ตรวจสอบว่าไฟล์นี้มีการเชื่อมต่อฐานข้อมูลหรือไม่

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// รับค่า document_id และป้องกัน SQL Injection
$ids = isset($_GET['id']) ? intval($_GET['id']) : 0; // ใช้ intval() เพื่อให้แน่ใจว่าเป็นตัวเลข

if ($ids <= 0) {
    die("Error: Invalid document_id!");
}

// Query ข้อมูลเอกสาร
$document_sql = "SELECT document.*, category.category_name
                 FROM document
                 JOIN document_category ON document.document_id = document_category.document_id
                 JOIN category ON document_category.categoty_id = category.categoty_id
                 WHERE document.document_id = '$ids'";

// Debug SQL

$result_document = mysqli_query($conn, $document_sql);

// ตรวจสอบว่า Query ทำงานได้หรือไม่
if (!$result_document) {
    die("Query failed: " . mysqli_error($conn));
}

// ตรวจสอบว่ามีข้อมูลหรือไม่
$row = mysqli_fetch_assoc($result_document);
if (!$row) {
    die("No document found with ID: " . htmlspecialchars($ids));
}

// แปลง Keywords เป็น Array
$keyword_string = $row['document_keyword'];
$keywords = explode(",", $keyword_string);
$keywords = array_map('trim', $keywords); // ตัดช่องว่าง

$is_thesis = ($row['category_name'] == 'วิทยานิพนธ์');
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Details</title>
    <link rel="stylesheet" href="style_detailspage.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 style="font-family: 'Inter', sans-serif;"><?= htmlspecialchars($row['document_title']) ?></h1>
        <div class="info-box">
            <table class="info-table">
                <tr>
                    <td class="label">Other title</td>
                    <td class="value"><?= htmlspecialchars($row['document_title_english']) ?></td>
                </tr>
                <tr>
                    <td class="label">Creator</td>
                    <td class="value"><?= htmlspecialchars($row['document_author']) ?></td>
                </tr>
                <tr>
                    <td class="label">Creator in other language</td>
                    <td class="value"><?= htmlspecialchars($row['document_author_english']) ?></td>
                </tr>
                <tr>
                    <td class="label">Key word</td>
                    <td>
                        <div class="tags">
                            <?php foreach ($keywords as $keyword) : ?>
                                <span class="tag"><?= htmlspecialchars($keyword); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label">Description</td>
                    <td class="value"><?= nl2br(htmlspecialchars($row['document_description'])) ?></td>
                </tr>
                <tr>
                    <td class="label">Publisher</td>
                    <td class="value"><?= htmlspecialchars($row['document_publisher']) ?></td>
                </tr>
                <tr>
                    <td class="label">Language</td>
                    <td class="value"><?= htmlspecialchars($row['document_language']) ?></td>
                </tr>
                <tr>
                    <td class="label">Date of issued</td>
                    <td class="value"><?= htmlspecialchars($row['document_upload_date']) ?></td>
                </tr>
                <tr>
                    <td class="label">Category</td>
                    <td class="value"><?= htmlspecialchars($row['category_name']) ?></td>
                </tr>
            </table>

            <div class="footer">
                <span>Digital file</span>
                <?php if ($is_thesis && !empty($row['document_file'])): ?>
                    <a href="files/<?= urlencode($row['document_file']) ?>" target="_blank" class="pdf-button"> .PDF</a>
                    <!-- ถ้าเป็นวิทยานิพนธ์และมีไฟล์ PDF ให้แสดงปุ่มที่จะเปิดไฟล์ PDF -->
                    <a href="<?php echo $row['document_file']; ?>" target="_blank" class="pdf-button"> .PDF</a>
                <?php else: ?>
                    <button class="pdf-button" disabled>Not available</button>
                <?php endif; ?>
            </div>

            <div class="back-button">
                <a href="htmlHomepage.php" class="back-button-link">← Back</a>
            </div>
        </div>
    </div>
</body>

</html>
