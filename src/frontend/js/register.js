document.getElementById("registerForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const name = document.getElementById("name");
    const surname = document.getElementById("surname");
    const username = document.getElementById("username");
      const email = document.getElementById("email");
    const password = document.getElementById("password");

    const nameRegex = /^[A-Za-z]{2,}$/;
    const usernameRegex = /^[a-zA-Z0-9_]{4,15}$/;
   // const passwordRegex =
//        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_])[A-Za-z\d@$!%*?&_]{8,}$/;

    const errors = {
        name: document.getElementById("nameError"),
        surname: document.getElementById("surnameError"),
        email: document.getElementById("emailError"),
        username: document.getElementById("usernameError"),
        password: document.getElementById("passwordError")
    };

   // Object.values(errors).forEach(e => e.textContent = "");


    [name, surname, email, username, password].forEach(i =>
        i.classList.remove("error-input")
    );

    let isValid = true;

if (!nameRegex.test(surname.value.trim())) {
    errors.surname.textContent = "Mbiemri duhet te ket se paku 2 shkronja!";
    surname.classList.add("error-input");
    isValid = false;
}

    if (!nameRegex.test(surname.value.trim())) {
        errors.lastname.textContent = "Mbiemri duhet te ket se paku 2 shkronja!";
        lastname.classList.add("error-input");
        isValid = false;
    }

    if (!usernameRegex.test(username.value.trim())) {
        errors.username.textContent =
            "Username duhet te ket 4–15 karaktere dhe duhet te permbaj shkronja, numra, ose nenvije!.";
        username.classList.add("error-input");
        isValid = false;
    }

   if (!passwordRegex.test(password.value)) {
        errors.password.textContent =
            "Fjalëkalimi duhet të ketë të paktën 8 karaktere dhe të përfshijë shkronja të mëdha, shkronja të vogla, numra dhe një karakter special.";
        password.classList.add("error-input");
        isValid = false;
    } 

    if (!isValid) return;

const formData = new FormData(document.getElementById("registerForm"));

    fetch('/UBT-studentmanagement/src/backend/api/UserController.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.success){
     alert("registered");
        }
       else{
        
        alert("failed to register");
        }
    })
    .catch(err => {
       alert(err);
        console.error("Fetch error:", err);
    });

    e.target.reset();
});









//----------------------------------------------------------------------------------------


// // Register form validation
// const form = document.getElementById("registerForm");
// const nameInput = document.getElementById("name");
// const surnameInput = document.getElementById("surname");
// const passwordInput = document.getElementById("password");

// form.addEventListener("submit", function (e) {

//     let hasError = false;

//     // RESET error messages
//     document.querySelectorAll(".error").forEach(el => el.textContent = "");

//     // Name validation
//     if (nameInput.value.trim() === "") {
//         document.getElementById("nameError").textContent = "Name is required";
//         hasError = true;
//     }

//     // Surname validation
//     if (surnameInput.value.trim() === "") {
//         document.getElementById("surnameError").textContent = "Last name is required";
//         hasError = true;
//     }

//     // Password validation
//     if (passwordInput.value.length < 6) {
//         document.getElementById("passwordError").textContent =
//             "Password must be at least 6 characters";
//         hasError = true;
//     }

    
//     if (hasError) {
//         e.preventDefault();   // ndalon submit-in vetëm nëse ka gabime
//     }
// });
