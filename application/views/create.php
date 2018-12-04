<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card wow slideInDown" data-wow-duration="1000ms">
                    <div class="card-header card-header-primary wow slideInLeft" data-wow-duration="1100ms">
                        <h4 class="card-title text-center"><?= $this->config->item('lang')['create_header']; ?></h4>
                    </div>
                    <div class="card-body">
                        <input type="text" class="form-control wow slideInLeft" data-wow-duration="1200ms"
                               id="server" maxlength="30"
                               placeholder=" [!] <?= $this->config->item('lang')['create_server']; ?>" required><br>
                        <input type="text" class="form-control wow slideInLeft" data-wow-duration="1300ms"
                               id="name" maxlength="30" placeholder=" [!] <?= $this->config->item('lang')['create_name']; ?>" required><br>
                        <input type="text" class="form-control wow slideInLeft" data-wow-duration="1600ms"
                               id="channel" maxlength="10" placeholder=" [!] <?= $this->config->item('lang')['create_channel']; ?>" required><br>
                        <textarea class="form-control" id="rights" rows="20"># Uprawnienie admin
[[rule]]
    groupid = [ 1337 ]
	"+" = [
		"*",
	]
# Uprawnienie Gildia
[[rule]]
    groupid = [ 1337 ]
	"+" = [
		"cmd.play",
		"cmd.volume",
		"cmd.bot.come",
		"cmd.pause",
		"cmd.stop",
		"cmd.stop",
		"cmd.link",
		"cmd.song",
	]</textarea><br>
                        <button type="submit" class="btn btn-info btn-fill btn-block" id="create"><?= $this->config->item('lang')['create_create']; ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>