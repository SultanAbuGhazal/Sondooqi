<!DOCTYPE html>

<html lang="en" dir="rtl">
  <head>
    <?php include $GLOBALS['webhost']['metadata']; ?>
    <title>صندوقي | التسوق عليك، التوصيل علينا</title>
    <link rel="stylesheet" href="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/home/home.css">
  </head>

<body>
  <?php include $GLOBALS['webhost']['navbar']; ?>
  
		<div class="backdrop">
      <div class="container" style="height: 100px;"><!--SPACER--></div>
      <div class="container">
        <div class="row">
          <h4>التسجيل</h4><br>
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
            <button class="btn btn-secondary" onclick="register(); return false;">إكمال التسجيل</button>
          </form>
        </div>
      </div>
    </div>
    
    
  <div class="container" id="how-it-works">
    <div class="container" style="height: 40px;"><!--SPACER--></div>
    <hr style="width: 100%; border: 1px solid orange;">
    <h1 class="heading-1 text-center">كيف نعمل؟</h1><br>
    <div class="container" style="height: 800px;"><!--SPACER--></div>
  </div>


  <div class="container" id="contact-us">
    <div class="container" style="height: 40px;"><!--SPACER--></div>
    <hr style="width: 100%; border: 1px solid orange;">
    <h1 class="heading-1 text-center">للتواصل والإستفسار</h1><br>
    <div class="container" style="height: 800px;"><!--SPACER--></div>
  </div>

  <?php include $GLOBALS['webhost']['footer']; ?>

  <?php include $GLOBALS['webhost']['scripts']; ?>
  <script src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/home/home.js"></script>
</body>

</html>