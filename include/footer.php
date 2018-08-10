<footer class="footer">
	<div class="container-fluid">
		<nav class="copyright float-left">
			Front-end made with <i class="material-icons">favorite</i> by <a href="https://www.creative-tim.com"
			                                                                 target="_blank">Creative Tim</a>
		</nav>
		<div class="copyright float-right">
			Back-end made with <i class="material-icons">favorite</i> by <a href="https://wright.pogadajtu.pl"
			                                                                target="_blank">Wright</a>
		</div>
	</div>
</footer>
</div>
</div>
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap-material-design.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="assets/js/plugins/chartist.min.js"></script>
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<script src="assets/js/material-dashboard.min.js?v=2.1.0"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>

	new WOW().init();

	<?php
	if (isset($_SESSION['alert'])) {
		echo '$.notify({ icon: "notifications", message: "' . $_SESSION['alert']['message'] . '" }, { type: "' . $_SESSION['alert']['type'] . '", timer: 1000 });';
		unset($_SESSION['alert']);
	}
	?>

	<?php if ($_SESSION['PAGE_REQUEST'] == 'logs') { ?>
	var objDiv = document.getElementById("logs");
	objDiv.scrollTop = objDiv.scrollHeight;
	<?php } ?>

	<?php if ($_SESSION['PAGE_REQUEST'] == 'dashboard') { ?>
	$('#EditBot').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var modal = $(this);
		modal.find('#header_bot_id').text(button.data('bot_id'));
		modal.find('#name').val(button.data('bot_name'));
		modal.find('#server').val(button.data('bot_server'));
		modal.find('#group').val(button.data('bot_group'));
		modal.find('#channel').val(button.data('bot_channel'));
		modal.find('#id').val(button.data('bot_id'));
	});

	function updateData()
	{
		$.ajax({
			url: 'ajax.php', type: 'POST', data: {request: 'bots'}, success: function (result) {
				var tr = '';
				$("#ajax").empty();
				$.each(result.message, function (index, val) {
					tr += `<tr style="background-color: ${val.color};"><td class="text-center">${val.id}</td><td>${val.name}</td><td><button type="button" class="btn btn-success btn-round btn-sm" name="start" id="start" data-bot_id="${val.id}" rel="tooltip" title="Włącz bota"><i class="material-icons">power_settings_new</i></button><button type="button" class="btn btn-danger btn-round btn-sm" name="stop" id="stop" data-bot_id="${val.id}" rel="tooltip" title="Wyłącz bota"><i class="material-icons">cancel</i></button><button type="button" class="btn btn-warning btn-round btn-sm" name="delete" id="delete" data-bot_id="${val.id}" rel="tooltip" title="Usuń bota"><i class="material-icons">delete_forever</i></button><button type="button" class="btn btn-info btn-round btn-sm" data-toggle="modal" data-target="#EditBot" data-bot_id="${val.id}" data-bot_name="${val.name}" data-bot_server="${val.server}" data-bot_group="${val.group}" data-bot_channel="${val.channel}" rel="tooltip" title="Edytuj bota"><i class="material-icons">build</i></button></td><td>${val.status}</td></tr>`;
				});
				$('#ajax').append(tr);
			},
		});
	};

	$(document).on('click', '#start', function () {
		$.ajax({
			url: 'ajax.php', type: 'post', data: {
				request: 'start', botId: $(this).data('bot_id')
			}, success: function (data) {
				$.notify({
					icon: "notifications", message: data.message
				}, {
					type: data.type, timer: 1000
				});
			}
		});
	});

	$(document).on('click', '#stop', function () {
		$.ajax({
			url: 'ajax.php', type: 'post', data: {
				request: 'stop', botId: $(this).data('bot_id')
			}, success: function (data) {
				$.notify({
					icon: "notifications", message: data.message
				}, {
					type: data.type, timer: 1000
				});
			}
		});
	});

	$(document).on('click', '#delete', function () {
		$.ajax({
			url: 'ajax.php', type: 'post', data: {
				request: 'stop', botId: $(this).data('bot_id')
			}
		});
		$.ajax({
			url: 'ajax.php', type: 'post', data: {
				request: "delete", botId: $(this).data('bot_id')
			}, success: function (data) {
				$.notify({
					icon: "notifications", message: data.message
				}, {
					type: data.type, timer: 1000
				});
			}
		});
	});

	var counter = 0;
	setInterval(function () {
		if (counter == 0) {
			counter = <?php echo $config['global']['bots_list_refresh']; ?>;
			updateData();
		}
		counter = counter - 1;
		$("#timer").html(counter);
	}, 1000);
	<?php } ?>

	<?php if ($_SESSION['PAGE_REQUEST'] == 'create') { ?>
	var lastId = 0;
	$(document).on('click', '#create', function () {
		if (document.getElementById('id').value == '[!] Id bota' || lastId == document.getElementById('id').value) {
			$.notify({
				icon: "notifications", message: "Wybierz poprawne ID bota!"
			}, {
				type: "danger", timer: 1000
			});
		} else {
			$.ajax({
				url: 'ajax.php', type: 'post', data: {
					request: "create",
					botId: document.getElementById('id').value,
					name: document.getElementById('name').value,
					channel: document.getElementById('channel').value,
					server: document.getElementById('server').value,
					group: document.getElementById('group').value,
					leave_message: document.getElementById('leave_message').value,
					avatar: document.getElementById('avatar').value,
					music_message: document.getElementById('music_message').value
				}, success: function (data) {
					lastId = document.getElementById('id').value;
					$.notify({
						icon: "notifications", message: data.message
					}, {
						type: data.type, timer: 1000
					});
				}
			});
		}
	});
	<?php } ?>
	<?php if ($_SESSION['PAGE_REQUEST'] == 'dashboard') { ?>
	$(document).on('click', '#create', function () {
		if (document.getElementById('id').value == '[!] Id bota') {
			$.notify({
				icon: "notifications", message: "Wybierz poprawne ID bota!"
			}, {
				type: "danger", timer: 1000
			});
		} else {
			$.ajax({
				url: 'ajax.php', type: 'post', data: {
					request: "create",
					botId: document.getElementById('id').value,
					name: document.getElementById('name').value,
					channel: document.getElementById('channel').value,
					server: document.getElementById('server').value,
					group: document.getElementById('group').value,
					leave_message: document.getElementById('leave_message').value,
					avatar: document.getElementById('avatar').value,
					music_message: document.getElementById('music_message').value
				}, success: function (data) {
					lastId = document.getElementById('id').value;
					$.notify({
						icon: "notifications", message: data.message
					}, {
						type: data.type, timer: 1000
					});
				}
			});
		}
	});
	<?php } ?>
</script>
</body>
</html>
