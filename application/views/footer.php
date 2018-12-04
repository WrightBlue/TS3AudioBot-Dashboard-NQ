<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<footer class="footer">
    <div class="container-fluid">
        <nav class="copyright float-left">
            Front-end made with <i class="material-icons">favorite</i> by <a href="https://www.creative-tim.com"
                                                                             target="_blank">Creative Tim</a>
        </nav>
        <div class="copyright float-right">
            Back-end made with <i class="material-icons">favorite</i> by <a href="https://www.intcode.pl"
                                                                            target="_blank">INTCODE.PL</a>
        </div>
    </div>
</footer>
</div>
</div>
<script src="<?= base_url(); ?>assets/js/core/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/core/popper.min.js"></script>
<script src="<?= base_url(); ?>assets/js/core/bootstrap-material-design.min.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins/chartist.min.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins/bootstrap-notify.js"></script>
<script src="<?= base_url(); ?>assets/js/material-dashboard.min.js?v=2.1.0"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    <?php if ($this->config->item('scripts')['wow_animation']): ?>
    new WOW().init();
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'home' || empty($this->uri->segment(1))): ?>
    $(document).on('click', '#auth', function () {
        $.ajax({
            url: "<?= base_url('api/auth'); ?>", type: 'post', data: {
                login: document.getElementById('login').value,
                password: document.getElementById('password').value,
            }, success: function (data) {
                showAlert(data.success, data.message);
                if (data.success === true) {
                    setTimeout(() => {
                        document.location.href = "<?= base_url('dash'); ?>";
                    }, 1000);
                }
            }
        });
    });
    <?php elseif ($this->uri->segment(1) == 'logs'): ?>
    var objDiv = document.getElementById("logs");
    if (objDiv !== null) {
        objDiv.scrollTop = objDiv.scrollHeight;
    }
    $(document).on('click', '#show-logs', function () {
        document.location.href = "<?= base_url('logs/show/') ?>" + $('select[name=day]').val();
    });
    <?php elseif ($this->uri->segment(1) == 'dash'): ?>
    function updateData() {
        $.ajax({
            url: "<?= base_url('api/bot/list'); ?>",
            type: 'GET',
            success: function (result) {
                var tr = '';
                $('[rel="tooltip"]').tooltip('hide');
                $("#ajax").empty();
                $.each(result, function (index, val) {
                    tr += `<tr style="background-color: ${val.color};"><td class="text-center">${val.id}</td><td>${val.name}</td><td><button type="button" class="btn btn-success btn-round btn-sm" name="start" id="start" data-bot_id="${val.id}" rel="tooltip" title="Włącz bota"><i class="material-icons">power_settings_new</i></button><button type="button" class="btn btn-danger btn-round btn-sm" name="stop" id="stop" data-bot_id="${val.id}" rel="tooltip" title="Wyłącz bota"><i class="material-icons">cancel</i></button><button type="button" class="btn btn-warning btn-round btn-sm" name="delete" id="delete" data-bot_id="${val.id}" rel="tooltip" title="Usuń bota"><i class="material-icons">delete_forever</i></button><a href="<?= base_url('edit/${val.id}'); ?>"><button type="button" class="btn btn-info btn-round btn-sm" rel="tooltip" title="Edytuj bota"><i class="material-icons">build</i></button></a></td><td>${val.status}</td></tr>`;
                });
                $('#ajax').append(tr);
                $('[rel="tooltip"]').tooltip();
            },
        });
    }
    updateData();
    setInterval(function () {
        updateData();
    }, 10000);
    $(document).on('click', '#start', function () {
        $.ajax({
            url: "<?= base_url('api/bot/start'); ?>", type: 'post', data: {
                id: $(this).data('bot_id')
            },
            success: function (data) {
               showAlert(data.success, data.message);
            }
        });
    });
    $(document).on('click', '#stop', function () {
        $.ajax({
            url: "<?= base_url('api/bot/stop'); ?>", type: 'post', data: {
                id: $(this).data('bot_id')
            },
            success: function (data) {
                showAlert(data.success, data.message);

            }
        });
    });
    $(document).on('click', '#delete', function () {
        $.ajax({
            url: "<?= base_url('api/bot/delete'); ?>", type: 'post', data: {
                id: $(this).data('bot_id')
            },
            success: function (data) {
                showAlert(data.success, data.message);

            }
        });
    });
    <?php elseif ($this->uri->segment(1) == 'create'): ?>
    $(document).on('click', '#create', function () {
        $.ajax({
            url: "<?= base_url('api/bot/create'); ?>", type: 'post', data: {
                name: document.getElementById('name').value,
                channel: document.getElementById('channel').value,
                server: document.getElementById('server').value,
                rights: document.getElementById('rights').value,
            }, success: function (data) {
                showAlert(data.success, data.message);
            }
        });
    });
    <?php elseif ($this->uri->segment(1) == 'edit'): ?>
    $(document).on('click', '#cfg-save', function () {
        $.ajax({
            url: "<?= base_url('api/bot/edit'); ?>", type: 'post', data: {
                id: "<?= $this->uri->segment(2); ?>",
                file: "cfg",
                data: document.getElementById('cfg').value,
            }, success: function (data) {
                showAlert(data.success, data.message);
            }
        });
    });
    $(document).on('click', '#toml-save', function () {
        $.ajax({
            url: "<?= base_url('api/bot/edit'); ?>", type: 'post', data: {
                id: "<?= $this->uri->segment(2); ?>",
                file: "toml",
                data: document.getElementById('toml').value,
            }, success: function (data) {
                showAlert(data.success, data.message);
            }
        });
    });
    <?php endif; ?>

    function showAlert(type, message)
    {
        $.notify({
            icon: "notifications", message: message
        }, {
            type: type ? "success" : "danger", timer: 1000
        });
    }
</script>
</body>
</html>
