<?php include_once ('includes/header.php');?>

<div id="conteudo">
        <?php
        $url = (isset($_GET['url'])) ? $_GET['url'] : '';
        $parametros = explode('/', $url);
        $arquivo = $parametros['0'];
        $post = $parametros['1'];
        
        $paginas = array('contato','Cadastre-se');
        if(isset($_GET['s']) && $_GET['s'] != ''){
            include "pages/busca.php";
        }elseif(isset ($post) && $post != '') {
            include "pages/single.php";
        }elseif(isset ($arquivo) && in_array($arquivo, $paginas)){
            include "pages/$arquivo".'.php';
        }elseif(isset ($arquivo) && $arquivo == ''){
            include "pages/home.php";
        } else {
            include "pages/categoria.php";
        }
    
        ?>
</div> <!-- conteudo principal -->
<?php include_once ('includes/footer.php');?>
