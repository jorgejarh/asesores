<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nota_cargo extends CI_Controller {

	public $datos_user=array();

	function __construct()
    {
        parent::__construct();
        $this->datos_user=comprobar_login();
		$this->load->model('nota_cargo_model');
    }

	public function index()
	{
		
		$data['title']="Notas de Cargo";
		$data['template']="sistema";
		$data['contenido']="nota_cargo/lista";
		$data['listado']=$this->nota_cargo_model->obtener();
		
		$this->load->view('template',$data);

	}
	
	public function nuevo()
	{
		$data['title']="Nueva Nota de Cargo";
		$data['template']="sistema";
		$data['contenido']="nota_cargo/nuevo";
		$data['listado']=$this->nota_cargo_model->obtener();
		$data['cooperativas']=$this->nota_cargo_model->obtener_cooperativas();
		$this->load->view('template',$data);
	}
	
	
	public function ajax_listado_personas($tipo_persona='')
	{
		if($tipo_persona=="C")
		{
			$data['lista_personas']=$this->nota_cargo_model->obtener_cooperativas();
			foreach($data['lista_personas'] as $val)
			{
				echo '<option value="'.$val['id_cooperativa'].'">'.$val['cooperativa'].'</option>';
			}
		}else{
			$data['lista_personas']=$this->nota_cargo_model->obtener_no_afiliadas();
			echo $this->db->last_query();
				foreach($data['lista_personas'] as $val)
				{
					echo '<option value="'.$val['dui'].'">'.$val['apellidos'].', '.$val['nombres'].'</option>';
				}
			}	
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