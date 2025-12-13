// -------Ruajtja e te dhenave ne local storage---------

const form = document.getElementById("registerForm"); // burimi i te dhenave

 form.addEventListener("submit", function(event){

      event.preventDefault();     // me parandalu rifreskimin e faqes

      localStorage.setItem("userData", JSON.stringify({  // ruajme te dhenat ne local storage(JSON.stringify per konvertim ne string)
        name : document.getElementById("name").value,
        lname: document.getElementById("lastname").value,
        username : document.getElementById("username").value,
        password : document.getElementById("password").value
      }))

      console.log(JSON.parse(localStorage.getItem("userData"))); // merren te dhenat nga local storage(JSON.parse i kthen prap ne objekt)

     alert("Ju jeni regjistruar!")
 });