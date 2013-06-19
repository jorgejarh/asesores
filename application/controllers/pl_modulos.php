<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pl_modulos extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="pl_modulos";

	public $modelo_usar="pl_modulos_model";

	public $nombre_controlador="pl_modulos";
	
	public $nombre_titulo="Modulos";
	
	public $campos=array();
	
	
		public function set_campo($nombre_campo,$nombre_mostrar,$reglas="",$tipo_elemento="text",$datos_select=array())
	{
		$this->campos[]=array(
								'nombre_campo'=>$nombre_campo,
								'nombre_mostrar'=>$nombre_mostrar,
								'reglas'=>$reglas,
								'tipo_elemento'=>$tipo_elemento,
								'datos_select'=>$datos_select
								);
	}
	
	function __construct()
    {
        parent::__construct();
        $this->datos_user=comprobar_login();
        $model=$this->modelo_usar;
		$this->load->model($model);
		$this->load->model('pl_capacitaciones_model');
		$this->load->model('mante_facilitadores_model');
		$this->load->model('mante_lugares_model');
		
		$this->set_campo("nombre_modulo","Nombre",'required|xss_clean');
		$this->set_campo("objetivo_modulo","Objetivo",'required|xss_clean','textarea');
		$this->set_campo("facilitadores[]","Facilitadores",'required|xss_clean','multi_select',preparar_select($this->mante_facilitadores_model->obtener(),'id_facilitador','nombre_completo'));
		$this->set_campo("id_lugar","Lugar",'required|xss_clean','select',preparar_select($this->mante_lugares_model->obtener(),'id_lugar','nombre_lugar'));
		$this->set_campo("n_participantes","# Partic. Estimados",'required|numeric|xss_clean');
		
    }

	public function index($id_capacitacion=0)
	{
		$data['capacitacion']=$this->pl_capacitaciones_model->obtener($id_capacitacion);
		if($data['capacitacion'])
		{
			$model=$this->modelo_usar;
			$data['title']=$this->nombre_titulo;
			$data['template']="sistema";
			$data['contenido']=$this->carpeta_view."/lista";
			$data['listado']=$this->$model->lista($id_capacitacion);
			$data['model']=$model;
			$this->load->view('template',$data);
		}else{
			
			redirect('portal');
			}
		

	}
	
	public function nuevo($id=0)
	{
		$model=$this->modelo_usar;
		$data=array();
		$data['title']=$this->nombre_titulo." - Nuevo";
		$data['id']=$id;
		$data['curriculas']=preparar_select($this->$model->obtener_curriculas(),'id_curricula','curricula');
		$this->load->view($this->carpeta_view.'/form_nuevo',$data);
	}
	
	public function insertar()
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		
		
		if($post)
		{
			unset($post['a']);
			$json=array();
			
			foreach($this->campos as $llave=>$valor)		
			{
				$this->form_validation->set_rules($valor['nombre_campo'], $valor['nombre_mostrar'], $valor['reglas']);
			}
			
			
			
			if($this->form_validation->run()==TRUE)
			{
				
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
		/*echo "<pre>";
		print_r($data['dato']);
		echo "</pre>";
		exit();*/
		if($data['dato'])
		{
			$data['curriculas']=preparar_select($this->$model->obtener_curriculas(),'id_curricula','curricula');
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
			unset($post['a']);
			
			$id=$post['id'];
			unset($post['id']);
						
			$json=array();
			
			foreach($this->campos as $llave=>$valor)		
			{
				$this->form_validation->set_rules($valor['nombre_campo'], $valor['nombre_mostrar'], $valor['reglas']);
			}
			
			if($this->form_validation->run()==TRUE)
			{
				

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
	
	function select_curricula($id=0)
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		if($post)
		{
			$json=array();

			$lista=preparar_select($this->$model->obtener_perfiles($post['id']),'id_perfil','perfil');
			$lista[0]="-Seleccione-";
			ksort($lista);
			$json['html']=form_dropdown('',$lista,$id,'id="perfiles_select"');

			echo json_encode($json);
		}
			
	}
	
	function select_perfil($id=0)
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		if($post)
		{
			$json=array();

			$lista=preparar_select($this->$model->obtener_contenidos($post['id']),'nombre','nombre');
			
			foreach($lista as $key=>$valor)
			{
				$lista[$key]=cortar_texto($valor,40);
				
			}
			$lista[""]="-Seleccione-";
			ksort($lista);
			$json['html']=form_dropdown('id_contenido',$lista,'',' id="id_contenido"');

			echo json_encode($json);
		}
			
	}
	
	
	function ver_presupuesto($id_modulo=0, $imprimir="")
	{
		$model=$this->modelo_usar;

		$data['datos']=$this->$model->obtener_presupuesto($id_modulo);

		$data['titulo']="Presupuesto";

		switch ($imprimir) {
			case 'web':
				$this->load->view($this->carpeta_view.'/ver_presupuesto_imprimir',$data);
				break;

			case 'pdf':
				
				$this->load->library('Pdf');
				
				// create new PDF document
				$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				
				// set document information
				$pdf->SetCreator(PDF_CREATOR);
				$pdf->SetAuthor('Jorge Rodriguez');
				$pdf->SetTitle('Detalle de Perfil');
				$pdf->SetSubject($data['datos']['data_modalidad_plan']['nombre_plan']);
				$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
				
							// set default header data
			$pdf->SetHeaderData('', '', 'Fundación Asesores para el Desarrollo', 'Detalle del Presupuesto '.$data['datos']['data_modalidad_plan']['nombre_plan'], array(0,64,255), array(0,64,128));
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
			$pdf->SetFont('dejavusans', '', 14, '', true);
			
			// Add a page
			// This method has several options, check the source code documentation for more information.
			$pdf->AddPage();
			
			// set text shadow effect
			$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
			
			// Set some content to print
			/*$html = 'EOD
			<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
			<i>This is the first example of TCPDF library.</i>
			<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
			<p>Please check the source code documentation and other examples for further information.</p>
			<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
			EOD';*/
			$html = $this->load->view($this->carpeta_view.'/ver_presupuesto_pdf',$data,true);
			
			
			// Print text using writeHTMLCell()
			$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
			
			// ---------------------------------------------------------
			
			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			$pdf->Output('Detalle_perfil_'.$data['datos']['data_modalidad_plan']['nombre_plan'].'.pdf', 'D');
			
			//============================================================+
			// END OF FILE
			//============================================================+

				break;

			case 'docx':
				
				$this->output->set_content_type('application/vnd.ms-word');
				$this->output->set_header("Pragma: no-cache");
				$this->output->set_header("Expires: 0");
				$this->output->set_header("Content-Disposition: attachment; filename=".'Detalle_perfil_'.$data['datos']['data_modalidad_plan']['nombre_plan'].".doc");
				$this->output->set_header('charset=UTF-8');
				
				$html='<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'.$this->load->view($this->carpeta_view.'/ver_presupuesto_pdf',$data,true);
				
				$this->output->set_output($html);

				break;
			
			default:
				$this->load->view($this->carpeta_view.'/ver_presupuesto',$data);
				break;
		}
	}
	


}