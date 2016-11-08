<?php
header("Content-Type: application/json");
class Banco{
    private static function iniciar(){
        $servidor = 'localhost';
        $usuario = 'root';
        $senha = 'caima19';
        $banco = 'mine';
        // Conecta-se ao banco de dados MySQL
        $mysqli = new mysqli($servidor, $usuario, $senha, $banco);
        // Caso algo tenha dado errado, exibe uma mensagem de erro
        if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
        return $mysqli;
    }
    static function query($sql){
        $mysqli = Banco::iniciar();
        $query = $mysqli->query($sql);
        $resultado = array();
        while ($dados = $query->fetch_assoc()) {
                $resultado[] = $dados;
        }
        return $resultado;
    }
    static function queryOne($sql){
        $resultado = Banco::query($sql);
        return $resultado[0];
    }
    static function queryObject($sql,$campos){
        $mysqli = Banco::iniciar();
        $query = $mysqli->query($sql);
        $resultado = array();
        $indice = 0;
        while ($dados = $query->fetch_assoc()) {
                $resultado[] = $dados;
        }
        return $resultado;
    }
    static function update($sql){
       $mysqli = Banco::iniciar();
       $query = $mysqli->query($sql);
       if($query){
           return array('resultado'=>'sucesso');
       }return array('resultado'=>'erro');
    }
    static function delete($sql){
       $mysqli = Banco::iniciar();
       $query = $mysqli->query($sql);
       if($query){
           return array('resultado'=>'sucesso');
       }return array('resultado'=>'erro');
    }
    static function insert($sql){
       $mysqli = Banco::iniciar();
       $query = $mysqli->query($sql);
       $lastId = $mysqli->insert_id;
       if($query){
           return array('resultado'=>'sucesso','id'=>$lastId);
       }return array('resultado'=>'erro');
    }
}
;

/*$sql = "select c.id as 'cliente_id',c.nome,c.ativo,c.sexo,c.aniversario,c.anotacao,c.foto
'{endereco',e.*,'[contato',cont.id as 'contato_id',cont.tipo,cont.contato,cont.categoria,cont.parentId
from cliente c inner join endereco e on c.endereco = e.id left join
clientecontato cont on cont.parentid = c.id where c.nome like '%ma%';";
*/
//echo json_encode(Banco::queryObject($sql,['','']));



?>
