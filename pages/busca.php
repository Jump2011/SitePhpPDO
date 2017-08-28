<?php include_once ('includes/sidebar.php');?>

<div id="content-single">
    <h1 class="title-cat">Categoria Noticias</h1>
        <?php
            if($_GET['s'] != ''){
               $explode = explode(' ', strip_tags($_GET['s']));
               $num = count($explode);
               $busca = '';
               for($i=0;$i<$num;$i++){
               $busca .= "titulo LIKE :busca$i";
               if($i<>$num-1){
                   $busca .= 'AND';
               }
            }//STRING DE PESQUISA DINAMICA
            
            $pg = (isset($_GET['pagina'])) ? (int)htmlentities($_GET['pagina']) : '1';
            $maximo = '5';
            $inicio = (($pg * $maximo) - $maximo);            
            $buscar = BD::conn()->prepare("SELECT * FROM posts WHERE status = '0' AND $busca LIMIT $inicio, $maximo");
            for($i=0;$i<$num;$i++){
                $buscar->bindValue(":busca$i",'%'.$explode[$i].'%',PDO::PARAM_STR);
            }
            $buscar->execute();
           }//fim verificação do get
           
           if($buscar->rowCount() >0){
            while ($resultado = $buscar->fetchObject()){
            for($i=0;$i<$num;$i++){
            if($i==0){$marcado = strtolower($resultado->titulo);}
            $titulo = str_replace($explode[$i],'<strong style="color:#069">'.$explode[$i].'</strong>', $marcado);
            $marcado = $titulo;
           }
           $comentariospost = BD::conn()->prepare("SELECT id FROM comentarios WHERE status = '1' AND id_post = '".$resultado->id."'");
           $comentariospost->execute();
           $numerocoments =  $comentariospost->rowCount();
           
           //pegar autor
           $pegarautor = BD::conn()->prepare("");
           ?>
    
           <div class="post-cat">
            <div class="sta">
                <span class="por">Postado por: Junio Santos em <?php echo date('d/m/Y', strtotime($resultado->data));?></span>
                <span class="cmt"><img src="imgs/coment.png" class="img-cmt"/><strong><?php echo $numerocoments;?> Comentários</strong></span>
                <span class="view"><?php echo $resultado->views;?> visualizações</span>
            </div>
                <img src="<?php echo $base;?>/posts/<?php echo $resultado->exibicao;?>" width="130" height="74"/>
                <a href="<?php echo $base.'/'.$resultado->categoria.'/'.$resultado->slug;?>" title="<?php echo $resultado->titulo;?>">
                <span class="title"><?php echo $titulo;?></span>
                <p><?php echo $query->limitar(html_entity_decode($resultado->conteudo), 120);?></p>
                </a>
            </div><!-- post-cat -->
           <?php
            }
           }else{
            echo '<p>Não foram encontrado resultados a sua busca</p>';
           }
        ?>
<div class="paginator">
    <?php
        $sql_res = BD::conn()->prepare("SELECT * FROM posts WHERE status = '0' AND $busca");
        for($i=0;$i<$num;$i++){
        $sql_res->bindValue(":busca$i",'%'.$explode[$i].'%',PDO::PARAM_STR);
        }            
        $sql_res->execute();
        $total = $sql_res->rowCount();
        $pags = ceil($total/$maximo);
        $links = '5';
        
        echo '<span class="page">Páginas: '.$pg.' de '.$pags.'</span>';
        for($i = $pg-$links; $i<= $pg-1;$i++){
        if($i<=0){}else{
         echo '<a href="'.$base.'/?s='. strip_tags($_GET['s']).'/$pagina='.$i.'">'.$i.'</a>';    
         }
        }echo '<strong>'.$pg.'</strong>';
          for($i = $pg+1; $i<=$pg+$links;$i++){
        if($i>$pags){}else {
          echo '<a href="'.$base.'/?s='. strip_tags($_GET['s']).'/$pagina='.$i.'">'.$i.'</a>';    
         }
        }
        echo '<a href="'.$base.'/'.$arquivo.'$pagina='.$i.'">Última Página</a>';    
    ?>
</div>
</div><!-- content-single -->