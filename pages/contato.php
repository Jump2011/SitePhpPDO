<?php include_once ('includes/sidebar.php');?>

<div id="content-pages">
    <h1>Fale Conosco</h1>
    <p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XV</p>
    <p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XV</p>
    
    <div id="form-pages">
<?php
if(isset($_POST['acao']) && $_POST['acao'] == 'enviar'){
    $nome = strip_tags(filter_input(INPUT_POST, 'nome'));
    $email = strip_tags(filter_input(INPUT_POST, 'email'));
    $assunto = strip_tags(filter_input(INPUT_POST, 'assunto'));
    $mensagem = strip_tags(filter_input(INPUT_POST, 'mensagem'));
    
    if($nome = '' || $email = '' || $assunto = '' || $mensagem = ''){
        print '<script>alert("Por favor! Preencha todos os campos nescessário.");</script>';
    }else{
        print '<script>alert("Obrigado por entrar em contato conosco, entraremos em contato em breve.");location.href="'.$base.'/"</script>';
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
            <span>E-mail:</span>
            <input type="text" name="email">
        </label>
            </div>
        <label>
            <span>Assunto:</span>
            <input type="text" name="assunto">
        </label>
        <label>
            <span>Mensagem:</span>
            <textarea name="mensagem" cols="30" rows="5">

            </textarea>
        </label>
            <input type="hidden" name="acao" value="enviar">
            <input type="submit" value="Enviar" class="btn cad">
        </form>
        <div style="clear: both;"></div>
    </div>
</div>

