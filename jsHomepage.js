function search() {
    // ดึงค่าจากช่องค้นหา
    const searchTerm = document.getElementById("searchInput").value.trim();
    
    // ตรวจสอบว่ามีการกรอกคำค้นหาหรือไม่
    if (searchTerm === "") {
        alert("กรุณากรอกคำค้นหา");
        return;
    }

    // ค้นหาผลลัพธ์ (ในที่นี้สมมติว่าเราค้นหาจากข้อมูลใน Array)
    const data = [
        "วิทยานิพนธ์ด้าน AI",
        "ผลงานสหกิจที่เกี่ยวข้องกับการพัฒนาโปรแกรม",
        "วิทยานิพนธ์ทางการแพทย์",
        "การศึกษาและงานวิจัยด้านเทคโนโลยีสารสนเทศ"
    ];

    // กรองข้อมูลที่ตรงกับคำค้นหา
    const results = data.filter(item => item.includes(searchTerm));

    // แสดงผลลัพธ์
    const resultsContainer = document.getElementById("searchResults");

    if (results.length > 0) {
        resultsContainer.innerHTML = "<h3>ผลการค้นหา:</h3><ul>" +
            results.map(item => `<li>${item}</li>`).join("") +
            "</ul>";
    } else {
        resultsContainer.innerHTML = "<h3>ไม่พบผลลัพธ์ที่ตรงกับคำค้นหา</h3>";
    }
}
