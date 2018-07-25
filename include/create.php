<?php
	if (!$_SESSION['user_online']) {
		$_SESSION['alert'] = array('message' => 'Najpierw musisz sie zalogować!', 'type' => 'danger');
		header('Location: ?login');
		exit();
	}
	if (isset($_GET['add'])) {
		$tempCache[] = [];
		$tempCache['bot_id'] = $_POST['id'];
		$tempCache['bot_name'] = htmlentities($_POST['name'], ENT_QUOTES, "UTF-8");
		$tempCache['channel'] = $_POST['channel'];
		$tempCache['server'] = $_POST['server'];
		$tempCache['group'] = $_POST['group'];
		$dashboard->setTempCache($_POST['name'], 'create', $tempCache);
		$dashboard->setTempCache($_POST['name'], 'start', $tempCache);
		$_SESSION['alert'] = array('message' => 'Storzono oraz uruchomiono bota <b>'.$tempCache['bot_name'].'</b>!', 'type' => 'success');
		header('Location: ?create');
		exit();
	}
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card wow slideInDown" data-wow-duration="1000ms">
					<div class="card-header card-header-primary wow slideInLeft" data-wow-duration="1100ms">
						<h4 class="card-title text-center">Tworzenie bota</h4>
					</div>
					<div class="card-body">
						<form method="post" action="?create&add=1" autocomplete="off">
							<input type="text" class="form-control wow slideInLeft" data-wow-duration="1200ms" name="server" maxlength="30" placeholder=" Adres serwera (ipv4 lub twoja-domena.pl)" required><br>
							<input type="text" class="form-control wow slideInLeft" data-wow-duration="1300ms" name="name" maxlength="30" placeholder=" Nazwa" required><br>
							<select class="form-control selectpicker wow slideInLeft" data-wow-duration="1400ms" data-style="btn btn-link" name="id"><?php echo $dashboard->getOptionList(); ?></select><br>
							<input type="text" class="form-control wow slideInLeft" data-wow-duration="1500ms" name="group" maxlength="10" pattern="[0-9]{0,10}" title="Tylko liczby!" placeholder=" Id grupy" required><br>
							<input type="text" class="form-control wow slideInLeft" data-wow-duration="1600ms" name="channel" maxlength="10" pattern="[0-9]{0,10}" title="Tylko liczby!" placeholder=" Id kanału" required><br>
							<button class="btn btn-info btn-fill btn-block wow slideInLeft" data-wow-duration="1700ms">Stwórz bota</button>
						</form>
						<hr class="wow slideInLeft" data-wow-duration="1800ms">
						     <small>*Nazwa - pseudonim które bedzie miał bot</small><br>
						     <small>*Adres serwera (ipv4 lub twoja-domena.pl) - Nazwa mowi za siebie, polecam jednak uzywac ipv4.</small><br>
						     <small>*Id bota - instancja ktora bedzie uruchamiana (Min. 1 - Max. 128)</small><br>
						     <small>*Id grupy - grupa która bedzie miała dostęp do komend bota (Np. grupa gildyjna)</small><br>
						     <small>*Id kanału - kanał na który bedzie wchodzic bot jak np. dostanie dropa</small>
						<hr class="wow slideInLeft" data-wow-duration="1800ms">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
