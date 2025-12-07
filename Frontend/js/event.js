
function openModal(img, title, date, time, location, price) {
  document.getElementById("modalImg").src = img;
  document.getElementById("modalTitle").innerText = title;
  document.getElementById("modalDate").innerText = "Tanggal: " + date;
  document.getElementById("modalTime").innerText = "Waktu: " + time;
  document.getElementById("modalLocation").innerText = "Lokasi: " + location;
  document.getElementById("modalPrice").innerText = price;

  document.getElementById("eventModal").style.display = "flex";
}

function closeModal() {
  document.getElementById("eventModal").style.display = "none";
}