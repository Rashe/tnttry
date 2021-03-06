<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title ?> - Our cool site</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('styles/reset.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('styles/registration.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('styles/style.css'); ?>">
    <script type="text/javascript" src="<?php echo base_url('scripts/jquery-1.10.2.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('scripts/user.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('scripts/script.js'); ?>"></script>
</head>
<body>
<header>
    <div id="topHeader">
        <a href="<?php echo base_url(); ?>" class="logo">LOGO</a>
        <div class="loginWrapper"><?php if(isset($userpanel)) print $userpanel; ?></div>
    </div>
    <div id="bottomHeader">
        <nav>
            <ul>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/about">About</a></li>
                <?php if($username){ ?>
                    <li><a href="<?php echo base_url(); ?>index.php/userdata">Your settings</a></li>
                <?php } else { ?>
                <li><a href="<?php echo base_url(); ?>index.php/registration">Registration</a></li>
                <?php } ?>
                <li><a href="<?php echo base_url(); ?>index.php/make_post">Make post</a></li>
            </ul>
        </nav>
    </div>

</header>
<section id="main">


