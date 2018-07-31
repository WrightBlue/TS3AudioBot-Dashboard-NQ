<?php
	if (!$_SESSION['user_online']) {
		$_SESSION['alert'] = array('message' => 'Najpierw musisz sie zalogować!', 'type' => 'danger');
		header('Location: ?login');
		exit();
	}
	if (isset($_GET['option'])) {
		if (isset($_POST['start'])) {
			$tempCache[] = [];
			$tempCache['bot_id'] = $_POST['start'];
			$dashboard->setTempCache($_POST['start'], 'start', $tempCache);
			exit();
		}
		if (isset($_POST['stop'])) {
			$tempCache[] = [];
			$tempCache['bot_id'] = $_POST['stop'];
			$dashboard->setTempCache($_POST['stop'], 'stop', $tempCache);
			exit();
		}
		if (isset($_POST['edit'])) {
			$tempCache[] = [];
			$tempCache['id'] = $_POST['id'];
			$tempCache['name'] = htmlentities($_POST['name'], ENT_QUOTES, "UTF-8");
			$tempCache['channel'] = $_POST['channel'];
			$tempCache['server'] = $_POST['server'];
			$tempCache['group'] = $_POST['group'];
			$tempCache['avatar'] = $_POST['avatar'];
			$tempCache['leave_message'] = $_POST['leave_message'];
			$tempCache['music_message'] = $_POST['music_message'];
			$dashboard->setTempCache($_POST['name'], 'edit', $tempCache);
			$_SESSION['alert'] = array('message' => 'Edytowano bota o nazwie <b>'.$tempCache['bot_name'].'</b>!', 'type' => 'success');
			header('Location: ?dashboard');
			exit();
		}
		if (isset($_POST['remove'])) {
			$tempCache[] = [];
			$tempCache['bot_id'] = $_POST['bot_id'];
			$dashboard->setTempCache($_POST['bot_id'], 'stop', $tempCache);
			$dashboard->setTempCache($_POST['bot_id'], 'remove', $tempCache);
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
						<h4 class="card-title text-center">Zarządzanie botami</h4>
					</div>
					<div class="card-body wow slideInRight" data-wow-duration="1200ms">
						<div class="table-responsive">
							<table class="table">
								<thead class="text-primary">
									<th class="text-center">ID</th>
									<th>Nazwa</th>
									<th>Opcje</th>
									<th>Status</th>
								</thead>
								<tbody id="ajax">
								</tbody>
							</table>
						</div>
						<hr>
						<div class="text-info text-center">Następne odświeżenie nastąpi za <b id="timer"></b> sekund!</div>
						<hr>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="EditBot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edycja Bota #<b id="header_bot_id"></b></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="?dashboard&option=1" method="post" autocomplete="off">
						<div class="modal-body">
							<div class="form-group">
								<label for="recipient-name" class="col-form-label">Nazwa:</label>
								<input type="text" class="form-control" id="name" name="name">
							</div>
							<div class="form-group">
								<label for="message-text" class="col-form-label">Serwer:</label>
								<input type="text" class="form-control" id="server" name="server">
							</div>
							<div class="form-group">
								<label for="message-text" class="col-form-label">Grupa:</label>
								<input type="text" class="form-control" id="group" name="group">
							</div>
							<div class="form-group">
								<label for="message-text" class="col-form-label">Avatar:</label>
								<input type="text" class="form-control" id="avatar" name="avatar">
							</div>
							<div class="form-group">
								<label for="message-text" class="col-form-label">Komunikat o rozłączeniu:</label>
								<input type="text" class="form-control" id="leave_message" name="leave_message">
							</div>
							<div class="form-group">
								<label for="message-text" class="col-form-label">Komunikat o muzyce:</label>
								<input type="text" class="form-control" id="music_message" name="music_message">
							</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" class="form-control" id="id" name="id">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
							<button type="submit" class="btn btn-primary" name="edit">Edytuj bota</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
