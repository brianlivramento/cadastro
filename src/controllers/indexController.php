<?php

namespace App\Controllers;

require   '../../vendor/autoload.php';

if ($_POST) 
{
	$arr_inf = [
		'name' => (!empty($_POST['name']) ? $_POST['name'] : null) ,
		'birthday' => (!empty($_POST['birthday']) ? $_POST['birthday'] : null) ,
		'email' => (!empty($_POST['email']) ? $_POST['email'] : null) ,
		'address' => (!empty($_POST['address']) ? $_POST['address'] : null) ,
		'postal' => (!empty($_POST['postal']) ? $_POST['postal'] : null) ,
		'fone' => (!empty($_POST['fone']) ? $_POST['fone'] : null) 
	];		
	return (new IndexController)->readFileSheet($arr_inf);
} else  
{
	return header("Location: ../index.php?error");
}

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;

class IndexController 
{
	const DIR = '../../dir/users.xlsx';

	public function writeFileSheet($inf)
	{
		$objPHPExcel = \PHPExcel_IOFactory::load(self::DIR);			
		$objPHPExcel->setActiveSheetIndex(0);			
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow() + 1;		
		
		for ($row = 1; $row <= $highestRow; $row++)
		{
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $highestRow, $inf['name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $highestRow, $inf['birthday']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $highestRow, $inf['email']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $highestRow, $inf['address']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $highestRow, $inf['postal']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $highestRow, $inf['fone']);
		}
		return $objPHPExcel;
	}

	public function readFileSheet($inf)
	{	
		try 
		{				
			if (!file_exists(self::DIR))
			{
				$objPHPExcel = new \PHPExcel();
				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()->SetCellValue('A1', "name");
				$objPHPExcel->getActiveSheet()->SetCellValue('B1', "birthday");
				$objPHPExcel->getActiveSheet()->SetCellValue('C1', "email");
				$objPHPExcel->getActiveSheet()->SetCellValue('D1', "address");
				$objPHPExcel->getActiveSheet()->SetCellValue('E1', "postal");
				$objPHPExcel->getActiveSheet()->SetCellValue('F1', "fone");	

				return $this->saveFileSheet($objPHPExcel, self::DIR);
			} 
			$objPHPExcel = $this->writeFileSheet($inf);
			
			return $this->saveFileSheet($objPHPExcel, self::DIR);	
		} catch (Exception $e) {
			return header("Location: ../../index.php?error");
		}
	}

	public function saveFileSheet($objPHPExcel, $dirFile)
	{
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save($dirFile);

		return header("Location: ../../index.php?success");
	}
}