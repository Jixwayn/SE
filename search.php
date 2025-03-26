<?php
include 'username.php';

$query = isset($_GET['query']) ? $_GET['query'] : "";
$category = isset($_GET['category']) ? $_GET['category'] : "";

$sql = "SELECT * FROM document WHERE document_title LIKE '%$query%'";
if (!empty($category)) {
    $sql .= " AND document_publisher = '$category'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="result-box">';
        echo '<strong>ชื่อเอกสาร:</strong> ' . htmlspecialchars($row['document_title']) . '<br>';
        echo '<strong>ผู้แต่ง:</strong> ' . htmlspecialchars($row['document_author']) . '<br>';
        echo '<strong>หมวดหมู่:</strong> ' . htmlspecialchars($row['document_publisher']) . '<br>';
        echo '<strong>วันที่อัปโหลด:</strong> ' . htmlspecialchars($row['document_upload_date']) . '<br>';
        echo '<button class="btn-detail" onclick="alert(\'ดูรายละเอียดของ ' . htmlspecialchars($row['document_title']) . '\')">ดูรายละเอียด</button>';
        echo '</div>';
    }
} else {
    echo "<p>ไม่พบข้อมูล</p>";
}

$conn->close();
?>
