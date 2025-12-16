const loginForm = document.getElementById("loginForm");

loginForm.addEventListener("submit", function(event) {
    event.preventDefault();

    const savedUsers = JSON.parse(localStorage.getItem("userData")) || []; 

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    const successMessage = document.getElementById("success");
    const usernameError = document.getElementById("usernameError");
    const passwordError = document.getElementById("passwordError");

  
    successMessage.textContent = "";
    usernameError.textContent = "";
    passwordError.textContent = "";


    const user = savedUsers.find(u => u.username === username && u.password === password);

    if (user) {
        successMessage.textContent = "Login i suksesshëm!";
      
    } else {
        usernameError.textContent = "Username ose password gabim!";
    }
});
