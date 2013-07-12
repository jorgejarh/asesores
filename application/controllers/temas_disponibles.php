<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temas_disponibles extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="temas_disponibles";

	public $modelo_usar="temas_disponibles_model";

	public $nombre_controlador="temas_disponibles";
	
	public $nombre_titulo="Gestion de Planes";
	
	
	
	
	function __construct()
    {
        parent::__construct();
        $this->datos_user=comprobar_login();
        $model=$this->modelo_usar;
		$this->load->model($model);
		
    }

	
	public function index($imprimir="")
	{
		$model=$this->modelo_usar;

		$data['datos']=$this->$model->obtener_plan_completo();

		$data['titulo']="Presupuesto";

		switch ($imprimir) {
			case 'web':
				$this->load->view($this->carpeta_view.'/ver_plan_imprimir',$data);
				break;

			
			
			case 'excel':
				
				error_reporting(E_ALL);
				ini_set('display_errors', TRUE);
				ini_set('display_startup_errors', TRUE);			
				$this->load->library('PHPExcel');			
	
				if (PHP_SAPI == 'cli')
					die('This example should only be run from a Web Browser');
				
				
				// Create new PHPExcel object
				$objPHPExcel = new PHPExcel();
				
				// Set document properties
				$objPHPExcel->getProperties()->setCreator(" ")
											 ->setLastModifiedBy(" ")
											 ->setTitle(" ")
											 ->setSubject(" ")
											 ->setDescription("")
											 ->setKeywords(" ")
											 ->setCategory(" ");
				
				
				// Add some data
				$objPHPExcel->setActiveSheetIndex(0);
				
				$datos=$data['datos'];
				
				$fila=1;
				$columna="A";
				
				$co="A";
				for($i=1;$i<=8;$i++)
				{
					$objPHPExcel->getActiveSheet()->getColumnDimension($co)->setAutoSize(true);
					$co++;
				}
				
				$objPHPExcel->setActiveSheetIndex(0)->getStyle($columna.$fila)->getFont()->setBold(true);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.$fila, $datos['nombre_plan']);
				$fila++;	
				$fila++;			
				
				$objPHPExcel->setActiveSheetIndex(0)->getStyle($columna.$fila)->getFont()->setBold(true);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.$fila, 'Nombre de modalidad');
				$columna++;
				
				$objPHPExcel->setActiveSheetIndex(0)->getStyle($columna.$fila)->getFont()->setBold(true);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.$fila, 'Costo de modalidad');
				$columna++;
				
				$objPHPExcel->setActiveSheetIndex(0)->getStyle($columna.$fila)->getFont()->setBold(true);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.$fila, 'Nombre del tema');
				$columna++;
				
				$objPHPExcel->setActiveSheetIndex(0)->getStyle($columna.$fila)->getFont()->setBold(true);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.$fila, 'Costo del tema');
				$columna++;
				
				$objPHPExcel->setActiveSheetIndex(0)->getStyle($columna.$fila)->getFont()->setBold(true);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.$fila, 'Nombre del modulo');
				$columna++;
				
				$objPHPExcel->setActiveSheetIndex(0)->getStyle($columna.$fila)->getFont()->setBold(true);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.$fila, 'Costo del modulo');
				$columna++;
				
				$objPHPExcel->setActiveSheetIndex(0)->getStyle($columna.$fila)->getFont()->setBold(true);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.$fila, 'Fecha Inicio');
				$columna++;
				
				$objPHPExcel->setActiveSheetIndex(0)->getStyle($columna.$fila)->getFont()->setBold(true);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.$fila, 'Fecha Fin');
				$columna++;
				
				$fila++;
				
				foreach($datos['modalidades'] as $modalidad)
				{
					$columna="A";
					
					$objPHPExcel->getActiveSheet()->getColumnDimension()->setAutoSize(true);
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.$fila, $modalidad['nombre_modalidad']);
					$columna++;
					
					$total_modalidad=0.00;
					if($modalidad['temas'])
					{
						foreach($modalidad['temas'] as $tema)
						{
							if($tema['modulos'])
							{
								foreach($tema['modulos'] as $modulo)
								{
									if($modulo['rubros'])
									{
										foreach($modulo['rubros'] as $rubro)
										{
											if($rubro['detalle'])
											{
												foreach($rubro['detalle'] as $detalle)
												{
													$total_modalidad+=($detalle['unidades']*$detalle['costo']);
												}
											}
										}
									}
								}
							}
						}
					}
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.$fila, $total_modalidad);
					
					if($modalidad['temas'])
					{
						$columna++;
						foreach($modalidad['temas'] as $tema)
                       	{
							$columna="C";
							
							$objPHPExcel->getActiveSheet()->getColumnDimension()->setAutoSize(true);
							
							$total_tema=0.00;
							if($tema['modulos'])
							{
								foreach($tema['modulos'] as $modulo)
								{
									if($modulo['rubros'])
									{
										foreach($modulo['rubros'] as $rubro)
										{
											if($rubro['detalle'])
											{
												foreach($rubro['detalle'] as $detalle)
												{
													$total_tema+=($detalle['unidades']*$detalle['costo']);
												}
											}
										}
									}
								}
							}
							
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.$fila, $tema['nombre_capacitacion']);
							$columna++;
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.$fila, number_format($total_tema,2));
							
							
							
							if($tema['modulos'])
							{
								
								foreach($tema['modulos'] as $modulo)
								{
									$columna="E";
									
									$objPHPExcel->getActiveSheet()->getColumnDimension()->setAutoSize(true);
									
									$total_modulo=00.00;
									if($modulo['rubros'])
									{
										foreach($modulo['rubros'] as $rubro)
										{
											if($rubro['detalle'])
											{
												foreach($rubro['detalle'] as $detalle)
												{
													$total_modulo+=($detalle['unidades']*$detalle['costo']);
												}
											}
										}
									}
									
									$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.$fila, $modulo['nombre_modulo']);
									$columna++;
									$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.$fila, number_format($total_modulo,2));
									$columna++;
									$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.$fila, $modulo['fecha_prevista']);
									$columna++;
									$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna.$fila, $modulo['fecha_prevista_fin']);
									
									$fila++;
									
								}
							}
							
							//$fila++;
							
						}
						
						//$fila++;
						
					}
					
				}
				
				
								
				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Plan');
				
				
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);
				
				
				// Redirect output to a client’s web browser (Excel5)
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$data['datos']['nombre_plan'].'.xls"');
				header('Cache-Control: max-age=0');
				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');
				
				// If you're serving to IE over SSL, then the following may be needed
				header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
				header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header ('Pragma: public'); // HTTP/1.0
				
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('php://output');
				exit;

				
				

				break;
			
			default:
				
				
				
				$this->load->view($this->carpeta_view.'/ver_plan',$data);
				break;
		}
	}

}