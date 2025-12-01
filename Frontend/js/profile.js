const userProfile = {
    fullname: "Dylan Claudius",
    phone: "08123456789",
    email: "eventours@gmail.com",
    institution: "OursEvent Team"
};

document.getElementById("fullname").value = userProfile.fullname;
document.getElementById("phone").value = userProfile.phone;
document.getElementById("email").value = userProfile.email;
document.getElementById("institution").value = userProfile.institution;

document.getElementById("editBtn").addEventListener("click", () => {
    window.location.href = "edit_profile.html";
});
