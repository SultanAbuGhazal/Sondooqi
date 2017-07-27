<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <?php include $GLOBALS['webhost']['metadata']; ?>
    <title>صندوقي | عناويني</title>
    <link rel="stylesheet" href="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/password/password.css">
  </head>

<body style="background-color: rgb(237, 237, 237);">

  <div class="container" style="height: 125px;"><!--SPACER--></div>

  <div class="container">
      <div class="row">
          <div class="col-md-4 offset-md-4">
              <form action="post" dir="rtl">
                <div class="form-group">
                    <label for="new-password" class="cairo-font">كلمة السر الجديدة</label>
                    <input class="form-control" type="password" placeholder="كلمة السر الجديدة" id="new-password" name="new_pass" maxlength="32" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password" class="cairo-font">أعد كلمة السر الجديدة</label>
                    <input class="form-control" type="password" placeholder="أعد كلمة السر الجديدة" id="confirm-password" name="confirm_pass" maxlength="32" required>
                </div>
                <div class="errors-box text-center" style="color: red" dir="ltr"></div>
                <div class="text-center">
                    <br><button class="btn btn-secondary" onclick="change(); return false;" style="color: white; font-family: 'Cairo', sans-serif; font-weight: 600; letter-spacing: 1px; background-color: orange; border: none; height: 40px; min-width: 40%;">إحفظ كلمة السر</button>
                </div>
              </form>
          </div>
      </div>
  </div>

  <div class="container" style="height: 150px;"><!--SPACER--></div>

  <?php include $GLOBALS['webhost']['footer']; ?>
  <?php include $GLOBALS['webhost']['scripts']; ?>
  <script src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/password/password.js"></script>
</body>

</html>
