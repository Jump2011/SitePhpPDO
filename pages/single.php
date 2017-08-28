<?php include_once ('includes/sidebar.php');?>

                <div id="content-single">
                    
                    <?php
                    foreach ($query->getPost($arquivo, $post) as $postagem){
                        $idPost = $postagem['id'];
                        try{
                        $atualizar = BD::conn()->prepare("UPDATE posts SET views = views+1 WHERE id= '$idPost'");
                        $atualizar->execute();
                        } catch (PDOException $erro){
                            echo 'Erro ao atualizar views';
                            logErrors($erro);
                        }
                        $pegarComentarios = BD::conn()->prepare("SELECT * FROM comentarios WHERE id_post = '$idPost'");
                        //$pegarComentarios = BD::conn()->prepare("SELECT * FROM comentarios WHERE id_post = '$idPost' AND status = '1'");
                        $pegarComentarios->execute();
                        $numComents = $pegarComentarios->rowCount();
                    ?>
                    
                    <div class="box-title">
                        <h1><?php echo $arquivo.'|'.$post;?></h1>
                    </div><!-- box-title -->
                    <div class="box-share">
                        <div class="compartilhar">
                            <span class="facebook">
                            <a name="fb-share" type="buttom_count" href="http://www.facebook.com/sharer.php"
                               share_url="https://www.facebook.com/junio.s.souza1">Curtir</a>
                            <script src="http://static.ak.fbcdn.net/connect.php/js/FB.share" type="text/javascript"></script>
                            </span><!-- facebook -->
                        </div><!-- REDES SOCIAIS -->
                        <span class="static"><img src="<?php echo $base;?>/imgs/coment.png" border="0" class="com"/><?php echo $numComents;?> Comentários | <?php echo $postagem['views'];?> Visualizações</span>
                    </div><!-- box-share -->
                    
                        <div class="content">
                            <p><?php echo html_entity_decode($postagem['conteudo']);?></p>
                        </div><!-- content // Conteudo da single -->
                    </div><!-- content-single -->
                
                <!-------------Aqui listamos os comentarios ---------->
                
                <div id="comentarios">
                    <h2>Comentários até o momento (<?php echo $numComents;?>)/</h2>
                    
                    <?php
                        while($comentario = $pegarComentarios->fetchObject()){
                            $emailuser = $comentario->email;
                            $default = "https://www.somewhere.com/homestar.jpg";
                            $size = 50;
                            $grav_url = "https://www.gravatar.com/avatar/".md5(strtolower(trim($emailuser)))."?d=".urlencode($default)."&s=".$size;
                            $uurl = $base.'/'.$arquivo.'/'.$post;
                    ?>
                    <div class="coment">
                    <img src="<?php echo $grav_url;?>" width="50" height="50" border="0"/>
                    <span><?php echo $comentario->nome;?> em <?php echo date('d/m/Y', strtotime($comentario->data));?></span>
                    <p><?php echo $comentario->comentario;?></p>
                    <div class="fix"><a href="<?php echo $uurl?>&replyto=<?php echo $comentario->id;?>" id="res">Responder</a></div>
                     <?php
                        $respostas = BD::conn()->prepare("SELECT * FROM respostas WHERE id_com= '".$comentario->id."'");
                        $respostas->execute();
                        if($respostas->rowCount() <= 0){}else{
                        while ($resposta = $respostas->fetchObject()){                            
                        $grav_resp = "https://www.gravatar.com/avatar/".md5(strtolower(trim($resposta->email)))."?d=".urlencode($default)."&s=".$size;
                    ?>
                    <div class="resposta">
                        <img src="" width="45" height="45" border="0"/>
                        <span><?php echo $comentario->nome; ?> em <?php echo Date('d/m/Y', strtotime($comentario->data));?></span>
                        <p><?php echo $resposta->comentario; ?></p>    
                    </div><!-- resposta -->
                    <?php }}?>
                   </div><!--coment-->
                  <?php }?>
                </div><!--comentario-->       

                    <div id="comentar">
                    <h1>Deixe seu Comentário</h1>
                    <?php
                        if(isset($_POST['acao']) && $_POST['acao'] == 'comentar'){
                            $nome = strip_tags(filter_input(INPUT_POST, 'nome'));
                            $email = strip_tags(filter_input(INPUT_POST, 'email'));
                            $site = strip_tags(filter_input(INPUT_POST, 'site'));
                            $comentario = strip_tags(filter_input(INPUT_POST, 'comentario'));
                            
                            if($nome == '' || $email == '' || $comentario == ''){
                                    echo '<script>alert("Por favor, preencha todos os campos do formulário")</script>';
                            }else{
                                $id_post = $postagem['id'];
                                $status = '0';
                                if(!strstr('http://', $site)){
                                    $site = 'http://'.$site;
                                }else{}
                                if(isset($_GET['replyto'])){
                                $to = (int) strip_tags($_GET['replyto']);
                                $dados = array($id_post,$to, $nome, $email, $site, $comentario);
                                $executar = $query->comentar($dados, true);
                                }else{
                                $dados = array($id_post,$nome, $email, $site, $comentario, $status);
                                $executar = $query->comentar($dados);
                                }
                                if($executar){
                                if(isset($_GET['replyto'])){
                                    echo '<script>alert("Sua resposta foi enviada");location.href="'.$base.'/'.$arquivo.'/'.$post.'"</script>';
                                }else{
                                    echo '<script>alert("Seu comentário esta aguardando aprovação.");location.href="'.$base.'/'.$arquivo.'/'.$post.'"</script>';
                                }
                                }else{
                                    echo '<script>alert("Não foi possivel comentar, ou ocorreu algum erro!")</script>';
                                }
                            }
                        }      
                        if(isset($_GET['replyto']) && $_GET['replyto'] != ''){
                            $reply = (int) strip_tags($_GET['replyto']);
                            $pegarquem = BD::conn()->prepare("SELECT nome FROM comentarios WHERE id = '$reply'");
                            $pegarquem->execute();
                            $namequem = $pegarquem->fetchObject();
                            echo '<p  style="float:left;margin-right:4px;">Respoder para: <b>'.$namequem->nome.'</b></p> <a href="'.$uurl.'#cancelado">Cancelar resposta</a>';
                        } 
                       ?>
                    
                    <form action="" method="post" enctype="multipart/form-data">   
                        <label>
                            <span>Nome</span>
                            <input type="text" name="nome"/>
                        </label>
                        <label>
                            <span>E-mail</span>
                            <input type="text" name="email"/>
                        </label>
                        <label>
                            <span>Site</span>
                            <input type="text" name="site"/>
                        </label>
                            <span>Comentário</span>
                            <textarea name="comentario" cols="30" rows="5">                                
                            </textarea>  
                            <input type="hidden" name="acao" value="comentar"/>
                            <input type="submit" value="Comentar" class="btn"/>
                    </form>
                </div><!-- comentar -->
               <?php }?>                
                        
           