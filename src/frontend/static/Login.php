<!DOCTYPE html>
<html>
    <!-- -_________________________________________________________ -->
    <head>
        <link rel="stylesheet" href="../css/Login.css">
    </head>
    <!-- -_________________________________________________________ -->

<body>
    <!-- Header -->
<header class="ubt-header">
    <div class="logo">
        <img src="../fotot/UBT-LOGO.png" alt="UBT Logo"/>
    </div>
    <nav class="ubt-nav">
        <ul>
            <li><a href="index.php" class="active">Home</a></li>
            <?php
            if(isset($_SESSION['email'])){
                // Nëse përdoruesi është loguar
                echo '<li><a href="#">Welcome, ' . htmlspecialchars($_SESSION['email']) . '</a></li>';
                echo '<li><a href="../../backend/logout.php">Logout</a></li>';
            } else {
                // Vizitorët
                echo '<li><a href="Login.php">Log in</a></li>';
                echo '<li><a href="Register.php">Register</a></li>';
            }
            ?>
            <li><a href="index.php#contact">Contact</a></li>
        </ul>
    </nav>
</header>



<main class="login-container">
<form action="../../backend/login.php" method="POST">

<h2>Login</h2>

<label>Email</label>
<input type="email" name="email" required>

<label>Password</label>
<input type="password" name="password" required>

<button type="submit">Login</button>

<a id="register" href="Register.php">Go to Register</a>
</form>
</main>


</body>
</html>