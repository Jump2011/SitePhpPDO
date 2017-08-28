<?php class Cadastro extends BD{

private function ifexists($email){
    $verificar = self::conn()->prepare("SELECT * FROM visitantes WHERE email = :email");
    $verificar->bindValue(':email', $email, PDO::PARAM_STR);    
    if($verificar->execute()){
        return false;
    }else{
        return true;
    }
 }
    
    private function crip($senha){
        return md5($senha);
    }
    
    public function cadastrar($dados = array()){               
            if($this->ifexists($dados[2])){
                return false;
            }else{
            try{
            $dados[4] = $this->crip($dados[4]);        
            $cadastrar = self::conn()->prepare("INSERT INTO visitantes (nome,sobrenome,email,site,senha,status ) VALUES (?,?,?,?,?,?)");
            if($cadastrar->execute($dados)){
                return TRUE;
            } else{
                return FALSE;
            }            
        }/* fim try catch*/catch(PDOException $e){
             return FALSE;    
             logErrors($e);
        }//FIM CATCH
       }
    }// FIM FUNCAO DE CADASTRO*/
}


    
