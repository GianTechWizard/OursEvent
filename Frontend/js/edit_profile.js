fetch("../../Backend/public/profile.php")
  .then((res) => res.json())
  .then((user) => {
    document.getElementById("fullname").value = user.fullname;
    document.getElementById("phone").value = user.phone;
    document.getElementById("email").value = user.email;
    document.getElementById("institution").value = user.institution;
  })
  .catch((err) => console.log(err));
