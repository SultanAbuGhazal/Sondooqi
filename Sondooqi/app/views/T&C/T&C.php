<!DOCTYPE html>

<html lang="en" dir="rtl">
  <head>
    <?php include $GLOBALS['webhost']['metadata']; ?>
    <title>صندوقي | عناويني</title>
    <link rel="stylesheet" href="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/T&C/T&C.css">
  </head>

<body style="background-color: rgb(237, 237, 237);">
  <?php include $GLOBALS['webhost']['navbar']; ?>

  <div class="container" style="height: 125px;"><!--SPACER--></div>

  <div class="container card-padding">
    <h1 class="title text-center">الشروط والأحكام</h1>
    <ol class="terms-list">
        <div class="section-title">عنوان فرعي</div>
        <li><p>هذا شرط من الشروط</p></li>
        <li>هذا شرط من الشروط</li>
        <ol type="a">
            <li></li>
            <li></li>
            <li></li>
        </ol><br>
        <li><p>هذا شرط من الشروط</p></li>
        <div class="section-title">عنوان فرعي</div>
        <li><p>هذا شرط من الشروط</p></li>
        <li><p>هذا شرط من الشروط</p></li>
    </ol>

  </div>

  <?php include $GLOBALS['webhost']['footer']; ?>

  <?php include $GLOBALS['webhost']['scripts']; ?>
  <script src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/T&C/T&C.js"></script>
</body>

</html>
