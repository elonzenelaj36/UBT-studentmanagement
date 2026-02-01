
// const form = document.getElementById('loginForm');
// const successMsg = document.getElementById('success');

// form.addEventListener('submit', function(e) {
//     e.preventDefault(); // prevent page reload

//     // Grab the form data automatically
//     const formData = new FormData(form);

//     fetch('/UBT-studentmanagement/src/backend/api/UserController.php', {
//         method: 'POST',
//         body: formData
//     })
//     .then(response => response.json())
//     .then(data => {
//         if(data.success && data.user.role == "admin"){

//             successMsg.style.color = 'green';
//             successMsg.textContent = "Welcome  Admin! " + data.user.emri + "!";
//             console.log("User data:", data.user);
//             return;
//         } else if(data.success){
//                          successMsg.style.color = 'green';
//             successMsg.textContent = "Welcome  student! " + data.user.emri + "!";
//             console.log("User data:", data.user);
//         }else{
        
//             successMsg.style.color = 'red';
//             successMsg.textContent = data.message || "Login failed"
//         }
//     })
//     .catch(err => {
//         successMsg.style.color = 'red';
//         successMsg.textContent = "An error occurred";
//         console.error("Fetch error:", err);
//     });
// });



const form = document.getElementById("loginForm");
const emailInput = document.getElementById("username"); // HTML input ka name="email"
const passwordInput = document.getElementById("password");

form.addEventListener("submit", function(e) {
    let hasError = false;
    document.querySelectorAll(".error").forEach(el => el.textContent = "");

    // Email validation
    if (emailInput.value.trim() === "") {
        document.getElementById("usernameError").textContent = "Email is required";
        hasError = true;
    }

    // Password validation
    if (passwordInput.value.length < 6) {
        document.getElementById("passwordError").textContent = "Password must be at least 6 characters";
        hasError = true;
    }

    if (hasError) {
        e.preventDefault(); // ndalon submit
    }
});
