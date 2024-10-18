<?php 
include('../banco/config.php');
$modelo = $_POST['modelo'];
$fabricante = $_POST['fabricante'];
$categoria = $_POST['categoria'];
$situacao = $_POST['situacao'];
$matricula = $_POST['matricula'];
$numero_serie = $_POST['numero_serie'];
$id = $_POST['id'];

$sql = "UPDATE `computadores` SET  `modelo`='$modelo' , `fabricante`= '$fabricante', `categoria`='$categoria',  `situacao`='$situacao', `matricula`='$matricula',`numero_serie`='$numero_serie'  WHERE id='$id' ";
$query= mysqli_query($conexao,$sql);
$lastId = mysqli_insert_id($conexao);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>