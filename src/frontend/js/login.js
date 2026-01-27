
const form = document.getElementById('loginForm');
const successMsg = document.getElementById('success');

form.addEventListener('submit', function(e) {
    e.preventDefault(); // prevent page reload

    // Grab the form data automatically
    const formData = new FormData(form);

    fetch('/UBT-studentmanagement/src/backend/api/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.success && data.user.role == "admin"){

            successMsg.style.color = 'green';
            successMsg.textContent = "Welcome  Admin! " + data.user.emri + "!";
            console.log("User data:", data.user);
            return;
        } else if(data.success){
                         successMsg.style.color = 'green';
            successMsg.textContent = "Welcome  student! " + data.user.emri + "!";
            console.log("User data:", data.user);
        }else{
        
            successMsg.style.color = 'red';
            successMsg.textContent = data.message || "Login failed"
        }
    })
    .catch(err => {
        successMsg.style.color = 'red';
        successMsg.textContent = "An error occurred";
        console.error("Fetch error:", err);
    });
});
