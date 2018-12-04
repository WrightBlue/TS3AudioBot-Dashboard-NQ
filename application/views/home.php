<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="container">
            <div class="col-lg-4 col-md-6 col-sm-6 ml-auto mr-auto">
                <div class="card card-login card-hidden">
                    <div class="card-header card-header-success text-center">
                        <h4 class="card-title"><?= $this->config->item('lang')['login_header']; ?></h4>
                    </div>
                    <div class="card-body">
							<span class="bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">
											<i class="material-icons">fingerprint</i>
										</span>
									</div>
					                     <input type="text" id="login" class="form-control"
                                                placeholder="<?= $this->config->item('lang')['login_user']; ?>">
					               </div>
							</span>
                        <span class="bmd-form-group">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">
											<i class="material-icons">lock_open</i>
										</span>
									</div>
					                     <input type="password" id="password" class="form-control"
                                                placeholder="<?= $this->config->item('lang')['login_password']; ?>">
					               </div>
							</span>
                    </div>
                    <div class="card-footer justify-content-center">
                        <button class="btn btn-success btn-link btn-lg"
                                id="auth"><?= $this->config->item('lang')['login_button']; ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
