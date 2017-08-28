<?php
include_once ('conf.php');
require_once ('classes/Query.class.php');
require_once ('classes/Cadastro.class.php');
$query = new Query;
?>
<!DOCTYPE html>
<!--@JunioSantos-->

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Seu site, um site de noticias, envolvendo entretenimento, novidades, novelas, cinema e muito mais."/>
        <meta name="Keywords" content="noticias, entreternimento, novidades, videos"/>
        <title>Seu site, seu slogan aqui</title>
        <link rel="stylesheet" type="text/css" href="<?php echo $base;?>/CSS/style.css"/>
        <script type="text/javascript" src="<?php echo $base;?>/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo $base;?>/js/efeito.js"></script>
    </head>
    <body>
        <div id="box">
            <div id="header">
                <div class="logo">
                    <a href="" title="Logomarca"><img src="<?php echo $base;?>/imgs/logo_.png" border="0" title="Seu site, Logomarca" alt="Seu site, Logomaca"></a>
                </div><!-- logomarga -->
                <div class="search">
                    <form action="<?php echo $base;?>" method="get" enctype="multipart/form-data">
                        <input type="text" name="s">
                        <input type="submit" value="" class="btn-search"/>
                    </form>
                </div><!-- Div search -->
                <div id="menu">
                    <ul>
                        <li><a href="<?php echo $base;?>" title="Home">Home</a></li>
                        <?php $query->get_menu($base); ?>
                        <li class="right"><a href="<?php echo $base;?>/contato" title="Contato">Contato</a></li>
                        <li class="right"><a href="<?php echo $base;?>/Cadastre-se">Cadastre-se</a></li>
                    </ul>
                </div>
            </div><!-- header -->