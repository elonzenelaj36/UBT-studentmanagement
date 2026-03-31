<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UBT Student Management</title>
<link rel="stylesheet" href="../css/index.css">
</head>
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
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>
</header>

<!-- Hero / Program buttons -->
<section class="hero">
    <div class="hero-content">
        <h1>Mirësevini në UBT</h1>
        <p>Institucion i arsimit të lartë me fokus në inovacion, kërkim shkencor dhe zhvillim profesional.</p>
        <div class="program-buttons">
            <a class="btn primary" href="Bachelor.html">Bachelor</a>
            <a class="btn primary" href="master.html">Master</a>
            <a class="btn primary" href="phd.html">PhD</a>
        </div>
    </div>
</section>






<!-- ------------------------------------------------->
 
 <?php
include_once '../../backend/Database.php';

$db = new Database();
$conn = $db->getConnection();

$query = "SELECT * FROM news ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->execute();

$news = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="news">
    <div class="news-wrapper">
        

        <div class="news-slider">
            <?php foreach($news as $n): ?>
                <div class="slide">
                    <img src="../fotot/ubtcampus.jpg" alt="<?= htmlspecialchars($n['title']) ?>"/>
                    <div class="slide-content">
                        <h3><?= $n['title'] ?></h3>
                        <p><?= substr($n['content'], 0, 350) ?>...</p>
                        <span class="date"><?= $n['created_at'] ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="slider-nav">
            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>
        </div>
    </div>
</section>


<!-------------------------------------------------------->




<!-- Rreth nesh -->
<section class="about" id="rreth-nesh">
    <h2>Rreth nesh</h2>
    <p>
      UBT është një institucion modern i arsimit të lartë që ofron programe në fusha të ndryshme, 
      duke ndërlidhur teorinë me praktikën. Ne investojmë në laboratorë, partneritete me industri 
      dhe projekte reale të studentëve, për të përgatitur profesionistë të aftë për tregun e punës.
    </p>
    <p>UBT ofron një mjedis mësimor bashkëkohor, duke kombinuar teorinë me praktikën, 
      teknologjinë moderne dhe zhvillimin e vazhdueshëm profesional. Universiteti inkurajon kreativitetin, 
      mendimin kritik dhe zhvillimin personal të studentëve të tij.</p>
    <p>
        UBT ka realizuar bashkëpunime të shumta me universitete dhe institucione ndërkombëtare, 
        duke ofruar mundësi për shkëmbime akademike, trajnime profesionale dhe projekte të përbashkëta kërkimore. 
        Këto bashkëpunime kanë kontribuar në rritjen e cilësisë së mësimdhënies dhe zgjerimin e përvojës akademike të studentëve.
        Arritjet tona përfshijnë publikime në revista shkencore, start-up të suksesshme të 
        studentëve, si dhe bashkëpunime ndërkombëtare për shkëmbime akademike dhe kërkime të avancuara.
    </p>
</section>

<!-- Testimonials -->
<section class="testimonials">
    <h2>Mendimet e studentëve</h2>
    <div class="cards">
        <article class="card">
            <img src="../fotot/STUDENTI1.png" alt="Student 1"/>
            <div class="card-body">
                <h3>Arianit, Bachelor në Shkenca Kompjuterike</h3>
                <p>“Projekti ynë i fundit me partnerë industrialë më ndihmoi të kuptoj teknologjitë cloud në praktikë.”</p>
            </div>
        </article>
        <article class="card">
            <img src="../fotot/STUDENTJA1.jpg" alt="Student 2"/>
            <div class="card-body">
                <h3>Elona, Master në Inxhinieri Softuerike</h3>
                <p>“Mentorimi dhe laboratorët e UBT-së më dhanë përvojë konkrete në zhvillimin e sistemeve.”</p>
            </div>
        </article>
        <article class="card">
            <img src="../fotot/STUDENTI2.jpg" alt="Student 3"/>
            <div class="card-body">
                <h3>Besart, PhD në Inteligjencë Artificiale</h3>
                <p>“Kërkimi ynë u publikua dhe bashkëpunimi me universitete të huaja ishte i paçmueshëm.”</p>
            </div>
        </article>
    </div>
</section>

<!-- Contact -->
<section class="contact" id="contact">
    <h2>Kontakt</h2>
    <p>Na kontaktoni për pyetje rreth programeve, regjistrimit dhe partneriteteve.</p>
    <form action="../../backend/contact.php" method="POST" class="contact-form" id="contactForm" class="contact-form">
      <div class="form-row">
        <label for="contactName">Emri</label>
        <input type="text" id="contactName" name="contactName" placeholder="Shkruani emrin"/>
      </div>
      <div class="form-row">
        <label for="contactPhone">Numri i telefonit</label>
        <input type="tel" id="contactPhone" name="contactPhone" placeholder="+383 xx xxx xxx"/>
      </div>
      <div class="form-row">
        <label for="contactMessage">Mesazhi</label>
        <textarea id="contactMessage" name="contactMessage" placeholder="Mesazhi juaj..."></textarea>
      </div>
      <button type="submit" class="btnsecondary">Dërgo</button>
      <p class="form-feedback" id="contactFeedback" aria-live="polite"></p>
    </form>
</section>

<!-- Footer -->
<footer>
    <div class="footer-container">
        <div class="footer-info">
            <h3>UBT-Student Management</h3>
            <p>© 2026 UBTStudentManagement. All rights reserved.</p>
            <p>Email: support@ubtstudentmanagement.com</p>
            <p>Phone: +383 49 445 676</p>
        </div>
    </div>
</footer>





<script>
let slideIndex = 0;
const slides = document.querySelectorAll('.slide');

function showSlide(n) {
    slides.forEach(slide => slide.style.display = 'none');
    slides[n].style.display = 'block';
}

function nextSlide() {
    slideIndex = (slideIndex + 1) % slides.length;
    showSlide(slideIndex);
}

function prevSlide() {
    slideIndex = (slideIndex - 1 + slides.length) % slides.length;
    showSlide(slideIndex);
}

// Buttons
document.querySelector('.next').addEventListener('click', nextSlide);
document.querySelector('.prev').addEventListener('click', prevSlide);

// Auto slide every 5s
function autoSlide() {
    nextSlide();
    setTimeout(autoSlide, 10000);
}

if(slides.length > 0){
    showSlide(slideIndex);
    setTimeout(autoSlide, 10000);
}
</script>

</body>
</html>