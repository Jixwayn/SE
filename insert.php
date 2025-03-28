<?php
include 'username.php';  // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // รับค่าจากฟอร์ม
    $document_title = $_POST['document_title'] ?? '';
    $document_title_english = $_POST['document_title_english'] ?? '';
    $document_author = $_POST['document_author'] ?? '';
    $document_author_english = $_POST['document_author_english'] ?? '';
    $document_author_secon = $_POST['document_author_secon'] ?? '';
    $document_author_secon_english = $_POST['document_author_secon_english'] ?? '';
    $document_description = $_POST['document_description'] ?? '';
    $document_keyword = $_POST['document_keyword'] ?? '';
    $document_publisher = $_POST['document_publisher'] ?? '';
    $document_language = $_POST['document_language'] ?? '';
    $advisor_id = $_POST['document_advisor']; // รับค่า advisor_id
    $document_category = $_POST['document_category']; // รับค่า category_id

    // ตรวจสอบไฟล์ที่อัปโหลด
    $document_file = "";
    if (isset($_FILES['document_file']) && $_FILES['document_file']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = "Files/"; // โฟลเดอร์อัปโหลดไฟล์
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // สร้างโฟลเดอร์ถ้ายังไม่มี
        }

        $file_name = basename($_FILES['document_file']['name']);
        $file_path = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['document_file']['tmp_name'], $file_path)) {
            $document_file = "Files/" . $file_name; // ให้แน่ใจว่าไม่มี "files/" ซ้ำซ้อน
        } else {
            echo "เกิดข้อผิดพลาดในการอัปโหลดไฟล์";
            exit();
        }
    }

    // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูลเอกสารลงในฐานข้อมูล
    $sql = "INSERT INTO document (
                document_title, document_title_english, document_author, document_author_english, 
                document_author_secon, document_author_secon_english, document_description, 
                document_keyword, document_publisher, document_language, document_file
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // เตรียมคำสั่ง SQL
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param(
            $stmt,
            'sssssssssss',
            $document_title,
            $document_title_english,
            $document_author,
            $document_author_english,
            $document_author_secon,
            $document_author_secon_english,
            $document_description,
            $document_keyword,
            $document_publisher,
            $document_language,
            $document_file
        );

        if (mysqli_stmt_execute($stmt)) {
            $document_id = mysqli_insert_id($conn); // ดึง document_id ที่เพิ่มล่าสุด

            // บันทึกข้อมูลอาจารย์ที่ปรึกษาในตาราง document_advisor
            $query_advisor = "INSERT INTO document_advisor (document_id, advisor_id) VALUES (?, ?)";
            if ($stmt_advisor = mysqli_prepare($conn, $query_advisor)) {
                mysqli_stmt_bind_param($stmt_advisor, 'ii', $document_id, $advisor_id);
                if (mysqli_stmt_execute($stmt_advisor)) {
                    echo "เอกสารถูกเพิ่มลงในฐานข้อมูลพร้อมไฟล์และข้อมูลอาจารย์ที่ปรึกษาแล้ว!";

                    // บันทึกข้อมูลประเภทเอกสารในตาราง document_category
                    $query_category = "INSERT INTO document_category (document_id, category_id) VALUES (?, ?)";
                    if ($stmt_category = mysqli_prepare($conn, $query_category)) {
                        mysqli_stmt_bind_param($stmt_category, 'ii', $document_id, $document_category);
                        if (mysqli_stmt_execute($stmt_category)) {
                            echo "ข้อมูลประเภทเอกสารถูกบันทึกแล้ว!";
                        } else {
                            echo "เกิดข้อผิดพลาดในการบันทึกข้อมูลประเภทเอกสาร: " . mysqli_error($conn);
                        }
                        mysqli_stmt_close($stmt_category);
                    }
                } else {
                    echo "เกิดข้อผิดพลาดในการบันทึกข้อมูลอาจารย์ที่ปรึกษา: " . mysqli_error($conn);
                }
                mysqli_stmt_close($stmt_advisor);
            }
        } else {
            echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูลเอกสาร: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>