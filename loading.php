<?php
ob_start();
session_start();
if (!isset($_SESSION['user']) && empty($_SESSION['user'])) {
  header("location: index.php");
  exit();
}

include 'includes/templates/header.php';
include 'includes/templates/nav.php'; ?>
<div class="container">
  <h2 class='text-center mt-5'>جاري الان تحميل البيانات</h2>
  <div style="margin: 23% 48% 65px;">
    <div class="box"><span class="spinner one"></span></div>
  </div>
  <h6 class='text-center'>...يرجي الانتظار</h6>
</div>
<?php ob_end_flush(); ?>
