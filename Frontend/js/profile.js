fetch("http://localhost/OursEvent/Backend/public/profile.php", {
  headers: { "X-Requested-With": "XMLHttpRequest" },
  credentials: "include",
})
  .then(async (response) => {
    if (!response.ok) {
      let text = await response.text();
      console.error("Profile fetch failed:", response.status, text);

      try {
        const parsed = JSON.parse(text);
        console.log("server-json-error:", parsed);
      } catch (e) {}

      if (response.status === 401) {
        console.log("User is not logged in (401).");
        return null;
      }
      throw new Error("HTTP error " + response.status);
    }

    return response.json();
  })
  .then((user) => {
    if (!user) return;

    if (user.error) {
      console.log("Profile error:", user.error);
      return;
    }

    document.getElementById("fullname").value = user.fullname || "";
    document.getElementById("phone").value = user.phone || "";
    document.getElementById("email").value = user.email || "";
    document.getElementById("institution").value = user.institution || "";
  })
  .catch((error) => console.log("Error (fetch/profile):", error));

document.getElementById("editBtn").addEventListener("click", function () {
  window.location.href = "edit_profile.html";
});
