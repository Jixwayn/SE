<?php
include 'username.php';

$query = isset($_GET['query']) ? trim($_GET['query']) : "";
$category = isset($_GET['category']) ? trim($_GET['category']) : "";

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// สร้างคำสั่ง SQL พร้อม JOIN ตารางที่เกี่ยวข้อง
$sql = "SELECT d.*, c.category_name, a.advisor_name
        FROM document d
        LEFT JOIN document_category dc ON d.document_id = dc.document_id
        LEFT JOIN category c ON dc.category_id = c.category_id
        LEFT JOIN document_advisor da ON d.document_id = da.document_id
        LEFT JOIN advisor a ON da.advisor_id = a.advisor_id
        WHERE 1=1";  // เพิ่ม WHERE 1=1 เพื่อให้ง่ายในการใช้ AND สำหรับเงื่อนไข

$params = [];
$types = "";

// ถ้ามีคำค้นหา
if (!empty($query)) {
    $sql .= " AND (d.document_title LIKE ? 
                   OR d.document_title_english LIKE ? 
                   OR d.document_keyword LIKE ? 
                   OR a.advisor_name LIKE ?)";
    $params = array_fill(0, 4, "%$query%");
    $types .= str_repeat("s", 4);
}

// ถ้ามีหมวดหมู่
if (!empty($category)) {
    $sql .= " AND c.category_name = ?";
    $params[] = $category;
    $types .= "s";
}

// ตรวจสอบว่า SQL ไม่ว่างก่อน prepare()
if (!empty($sql)) {
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error in SQL: " . $conn->error);
    }

    // ถ้ามีพารามิเตอร์ให้ bind
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // แสดงผลลัพธ์
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="result-box">';
            echo '<strong>ชื่อเอกสาร:</strong> ' . htmlspecialchars($row['document_title']) . '<br>';
            echo '<strong>ชื่อเอกสาร (ภาษาอังกฤษ):</strong> ' . htmlspecialchars($row['document_title_english']) . '<br>';
            echo '<strong>ชื่ออาจารย์ที่ปรึกษา:</strong> ' . htmlspecialchars($row['advisor_name']) . '<br>';
            echo '<strong>หมวดหมู่:</strong> ' . htmlspecialchars($row['category_name']) . '<br>';
            echo '<strong>วันที่อัปโหลด:</strong> ' . htmlspecialchars($row['document_upload_date']) . '<br>';
            echo '<button class="btn-detail" onclick="window.location.href=\'Detailspage.php?id=' . $row['document_id'] . '\'">ดูรายละเอียด</button>';
            echo '</div>';
        }
    } else {
        echo "<p>ไม่พบข้อมูล</p>";
    }
}

$stmt->close();
$conn->close();
?>
