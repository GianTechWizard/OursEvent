// ================================
// LOAD REGISTRATIONS (FINAL)
// ================================
async function loadRegistrations() {
  try {
    const response = await fetch(
      "http://localhost/OursEvent/Backend/public/my_registrasions.php"
    );

    const events = await response.json();

    const container = document.getElementById("event-list");
    const emptyMsg = document.getElementById("no-events");

    if (!events.length) {
      emptyMsg.style.display = "block";
      return;
    }

    // GROUP PER ID EVENT
    const grouped = {};

    events.forEach((ev) => {
      const id = ev.id_event;

      if (!grouped[id]) {
        grouped[id] = {
          id_event: id,
          judul_event: ev.judul_event,
          tanggal: ev.tanggal,
          jam: ev.jam,
          lokasi: ev.lokasi,
          harga: ev.harga,
          poster: ev.poster,

          jumlah_total: Number(ev.jumlah_tiket),
          biaya_total: Number(ev.total_biaya),

          daftar_ids: [Number(ev.id_daftar)],
          status_list: [ev.status],
        };
      } else {
        grouped[id].jumlah_total += Number(ev.jumlah_tiket);
        grouped[id].biaya_total += Number(ev.total_biaya);

        grouped[id].daftar_ids.push(Number(ev.id_daftar));
        grouped[id].status_list.push(ev.status);
      }
    });

    // TAMPILKAN CARD EVENT
    Object.values(grouped).forEach((ev) => {
      const card = document.createElement("div");
      card.classList.add("event-card");

      const posterURL = "../assets/img/" + ev.poster;

      card.innerHTML = `
        <img src="${posterURL}" class="event-img" />

        <div class="event-content">
          <h3>${ev.judul_event}</h3>

          <div class="event-dates">
            <div class="date-box">
              <p class="label">Tanggal</p>
              <p>${ev.tanggal}</p>
              <p>${ev.jam}</p>
            </div>
          </div>

          <p class="price">Rp. ${parseInt(ev.harga).toLocaleString()}</p>

          <button class="btn-detail" data-event='${JSON.stringify(ev)}'>
            Detail
          </button>

          <button class="btn-cancel" data-ids='${JSON.stringify(
            ev.daftar_ids
          )}'>
            Cancel
          </button>
        </div>
      `;

      container.appendChild(card);
    });
  } catch (err) {
    console.error("Fetch error:", err);
  }
}

loadRegistrations();

// ================================
// DETAIL MODAL
// ================================
function showDetail(ev) {
  document.getElementById("detailJudul").innerText =
    "Judul Event: " + ev.judul_event;

  document.getElementById("detailTanggal").innerText = "Tanggal: " + ev.tanggal;

  document.getElementById("detailJam").innerText = "Jam: " + ev.jam;

  document.getElementById("detailLokasi").innerText = "Lokasi: " + ev.lokasi;

  document.getElementById("detailTiket").innerText =
    "Jumlah Tiket: " + ev.jumlah_total;

  document.getElementById("detailTotal").innerText =
    "Total Biaya: Rp " + parseInt(ev.biaya_total).toLocaleString();

  document.getElementById("detailStatus").innerText =
    "Status Pembayaran: " +
    (ev.status_list.includes("Pending") ? "Pending" : ev.status_list[0]);

  document.getElementById("detailModal").classList.add("show");
}

function closeDetail() {
  document.getElementById("detailModal").classList.remove("show");
}

document.addEventListener("click", (e) => {
  if (e.target.classList.contains("btn-detail")) {
    const ev = JSON.parse(e.target.dataset.event);
    showDetail(ev);
  }
});

// ================================
// CANCEL EVENT — FINAL
// ================================
document.addEventListener("click", async (e) => {
  if (e.target.classList.contains("btn-cancel")) {
    const ids = JSON.parse(e.target.dataset.ids);

    if (!confirm("Cancel ALL registrations for this event?")) return;

    const response = await fetch(
      "http://localhost/OursEvent/Backend/public/cancel.php",
      {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ daftar_ids: ids }),
      }
    );

    const text = await response.text();
    console.log("Cancel response:", text);

    let result;
    try {
      result = JSON.parse(text);
    } catch {
      alert("Server error:\n" + text);
      return;
    }

    // SELALU SUKSES SESUAI OPSI A
    e.target.closest(".event-card").remove();
    alert("Event berhasil dibatalkan.");
  }
});
