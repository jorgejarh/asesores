<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfiles extends CI_Controller {

	public $datos_user=array();

	function __construct()
    {
        parent::__construct();

        $this->datos_user=comprobar_login();
        $this->load->model('perfiles_model');

    }

	public function index($id_curricula=0)
	{
		
		$data['title']="Mantenimiento de Perfiles";
		$data['template']="sistema";
		$data['contenido']="perfiles/list_perfiles";
		$data['curricula']=$this->curricula_model->obtener_curricula($id_curricula);
		if($id_curricula!=0){
			$data['listado']=$this->curricula_model->obtener_perfiles_por_id_curricula($id_curricula);
			$data['id_curricula'] = $id_curricula;
		}else{
			
			redirect('portal');
			//$data['listado']=$this->curricula_model->obtener_perfiles();	
		}
		
		$this->load->view('template',$data);

	}
	
	public function nuevo($id_curricula)
	{
		$data=array();
		$data['id_curricula'] = $id_curricula;
		$data['curriculas']=$this->curricula_model->obtener_curricula();
		
		$this->load->view('perfiles/form_nuevo',$data);
	}
	
	public function insertar_perfil()
	{
		$post=$this->input->post();
		if($post)
		{
						
			$guardar=$this->perfiles_model->insertar_perfil($post);

			if($guardar)
			{
				echo "ok";
			}else{

				echo "Error al guardar el registro.";
			}

		}

	}
	
	public function editar($id=0)
	{
		
		$data['dato']=$this->curricula_model->obtener_perfiles($id);
		
		$data['curriculas']=$this->curricula_model->obtener_curricula();
		
		$this->load->view('perfiles/form_editar',$data);
	}
	
	
	public function editar_perfil()
	{
		$post=$this->input->post();
		if($post)
		{
			$id=$post['id_perfil'];
			unset($post['id_perfil']);

			$resultado = $this->perfiles_model->editar_perfil($post,$id);

			if($resultado)
			{
				echo "ok";

			}else{
				echo "Error al actualizar el registro";
			}
		}
	}
	
	public function eliminar($id=0)
	{
		if ($id!=0)
		{
			//$resultado=$this->db->update('usu_usuario', array('estado'=>$this->input->post('activo')),array('id_usuario'=>$id));
			$resultado = $this->perfiles_model->eliminar($id);
		}
		if($resultado)
		{
			echo "<h1>Registro Eliminado Correctamente</h1>";
		}else{
			echo "<h1>Error al eliminar el registro</h1>";
		}
	}
	
	public function asignar($id_perfil=0)
	{
		if(is_numeric($id_perfil) && $id_perfil!=0)
		{
			$data['perfil']=$this->curricula_model->obtener_perfiles($id_perfil);
			
			if($data['perfil'])
			{
				$data['title']="Perfil - ".$data['perfil']['perfil'];
				$data['template']="sistema";
				$data['contenido']="perfiles/asignar_contenido";
				
				$data['tipos_contenido']=$this->curricula_model->obtener_tipos_contenido();
				
				$this->load->view('template',$data);
			}
			
			
		}
		
	}
	
	public function actualizar_contenido($id=0,$id_perfil=0)
	{
		if($id!=0)
		{
			$data['tipo_contenido']=$this->curricula_model->obtener_tipos_contenido($id);
			
			if($data['tipo_contenido'])
			{
				$data['listado']=$this->curricula_model->obtener_listado_contenido($data['tipo_contenido']['nombre_tabla'],$id_perfil);
				$data['id_perfil']=$id_perfil;
				$this->load->view('perfiles/actualizar_contenido',$data);
			}
			
		}
	}
	
	public function nuevo_contenido($id=0,$id_perfil=0)
	{
		if($id!=0)
		{
			$data['tipo_contenido']=$this->curricula_model->obtener_tipos_contenido($id);
			
			if($data['tipo_contenido'])
			{
				$data['id_perfil']=$id_perfil;			
				$this->load->view('perfiles/nuevo_contenido',$data);
			}
			
		}
	}
	
	public function insertar_contenido()
	{
		$post=$this->input->post();
		if($post)
		{
			//$resultado=$this->db->insert($post['tabla'],array('nombre'=>$post['nombre'],'id_perfil'=>$post['id_perfil']));
			$resultado = $this->perfiles_model->insertar_contenido($post);
			if($resultado)
			{
				echo "ok";
			}else{
				echo "Error en guardar el registro";
				}
			
		}
	}
	
	public function editar_contenido($id,$id_perfl)
	{
		$post=$this->input->post();
		if($id!=0)
		{
			$data['tipo_contenido']=$this->curricula_model->obtener_tipos_contenido($id);
			
			if($data['tipo_contenido'])
			{
				$data['dato']=$this->curricula_model->obtener_contenido($data['tipo_contenido']['nombre_tabla'],$post['id']);
				$data['id_perfil']=$id_perfl;
				$this->load->view('perfiles/editar_contenido',$data);
			}
			
		}
	}
	
	
	public function editar_y_actualizar_contenido()
	{
		$post=$this->input->post();
		if($post)
		{
			$resultado = $this->perfiles_model->editar_y_actualizar_contenido($post);
			
			if($resultado)
			{
				echo "ok";
			}else{
				echo "Error en guardar el registro";
				}
			
		}
	}
	
	public function eliminar_contenido()
	{
		$post=$this->input->post();
		if($post)
		{
			//$resultado=$this->db->delete($post['tabla'],array('id'=>$post['id']));
			$resultado = $this->perfiles_model->eliminar_contenido($post);

			if($resultado)
			{
				echo "ok";
			}else{
				echo "Error en eliminar el registro";
				}
			
		}
	}
	
	public function ver_perfil($id_perfil=0,$imprimir="")
	{
		
		
		$data['perfil']=$this->curricula_model->obtener_perfiles($id_perfil);
		
		$data['curricula']=$this->curricula_model->obtener_curricula($data['perfil']['id_curricula']);
		
		$data['tipos_contenido']=$this->curricula_model->obtener_tipos_contenido();
		
		foreach($data['tipos_contenido'] as $indice=>$valor)
		{
			$data['tipos_contenido'][$indice]['lista_contenido']=$this->curricula_model->obtener_listado_contenido($valor['nombre_tabla'],$id_perfil);
		}
		
		switch($imprimir)
		{
			
			case 'web':
				$this->load->view('perfiles/ver_perfil_imprimir',$data);
				break;
			
			case 'pdf':
				$this->load->library('Pdf');
				
				// create new PDF document
				$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				
				// set document information
				$pdf->SetCreator(PDF_CREATOR);
				$pdf->SetAuthor('Jorge Rodriguez');
				$pdf->SetTitle('Detalle de Perfil');
				$pdf->SetSubject($data['perfil']['perfil']);
				$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
				
							// set default header data
			$pdf->SetHeaderData('', '', 'Fundación Asesores para el Desarrollo', 'Detalle del perfil '.$data['perfil']['perfil'], array(0,64,255), array(0,64,128));
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
			$html = $this->load->view('perfiles/ver_perfil_pdf',$data,true);
			
			
			// Print text using writeHTMLCell()
			$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
			
			// ---------------------------------------------------------
			
			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			$pdf->Output('Detalle_perfil_'.$data['perfil']['perfil'].'.pdf', 'D');
			
			//============================================================+
			// END OF FILE
			//============================================================+
				break;
			
			case 'docx':
				
				
				/*
				$this->load->library('docx');
				$docx = new CreateDocx();
				$html=$this->load->view('perfiles/ver_perfil_pdf',$data,true);
				
				//print_r($docx);
				
				$docx->addText($html);
				//$docx->createDocxAndDownload('example_text');
				$docx->createDocx('simpleHTML');*/
				$this->output->set_content_type('application/vnd.ms-word');
				$this->output->set_header("Pragma: no-cache");
				$this->output->set_header("Expires: 0");
				$this->output->set_header("Content-Disposition: attachment; filename=".'Detalle_perfil_'.$data['perfil']['perfil'].".doc");
				$this->output->set_header('charset=UTF-8');
				
				$html='<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'.$this->load->view('perfiles/ver_perfil_pdf',$data,true);
				
				$this->output->set_output($html);
				//echo $html;
				
				break;
			
			default:
				$this->load->view('perfiles/ver_perfil',$data);
				break;
		}
		
		
		
		/*
		$this->output
		->set_content_type('application/msword');
		//->set_output(json_encode(array('foo' => 'bar')));
		
		$this->output->set_header("Content-Disposition: inline; filename=perfil.doc");*/
		
		
	}
	
}