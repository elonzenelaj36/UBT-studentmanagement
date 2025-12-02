

const form = document.getElementById("registerForm");

 form.addEventListener("submit", function(event){

      event.preventDefault();

      localStorage.setItem("userData", JSON.stringify({
        name : document.getElementById("name").value,
        lname: document.getElementById("lastname").value,
        username : document.getElementById("username").value,
        password : document.getElementById("password").value
      }))

      console.log(JSON.parse(localStorage.getItem("userData")));

     alert("Ju jeni regjistruar!")
 });