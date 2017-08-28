    <?php include_once ('includes/sidebar.php');?>
    <div id="sidebar">
    <?php
        if($arquivo != '' && $post != ''){
        $pegarpost = BD::conn()->prepare("SELECT autor FROM posts WHERE categoria = '$arquivo' AND slug = '$post' LIMIT 1");
        $pegarpost->execute();
        $fetch = $pegarpost->fetchObject();
            //AQUI PEGA O AUTOR
        $pegarAutor = BD::conn()->prepare("SELECT * FROM usuario WHERE id = '".$fetch->autor."'");
        $pegarAutor->execute();
        $fetchAutor = $pegarAutor->fetchObject();
    ?>

    <div class="dados-autor">
        <img src="<?php echo $base.'/usuarios/'.$fetchAutor->imagem; ?>" width="60" height="60" alt=""/>
        <span><?php echo $fetchAutor->nome; ?></span>
        <span class="email"><?php echo $fetchAutor->email; ?></span>
        <p><?php $fetchAutor->descricao;?></p>
        <a href="<?php echo $fetchAutor->site;?>">Site do Autor</a>
    </div><!-- dados-autor -->
    <?php }?>
    
    <div class="mais-vistos">
        <h1>Mais Vistos</h1>
            <ul>
        <?php
        $pegarMaisVistos = BD::conn()->prepare("SELECT *  FROM posts ORDER BY views DESC LIMIT 5");
        $pegarMaisVistos->execute();
        if($pegarMaisVistos->rowCount() == 0){                                
        }else {
        $num = '0';
        while ($postvisto = $pegarMaisVistos->fetchObject()){
        $num++;                             
        ?>
        <li>
        <span class="num"><?php echo $num;?></span>
        <a href="<?php echo $base.'/'.$postvisto->categoria.'/'.$postvisto->slug;?>"><?php echo $postvisto->titulo;?></a>
        </li>
        <?php }}?>    
        </ul>
        </div><!-- mais-vistos -->
        </div><!-- sidebar -->