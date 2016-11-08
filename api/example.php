<?php
session_start();
$_SESSION['usuario'] = "Hanashiro Akira";

echo $_SESSION['usuario'];


?>


<script src="https://code.jquery.com/jquery-1.10.2.min.js" ></script>
<script>

function Ajax(tipo,sucesso,erro){
    if(tipo.acao=="buscar"){
        $.ajax({
		type: "GET",
		url: "http://localhost/testeAPI/api/v1/example/"+tipo.obj.id,
		dataType: "json",
		async: false,
		success: sucesso,
		error: erro
	});
    }else if(tipo.acao=="todos"){
        $.ajax({
		type: "GET",
		url: "http://localhost/testeAPI/api/v1/example/",
		dataType: "json",
		async: false,
		success: sucesso,
		error: erro
	});
    }else if(tipo.acao=="inserir"){
        $.ajax({
		type: "POST",
		url: "http://localhost/testeAPI/api/v1/example/",
		dataType: "json",
                data: tipo.obj,
		async: false,
		success: sucesso,
		error: erro
	});
    }else if(tipo.acao=="alterar"){
        $.ajax({
		type: "POST",
		url: "http://localhost/testeAPI/api/v1/example/alterar/",
		dataType: "json",
                data: tipo.obj,
		async: false,
		success: sucesso,
		error: erro
	});
    }else if(tipo.acao=="deletar"){
        $.ajax({
		type: "POST",
		url: "http://localhost/testeAPI/api/v1/example/deletar/",
		dataType: "json",
                data: {"id":tipo.obj.id},
		async: false,
		success: sucesso,
		error: erro
	});
    }
	
}
// Ajax(function(a){console.log(a)},function(a){console.log(a)},{nome:"Hanashiro"})
</script>