<?php
include ('BD.class.php');
class Query extends BD {
    
    public function selecaoLimit($limite){
    $sqlLimite = "SELECT * FROM `posts` WHERE status = '0' AND categoria != 'artigos' ORDER BY id DESC LIMIT $limite";
    return self::conn()->query($sqlLimite);
    }//METODOS DE SELECAO DE DADOS LIMITADO
    
    public function selecaoArtigo($limite, $categoria){
    $sqlLimite = "SELECT * FROM `posts` WHERE status = '0' AND categoria = '$categoria' ORDER BY id DESC LIMIT $limite";
    return self::conn()->query($sqlLimite);
    }//METODOS DE SELECAO DE DADOS LIMITADOS
    
    public function limitar($str, $limita = 100, $limpar = true){
        if($limpar = true){
            $str = strip_tags($str);
        }
        if(strlen($str)<= $limita){
            return $str;
        }
        
        $limita_str = substr($str,0, $limita);
        $ultimo = strripos($limita_str,'');
        return substr($str, $ultimo).'...';
    }//Limita string dentro do site
    
    public function get_menu($urlBase){
        $sql_cat = "SELECT * FROM `categorias` ORDER BY id DESC";
        $categorias = self::conn()->prepare($sql_cat);
        $categorias->execute();
        
        while($cat = $categorias->fetchObject()){
           echo '<li><a href="#">'.$cat->nome.'</a>';
            $sqlSub = "SELECT * FROM subcat WHERE id_cat = '".$cat->id."'";
            $subcat = self::conn()->prepare($sqlSub);
            $subcat->execute();
            if($subcat->rowCount() == 0){
                echo '</li>';
            }else {
                echo '<ul>';
                while($sub = $subcat->fetchObject()){
                    echo '<li><a href="'.$urlBase.'/'.$sub->slug.'">'.$sub->nome.'</a></li>';
                }
                echo '</ul>';
            }
        echo '</li>';
    }
  }//Termina a Funcao get_menu
  
  public function getPost($categoria, $slug){
      $categoria = htmlentities($categoria);
      $slug = htmlentities($slug);
      $sqlPegar = "SELECT * FROM posts WHERE categoria = '$categoria' AND slug = '$slug' LIMIT 1";
      return self::conn()->query($sqlPegar);
  }//Pegar post na single
  
    public function comentar($dados = array(), $resp = false){
    try{
        if($resp == true){
        $sqlCad = "INSERT INTO `respostas`(id_post,id_com, nome, email, site, comentario) VALUES (?,?,?,?,?,?)";        
        }else{
        $sqlCad = "INSERT INTO `comentarios`(id_post, nome, email, site, comentario, status, data) VALUES (?,?,?,?,?,?,NOW())";    
        }
        $cadastrar = self::conn()->prepare($sqlCad);
        if($cadastrar->execute($dados)){
            return true;
        }else{
            return false;
        }
    }catch (PDOException $e){
        logErrors($e);
        return false;
  }
 }
}
