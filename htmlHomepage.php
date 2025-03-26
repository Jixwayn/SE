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
            display: none; /* ซ่อนผลลัพธ์ตอนเริ่มต้น */
            flex-direction: column;
            gap: 15px;
            position: absolute;
            top: 280px;
            right: 0;
            width: 1000px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fafafa;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
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
                    <select id="category" onchange="filterResults()">
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
            var input = document.getElementById("searchInput").value.toLowerCase(); // รับค่าจาก input
            var category = document.getElementById("category").value; // รับค่าจาก category
            var resultDiv = document.getElementById("searchResults"); // ผลลัพธ์ที่จะแสดง

            // ส่งคำค้นหาไปยัง search.php
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "search.php?query=" + input + "&category=" + category, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    resultDiv.innerHTML = xhr.responseText; // แสดงผลลัพธ์จาก server
                    resultDiv.style.display = 'block'; // แสดงผลลัพธ์
                    filterResults(input, category); // เรียกใช้ฟังก์ชันกรองข้อมูล
                }
            };
            xhr.send();
        }

        function filterResults(input = "", category = "") {
            var resultDiv = document.getElementById("searchResults");
            var resultBoxes = resultDiv.getElementsByClassName("result-box");

            // กรองข้อมูลตามคำค้นหาและหมวดหมู่ที่เลือก
            for (var i = 0; i < resultBoxes.length; i++) {
                var box = resultBoxes[i];
                var boxContent = box.textContent || box.innerText;

                var showBox = true;

                // กรองด้วยคำค้นหา
                if (input && !boxContent.toLowerCase().includes(input)) {
                    showBox = false;
                }

                // กรองด้วยหมวดหมู่
                if (category && box.getAttribute("data-category") !== category) {
                    showBox = false;
                }

                // แสดงหรือซ่อนผลลัพธ์ตามเงื่อนไข
                box.style.display = showBox ? "block" : "none";
            }
        }

        function clearFilter() {
            document.getElementById("searchInput").value = "";
            document.getElementById("category").value = "";
            document.getElementById("searchResults").innerHTML = "";
            document.getElementById("searchResults").style.display = 'none'; // ซ่อนผลลัพธ์เมื่อยกเลิก
        }
    </script>

</body>
</html>
