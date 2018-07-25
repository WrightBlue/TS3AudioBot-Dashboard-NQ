<?php
	if (!$_SESSION['user_online']) {
		$_SESSION['alert'] = array('message' => 'Najpierw musisz sie zalogować!', 'type' => 'danger');
		header('Location: ?login');
		exit();
	}
	if (isset($_GET['option'])) {
		if (md5($_POST['old']) == $_SESSION['user_password']) {
			$tempCache['old'] = htmlentities($_POST['old'], ENT_QUOTES, "UTF-8");
			$tempCache['new'] = htmlentities($_POST['new'], ENT_QUOTES, "UTF-8");
			$_SESSION['user_password'] = md5($_POST['new']);
			$dashboard->setTempCache($_POST['old'], 'changepass', $tempCache);
			$_SESSION['alert'] = array('message' => 'Poprawnie zmieniono hasło dla <b>'.$_SESSION['user_name'].'</b>!', 'type' => 'success');
			header('Location: ?changepass');
			exit();
		} else {
			$_SESSION['alert'] = array('message' => 'Hasła nie zgadzają się!', 'type' => 'danger');
			header('Location: ?changepass');
			exit();
		}
	}
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card wow slideInDown" data-wow-duration="1000ms">
					<div class="card-header card-header-primary wow slideInLeft" data-wow-duration="1100ms">
						<h4 class="card-title text-center">Zmiana hasła</h4>
					</div>
					<div class="card-body">
						<form method="post" action="?changepass&option=1" autocomplete="off">
							<input type="text" class="form-control wow slideInLeft" data-wow-duration="1200ms" name="old" minlength="6" maxlength="32" placeholder=" Obecne hasło" required><br>
							<input type="text" class="form-control wow slideInLeft" data-wow-duration="1300ms" name="new" minlength="6" maxlength="32" placeholder=" Nowe hasło" required><br>
							<button class="btn btn-info btn-fill btn-block wow slideInLeft" data-wow-duration="1400ms">Zmień hasło</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
