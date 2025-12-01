// Script tombol, popup, loader, dll
document.addEventListener("DOMContentLoaded", () => {

    const loginBtn = document.querySelector(".login-btn");
    const signupLink = document.querySelector("#signup-link");

    loginBtn.addEventListener("click", () => {
        const email = document.querySelector("input[type='email']").value.trim();
        const password = document.querySelector("input[type='password']").value.trim();

        if (email === "" || password === "") {
            alert("Please fill out all fields!");
            return;
        }

        alert("Login Successful!");
        window.location.href = "index.html";
    });

    signupLink.addEventListener("click", (e) => {
        e.preventDefault();
        window.location.href = "register.html";
    });

});


