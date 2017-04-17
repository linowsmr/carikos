<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Stylish Portfolio - Start Bootstrap Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/stylish-portfolio.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/css/bootstrap-select.min.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/css/bootstrap-multiselect.min.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.js"></script>
    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!-- Navbar -->
    <nav id="top" class="navbar navbar-default" style="margin-bottom: 0%;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <a href="<?php echo site_url('home/index') ?>"><img class="navbar-brand" src="<?php echo base_url();?>assets/images/carikos-logo.png" style="width: 11%; height: 11%; margin-top: -1%;margin-bottom: -30%;"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo site_url('home/index') ?>">Cari Kos</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Transaksi  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="<?php echo site_url('transaksi/daftar') ?>"><i class="fa fa-user fa-fw"></i> Daftar Transaksi</a>
                    </li>
                    <li><a href="<?php echo site_url('transaksi/konfirmasi') ?>"><i class="fa fa-user fa-fw"></i> Konfirmasi Pembayaran</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <li><a href="<?php echo site_url('promo/index') ?>">Promo</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <?php echo $username ?>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> Edit Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="<?php echo site_url('pemilik/logout') ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
          </ul>
        </div>
      </div>
    </nav>
</body>