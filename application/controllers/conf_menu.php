<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conf_menu extends CI_Controller {

	public $datos_user=array();

	function __construct()
    {
        parent::__construct();
        $this->datos_user=comprobar_login();
		$this->load->model('conf_menu_model');

    }

	public function index()
	{
		
		$data['title']="Gestion de Menu";
		$data['template']="sistema";
		$data['contenido']="conf_menu/lista";
		$data['listado']=$this->conf_menu_model->obtener_menus_completo();
		
		$this->load->view('template',$data);

	}
	
	public function nuevo()
	{
		$data=array();
		$data['menus']=preparar_select($this->conf_menu_model->obtener_menus(),'id_menu','nombre_menu');
		$data['menus'][0]="--Sin Padre--";
		ksort($data['menus']);
		$this->load->view('conf_menu/form_nuevo',$data);
	}
	
	public function insertar_datos()
	{
		$post=$this->input->post();
		if($post)
		{
			$guardar=$this->conf_menu_model->insertar_menu($post);

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
		$data['menus']=preparar_select($this->conf_menu_model->obtener_menus(),'id_menu','nombre_menu');
		$data['menus'][0]="--Sin Padre--";
		ksort($data['menus']);
		
		$data['dato']=$this->conf_menu_model->obtener_info_menu($id);
		$this->load->view('conf_menu/form_editar',$data);
	}
	
	
	public function editar_datos()
	{
		$post=$this->input->post();
		if($post)
		{
			$id=$post['id'];
			unset($post['id']);
						
			$resultado = $this->conf_menu_model->actualizar_menu($post,$id);

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
			$resultado= $this->conf_menu_model->eliminar($id);
		}
		if($resultado)
		{
			echo "ok";
		}else{
			echo "error";
		}
	}

}