<!DOCTYPE html>
<html lang="en" dir="rtl">
	<head>
		<?php include $GLOBALS['webhost']['metadata']; ?>
		<title>صندوقي | محتويات صندوقي</title>
		<link rel="stylesheet" href="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/box/box.css">
	</head>
	<body style="background-color: rgb(237, 237, 237);">
    <?php include $GLOBALS['webhost']['navbar']; ?>
    
    <div class="container" style="height: 125px;"><!--SPACER--></div>    
    
    <div class="container">
      <div id="boxes-accordion" role="tablist" aria-multiselectable="true">
        <div class="card">
          <div class="card-header" role="tab" id="heading-uae">
          <h5 class="mb-0">
            <div class="d-flex p-1">
              <a data-toggle="collapse" data-parent="#boxes-accordion" href="#collapse-uae" aria-expanded="true" aria-controls="collapseOne">
                <span class="ml-auto box-heading">محتويات صندوقي في الإمارات العربية المتحدة</span>
              </a>
              <div class="mr-auto p-1">صندوق رقم: <?php echo $data['boxes'][0]['boxid'] ?></div>
            </div>
          </h5>
          </div>
          <div id="collapse-uae" class="collapse show" role="tabpanel" aria-labelledby="heading-uae">
            <div class="card-block" style="padding-right: 25px; padding-left: 25px;">

              <div class="row">
                <?php foreach($data['boxes'][0]['items'] as $item) : ?>
                  <?php $this->getSnippet("boxItemTemplate", $item); ?>
                <?php endforeach; ?>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    

		<?php include $GLOBALS['webhost']['footer']; ?>
		<?php include $GLOBALS['webhost']['scripts']; ?>
		<script src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/box/box.js"></script>
	</body>
</html>