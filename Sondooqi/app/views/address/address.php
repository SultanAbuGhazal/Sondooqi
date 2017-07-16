<!DOCTYPE html>

<html lang="en" dir="rtl">
  <head>
    <?php include $GLOBALS['webhost']['metadata']; ?>
    <title>صندوقي | عناويني</title>
    <link rel="stylesheet" href="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/address/address.css">
  </head>

<body>
  <?php include $GLOBALS['webhost']['navbar']; ?>
  
  <br>
  <br>
  <h2>عناويني</h2>
  <br>
  <a href="<?php echo $GLOBALS['webhost']['base_url']."/home"; ?>">go back home</a><br><br>
  <div dir="ltr">
  <?php echo json_encode($data['addresses']); ?>
  </div>


  <?php include $GLOBALS['webhost']['scripts']; ?>
  <script src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/address/address.js"></script>
</body>

</html>
