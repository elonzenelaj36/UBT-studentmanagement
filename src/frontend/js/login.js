const loginForm = document.getElementById("loginForm");

loginForm.addEventListener("submit", function(event){
    event.preventDefault();
 
    const savedUser = JSON.parse(localStorage.getItem("userData")); //marrja e te dhenave qe jan regjistruar ne register.js(localStorage)

    const username = document.getElementById("loginUsername").value; //marrja e te dhenave nga forma e login(ato qe i shkruan perdoruesi)
    const password = document.getElementById("loginPassword").value;
 
    if(savedUser && username === savedUser.username && password === savedUser.password){ //kontrolli nese te dhenat e futura perputhen me ato te regjistruara
        alert("Login i suksesshëm!");
    } else {
        alert("Username ose password gabim!");
    }
});


  