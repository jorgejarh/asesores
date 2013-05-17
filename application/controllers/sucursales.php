<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sucursales extends CI_Controller {

	public $datos_user=array();

	function __construct()
    {
        parent::__construct();

        $this->datos_user=comprobar_login();

    }

	public function index()
	{
		
		$data['title']="Mantenimiento de Sucursales";
		$data['template']="sistema";
		$data['contenido']="sucursales/list_sucursales";
		
		$data['listado']=$this->cooperativa_model->obtener_sucursales();
		

		$this->load->view('template',$data);

	}
	
	public function nuevo()
	{
		$data=array();
		
		$data['cooperativas']=$this->cooperativa_model->obtener_cooperativa();
		
		$this->load->view('sucursales/form_nuevo',$data);
	}
	
	public function insertar_sucursal()
	{
		$post=$this->input->post();
		if($post)
		{
						
			$guardar=$this->db->insert('conf_sucursal',$post);

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
		
		$data['dato']=$this->cooperativa_model->obtener_sucursales($id);
		
		$data['cooperativas']=$this->cooperativa_model->obtener_cooperativa();
		
		$this->load->view('sucursales/form_editar',$data);
	}
	
	
	public function editar_sucursal()
	{
		$post=$this->input->post();
		if($post)
		{
			$id=$post['id_sucursal'];
			unset($post['id_sucursal']);
						
			$resultado = $this->db->update('conf_sucursal',$post,array('id_sucursal'=>$id));

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
			$resultado=$this->db->delete('conf_sucursal', array('id_sucursal'=>$id));
		}
		if($resultado)
		{
			echo "<h1>Registro Eliminado Correctamente</h1>";
		}else{
			echo "<h1>Error al eliminar el registro</h1>";
		}
	}
	
}