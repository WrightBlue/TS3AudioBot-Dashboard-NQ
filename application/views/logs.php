<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="container">
            <div class="card wow slideInDown" data-wow-duration="1s">
                <div class="card-header card-header-primary wow slideInLeft"
                     data-wow-duration="1100ms">
                    <h4 class="card-title text-center">Wybierz logi</h4>
                </div>
                <div class="card-body wow slideInRight" data-wow-duration="1100ms">
                    <select class="form-control wow slideInLeft"
                            data-wow-duration="1400ms" data-style="btn btn-link" name="day">
                        <?php
                        foreach (glob('/home/TS3AudioBot-FREE/Logs/*.log') as $file) {
                            preg_match("/\d{4}-\d{2}-\d{2}/", $file, $match);
                            if ($match[0] == date('Y-m-d')) {
                                echo '<option value="' . $match[0] . '" selected>Logi z dnia: ' . $match[0] . '</option>';
                            } else {
                                echo '<option value="' . $match[0] . '">Logi z dnia: ' . $match[0] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <button class="btn btn-info btn-fill btn-block" id="show-logs">Pokaż logi</button>
                </div>
            </div>
        </div>
    </div>
</div>
