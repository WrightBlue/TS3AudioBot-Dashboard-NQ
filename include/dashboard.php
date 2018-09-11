<?php
	if (empty($_SESSION['user_online'])) {
		$_SESSION['alert'] = array('message' => 'Najpierw musisz sie zalogować!', 'type' => 'danger');
		exit(header('Location: ?login'));
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
						<div class="text-info text-center">Następne odświeżenie nastąpi za <b id="timer"></b>
							sekund!
						</div>
						<hr>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="EditBot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		     aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edycja Bota #<b id="header_bot_id"></b>
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="recipient-name" class="col-form-label">[!] Nazwa:</label>
							<input type="text" class="form-control" id="name">
						</div>
						<div class="form-group">
							<label for="message-text" class="col-form-label">[!] Serwer:</label>
							<input type="text" class="form-control" id="server">
						</div>
						<div class="form-group">
							<label for="message-text" class="col-form-label">[!] Kanał:</label>
							<input type="text" class="form-control" id="channel">
						</div>
						<div class="form-group">
							<label for="message-text" class="col-form-label">[!] Grupa:</label>
							<input type="text" class="form-control" id="group">
						</div>
						<div class="form-group">
							<label for="message-text" class="col-form-label">[?] Avatar:</label>
							<input type="text" class="form-control" id="avatar">
						</div>
						<div class="form-group">
							<label for="message-text" class="col-form-label">[!] Komunikat o rozłączeniu:</label>
							<input type="text" class="form-control" id="leave_message">
						</div>
						<div class="form-group">
							<label for="message-text" class="col-form-label">[?] Komunikat o muzyce:</label>
							<input type="text" class="form-control" id="music_message">
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" class="form-control" id="id">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
						<button type="submit" class="btn btn-primary" id="create" data-dismiss="modal">Edytuj
							bota
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
