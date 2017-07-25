<!DOCTYPE html>
<html lang="en" dir="rtl">
	<head>
		<?php include $GLOBALS['webhost']['metadata']; ?>
		<title>صندوقي | تأكيد مستخدم جديد</title>
		<link rel="stylesheet" href="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/confirm/confirm.css">
	</head>
	<body style="background-color: rgb(237, 237, 237);">
        <?php include $GLOBALS['webhost']['navbar']; ?>
    
        <div class="container" style="height: 125px;"><!--SPACER--></div>
        
        <div class="container text-center">
            <h2 class="heading">تأكيد مستخدم جديد</h2>
            <p class="paragraph"> لضمان وصول الطرود الخاصة بك إليك في أسرع وقت، يجب تأكيد رقم الجوال المزود من خلال رسالة نصية.</p>
            <p class="paragraph">سوف يتم إرسال رسالة نصية إلى الرقم التالي</p>
            <h3 class="number"><?php echo $data['mobile']; ?></h3>
            <!-- Modal trigger -->
            <small><a href="#" class="paragraph" data-toggle="modal" data-target="#change-mobile-modal">أريد تعديل رقم الجوال</a></small>
            <p class="paragraph">فيها رقم مكون من ستة رموز، الرجاء كتابة هذا الرقم في المكان المخصص أدناه.</p><br>
            
            <form method="post" id="user-confirm">
              <div class="form-group">
                <input class="form-control form-control-lg" type="text" placeholder="إكتب الرموز هنا" id="code-textbx" name="confirm-code" maxlength="6" minlength="6" required>
              </div>
              <div class="errors-box text-center" style="color: red; margin-bottom: 15px;"></div>
              <div class="success-msg text-center" style="color: green; display: none;">تم التأكيد! <br> سوف تتم إعادة التوجيه خلال ثواني..<br><br> </div>
              <button  onclick="confirm(); return false;" class="btn btn-success form-control form-control-lg confirm-btn">تأكيد رقم الجوال</button>
            </form>

            <br>
            <div id="resend-btn-container">
              <button onclick="resend();"><a class="paragraph">لم أستلم رسالة نصية</a></button>
            </div>
            <br>
        </div>    
        <div class="container bottom-spacer"><!--SPACER--></div>
        

        <!-- Change Mobile Modal -->
        <div class="modal fade" id="change-mobile-modal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title cairo-font">تعديل رقم الجوال</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" id="change-mobile-form">
                  <div class="form-group">
                    <label for="new-mobile"class="cairo-font">رقم الجوال الجديد</label>
                    <input class="form-control" type="text" id="new-mobile" name="new-mobile" placeholder="إكتب الرقم الجديد هنا..">
                  </div>
                  <div class="success-change-msg text-center" style="color: green; display: none;">تم إرسال الرسالة النصية.</div>
                  <div class="errors-box text-center" style="color: red"></div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary cairo-font" data-dismiss="modal" style="margin-left: 10px;">إغلاق</button>
                <button onclick="change();" type="button" class="btn btn-primary cairo-font">حفظ التعديل</button>
              </div>
            </div>
          </div>
        </div>

		<?php include $GLOBALS['webhost']['footer']; ?>
		<?php include $GLOBALS['webhost']['scripts']; ?>
		<script src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/confirm/confirm.js"></script>
	</body>
</html>