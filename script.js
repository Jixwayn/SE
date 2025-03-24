function search() {
    var input = document.getElementById("searchInput").value.toLowerCase();
    var resultDiv = document.getElementById("results");

    if (input.includes("กล้วยน้ำว้า")) {
        resultDiv.style.display = "block";
    } else {
        resultDiv.style.display = "none";
    }
}
