<?php
session_start();

// fshin gjithçka
$_SESSION = [];

// shkatërron session
session_destroy();

// 🔥 redirect i sigurt
header("Location: ../frontend/static/Login.php");
exit();
?>