<?php
ob_start();

require_once '../lib/Classes/PHPExcel.php';
require_once '../database/Connection.php';

ini_set ( 'display_errors', 1 );
ini_set ( 'log_errors', 1 );

error_reporting ( E_ALL );

$conn = Connection::getInstance();
$mysqli = $conn->getConnection();

$form_usuario[] = array();

$form_usuario['nomeCompleto'] = $_POST['nomeCompleto'];
$dtnascimento = $_POST['dtnascimento'];

$data_form = explode("-", str_replace('/', '-', $dtnascimento));
print_r($data_form);
$dtnascimento_f = $data_form[2] ."-". $data_form[1] ."-". $data_form[0];

$form_usuario['dtnascimento'] = $dtnascimento_f;
$form_usuario['email'] = $_POST['email'];
$form_usuario['facebook'] = $_POST['facebook'];

$form_usuario['rg'] = $_POST['rg'];
$form_usuario['cpf'] = $_POST['cpf'];

$form_usuario['endereco'] = $_POST['endereco'];
$form_usuario['cep'] = $_POST['cep'];
$form_usuario['telefone'] = $_POST['telefone'];

$calculo = 2015 - $data_form[2];

if($calculo >= 18){
cadastrarRegistros($form_usuario, $mysqli);
} else {
	header("Location: ../index.php?menoridade");
}

function cadastrarRegistros($form_usuario, $mysqli) {		
	$queryInsert = "			
			INSERT INTO usuarios(nome_usuario, dtnascimento_usuario, email_usuario, facebook_usuario, rg_usuario, cpf_usuario, endereco_usuario, cep_usuario, fone_usuario) 
			VALUES ('".$form_usuario['nomeCompleto']."', '".$form_usuario['dtnascimento']."', '".$form_usuario['email']."', '".$form_usuario['facebook']."', 
					'".$form_usuario['rg']."', '".$form_usuario['cpf']."', '".$form_usuario['endereco']."', '".$form_usuario['cep']."', '".$form_usuario['telefone']."' )";

	echo '<br /><br />'.$queryInsert;
		
	if ($mysqli->query($queryInsert)) {		
		$retornando_id_usuario = mysqli_insert_id($mysqli);		
		echo '<br /><br /><strong>Usuario Cadastrado.</strong>';
	} else {
		echo '<br /><br /><strong>Erro ao cadastrar. Por favor, verifique</strong>';
	}
	
	listarRegistros($mysqli);
}

function listarRegistros($mysqli) {	
	
	$lista_usuarios[] = array();	
	
	if ($result = $mysqli->query ( " SELECT * FROM usuarios " ) ) {
		$i = 0;		
		while ($row = $result->fetch_assoc()) {
			$lista_usuarios[$i]['nome_usuario'] = $row['nome_usuario'];
			$lista_usuarios[$i]['dtnascimento_usuario'] = $row['dtnascimento_usuario'];
			$lista_usuarios[$i]['email_usuario'] = $row['email_usuario'];
			$lista_usuarios[$i]['facebook_usuario'] = $row['facebook_usuario'];
			$lista_usuarios[$i]['rg_usuario'] = $row['rg_usuario'];
			$lista_usuarios[$i]['cpf_usuario'] = $row['cpf_usuario'];
			$lista_usuarios[$i]['endereco_usuario'] = $row['endereco_usuario'];
			$lista_usuarios[$i]['cep_usuario'] = $row['cep_usuario'];
			$lista_usuarios[$i]['fone_usuario'] = $row['fone_usuario'];
			$i++;
		}			
		exportarExcell($lista_usuarios);
		
	} else {
		echo '<br /><br /><strong>Erro ao listar usuarios. Por favor, verifique</strong>';
	}
}


function exportarExcell($lista) {	
			
	$objPHPExcel = PHPExcel_IOFactory::load('../planilha/usuarios.xlsx');
	$objPHPExcel->setActiveSheetIndex(0);
	
	$rowCount = 4;

	for($i=0; $i < count($lista); $i++) {
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $lista[$i]['nome_usuario']);
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $lista[$i]['dtnascimento_usuario']);
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $lista[$i]['email_usuario']);
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $lista[$i]['facebook_usuario']);
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $lista[$i]['rg_usuario']);
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $lista[$i]['cpf_usuario']);
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $lista[$i]['endereco_usuario']);
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $lista[$i]['cep_usuario']);
		$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $lista[$i]['fone_usuario']);
		$rowCount++;
	}
	
	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	$objWriter->save('../planilha/usuarios.xlsx');

	header("Location: ../index.php?sucesso");
}
