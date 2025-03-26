<?php
include 'username.php';
$ids = isset($_GET['id']) ? $_GET['id'] : 0;

$document_sql = "SELECT document.*, category.category_name
            FROM document
            JOIN document_category ON document.document_id = document_category.document_id
            JOIN category ON document_category.category_id = category.category_id
            WHERE document.document_id = '$ids'";
$result_document = mysqli_query($conn, $document_sql);
$row = mysqli_fetch_assoc($result_document);

$keyword_string = $row['document_keyword'];
$keywords = explode(",", $keyword_string); // แปลงเป็นอาร์เรย์โดยใช้ explode
$keywords = array_map('trim', $keywords); // ตัดช่องว่างออกจากแต่ละค่าในอาร์เรย์

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
</head>

<body>
    <div class="container">
        <h1 style="font-family: 'Inter', sans-serif;"><?= $row['document_title'] ?></h1>
        <div class="info-box">
            <table class="info-table">
                <tr>
                    <td class="label">Other title</td>
                    <td class="value"><?= $row['document_title_english'] ?></td>
                </tr>
                <tr>
                    <td class="label">Creator</td>
                    <td class="value"><?= $row['document_author'] ?></td>
                </tr>
                <tr>
                    <td class="label">Creator in other language</td>
                    <td class="value"><?= $row['document_author_english'] ?></td>
                </tr>
                <tr>
                    <td class="label">Key word</td>
                    <td>
                        <div class="tags">
                            <?php foreach ($keywords as $keyword) : ?>
                                <span class="tag"><?php echo htmlspecialchars($keyword); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label">Description</td>
                    <td class="value">
                        <?= $row['document_description'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="label">Publisher</td>
                    <td class="value"><?= $row['document_publisher'] ?></td>
                </tr>
                <tr>
                    <td class="label">Language</td>
                    <td class="value"><?= $row['document_language'] ?></td>
                </tr>
                <tr>
                    <td class="label">Date of issued</td>
                    <td class="value"><?= $row['document_upload_date'] ?></td>
                </tr>
                <tr>
                    <td class="label">Category</td>
                    <td class="value"><?= $row['category_name'] ?></td>
                </tr>
            </table>
            <div class="footer">
                <span>Digital file</span>
                <?php if ($is_thesis && !empty($row['document_file'])): ?>
                    <!-- ถ้าเป็นวิทยานิพนธ์และมีไฟล์ PDF ให้แสดงปุ่มที่จะเปิดไฟล์ PDF -->
                    <a href="files/<?php echo $row['document_file']; ?>" target="_blank" class="pdf-button"> .PDF</a>
                <?php else: ?>
                    <!-- ถ้าไม่ใช่วิทยานิพนธ์ หรือไม่มีไฟล์ PDF จะแสดงปุ่ม disabled -->
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