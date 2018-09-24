<!DOCTYPE html>
<html lang="pt_BR">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Encurtador de URLs">
<meta name="author" content="Mauricio Toledo">
<title>Encurtador de URLs</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link href="http://getbootstrap.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
<link href="<?=base_url('assets/css/layout.css')?>" rel="stylesheet">
<!--[if lt IE 9]><script src="http://getbootstrap.com/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="http://getbootstrap.com/assets/js/ie-emulation-modes-warning.js"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="<?=base_url()?>">Encurtador de URLs</a>
</div>
<div id="navbar" class="collapse navbar-collapse">
<ul class="nav navbar-nav pull-right">
<li><a href="<?=base_url()?>">Home</a></li>
<?php if($this->session->userdata('logged')){?>
<li><a href="<?=base_url('minhas-urls')?>">Minhas URLs</a></li>
<li><a href="<?=base_url('alterar-senha')?>">Alterar Senha</a></li>
<li><a href="<?=base_url('logout')?>">Sair</a></li>
<?php } else{ ?>
<li><a href="<?=base_url('login')?>">Login/Cadastro</a></li>
<?php } ?>
</ul>
</div>
</div>
</nav>