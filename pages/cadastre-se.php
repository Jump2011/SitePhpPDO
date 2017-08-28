<?php include_once ('includes/sidebar.php');?>                              

<div id="content-pages">
    <h1>Cadastre-se no nosso site</h1>
    <p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XV</p>
    <p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XV</p>
    
    <div id="form-pages">
<?php 

if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){
    $status = '0';
    $nome = strip_tags(filter_input(INPUT_POST, 'nome'));
    $sobrenome = strip_tags(filter_input(INPUT_POST, 'sobrenome'));
    $email = strip_tags(filter_input(INPUT_POST, 'email'));
    $senha = strip_tags(filter_input(INPUT_POST, 'senha'));
    $site = strip_tags(filter_input(INPUT_POST, 'site'));
    
    if($nome == '' || $sobrenome == '' || $email == '' || $senha == ''){
        echo '<script>alert("Por favor, informe todos os dados necessários para cadastrar-lo.")</script>';
        
    }else{
        $usuario = new Cadastro;
        $dados = array($nome, $sobrenome, $email, $site, $senha, $status);
        if($usuario->cadastrar($dados)){
            echo '<script>alert("Cadastro realizado com Sucesso, verifique o seu E-mail, para confirmação do mesmo!");location.href="'.$base.'/Cadastre-se"</script>';
        }else{
            echo '<script>alert("Error ao cadastrar, ou usuário já existente!");location.href="'.$base.'/Cadastre-se"</script>';
        }
    }
}
?>    
        <form action="" method="post" enctype="multipart/form-data">
            <div class="name">
            <label>
            <span>Nome:</span>
            <input type="text" name="nome">
        </label>
        <label>
            <span>Sobre nome:</span>
            <input type="text" name="sobrenome">
        </label>
            </div>
            <div class="name">
        <label>
            <span>E-mail:</span>
            <input type="text" name="email">
        </label>
        <label>
            <span>Senha:</span>
            <input type="password" name="senha">
        </label>    
            </div>       
        <label>
            <span>Site:</span>
            <input type="text" name="site">
        </label>
            <input type="hidden" name="acao" value="cadastrar">
            <input type="submit" value="Cadastrar" class="btn cad">
        </form>
        <div style="clear: both;"></div>
    </div>
</div>



