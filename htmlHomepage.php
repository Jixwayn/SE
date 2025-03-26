<?php
header("Content-Type: text/html; charset=UTF-8");
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบสืบค้นวิทยานิพนธ์ และผลงานสหกิจ</title>
    <link rel="stylesheet" href="cssHomepage.css">
    <style>
        .search-results {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    gap: 15px;
    position: absolute;  /* ใช้ absolute positioning */
    top: 280px;           /* ตำแหน่งจากด้านบน */
    right: 0;            /* ขยับไปทางขวา */
    width: 1000px;        /* กำหนดความกว้างที่ต้องการ */
    padding: 15px;
    border: 1px solid #ddd; /* ขอบสีเทาอ่อน */
    border-radius: 8px; /* ขอบมน */
    background: #fafafa; /* เพิ่มพื้นหลังอ่อนๆ */
    box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1); /* เงาเบาๆ */
}

        .result-box {
            background: #ffffff;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #d3d3d3; /* ขอบสีเทาอ่อน */
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .result-box:hover {
            transform: translateY(-2px);
            box-shadow: 2px 4px 15px rgba(0, 0, 0, 0.1);
        }

        .result-box strong {
            color: #333;
        }

        .btn-detail {
            background: #5c67f2;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.2s;
        }

        .btn-detail:hover {
            background: #434fd3;
        }
    </style>
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

    <!-- Main Content -->
    <div class="container">
        <div class="search-container">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="ค้นหา">
                <button onclick="search()">🔍</button>
            </div>
        </div>
        
        <!-- แสดงผลการค้นหา -->
        <div id="searchResults" class="search-results"></div>

        <div class="content-container">
            <div class="filter-container">
                <div class="filter-box">
                    <select id="category">
                        <option value="">ประเภทหมวดหมู่</option>
                        <option value="วิทยานิพนธ์">วิทยานิพนธ์</option>
                        <option value="สหกิจ">สหกิจ</option>
                        <option value="ผลงาน">ผลงาน</option>
                    </select>
                </div>
                <div class="button-group">
                    <button class="search-btn" onclick="search()">ค้นหา</button>
                    <button class="cancel-btn" onclick="clearFilter()">ยกเลิก</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function search() {
            var query = document.getElementById("searchInput").value;
            var category = document.getElementById("category").value;

            var xhr = new XMLHttpRequest();
            xhr.open("GET", "search.php?query=" + query + "&category=" + category, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("searchResults").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        function clearFilter() {
            document.getElementById("searchInput").value = "";
            document.getElementById("category").value = "";
            document.getElementById("searchResults").innerHTML = "";
        }
    </script>

</body>
</html>