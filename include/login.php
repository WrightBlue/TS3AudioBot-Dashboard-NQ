<?php
	if (isset($_GET['auth'])) {
		if (isset($_POST['login']) && isset($_POST['password'])) {
			$login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
			$password = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");
			$db = $dashboard->getMySQL($config);
			$result = $db->query("SELECT * FROM `dashboard_auth` WHERE login='" . $login . "' AND password='" . $password . "'");
			if ($result->rowCount() != 0) {
				$_SESSION['user_online'] = true;
				$_SESSION['user_name'] = $login;
				$_SESSION['alert'] = array('message' => 'Zalogowano pomyślnie!', 'type' => 'success');
				exit(header('Location: ?dashboard'));
			} else {
				$_SESSION['alert'] = array('message' => 'Błędny login lub hasło!', 'type' => 'danger');
				exit(header('Location: ?login'));
			}
		} else {
			$_SESSION['alert'] = array('message' => 'Wpisz login oraz hasło!', 'type' => 'danger');
			exit(header('Location: ?login'));
		}
	} else {
		$dashboard->getMySQL($config, true);
	}
?>
<div class="content">
	<div class="container-fluid">
		<div class="container">
			<div class="col-lg-4 col-md-6 col-sm-6 ml-auto mr-auto">
				<form method="post" action="?login&auth=1">
					<div class="card card-login card-hidden">
						<div class="card-header card-header-success text-center">
							<h4 class="card-title">LOGOWANIE</h4>
						</div>
						<div class="card-body">
							<span class="bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">
											<i class="material-icons">fingerprint</i>
										</span>
									</div>
					                     <input type="text" name="login" class="form-control" placeholder="Login">
					               </div>
							</span>
							<span class="bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">
											<i class="material-icons">lock_open</i>
										</span>
									</div>
					                     <input type="password" name="password" class="form-control"
					                            placeholder="Hasło">
					               </div>
							</span>
						</div>
						<div class="card-footer justify-content-center">
							<button class="btn btn-success btn-link btn-lg">ZALOGUJ</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
