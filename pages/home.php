            <div id="bloco-um">
                  <?php
                  foreach ($query->selecaoLimit(1) as $post){
                  ?>
                    <div id="destaque">
                        <a href="<?php echo $base.'/'.$post['categoria'].'/'.$post['slug'];?>" title="<?php echo $post['titulo'];?>">
                            <img src="posts/<?php echo $post['exibicao'];?>" width="300" title="<?php echo $post['titulo'];?>" alt=""  height="170"/>
                            <span><?php echo $post['titulo'];?></span>
                        </a>
                    </div><!-- destaque -->
                  <?php } ?>
                    
                    <div id="outros-destaques">
                        <?php 
                          foreach ($query->selecaoLimit('1,3') as $postdois){
                        ?>
                        <div class="outro-destaque">
                            <a href="<?php echo $base.'/'.$postdois['categoria'].'/'.$postdois['slug']?>" title="<?php echo $postdois['titulo']?>">
                                <img src="posts/<?php echo $postdois['exibicao']?>" width="110" title="<?php echo $postdois['titulo']?>" alt="" height="62"/>
                                <span><?php echo $postdois['titulo']?></span> 
                            </a>                       
                        </div><!-- outros destaque -->                        
                          <?php }?>
                    </div><!-- outros destaques -->
                    
                   <div id="tabnav">
                            <ul id="tab-nav">
                                <li><a href="#cmt-home">Comentário</a></li> 
                                <li><a href="#mais-visto">Mais Vistos</a></li>
                            </ul>
                       <div id="#cmt-home" class="tab">                           
                       </div><!-- comentarios -->
                       <div id="mais-visto" class="tab"> 
                           <ul>
                               <?php
                               $maisvistos = BD::conn()->prepare("SELECT * FROM posts ORDER BY views DESC LIMIT 5");
                               $maisvistos->execute();
                               $num='0';
                               while ($postmais = $maisvistos->fetchObject()){
                                   $num++;
                                   echo '<li><span>'.$num.'</span><a href="'.$base.'/'.$postmais->categoria.'/'.$postmais->slug.'">'.$postmais->titulo.'</a></li>';       
                               }
                            ?>
                               
                           </ul>
                       </div><!-- comentarios -->
                        </div><!-- div tab nav -->                         
                </div><!-- bloco de destaques bloco um -->
<!-- ------------------------------------------------------------------------------------------------------------- -->
               <div id="bloco-dois">
                   <div id="artigos">
                       <h1>Últimos Artigos</h1> 
                       <?php 
                           foreach ($query->selecaoArtigo('4','artigos') as $artigo){
                       ?>
                       <div class="artigo">
                           <a href="<?php echo $base.'/'.$artigo['categoria'].'/'.$artigo['slug']?>" title="<?php echo $artigo['titulo']?>">
                               <img src="posts/<?php echo $artigo['exibicao']?>" width="110" <?php echo $artigo['titulo']?> alt="" height="62"/>
                               <span><?php echo $artigo['titulo']?></span>
                           </a>
                       </div> <!-- artigo -->                                             
                           <?php } ?>
               </div> <!-- ULTIMOS ARTIGOS -->
<!-- ------------------------------------------------------------------------------------------------------------- -->               
               <div id="videos">
                   <h1>Últimos Vídeos</h1> 
                   <div class="video">
                       <div id="thumb-vid">
                           <iframe width="80" height="60" src="https://www.youtube.com/embed/X9aztTn0R5M" frameborder="0" allowfullscreen border="0"></iframe>
                       </div>
                       <span>Titulo do video de teste para o site</span>
                   </div> <!-- video destaque -->
                   <div class="video">
                       <div id="thumb-vid">
                           <iframe width="80" height="60" src="https://www.youtube.com/embed/X9aztTn0R5M" frameborder="0" allowfullscreen border="0"></iframe>
                       </div>
                       <span>Titulo do video de teste para o site</span>
                   </div> <!-- video destaque -->
                   <div class="video">
                       <div id="thumb-vid">
                           <iframe width="80" height="60" src="https://www.youtube.com/embed/X9aztTn0R5M" frameborder="0" allowfullscreen border="0"></iframe>
                       </div>
                       <span>Titulo do video de teste para o site</span>
                   </div> <!-- video destaque -->
                   <div class="video">
                       <div id="thumb-vid">
                           <iframe width="80" height="60" src="https://www.youtube.com/embed/X9aztTn0R5M" frameborder="0" allowfullscreen border="0"></iframe>
                       </div>
                       <span>Titulo do video de teste para o site</span>
                   </div> <!-- video destaque -->                   
               </div><!-- videos -->
<!-- ------------------------------------------------------------------------------------------------------------- -->               
               <div id="publicidades">
                   <div id="pub">
                   </div> <!-- publicidade -->
                   <?php
                       foreach ($query->selecaoArtigo(2,'noticias') as $noticia){
                    ?>
                   <div class="notice">
                       <a href="<?php echo $base.'/'.$noticia['categoria'].'/'.$noticia['slug']?>" title="<?php echo $noticia['titulo']?>">
                           <img src="posts/<?php echo $noticia['exibicao']?>" width="100" <?php echo $noticia['titulo']?> alt="" height="58"/>
                             <span><?php echo $noticia['titulo']?></span>    
                       </a>
                    </div><!-- notice -->
                       <?php }?>
               </div> <!-- publicidades -->
            </div> <!-- bloco dois -->            
<!-- ------------------------------------------------------------------------------------------------------------- -->               
<!-- BLOCO TRÊS ULTIMO BLOCO -->                           
            <div id="bloco-tres">
                <h1>Outros Posts</h1>
                
                <?php
                        foreach ($query->selecaoLimit(5,9) as $outros){
                ?>                
                <div class="outro">
                    <a href="<?php echo $base.'/'.$outros['categoria'].'/'.$outros['slug']?>" title="<?php echo $outros['titulo']?>">
                                <img src="posts/<?php echo $outros['exibicao'];?>" width="190" alt="" height="108" border="0"/>
                                <span><?php echo $outros['titulo'];?></span> 
                                <p><?php echo $query->limitar($outros['conteudo'], 70);?></p> 
                    </a>                       
                </div><!-- Outro -->
                   <?php }?>
              </div><!-- Termina Bloco TRES -->