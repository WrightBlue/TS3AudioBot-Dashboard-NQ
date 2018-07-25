<?php
	if (!$_SESSION['user_online']) {
		$_SESSION['alert'] = array('message' => 'Najpierw musisz sie zalogować!', 'type' => 'danger');
		header('Location: ?login');
		exit();
	}
?>
<div class="content">
	<div class="container-fluid">
		<div class="container">
			<div class="card wow slideInDown" data-wow-duration="1s">
				<div class="card-header card-header-primary wow slideInLeft" data-wow-duration="1100ms">
					<h4 class="card-title text-center">Logi TS3AudioBot</h4>
				</div>
				<div class="card-body wow slideInRight" data-wow-duration="1100ms" style="height:500px; overflow-y: scroll;" id="logs">
					<?php
						$file = file_get_contents('/home/TS3AudioBot/ts3audiobot.log');
						$items = [" INFO", " WARN", "DEBUG", "ERROR"];
						$itemsreplace = ["<b class='text-info'>INFO</b>", "<b class='text-warning'>WARN</b>", "<b class='text-muted'>DEBUG</b>", "<b class='text-danger'>ERROR</b>"];
						$file = str_replace($items, $itemsreplace, $file);
						$file = str_replace(array('&lt;','&gt;'),array('<','>'), htmlentities($file));
						echo '<code><pre>'.$file.'</pre></code>';
					?>
				</div>
			</div>
		</div>
	</div>
</div>