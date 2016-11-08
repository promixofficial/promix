<?php

function apiEmail($propriedades){


    switch ($propriedades->method){
        case 'GET':
            /*if(count($propriedades->args)==0){
                $sql = 'select * from pessoa';
                $resultado = Banco::query($sql);
            }else{
                $sql = 'select * from pessoa where id="'.$propriedades->args[0].'"';
                $resultado = Banco::queryOne($sql);
            }*/
            $resultado = array('teste'=>'sucesso');
        break;
        case 'POST':
            if($propriedades->verb==""){
                $resultado = array("resultado"=>"erro","mensagem"=>"Erro ao enviar email");
                if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['assunto']) && isset($_POST['mensagem'])){
                    $destinatario = 'promixoficial@gmail.com';
                    $nome = $_POST['nome'];
                    $remetente = $_POST['email'];
                    $assunto = $_POST['assunto'];
                    $mensagem = $_POST['mensagem'];

                    if($nome!='' && $remetente!='' && $assunto!='' && $mensagem!=''){
                        mail($destinatario, $assunto, $mensagem, "From:" .$remetente);
                        mail("mestrepokemon@hotmail.com", "PRO-MIX MENSAGEM", "Nova mensagem enviada pelo site Pro-MIX:\n ------------------------------------------------------------------ \n\n\n".$mensagem, "From: $destinatario");//aviso de email novo
                        $resultado = array("resultado"=>"sucesso","mensagem"=>"Email enviado com sucesso!");
                    }else{
                        $resultado = array("resultado"=>"erro","mensagem"=>"Preencha todos os campos!");
                    }
                }
            }else{
                if($propriedades->verb=="alterar"){
                    
                }else if($propriedades->verb=="deletar"){
                    
                }else if($propriedades->verb=="buscar"){
                   
                }
            }
        break;
        default : $resultado = array("error"=>"Only accepts GET or POST requests");
    }
    return $resultado;
}

?>
