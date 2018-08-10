<?php
	if (!$_SESSION['user_online']) {
		$_SESSION['alert'] = array('message' => 'Najpierw musisz sie zalogować!', 'type' => 'danger');
		header('Location: ?login');
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
						<input type="text" class="form-control wow slideInLeft" data-wow-duration="1200ms"
						       id="server" maxlength="30"
						       placeholder=" [!] Adres serwera (ipv4 lub twoja-domena.pl)" required><br>
						<input type="text" class="form-control wow slideInLeft" data-wow-duration="1300ms"
						       id="name" maxlength="30" placeholder=" [!] Nick bota" required><br>
						<select class="form-control selectpicker wow slideInLeft" data-wow-duration="1400ms"
						        data-style="btn btn-link"
						        id="id"><?php echo $dashboard->getOptionList($config); ?></select><br>
						<input type="text" class="form-control wow slideInLeft" data-wow-duration="1500ms"
						       id="group" maxlength="10" pattern="[0-9]{0,10}" title="Tylko liczby!"
						       placeholder=" [!] Id grupy" required><br>
						<input type="text" class="form-control wow slideInLeft" data-wow-duration="1600ms"
						       id="channel" maxlength="10" pattern="[0-9]{0,10}" title="Tylko liczby!"
						       placeholder=" [!] Id kanału" required><br>
						<input type="text" class="form-control wow slideInLeft" data-wow-duration="1700ms"
						       id="avatar" placeholder=" [?] Avatar"><br>
						<input type="text" class="form-control wow slideInLeft" data-wow-duration="1800ms"
						       id="leave_message" placeholder=" [!] Komunikat o rozłączeniu" required><br>
						<input type="text" class="form-control wow slideInLeft" data-wow-duration="1900ms"
						       id="music_message" placeholder=" [?] Komunikat o muzyce"><br>
						<button type="submit" class="btn btn-info btn-fill btn-block" id="create">Stwórz bota
						</button>
						<hr class="wow slideInLeft" data-wow-duration="2100ms">
						<small>[*] [!] Nazwa bota - pseudonim które bedzie miał bot</small>
						<br>
						<small>[*] [!] Adres serwera (ipv4 lub twoja-domena.pl) - Nazwa mowi za siebie, polecam
							jednak uzywac ipv4.
						</small>
						<br>
						<small>[*] [!] Id bota - instancja ktora bedzie uruchamiana (Min. 1 - Max. 128)</small>
						<br>
						<small>[*] [!] Id grupy - grupa która bedzie miała dostęp do komend bota (Np. grupa
							gildyjna)
						</small>
						<br>
						<small>[*] [!] Id kanału - kanał na który bedzie wchodzic bot jak np. dostanie dropa
						</small>
						<br>
						<small>[*] Avatar - Link lub ścieżka do avatara, który będzie miał bot</small>
						<br>
						<small>[*] [!] Komunikat o rozłączeniu - Wiadomości która bedzie widoczna gdy bot zostanie
							wyłaczony. Przykład: "<23:33:37> "TS3AudioBot" rozłączono (Wright <3)"
						</small>
						<br>
						<small>[*] Komunikat o muzyce - Bot na kanale bedzie wysyłać wiadomość wraz z linkiem oraz
							nazwa aktualnie granej muzyki. Dostepne zmienne: <b>%SONG</b></b></small>
						<br>
						<small>[*] [?] - Zostaw puste pole jeśl nie chcesz aktywować tej funkcji</small>
						<hr class="wow slideInLeft" data-wow-duration="2200ms">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
