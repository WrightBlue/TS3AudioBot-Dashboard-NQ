<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card wow slideInDown" data-wow-duration="1000ms">
                    <div class="card-header card-header-primary wow slideInLeft" data-wow-duration="1100ms">
                        <h4 class="card-title text-center">Plik: <?= $this->uri->segment(2); ?>.cfg</h4>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control" id="cfg" rows="20"><?= file_get_contents("/home/TS3AudioBot-FREE/config/".$this->uri->segment(2).".cfg"); ?></textarea><br>
                        <button type="submit" class="btn btn-info btn-fill btn-block" id="cfg-save">ZAPISZ PLIK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card wow slideInDown" data-wow-duration="1000ms">
                    <div class="card-header card-header-primary wow slideInLeft" data-wow-duration="1100ms">
                        <h4 class="card-title text-center">Plik: <?= $this->uri->segment(2); ?>.toml</h4>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control" id="toml" rows="20"><?= file_get_contents("/home/TS3AudioBot-FREE/permissions/".$this->uri->segment(2).".toml"); ?></textarea><br>
                        <button type="submit" class="btn btn-info btn-fill btn-block" id="toml-save">ZAPISZ PLIK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>