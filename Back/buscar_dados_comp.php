<?php include('../banco/config.php');

$output= array();
$sql = "SELECT * FROM computadores";

$totalQuery = mysqli_query($conexao,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'modelo',
	2 => 'fabricante',
	3 => 'categoria',
	4 => 'situacao',
    5 => 'matricula',
    6 => 'numero_serie',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE modelo like '%".$search_value."%'";
	$sql .= " OR fabricante like '%".$search_value."%'";
	$sql .= " OR categoria like '%".$search_value."%'";
	$sql .= " OR situacao like '%".$search_value."%'";
	$sql .= " OR matricula like '%".$search_value."%'";
	$sql .= " OR numero_serie like '%".$search_value."%'";

}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY id desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($conexao,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $row['id'];
	$sub_array[] = $row['modelo'];
	$sub_array[] = $row['fabricante'];
	$sub_array[] = $row['categoria'];
	$sub_array[] = $row['situacao'];
	$sub_array[] = $row['matricula'];
	$sub_array[] = $row['numero_serie'];
	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-info btn-sm editbtn" >Editar</a>  <a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-danger btn-sm deleteBtn" >Deletar</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
