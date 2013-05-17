<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curricula extends CI_Controller {

	public $datos_user=array();

	function __construct()
    {
        parent::__construct();

        $this->datos_user=comprobar_login();

    }
    

	public function index()
	{
		
		$data['title']="Curricula";
		$data['template']="sistema";
		$data['contenido']="curricula/list_curricula";
		
		$data['listado']=$this->curricula_model->obtener_curricula();

		$this->load->view('template',$data);

	}
	public function nuevo()
	{
		$data['roles']=$this->users_model->obtener_roles();
		
		$this->load->view('curricula/form_nuevo');
	}
	

	public function insertar_curricula()
	{
		$post=$this->input->post();
		if($post)
		{
			/*if($post['id_rol']!=2 && $post['id_cooperativa']==0 && $post['id_sucursal']==0)
			{
				$post['id_subrol']=1;
			}*/

			/*unset($post['id_rol']);
			unset($post['id_cooperativa']);
			unset($post['id_sucursal']);
			$post['id_subrol']=1;*/

			$guardar=$this->db->insert('cu_curricula',$post);

			if($guardar)
			{
				echo "ok";
			}else{

				echo "Error al guardar Curricula.";
			}

			//print_r($post);
		}

	} 

}