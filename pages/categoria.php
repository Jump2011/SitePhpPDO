<?php include_once ('includes/sidebar.php');?>    
    <div id="content-single">
    <?php 
        $arquivo = htmlentities($arquivo);
        $pegar_categoria = BD::conn()->prepare("SELECT * FROM subcat WHERE slug = '$arquivo'");
        $pegar_categoria->execute();
        $fetchCat = $pegar_categoria->fetch(PDO::FETCH_OBJ);
    ?>
    <h1 class="title-cat">Categoria <?php echo $fetchCat->nome;?></h1>
    <?php
        $pg = (isset($_GET['pagina'])) ? (int)htmlentities($_GET['pagina']) : '1';
        $maximo = '2';
        $inicio = (($pg * $maximo) - $maximo);
        $pegarPosts = BD::conn()->prepare("SELECT * FROM posts WHERE categoria = '$arquivo' ORDER BY id DESC LIMIT $inicio, $maximo"
                . "");
        $pegarPosts->execute();
        if($pegarPosts->rowCount() == 0){
            echo '<p>Não existe posts nesta categoria!</p>';
        } else {
            while ($linha = $pegarPosts->fetchObject()){
                $selecionarAutor = BD::conn()->prepare("SELECT nome FROM usuario WHERE id = '".$linha->autor."'");
                $selecionarAutor->execute();
                $fetchAutor = $selecionarAutor->fetch();
                
                $selecionarComentarios = BD::conn()->prepare("SELECT id FROM comentarios WHERE id_post = '".$linha->id."' AND status = '1'");
                $selecionarComentarios->execute();
                $contarComent = $selecionarComentarios->rowCount();
    ?>          
    <div class="post-cat">
        <div class="sta">
            <span class="por">Postado por: <?php echo $fetchAutor['nome'];?> em <?php echo date('d/m/Y', strtotime($linha->data));?></span>
            <span class="cmt"><img src="imgs/coment.png" class="img-cmt"/><strong><?php echo $contarComent;?> Comentários</strong></span>
            <span class="view"> <?php echo $linha->views;?> visualizações</span>
        </div>
        <img src="<?php echo $base;?>imgs/<?php echo $linha->exibicao;?>" width="130" height="74"/>
        <a href="<?php echo $base.'/'.$linha->categoria.'/'.$linha->slug;?>">
            <span class="title"><?php echo $linha->titulo;?></span>
            <p><?php echo $query->limitar (html_entity_decode($linha->categoria), 110);?></p>
        </a>
    </div><!-- post-cat -->
            <?php }}?>
                           
    <div class="paginator">
        <?php
            $sql_res = BD::conn()->prepare("SELECT * FROM posts WHERE categoria = '$arquivo'");
            $sql_res->execute();
            $total = $sql_res->rowCount();
            $pags = ceil($total/$maximo);
            $links = '5';
            
            echo '<span class="page">Páginas: '.$pg.' de '.$pags.'</span>';
                for($i = $pg-$links; $i<= $pg-1;$i++){
                   if($i<=0){}else{
                      echo '<a href="'.$base.'/'.$arquivo.'/$pagina='.$i.'">'.$i.'</a>';    
                }
            }echo '<strong>'.$pg.'</strong>';
                for($i = $pg+1; $i<=$pg+$links;$i++){
                  if($i>$pags){}else {
                     echo '<a href="'.$base.'/'.$arquivo.'/$pagina='.$i.'">'.$i.'</a>';
               }
            }
            echo '<a href="'.$base.'/'.$arquivo.'$pagina='.$pags.'">Última Página</a>';    
        ?>
        </div>
    </div><!-- content-single -->           
           