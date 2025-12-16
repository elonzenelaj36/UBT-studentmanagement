document.getElementById("registerForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const name = document.getElementById("name");
    const lastname = document.getElementById("lastname");
    const username = document.getElementById("username");
    const password = document.getElementById("password");

    const nameRegex = /^[A-Za-z]{2,}$/;
    const usernameRegex = /^[a-zA-Z0-9_]{4,15}$/;
    const passwordRegex =
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_])[A-Za-z\d@$!%*?&_]{8,}$/;

    const errors = {
        name: document.getElementById("nameError"),
        lastname: document.getElementById("lastnameError"),
        username: document.getElementById("usernameError"),
        password: document.getElementById("passwordError")
    };

    Object.values(errors).forEach(e => e.textContent = "");
    [name, lastname, username, password].forEach(i =>
        i.classList.remove("error-input")
    );

    let isValid = true;

    if (!nameRegex.test(name.value.trim())) {
        errors.name.textContent = "Emri duhet te ket se paku 2 shkronja!";
        name.classList.add("error-input");
        isValid = false;
    }

    if (!nameRegex.test(lastname.value.trim())) {
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

  let userData = JSON.parse(localStorage.getItem("userData"));

if (!Array.isArray(userData)) {
    userData = [];
}

userData.push({
    name: name.value.trim(),
    lastname: lastname.value.trim(),
    username: username.value.trim(),
    password: password.value
});

localStorage.setItem("userData", JSON.stringify(userData));

    e.target.reset();
});