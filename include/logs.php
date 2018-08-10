<?php
	if (!$_SESSION['user_online']) {
		$_SESSION['alert'] = array('message' => 'Najpierw musisz sie zalogować!', 'type' => 'danger');
		header('Location: ?login');
		exit();
	}
	if ($_GET['type'] == 'TS3AudioBot') {
		if (isset($_POST['day'])) {
			header('Location: ?logs&type=TS3AudioBot&day=' . $_POST['day']);
			exit();
		}
		?>
		<div class="content">
			<div class="container-fluid">
				<div class="container">
					<?php if (empty($_GET['day'])) { ?>
						<div class="card wow slideInDown" data-wow-duration="1s">
							<div class="card-header card-header-primary wow slideInLeft"
							     data-wow-duration="1100ms">
								<h4 class="card-title text-center">Wybierz logi</h4>
							</div>
							<div class="card-body wow slideInRight" data-wow-duration="1100ms">
								<form method="post" action="?logs&type=TS3AudioBot">
									<select class="form-control selectpicker wow slideInLeft"
									        data-wow-duration="1400ms" data-style="btn btn-link" name="day">
										<?php
											foreach (glob('/home/TS3AudioBot/Logs/*.log') as $file) {
												preg_match("/\d{4}-\d{2}-\d{2}/", $file, $match);
												if ($match[0] == date('Y-m-d')) {
													echo '<option value="' . $match[0] . '" selected>Logi z dnia: ' . $match[0] . '</option>';
												} else {
													echo '<option value="' . $match[0] . '">Logi z dnia: ' . $match[0] . '</option>';
												}
											}

										?>
									</select>
									<button class="btn btn-info btn-fill btn-block">Pokaż logi</button>
								</form>
							</div>
						</div>
					<?php } else { ?>
						<div class="card wow slideInDown" data-wow-duration="1s">
							<div class="card-header card-header-primary wow slideInLeft"
							     data-wow-duration="1100ms">
								<h4 class="card-title text-center">Logi TS3AudioBot</h4>
							</div>
							<div class="card-body wow slideInRight" data-wow-duration="1100ms"
							     style="height:500px; overflow-y: scroll;" id="logs">
								<?php
									$file = file_get_contents('/home/TS3AudioBot/Logs/' . $_GET['day'] . '.log');
									$items = [" INFO", " WARN", "DEBUG", "ERROR"];
									$itemsreplace = ["<b class='text-info'>INFO</b>", "<b class='text-warning'>WARN</b>", "<b class='text-muted'>DEBUG</b>", "<b class='text-danger'>ERROR</b>"];
									$file = str_replace($items, $itemsreplace, $file);
									$file = str_replace(array('&lt;', '&gt;'), array('<', '>'), htmlentities($file));
									echo '<code><pre>' . $file . '</pre></code>';
								?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php } else {
		header('Location: ?dashboard');
	} ?>
