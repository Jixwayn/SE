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

    <script src="script.js"></script>
</body>
</html>