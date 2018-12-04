<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no"
          name="viewport">
    <title><?= $this->config->item('lang')['title']; ?></title>
    <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/img/favicon.png">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/material-dashboard.css?v=2.1.0">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/animate.css">
</head>
<body>
<div class="wrapper">
    <div class="sidebar wow slideInLeft" data-wow-duration="1s" data-color="green" data-background-color="white"
         data-image="<?= base_url(); ?>assets/img/sidebar-1.png">
        <div class="logo">
            <a href="#" class="simple-text logo-normal">
                <?= $this->config->item('lang')['title']; ?>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('dash'); ?>">
                        <i class="material-icons">dashboard</i>
                        <p><?= $this->config->item('lang')['manage_bots']; ?></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('create'); ?>">
                        <i class="material-icons">build</i>
                        <p><?= $this->config->item('lang')['create_bots']; ?></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('logs'); ?>">
                        <i class="material-icons">event_note</i>
                        <p><?= $this->config->item('lang')['logs_bots']; ?></p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top wow slideInDown"
             data-wow-duration="1s">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <?php if ($this->session->userdata('logged')) { ?>
                    <div class="collapse navbar-collapse justify-content-end">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('logout'); ?>">
                                    <i class="material-icons">power_settings_new</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </nav>
