<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $the_title; ?></title>
  <link rel="icon" href="<?php echo Routing::home(); ?>assets/img/favicon.png">

  <link href="<?php echo Routing::home(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo Routing::home(); ?>assets/css/bootstrap4-material-lite.css" rel="stylesheet">
  <link href="<?php echo Routing::home(); ?>assets/css/template.css" rel="stylesheet">
</head>
<body class="view-<?php echo $template; ?>">