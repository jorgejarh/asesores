<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cooperativas extends CI_Controller {

	public $datos_user=array();

	function __construct()
    {
        parent::__construct();
        $this->datos_user=comprobar_login();

    }

	public function index()
	{
		
		$data['title']="Cooperativas";
		$data['template']="sistema";
		$data['contenido']="cooperativas/list_coop";
		$data['listado']=$this->users_model->obtener_cooperativas();
		$this->load->view('template',$data);

	}
	
	public function nuevo()
	{
		$data=array();
		$this->load->view('cooperativas/form_nuevo',$data);
	}
	
	public function insertar_cooperativa()
	{
		$post=$this->input->post();
		if($post)
		{
			$guardar = $this->cooperativa_model->insertar_cooperativa($post);
			$id_cooperativa = $this->db->insert_id();
			$obtener_cooperativa = $this->cooperativa_model->obtener_cooperativa($id_cooperativa);
			if($guardar)
			{
				$data['cooperativa'] = $obtener_cooperativa['cooperativa'];
				$data['id_cooperativa'] = $id_cooperativa;
				$this->load->view('cooperativas/sube_arc',$data);
			}else{

				echo "Error al guardar el registro.";
			}
		}
	}
	
	public function editar($id=0)
	{
		$data['dato']=$this->cooperativa_model->obtener_cooperativa($id);
		$this->load->view('cooperativas/form_editar',$data);
	}

	public function cambiar_imagen($id_cooperativa=0){
		$obtener_cooperativa = $this->cooperativa_model->obtener_cooperativa($id_cooperativa);
		$data['cooperativa'] = $obtener_cooperativa['cooperativa'];
		$data['id_cooperativa'] = $id_cooperativa;
		$this->load->view('cooperativas/sube_arc', $data);
	}
	
	
	public function editar_cooperativa()
	{
		$post=$this->input->post();
		if($post)
		{
			$id=$post['id_cooperativa'];
			unset($post['id_cooperativa']);		
			$resultado = $this->cooperativa_model->editar_cooperativa($post, $id);
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
			$obtener_cooperativa = $this->cooperativa_model->obtener_cooperativa($id);
			$resultado = $this->cooperativa_model->eliminar($id);
			$logotipo = $obtener_cooperativa['logotipo'];
		}
		if($resultado)
		{
			if($logotipo){
				$existeArc = $this->cooperativa_model->existeArc('public/img/'.$logotipo);
				if($existeArc){
					$eliminarArc = $this->cooperativa_model->eliminarArc('public/img/'.$logotipo);
					if($eliminarArc){
						echo "Cooperativa Eliminada";
					}else{
						echo "Cooperativa Eliminada. El logo no pudo ser eliminado";
					}
				}
			}else{
				echo "Cooperativa Eliminada";
			}
		}else{
			echo "Error! No se pudo Eliminar la Cooperativa";
		}
	}

	function do_upload()
	{
		$id_cooperativa = $this->input->post('id_cooperativa');
		$obtener_cooperativa = $this->cooperativa_model->obtener_cooperativa($id_cooperativa);
		$logotipo = $obtener_cooperativa['logotipo'];

	    /*$config['upload_path'] = 'public/img/logos/';
	    $config['allowed_types'] = 'gif|jpg|png|bmp|GIF|JPG|PNG|BMP';
	    $config['max_size'] = '100';
	    $config['max_width'] = '1024';
	    $config['max_height'] = '768';
	 
	    $this->load->library('upload', $config);
	    $subido = $this->upload->do_upload();*/
	    
	    $max = 650000;
	    $arc = $_FILES["file"]["name"];
	    $size = $_FILES["file"]["size"];
		$dirTemp = $_FILES["file"]["tmp_name"];
		$dirAct = "public/img/logos/";
		$subido = false;
		$existeArc = $this->cooperativa_model->existeArc($dirAct.$arc);
		
		if(($size <= $max) && (!$existeArc)){
			$subido = $this->cooperativa_model->subeArc($dirTemp, $dirAct, $arc);
		}
		
		if($subido){
			$insertArc = $this->cooperativa_model->insertArc($id_cooperativa, $arc);
			if($insertArc){
				if($logotipo){
					$existeArcAnterior = $this->cooperativa_model->existeArc('public/img/'.$logotipo);
					if($existeArcAnterior){
						$this->cooperativa_model->eliminarArc('public/img/'.$logotipo);
					}
				}
				echo "<script>";
				echo "parent.document.getElementById('ok').innerHTML = 'El archivo ".$arc." fue subido';";
				echo "parent.document.getElementById('ok').style.display = 'block';";
				echo "parent.document.getElementById('cerrar').style.display = 'block';";
				echo "parent.document.getElementById('error').style.display = 'none';";
				echo "parent.document.getElementById('subir').style.display = 'none';";
				echo "</script>";
			}else{
				echo "algo pasa";
				echo "<script>";
				echo "parent.document.getElementById('error').innerHTML = 'Error: El archivo no pudo ser Guardado';";
				echo "parent.document.getElementById('error').style.display = 'block';";
				echo "parent.document.getElementById('cerrar').style.display = 'block';";
				echo "</script>";
			}
			
		}else{
			echo "<script>";
			echo "parent.document.getElementById('error').innerHTML = 'Error: El archivo no pudo ser Subido Puede ser que el archivo sobrepase el maximo permitido o puede ser que ya exista un Archivo con ese Nombre';";
			echo "parent.document.getElementById('error').style.display = 'block';";
			echo "parent.document.getElementById('cerrar').style.display = 'block';";
			echo "</script>";
		}

	}
}