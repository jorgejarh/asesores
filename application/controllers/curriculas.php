<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curriculas extends CI_Controller {

	public $datos_user=array();

	function __construct()
    {
        parent::__construct();

        $this->datos_user=comprobar_login();

    }

	public function index()
	{
		
		$data['title']="Mantenimiento de Curriculas";
		$data['template']="sistema";
		$data['contenido']="curricula/list_curricula";
		
		$data['listado']=$this->curricula_model->obtener_curricula();

		$this->load->view('template',$data);

	}
	
	public function nuevo()
	{
		$data=array();
		
		$this->load->view('curricula/form_nuevo',$data);
	}
	
	public function insertar_curricula()
	{
		$post=$this->input->post();
		if($post)
		{
						
			$guardar=$this->db->insert('cu_curricula',$post);

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
		
		$data['dato']=$this->curricula_model->obtener_curricula($id);

		$this->load->view('curricula/form_editar',$data);
	}
	
	
	public function editar_curricula()
	{
		$post=$this->input->post();
		if($post)
		{
			$id=$post['id_curricula'];
			unset($post['id_curricula']);
						
			$resultado = $this->db->update('cu_curricula',$post,array('id_curricula'=>$id));

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
			$resultado=$this->db->delete('cu_curricula', array('id_curricula'=>$id));
		}
		if($resultado)
		{
			echo "<h1>Registro Eliminado Correctamente</h1>";
		}else{
			echo "<h1>Error al eliminar el registro</h1>";
		}
	}
	
	
}