<?php 
include('../banco/config.php');

$user_id = $_POST['id'];
$sql = "UPDATE estoque SET ativo = FALSE WHERE id='$user_id'";
$updateQuery = mysqli_query($conexao, $sql);

if($updateQuery == true)
{
    $data = array(
        'status' => 'success',
    );

    echo json_encode($data);
}
else
{
    $data = array(
        'status' => 'failed',
    );

    echo json_encode($data);
} 
?>
