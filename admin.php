<?php
include 'username.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>เพิ่มเอกสาร</title>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="user-icon">
            <img src="user.png" alt="ไอคอนผู้ใช้">
        </div>
    </header>

    <!-- Title Bar -->
    <div class="title-bar">
        <div class="logo-container">
            <img src="logocsit.jpeg" alt="โลโก้ซ้าย" class="logo">
        </div>
        <h1>ระบบสืบค้นวิทยานิพนธ์ และผลงานสหกิจ</h1>
    </div>
    <!-- Form for Adding Document -->
    <section>
        <h2>เพิ่มเอกสารใหม่</h2>
        <form action="insert.php" method="POST" enctype="multipart/form-data">
            <label for="document_title">ชื่อเอกสาร:</label>
            <input type="text" id="document_title" name="document_title" placeholder="กรอกชื่อเอกสารภาษาไทย" required>

            <label for="document_title_english">ชื่อเอกสาร (ภาษาอังกฤษ):</label>
            <input type="text" id="document_title_english" name="document_title_english" placeholder="กรอกชื่อเอกสารภาษาอังกฤษ" required>

            <label for="document_author">ชื่อผู้จัดทำคนที่ 1 :</label>
            <input type="text" id="document_author" name="document_author" placeholder="กรอกชื่อผู้จัดทำภาษาไทย" required>

            <label for="document_author_english">ชื่อผู้จัดทำคนที่ 1 (ภาษาอังกฤษ):</label>
            <input type="text" id="document_author_english" name="document_author_english" placeholder="กรอกชื่อผู้จัดทำภาษาอังกฤษ" required>

            <label for="document_author_secon">ชื่อผู้จัดทำคนที่ 2 :</label>
            <input type="text" id="document_author_secon" name="document_author_secon" placeholder="กรอกชื่อผู้จัดทำภาษาไทย" required>

            <label for="document_author_secon_english">ชื่อผู้จัดทำคนที่ 2 (ภาษาอังกฤษ):</label>
            <input type="text" id="document_author_secon_english" name="document_author_secon_english" placeholder="กรอกชื่อผู้จัดทำภาษาอังกฤษ" required>

            <label for="document_description">คำอธิบายเอกสาร:</label>
            <textarea id="document_description" name="document_description" placeholder="กรอกคำอธิบายเอกสาร" required></textarea>

            <label for="document_keyword">Keyword:</label>
            <textarea id="document_keyword" name="document_keyword" placeholder="หากมี keyword หลายตัวให้คั่นด้วยเครื่องหมายคอมม่า (,)" required></textarea>

            <label for="document_publisher">สาขาวิชา:</label>
            <select id="document_publisher" name="document_publisher" required>
                <option value="" selected hidden>เลือกสาขาวิชา</option>
                <option value="computer_science">วิทยาการคอมพิวเตอร์</option>
                <option value="information_technology">เทคโนโลยีสารสนเทศ</option>
            </select>

            <label for="document_language">ภาษาที่ใช้ภายในเอกสาร:</label>
            <select id="document_language" name="document_language" required>
                <option value="" selected hidden>เลือกภาษาที่ใช้ภายในเอกสาร</option>
                <option value="thai">ไทย</option>
                <option value="english">English</option>
            </select>

            <label for="document_file" class="file-upload-btn">เลือกไฟล์ (PDF)</label>
            <input type="file" id="document_file" name="document_file" accept="application/pdf" class="file-input" required style="display: none;">


            <button type="submit" id="tbtn">เพิ่มเอกสาร</button>
        </form>
    </section>

</body>
<script>
    document.getElementById("tbtn").addEventListener("click", function() {
        // ดึงข้อมูลจากฟอร์ม
        let document_title = document.getElementById("document_title").value;
        let document_title_english = document.getElementById("document_title_english").value;
        let document_author = document.getElementById("document_author").value;
        let document_author_english = document.getElementById("document_author_english").value;
        let document_author_secon = document.getElementById("document_author_secon").value;
        let document_author_secon_english = document.getElementById("document_author_secon_english").value;
        let document_description = document.getElementById("document_description").value;
        let document_keyword = document.getElementById("document_keyword").value;
        let document_publisher = document.getElementById("document_publisher").value;
        let document_language = document.getElementById("document_language").value;

        // สร้างข้อมูลที่จะส่งไปยัง PHP
        let formData = {
            "document_title": document_title,
            "document_title_english": document_title_english,
            "document_author": document_author,
            "document_author_english": document_author_english,
            "document_author_secon": document_author_secon,
            "document_author_secon_english": document_author_secon_english,
            "document_description": document_description,
            "document_keyword": document_keyword,
            "document_publisher": document_publisher,
            "document_language": document_language
        };

        // ส่งข้อมูลไปยัง PHP
        fetch_order_equipment(formData);
    });

    const fetch_order_equipment = function(formData) {
        fetch('insert.php', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json; charset=utf-8"
                },
                body: JSON.stringify(formData) // ส่งข้อมูลไปในรูปแบบ JSON
            })
            .then(response => response.text()) // รับข้อมูลจาก PHP
            .then(data => {
                console.log("Response from PHP:", data); // แสดงข้อมูลที่ได้รับจาก PHP
            })
            .catch(error => {
                console.error('Error:', error); // หากเกิดข้อผิดพลาด
            });
    }
</script>

</html>