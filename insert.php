<?php
include 'username.php';  // เชื่อมต่อฐานข้อมูล

// รับข้อมูลที่ส่งมาจาก JavaScript
$data = json_decode(file_get_contents('php://input'), true);

// ตรวจสอบว่าได้รับข้อมูลครบถ้วนหรือไม่
if (isset($data['document_title'], $data['document_title_english'], $data['document_author'], $data['document_author_english'],
          $data['document_author_secon'], $data['document_author_secon_english'], $data['document_description'],
          $data['document_keyword'], $data['document_publisher'], $data['document_language'])) {

    // รับข้อมูลจากฟอร์ม
    $document_title = $data['document_title'];
    $document_title_english = $data['document_title_english'];
    $document_author = $data['document_author'];
    $document_author_english = $data['document_author_english'];
    $document_author_secon = $data['document_author_secon'];
    $document_author_secon_english = $data['document_author_secon_english'];
    $document_description = $data['document_description'];
    $document_keyword = $data['document_keyword'];
    $document_publisher = $data['document_publisher'];
    $document_language = $data['document_language'];

    // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO documents (
                document_title, document_title_english, document_author, document_author_english, 
                document_author_secon, document_author_secon_english, document_description, document_keyword, 
                document_publisher, document_language
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // เตรียมคำสั่ง SQL
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // ผูกพารามิเตอร์
        mysqli_stmt_bind_param($stmt, 'ssssssssss', 
            $document_title, $document_title_english, $document_author, $document_author_english,
            $document_author_secon, $document_author_secon_english, $document_description, $document_keyword,
            $document_publisher, $document_language
        );

        // ดำเนินการคำสั่ง SQL
        if (mysqli_stmt_execute($stmt)) {
            echo "เอกสารถูกเพิ่มลงในฐานข้อมูลเรียบร้อยแล้ว!";
        } else {
            echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . mysqli_error($conn);
        }

        // ปิดการเตรียมคำสั่ง
        mysqli_stmt_close($stmt);
    }
}
?>
