<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ase_proyectos extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="ase_proyectos";

	public $modelo_usar="ase_proyectos_model";

	public $nombre_controlador="ase_proyectos";
	
	public $nombre_titulo="Proyectos ";
	
	public $campos=array();
	
	
		public function set_campo($nombre_campo,$nombre_mostrar,$reglas="",$tipo_elemento="text",$datos_select=array(),$clases='')
	{
		$this->campos[]=array(
								'nombre_campo'=>$nombre_campo,
								'nombre_mostrar'=>$nombre_mostrar,
								'reglas'=>$reglas,
								'tipo_elemento'=>$tipo_elemento,
								'datos_select'=>$datos_select,
								'clases'=>$clases
								);
	}
	
	function __construct()
    {
        parent::__construct();
        $this->datos_user=comprobar_login();
        $model=$this->modelo_usar;
		$this->load->model($model);
		$this->load->model("ase_servicios_model");
		$this->load->model("ase_actividades_model");
		$this->load->model("ase_bitacora_model");
		$this->load->model("ase_recomendaciones_model");
		
		$this->set_campo("fecha_inicio","Fecha Inicio",'required|xss_clean','text',array(),'fecha__');
		$this->set_campo("nombre_proyecto","Nombre del Proyecto",'required|xss_clean');
		$this->set_campo("cantidad_tiempo_estimado","Cantidad",'is_numeric|required|xss_clean');
		$this->set_campo("nombre_tiempo_estimado","Tiempo",'required|xss_clean','select',array('days'=>'Dia(s)','months'=>'Mes(es)','years'=>'Año(s)'));
		
    }

	public function index($id=0)
	{
		
		$data['dato']=$this->ase_servicios_model->obtener($id);
		
		if($data['dato'])
		{
			$model=$this->modelo_usar;
			$data['title']=$this->nombre_titulo."de ".$data['dato']['nombre_solicitante'];
			$data['template']="sistema";
			$data['contenido']=$this->carpeta_view."/lista";
			$data['listado']=$this->$model->lista($id);
			$data['model']=$model;
			$this->load->view('template',$data);
		}else{
			redirect('ase_servicios');
			}
		
		
	}
	
	public function nuevo($id=0)
	{
		$model=$this->modelo_usar;
		$data=array();
		$data['title']=$this->nombre_titulo." - Nuevo";
		$data['id']=$id;
		$this->load->view($this->carpeta_view.'/form_nuevo',$data);
	}
	
	public function insertar()
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		
		
		if($post)
		{
			$json=array();
			
			foreach($this->campos as $llave=>$valor)		
			{
				$this->form_validation->set_rules($valor['nombre_campo'], $valor['nombre_mostrar'], $valor['reglas']);
			}


			if($this->form_validation->run()==TRUE)
			{
				
				$post['fecha_fin']=date('Y-m-d',strtotime($post['fecha_inicio']." +".$post['cantidad_tiempo_estimado']." ".$post['nombre_tiempo_estimado']));
				
				//$json['mensaje']=print_r($post,true);

				$resultado=$this->$model->nuevo($post);

				$json['error']=false;


			}else{

				$json['error']=true;
				$json['mensaje']=traer_errores_form();
			}


			echo json_encode($json);

		}

	}
	
	public function editar($id=0)
	{
		
		$model=$this->modelo_usar;
		$data['model']=$model;			
		$data['dato']=$this->$model->obtener($id);
		
		if($data['dato'])
		{
			
			$data['title']=$this->nombre_titulo." - Editar";
			$this->load->view($this->carpeta_view.'/form_editar',$data);
			
		}else{
			redirect($this->nombre_controlador);

		}

		
	}
	
	
	public function actualizar()
	{
		$post=$this->input->post();
		$model=$this->modelo_usar;
		if($post)
		{
			$id=$post['id'];
			unset($post['id']);
						
			$json=array();
			
			foreach($this->campos as $llave=>$valor)		
			{
				$this->form_validation->set_rules($valor['nombre_campo'], $valor['nombre_mostrar'], $valor['reglas']);
			}
			
			if($this->form_validation->run()==TRUE)
			{
				$post['fecha_fin']=date('Y-m-d',strtotime($post['fecha_inicio']." +".$post['cantidad_tiempo_estimado']." ".$post['nombre_tiempo_estimado']));

				$resultado=$this->$model->actualizar($post,$id);

				$json['error']=false;


			}else{

				$json['error']=true;
				$json['mensaje']=traer_errores_form();
			}


			echo json_encode($json);
		}
	}
	
	public function eliminar()
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		if ($post)
		{
			$id=$post['id'];
			unset($post['id']);
			$resultado= $this->$model->eliminar($id,$post);
		}
	}
	
	
	public function asignar_tecnico($id=0)
	{
		$model=$this->modelo_usar;
		$data=array();
		$data['title']=$this->nombre_titulo." - Asignar";
		$data['id']=$id;
		$data['facilitadores']=preparar_select($this->$model->obtener_tecnicos(),'id_facilitador','nombre_completo');
		$this->load->view($this->carpeta_view.'/asignar_tecnico',$data);
	}
	
	
	public function ingresar_tecnico()
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		
		
		if($post)
		{
			$json=array();
			
			
			$this->form_validation->set_rules('id_facilitador',"Técnico", "required|xss_clean");
			

			if($this->form_validation->run()==TRUE)
			{
				
				$resultado=$this->$model->asignar_tecnico($post);

				$json['error']=false;


			}else{

				$json['error']=true;
				$json['mensaje']=traer_errores_form();
			}


			echo json_encode($json);

		}

	}
	
	function eliminar_tecnico()
	{
		$id=$this->input->post('id');
		if($id)
		{
			$model=$this->modelo_usar;
			$this->$model->eliminar_tecnico($id);
		}
	}
	
	function reporte($id_proyecto=0)
	{
			$data=array();
			
			$data['proyecto']=$this->ase_proyectos_model->obtener($id_proyecto);
			$data['proyecto']['actividades']=$this->ase_actividades_model->lista($id_proyecto);
			$data['servicio']=$this->ase_servicios_model->obtener($data['proyecto']['id_servicio']);
			
			
			foreach($data['proyecto']['actividades'] as $key=>$valor)
			{
				$data['proyecto']['actividades'][$key]['bitacoras']=$this->ase_bitacora_model->lista($valor['id_actividad']);
				$data['proyecto']['actividades'][$key]['recomendaciones']=$this->ase_recomendaciones_model->lista($valor['id_actividad']);
			}
			
			$this->load->library('Pdf');
				
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			
			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Jorge Rodriguez');
			$pdf->SetTitle('');
			$pdf->SetSubject('');
				
			// set default header data
			$pdf->SetHeaderData('', '', 'Fundación Asesores para el Desarrollo', 'Reporte de Actividades, Bitacoras y Recomendaciones', array(0,64,255), array(0,64,128));
			//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
			$pdf->setFooterData(array(0,64,0), array(0,64,128));
			
			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			// set margins
			//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetMargins(PDF_MARGIN_LEFT, '17', PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			
			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			
			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			
			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}
			
			// ---------------------------------------------------------
			
			// set default font subsetting mode
			$pdf->setFontSubsetting(true);
			
			// Set font
			// dejavusans is a UTF-8 Unicode font, if you only need to
			// print standard ASCII chars, you can use core fonts like
			// helvetica or times to reduce file size.
			$pdf->SetFont('helvetica', '', 11, '', true);
			
			// Add a page
			// This method has several options, check the source code documentation for more information.
			$pdf->AddPage();
			
			// set text shadow effect
			$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
			
			// Set some content to print
			$html = $this->load->view($this->carpeta_view.'/reporte',$data,true);
			
			
			// Print text using writeHTMLCell()
			$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
			
			// ---------------------------------------------------------
			
			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			$pdf->Output('Actividades_de_'.$data['proyecto']['nombre_proyecto'].'.pdf', 'I');
			
			//============================================================+
			// END OF FILE
			//============================================================+
		
		
	}
	
	
}