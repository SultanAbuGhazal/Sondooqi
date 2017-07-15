<!DOCTYPE html>

<html lang="en" dir="rtl">
  <head>
    <?php include $GLOBALS['webhost']['metadata']; ?>
    <title>صندوقي | التسوق عليك، التوصيل علينا</title>
    <link rel="stylesheet" href="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/home/home.css">
  </head>

<body>
  <?php include $GLOBALS['webhost']['navbar']; ?>
  
  <br>
  <h2>صندوقي.كوم</h2>
  <p>التسوق عليك، التوصيل علينا</p>

  <br>
  <br>

  <h4>التسجيل</h4>
  <form class="user-register" method="post">    
    <input type="email" placeholder="البريد الإلكتروني" id="register-email" name="user_email" value="example@email.com">
    <input type="text" placeholder="رقم الجوال" id="register-email" name="user_mobile" value="0501234567">
    <input type="password" placeholder="كلمة السر" id="register-password" name="user_pass" value="1234">
    <hr>
    <input type="text" placeholder="الإسم الكامل" id="register-name" name="user_name" value="سلطان مبين جودت أبوغزال">
    <input type="text" placeholder="العنوان" id="register-address" name="user_address" value="سبسطية">
    <input type="text" placeholder="المحافظة" id="register-city" name="user_city" value="نابلس">
    <input type="text" placeholder="بالقرب من؟" id="register-nearby" name="user_nearby" value="قرب البلدية">
    <hr>
    <div class="errors-box text-center" style="color: red" dir="ltr"></div>
    <br>
  </form>
  <button onclick="register();">إكمال التسجيل</button>


  <?php include $GLOBALS['webhost']['scripts']; ?>
  <script src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/home/home.js"></script>
</body>

</html>