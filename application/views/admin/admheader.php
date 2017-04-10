<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - CariKos</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/Admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>assets/Admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/Admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url(); ?>assets/Admin/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/Admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url('admin/beranda')?>">CariKos</a>
            </div>

            <div class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      <i class="fa fa-bell fa-fw"></i>
                      <?php
                        foreach ($notifTransaksi as $row) {
                             if($row->totalTransaksi > 0){ ?>
                                <span class="badge"><?php echo $row->totalTransaksi;?></span>
                            <?php }?>
                        <?php }?>
                      <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                      <li><a href="<?php echo site_url('admin/trans')?>"><h5 style="margin-left: 20px;">Transaksi <?php
                        foreach ($notifTransaksi as $row) {
                             if($row->totalTransaksi > 0){ ?>
                                <span class="badge"><?php echo $row->totalTransaksi;?></span>
                            <?php }?>
                        <?php }?></h5></li></a>
                  </ul>
                </li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      <i class="fa fa-user fa-fw"></i>
                        <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                      <li><h4 style="margin-left: 20px; text-transform: uppercase; font-weight: bold;"><?php echo $username?></h4></li>
                      <li class="divider"></li>
                      <li><a href="<?php echo site_url('admin/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Keluar</a></li>
                  </ul>
                </li>
                
            </div>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo site_url('admin/beranda')?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Master Data<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('admin/lihatKos')?>"><i class="fa fa-home fa-fw"></i> Indekos</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('admin/reservasi')?>"><i class="fa fa-book fa-fw"></i> Reservasi</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('admin/trans')?>"><i class="fa fa-dollar fa-fw"></i> Transaksi</a>
                                </li>
                                
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo site_url('admin/lapkeu')?>"><i class="fa fa-dollar fa-fw"></i> Laporan Keuangan</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

  <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/Admin/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/Admin/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/Admin/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url(); ?>assets/Admin/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/Admin/vendor/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/Admin/data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>assets/Admin/dist/js/sb-admin-2.js"></script>