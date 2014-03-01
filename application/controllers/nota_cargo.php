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
	public function ajax_capacitaciones()
	{
		$post=$this->input->post();
		
		if($post)
		{
			$json=array();
			
			$capacitaciones=$this->nota_cargo_model->obtener_capacitaciones($post);
			
			foreach($capacitaciones as $valor)
			{
				$json['capacitaciones']='<option value="'.$valor['id_capacitacion'].'">'.$valor['nombre_capacitacion'].'</option>';
			}
			
			
			
			echo json_encode($json);
		}
		
		//print_r($post);
	}
	

}