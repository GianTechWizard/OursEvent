document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("form");
    const inputs = document.querySelectorAll(".form-input");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const nama = inputs[0].value.trim();
        const telp = inputs[1].value.trim();
        const instansi = inputs[2].value.trim();
        const email = inputs[3].value.trim();
        const pass = inputs[4].value.trim();
        const cpass = inputs[5].value.trim();

        if (nama === "") {
            alert("Nama Lengkap is required");
            return;
        }

        if (telp === "") {
            alert("Nomor Telepon is required!");
            return;
        }

        if (instansi === "") {
            alert("Institusi is required!");
            return;
        }

        if (email === "") {
            alert("Email is required!");
            return;
        }

        if (pass === "") {
            alert("Password is required!");
            return;
        }

        if (cpass === "") {
            alert("Confirm Password is required!");
            return;
        }

        if (pass !== cpass) {
            alert("Password dan Confirm Password do not match!");
            return;
        }

        window.location.href = "../pages/login.html";
    });
});
