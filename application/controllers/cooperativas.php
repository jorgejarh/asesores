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
			$guardar=$this->db->insert('conf_cooperativa',$post);

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
		$data['dato']=$this->cooperativa_model->obtener_cooperativa($id);
		$this->load->view('cooperativas/form_editar',$data);
	}
	
	
	public function editar_cooperativa()
	{
		$post=$this->input->post();
		if($post)
		{
			$id=$post['id_cooperativa'];
			unset($post['id_cooperativa']);
						
			$resultado = $this->db->update('conf_cooperativa',$post,array('id_cooperativa'=>$id));

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
			$resultado=$this->db->delete('conf_cooperativa', array('id_cooperativa'=>$id));
		}
		if($resultado)
		{
			echo "<h1>Registro Eliminado Correctamente</h1>";
		}else{
			echo "<h1>Error al eliminar el registro</h1>";
		}
	}

	function do_upload()
	{
	    $config['upload_path'] = 'public/img/logos/';
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['max_size'] = '100';
	    $config['max_width'] = '1024';
	    $config['max_height'] = '768';
	 
	    // You can give video formats if you want to upload any video file.
	 
	    $this->load->library('upload', $config);
	}
}