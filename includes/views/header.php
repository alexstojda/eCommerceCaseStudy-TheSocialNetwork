<!doctype html>
<html>
<head>

    <title><?=(isset($this->title)) ? $this->title : 'MVC'; ?></title>




    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/sunny/jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>/css/default.css" />

    <link rel="stylesheet" href="<?php echo URL; ?>/css/font-awesome.min.css" />

    <link rel="stylesheet" href="<?php echo URL; ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>/css/bootstrap-theme.min.css" />

    <script type="text/javascript" src="<?php echo URL; ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>/js/npm.js"></script>

    <?php
    if (isset($this->js)) 
    {
        foreach ($this->js as $js)
        {
            echo '<script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';
        }
    }
    ?>
</head>
<body>

<?php Session::init(); ?>
    
<div id="header">

    <?php if (Session::get('loggedIn') == false):?>
        <a href="<?php echo URL; ?>index">Index</a>
        <a href="<?php echo URL; ?>help">Help</a>
    <?php endif; ?>    
    <?php if (Session::get('loggedIn')  == true):?>
        <a href="<?php echo URL; ?>dashboard">Dashboard</a>
        <a href="<?php echo URL; ?>note">Notes</a>
        
        <?php if (Session::get('role') == 'owner'):?>
        <a href="<?php echo URL; ?>user">Users</a>
        <?php endif; ?>
        
        <a href="<?php echo URL; ?>dashboard/logout">Logout</a>    
    <?php else: ?>
        <a href="<?php echo URL; ?>login">DELETE FROM HEADER.PHP</a>
    <?php endif; ?>
</div>
    
<div id="content">
    
    