<?php
include 'username.php';
$ids = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียด</title>
    <link rel="stylesheet" href="cssDetailspage.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
</head>

<body>
    <div class="container">
        <h1 style="font-family: 'Inter', sans-serif;">กล้วยน้ำว้าจากดาวนาเม็ก</h1>
        <div class="info-box">
            <table class="info-table">
                <tr>
                    <td class="label">Other title</td>
                    <td class="value">Banana From Star Namek</td>
                </tr>
                <tr>
                    <td class="label">Creator</td>
                    <td class="value">เปรี้ยว แซบ</td>
                </tr>
                <tr>
                    <td class="label">Creator in other language</td>
                    <td class="value">Preaw Zap’s</td>
                </tr>
                <tr>
                    <td class="label">Key word</td>
                    <td>
                        <div class="tags">
                            <span class="tag">banana</span>
                            <span class="tag">namek</span>
                            <span class="tag">star</span>
                            <span class="tag">กล้วย</span>
                            <span class="tag">กล้วยน้ำว้า</span>
                            <span class="tag">ดาวนาเม็ก</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label">Description</td>
                    <td class="value">
                        วิทยานิพนธ์นี้มุ่งเน้นไปที่การค้นหากล้วยน้ำว้าจากดาวนาเม็กโดยใช้ดาวเทียมและนำมาเปรียบเทียบกับกล้วยในประเทศไทย
                        โดยใช้เทคนิค Deep Learning และ CNN เก็บเป็น Database
                    </td>
                </tr>
                <tr>
                    <td class="label">Publisher</td>
                    <td class="value">ภาควิชาวิทยาการคอมพิวเตอร์ คณะวิทยาศาสตร์ มหาวิทยาลัยนเรศวร</td>
                </tr>
                <tr>
                    <td class="label">Language</td>
                    <td class="value">ไทย</td>
                </tr>
                <tr>
                    <td class="label">Date of issued</td>
                    <td class="value">2024</td>
                </tr>
                <tr>
                    <td class="label">Category</td>
                    <td class="value">วิทยานิพนธ์ (example: วิทยานิพนธ์, สหกิจ, ผลงาน)</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <span>Digital file</span>
            <button class="pdf-button">.PDF</button>
        </div>

    </div>
</body>

</html>