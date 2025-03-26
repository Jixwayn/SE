<?php
include 'username.php';

$query = isset($_GET['query']) ? $_GET['query'] : "";
$category = isset($_GET['category']) ? $_GET['category'] : "";

// เริ่มต้นคำสั่ง SQL ที่ค้นหาในหลายคอลัมน์ และเชื่อมตาราง advisor กับ document_advisor และ document
$sql = "SELECT d.*, a.advisor_name
        FROM document d
        LEFT JOIN document_advisor da ON d.document_id = da.document_id
        LEFT JOIN advisor a ON da.advisor_id = a.advisor_id
        WHERE 
            (d.document_title LIKE '%$query%' OR 
             d.document_title_english LIKE '%$query%' OR 
             d.document_keyword LIKE '%$query%' OR 
             a.advisor_name LIKE '%$query%')";

if (!empty($category)) {
    $sql .= " AND d.document_publisher = '$category'";  // กรองตามหมวดหมู่ (ถ้ามี)
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="result-box">';
        echo '<strong>ชื่อเอกสาร:</strong> ' . htmlspecialchars($row['document_title']) . '<br>';
        echo '<strong>ชื่อเอกสาร (ภาษาอังกฤษ):</strong> ' . htmlspecialchars($row['document_title_english']) . '<br>';
        echo '<strong>ชื่ออาจารย์ที่ปรึกษา:</strong> ' . htmlspecialchars($row['advisor_name']) . '<br>';
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
