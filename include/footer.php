<footer class="footer">
	<div class="container-fluid">
		<nav class="copyright float-left">
			Front-end made with <i class="material-icons">favorite</i> by <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>
		</nav>
		<div class="copyright float-right">
			Back-end made with <i class="material-icons">favorite</i> by <a href="https://wright.pogadajtu.pl" target="_blank">Wright</a>
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
			echo '$.notify({ icon: "notifications", message: "'.$_SESSION['alert']['message'].'" }, { type: "'.$_SESSION['alert']['type'].'", timer: 1000 });';
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
	<?php } ?>

	<?php if ($_SESSION['PAGE_REQUEST'] == 'dashboard') { ?>
	function updateData() {
		$.ajax({
			type        :   'GET',
			url         :   'cache/bots_list.wright',
			async       :   true,
			dataType    :   'json',
			success     :   function(result) {
				var tr = '';
				$("#ajax").empty();
				$.each(result, function(index, val){
					tr += `<tr style="background-color: ${val.color};"><td class="text-center">${val.id}</td><td>${val.name}</td><td><button type="button" class="btn btn-success btn-round btn-sm" name="start" id="start" data-bot_id="${val.id}"><i class="material-icons">power_settings_new</i></button><button type="button" class="btn btn-danger btn-round btn-sm" name="stop" id="stop" data-bot_id="${val.id}"><i class="material-icons">cancel</i></button><button type="button" class="btn btn-warning btn-round btn-sm" name="remove" id="remove" data-bot_id="${val.id}""><i class="material-icons">delete_forever</i></button><button type="button" class="btn btn-info btn-round btn-sm" data-toggle="modal" data-target="#EditBot" data-bot_id="${val.id}" data-bot_name="${val.name}" data-bot_server="${val.server}" data-bot_group="${val.group}" data-bot_channel="${val.channel}""><i class="material-icons">build</i></button></td><td>${val.status}</td></tr>`;
				});
				$('#ajax').append(tr);
			},
		});
	};

	$(document).on('click', '#start',function(){
		var id = $(this).data('bot_id');
		$.ajax({
			url        : '?dashboard&option=1',
			type       : 'post',
			data       : {
				start: id
			},
			success    : function(data) {
				$.notify({
					icon    : "notifications",
					message : "Włączono bota ID " + id + "!"
				}, {
					type    : "success",
					timer   : 1000
				});
			}
		});
	});

	$(document).on('click', '#stop',function(){
		var id = $(this).data('bot_id');
		$.ajax({
			url        : '?dashboard&option=1',
			type       : 'post',
			data       : {
				stop: id
			},
			success    : function(data) {
				$.notify({
					icon    : "notifications",
					message : "Wyłączono bota ID " + id + "!"
				}, {
					type    : "danger",
					timer   : 1000
				});
			}
		});
	});

	$(document).on('click', '#remove',function(){
		var id = $(this).data('bot_id');
		$.ajax({
			url        : '?dashboard&option=1',
			type       : 'post',
			data       : {
				remove:  1,
				bot_id:  id
			},
			success    : function(data) {
				$.notify({
					icon    : "notifications",
					message : "Usunięto bota ID " + id + "!"
				}, {
					type    : "danger",
					timer   : 1000
				});
			}
		});
	});

	var counter = 0;
	setInterval(function () {
		if (counter == 0) {
			counter = 61;
			updateData();
			$.notify({
				icon: "notifications",
				message: "Odświeżono liste botów!"
			}, {
				type: "info",
				timer: 1000
			});
		}
		counter = counter-1;
		$("#timer").html(counter);
	}, 1000);
	<?php } ?>

</script>
</body>
</html>