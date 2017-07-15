<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include $GLOBALS['webhost']['metadata']; ?>
		<title>About | BestFix</title>
		<link rel="stylesheet" href="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/about/about.css">
	</head>
	<body style="background-color: aliceblue;">
		<?php include $GLOBALS['webhost']['scripts']; ?>
		<!--<script src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/about/about.js"></script>-->

		<div class="container-fluid" style="background-color: #003a99;">
			<?php include $GLOBALS['webhost']['navbar']; ?>
		</div>

    <div class="row custom-spacer" style="height:25px"><!--SPACER--></div>

    <div class="container">
      <div class="display-4">About BestFix</div> <br/>
      <p class="lead">This. Is. Bestfixxxx.</p>
    </div>

    <div class="row custom-spacer" style="height:100px"><!--SPACER--></div>

    <div class="container">
      <div class="display-4">The Team</div> <br/>
      <p class="lead">This. Is. The Teeeeam.</p>
    </div>

    <div class="row custom-spacer" style="height:100px"><!--SPACER--></div>

    <div class="container" id="contact">
      <div class="display-4">Contact BestFix</div> <br/>
      <p class="lead">Contact.</p>
    </div>

    <?php include $GLOBALS['webhost']['footer']; ?>
	</body>
</html>