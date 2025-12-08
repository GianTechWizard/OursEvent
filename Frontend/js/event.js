let currentEventId = null;
async function loadEvents() {
  try {
    const response = await fetch(
      "http://localhost/OursEvent/Backend/public/events.php"
    );

    const events = await response.json();

    const container = document.getElementById("event-grid");
    const emptyMsg = document.getElementById("no-events");

    if (!Array.isArray(events) || events.length === 0) {
      emptyMsg.style.display = "block";
      return;
    }

    events.forEach((ev) => {
      const div = document.createElement("div");
      div.classList.add("event-card");

      div.innerHTML = `
        <img src="${ev.poster_url}" class="event-img" />

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

          <button class="btn detail"
            onclick="showDetail(${ev.id_event})">
            Details
          </button>
        </div>
      `;

      container.appendChild(div);
    });
  } catch (err) {
    console.error("Error load events:", err);
  }
}

async function showDetail(id) {
  try {
    const res = await fetch(
      `http://localhost/OursEvent/Backend/public/event_detail.php?id=${id}`
    );
    const ev = await res.json();

    if (ev.error) {
      alert("Event not found");
      return;
    }

    currentEventId = ev.id_event;

    document.getElementById("modalImg").src = ev.poster_url;
    document.getElementById("modalTitle").innerText = ev.judul_event;
    document.getElementById("modalSpeaker").innerText =
      "Pembicara: " + ev.pembicara;

    document.getElementById("modalDescription").innerText = ev.deskripsi;

    document.getElementById("modalQuota").innerText = "Kuota: " + ev.kuota;

    document.getElementById("modalDate").innerText = "Tanggal: " + ev.tanggal;
    document.getElementById("modalTime").innerText = "Waktu: " + ev.jam;
    document.getElementById("modalLocation").innerText = "Lokasi: " + ev.lokasi;
    document.getElementById("modalPrice").innerText =
      "Rp. " + parseInt(ev.harga).toLocaleString();

    document.getElementById("eventModal").style.display = "flex";
  } catch (e) {
    console.error("Error detail:", e);
  }
}

async function buyTicket() {
  if (!currentEventId) {
    alert("Invalid event");
    return;
  }

  const formData = new FormData();
  formData.append("id_event", currentEventId);
  formData.append("jumlah_tiket", 1);

  try {
    const res = await fetch(
      "http://localhost/OursEvent/Backend/process/register_event_process.php",
      {
        method: "POST",
        body: formData,
        credentials: "include", // WAJIB agar PHP session terkirim
        headers: {
          "X-Requested-With": "XMLHttpRequest", // WAJIB agar dianggap AJAX
        },
      }
    );

    const text = await res.text();
    console.log("Server response:", text);

    alert("Successfully registered for the event!");
    closeModal();

    window.location.href = "index.html";
  } catch (e) {
    console.error("Error register:", e);
    alert("Failed to purchase a ticket");
  }
}

function closeModal() {
  document.getElementById("eventModal").style.display = "none";
}

loadEvents();
