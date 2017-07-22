<!DOCTYPE html>
<html lang="en" dir="rtl">
	<head>
		<?php include $GLOBALS['webhost']['metadata']; ?>
		<title>صندوقي | Administrator</title>
		<link rel="stylesheet" href="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/dashboard/dashboard.css">
	</head>
	<body style="background-color: aliceblue;">
        <div class="container" style="height: 60px;"><!--SPACER--></div>
        
        <?php include $GLOBALS['webhost']['navbar']; ?>
        
		<div class="container-fluid" dir="ltr">
			<div class="row dashboard-nav-container">
				<nav class="nav nav-pills flex-column flex-sm-row" id="dash-tabs">
					<h4 style="margin: 10px; color: grey;">Admin Dashboard</h4>
					<a class="flex-sm-fill text-sm-center nav-link active" data-toggle="tab" role="tab" href="#items">Items</a>
					<a class="flex-sm-fill text-sm-center nav-link" data-toggle="tab" role="tab" href="#batches">Batches</a>
					<a class="flex-sm-fill text-sm-center nav-link" data-toggle="tab" role="tab" href="#users">Users</a>
				</nav>
			</div>
		</div>
		<div class="container" dir="ltr">
			<div class="row">
				<div class="tab-content">
					<div class="tab-pane active" id="items" role="tabpanel">
                        <div class="container">
                            <div class="row" style="height: 50px;"><!--SPACER--></div>
                            <div class="row">
                                <form method="post" id="new-item-form" enctype="multipart/form-data">
                                    <h2>Insert a New Item</h2> <br>
                                    <div class="form-group">
                                        <label for="newitem-photo">Item Photo</label>
                                        <input type="file" accept="image/*" class="form-control-file" id="newitem-photo" name="photo" required>
                                    </div><br>
                                    <div class="form-group">
                                        <label for="newitem-box">Box ID number</label>
                                        <input type="text" class="form-control" id="newitem-box" name="boxid" value="BX" maxlength="8" minlength="8" required>
                                    </div><br>
                                    <div class="form-group">
                                        <label for="newitem-weight">Item Weight</label>
                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                            <input type="number" step="0.5" class="form-control" id="newitem-weight" name="weight" required>
                                            <div class="input-group-addon">Kg</div>
                                        </div>
                                    </div><br>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Insert Item</button>
                                        <span style="color: green; display: none;" id="success-insert-msg">Insertion Successful!</span>
                                        <span style="color: red; display: none;" id="fail-insert-msg">Insertion Failed!</span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
					<div class="tab-pane" id="batches" role="tabpanel">Batches</div>
					<div class="tab-pane" id="users" role="tabpanel">Users</div>
				</div>
			</div>
        </div>
        
        <div class="container-fluid fixed-bottom" style="background-color: black; height: 25px;"></div>
        <?php include $GLOBALS['webhost']['scripts']; ?>
        
		<script src="<?php echo $GLOBALS['webhost']['base_url']; ?>/app/views/dashboard/dashboard.js"></script>
	</body>
</html>