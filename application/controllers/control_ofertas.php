<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_ofertas extends CI_Controller {

	public $datos_user=array();

	public $carpeta_view="control_ofertas";

	public $modelo_usar="control_ofertas_model";

	public $nombre_controlador="control_ofertas";
	
	public $nombre_titulo="Control de Ofertas";
	
	public $campos=array();
	
	
	public function set_campo($nombre_campo,$nombre_mostrar,$reglas="",$tipo_elemento="text",$datos_select=array(),$dato='')
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
		$this->load->model("cooperativa_model");
		$this->load->model("pl_planes_model");
		$this->set_campo("codigo_oferta","Nº Oferta",'required|xss_clean', 'text');
		$this->set_campo("id_servicio","Servicio",'required|xss_clean', 'select',preparar_select($this->$model->servicios(),'id_servicio','nombre'));
		$this->set_campo("id_plan","Plan",'required|xss_clean', 'select',preparar_select($this->pl_planes_model->obtener(0),'id_plan','nombre_plan'));
		$this->set_campo("id_modalidad","Modalidad",'required|xss_clean', 'select',array());
		$this->set_campo("id_capacitacion","Capacitacion",'required|xss_clean', 'select',array());
		$this->set_campo("id_cooperativa","Cooperativa",'required|xss_clean', 'select',preparar_select($this->cooperativa_model->obtener_cooperativa(),'id_cooperativa','cooperativa'));
		
		$this->set_campo("fecha_envio_solicitante","Fecha Envio al solicitante",'required|xss_clean', 'text');
		$this->set_campo("id_resolucion","Resolucion",'required|xss_clean', 'select',preparar_select($this->$model->obtener_resoluciones(),'id_resolucion','nombre'));
		$this->set_campo("fecha_aceptada","Fecha Aceptada",'xss_clean', 'text');
		$this->set_campo("fecha_inicio","Fecha Inicio",'xss_clean', 'text');
		$this->set_campo("fecha_fin","Fecha Fin",'xss_clean', 'text');
		$this->set_campo("id_estado","Estado",'required|xss_clean', 'select',preparar_select($this->$model->obtener_estados(),'id_estado','nombre'));
		$this->set_campo("fecha_entrega","Fecha ntrega",'xss_clean', 'text');
		$this->set_campo("monto","Monto",'xss_clean', 'text');
		$this->set_campo("observacion","Observacion",'xss_clean', 'textarea');
		$this->set_campo("montos","Montos",'xss_clean', 'text');
    }
	
	
	public function validar_telefonos($str)
	{
		$user=comprobar_login();
		
		if (!$str && !$this->input->post('t_oficina') && !$this->input->post('celular'))
		{
			$this->form_validation->set_message('validar_telefonos', 'Debe tener al menos un numero telefonico');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function index($excel="")
	{
		$model=$this->modelo_usar;
		$data['title']=$this->nombre_titulo;
		$data['template']="sistema";
		$data['contenido']=$this->carpeta_view."/lista";
		$data['listado']=$this->$model->obtener();
		$data['model']=$model;
		
		if($excel=="")
		{
			$this->load->view('template',$data);
		}else{
				header("Content-type: application/vnd.ms-excel"); 
				header("Content-Disposition: attachment; filename=ofertas_".date('d-m-Y').".xls");  
				
				$data['contenido']=$this->carpeta_view."/excel";
				/*$file_name="ofertas_".date('y-m-d').'.xls';
			 // get the file Mime type using the file extension
				switch(strtolower(substr(strrchr($file_name, '.'), 1))) {
					case 'pdf':  $mime = 'application/pdf'; break; // pdf files
					case 'zip':  $mime = 'application/zip'; break; // zip files
					case 'jpeg': $mime = 'image/jpeg'; break;// images jpeg
					case 'jpg':  $mime = 'image/jpg'; break;
					case 'mp3':  $mime = 'audio/mpeg'; break; // audio mp3 formats
					case 'doc':  $mime = 'application/msword'; break; // ms word
					case 'avi':  $mime = 'video/x-msvideo'; break;  // video avi format
					case 'txt':  $mime = 'text/plain'; break; // text files
					case 'xls':  $mime = 'application/vnd.ms-excel'; break; // ms excel
					default: $mime = 'application/force-download';
				}
				
				header('Pragma: public');   // required
				header('Expires: 0');       // no cache
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Cache-Control: private',false);
				header('Content-Type: '.$mime);
				header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
				header('Content-Transfer-Encoding: binary');
				header('Connection: close');*/
				//readfile($file_name);       
				$this->load->view($data['contenido'],$data);
				/*exit();*/
			
						
			}

	}
	
	public function modalidades()
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		if($post)
		{
			$this->load->model("pl_modalidades_model");
			$datos=$this->pl_modalidades_model->lista($post['id']);
			foreach($datos as $valor)
			{
				echo '<option value="'.$valor['id_plan_modalidad'].'">'.$valor['nombre_modalidad'].'</option>';
			}
		}
	}
	
	public function capacitaciones()
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		if($post)
		{
			$this->load->model("pl_capacitaciones_model");
			$datos=$this->pl_capacitaciones_model->lista($post['id']);
			foreach($datos as $valor)
			{
				echo '<option value="'.$valor['id_capacitacion'].'">'.$valor['nombre_capacitacion'].'</option>';
			}
		}
	}
	
	
	
	public function nuevo()
	{
		$model=$this->modelo_usar;
		$data=array();
		$data['title']=$this->nombre_titulo." - Nuevo";
		
		$this->load->view($this->carpeta_view.'/form_nuevo',$data);
	}
	
	public function insertar()
	{
		$model=$this->modelo_usar;
		$post=$this->input->post();
		
		unset($post['id_plan']);
		unset($post['id_modalidad']);
		if($post)
		{
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
		
		if($data['dato'])
		{
			$data['title']=$this->nombre_titulo." - Editar";
			
			$this->load->model("pl_capacitaciones_model");
			$cap=$this->pl_capacitaciones_model->obtener($data['dato']['id_capacitacion']);
			
			
			$this->load->model("pl_modalidades_model");
			$mod=$this->pl_modalidades_model->obtener($cap['id_plan_modalidad']);
			
			
			
			$data['dato']['id_modalidad']=$mod['id_modalidad'];
			$data['dato']['id_plan']=$mod['id_plan'];
			
			$this->load->view($this->carpeta_view.'/form_editar',$data);
		}else{
			redirect($this->nombre_controlador);

		}

		
	}
	
	
	public function actualizar()
	{
		$post=$this->input->post();
		$model=$this->modelo_usar;
		
		unset($post['id_plan']);
		unset($post['id_modalidad']);
		
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
	
}
