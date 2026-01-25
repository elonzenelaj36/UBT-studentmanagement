
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
        if(data.success){
            // Login successful
            successMsg.style.color = 'green';
            successMsg.textContent = "Welcome " + data.student.emri + "!";
            console.log("User data:", data.student);
        } else {
            // Login failed
            successMsg.style.color = 'red';
            successMsg.textContent = data.message || "Login failed";
        }
    })
    .catch(err => {
        successMsg.style.color = 'red';
        successMsg.textContent = "An error occurred";
        console.error("Fetch error:", err);
    });
});
