<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card wow slideInDown" data-wow-duration="1000ms">
                    <div class="card-header card-header-primary wow slideInLeft" data-wow-duration="1100ms">
                        <h4 class="card-title text-center"><?= $this->config->item('lang')['dash_manage_bots']; ?></h4>
                    </div>
                    <div class="card-body wow slideInRight" data-wow-duration="1200ms">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                <th class="text-center"><?= $this->config->item('lang')['dash_tabele_id']; ?></th>
                                <th><?= $this->config->item('lang')['dash_tabele_name']; ?></th>
                                <th><?= $this->config->item('lang')['dash_tabele_options']; ?></th>
                                <th><?= $this->config->item('lang')['dash_tabele_status']; ?></th>
                                </thead>
                                <tbody id="ajax">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="EditBot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?= $this->config->item('lang')['dash_edit_header']; ?> #<b id="header_bot_id"></b>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">[!] <?= $this->config->item('lang')['dash_edit_input_name']; ?> :</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">[!] <?= $this->config->item('lang')['dash_edit_input_server']; ?>:</label>
                            <input type="text" class="form-control" id="server">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">[!] <?= $this->config->item('lang')['dash_edit_input_channel']; ?>:</label>
                            <input type="text" class="form-control" id="channel">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">[?] <?= $this->config->item('lang')['dash_edit_input_avatar']; ?>:</label>
                            <input type="text" class="form-control" id="avatar">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">[!] <?= $this->config->item('lang')['dash_edit_input_disconnect']; ?>:</label>
                            <input type="text" class="form-control" id="leave_message">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">[?] <?= $this->config->item('lang')['dash_edit_input_music']; ?>:</label>
                            <input type="text" class="form-control" id="music_message">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="form-control" id="id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $this->config->item('lang')['dash_edit_button_cancel']; ?></button>
                        <button type="submit" class="btn btn-primary" id="create" data-dismiss="modal"><?= $this->config->item('lang')['dash_edit_button_edit']; ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>