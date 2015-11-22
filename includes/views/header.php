<!doctype html>
<html>
<head>

    <title><?= (isset($this->title)) ? $this->title : 'NO TITLE'; ?></title>

    <!-- Jquery-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/sunny/jquery-ui.css"/>



    <link rel="stylesheet" href="<?php echo URL; ?>css/default.css"/>

    <!-- Font awesome-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Bootstrap Original-->
    <!--link rel="stylesheet" href="<?php //echo URL; ?>/css/bootstrap.min.css" /-->
    <!--link rel="stylesheet" href="<?php //echo URL; ?>/css/bootstrap-theme.min.css" /-->

    <!-- Bootstrap Theme @http://bootswatch>
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/cerulean/bootstrap.min.css" rel="stylesheet"-->
    <link href="<?php echo URL; ?>/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo URL; ?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>js/npm.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>js/bootstrap-filestyle.min.js"> </script>
    <link rel="stylesheet" href="<?php echo URL; ?>css/default.css"/>
    <!-- Custom CSS (READ THIS PLEASE, TNX : http://verekia.com/less-css/dont-read-less-css-tutorial-highly-addictive)-->

    <?php
    if (isset($this->js)) {
        foreach ($this->js as $js) {
            echo '<script type="text/javascript" src="' . URL . 'views/' . $js . '"></script>';
        }
    }
    ?>
</head>
    
    