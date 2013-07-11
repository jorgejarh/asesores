<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public $datos_user=array();

	function __construct()
    {
        parent::__construct();

        $this->datos_user=comprobar_login();

    }

	public function index()
	{
		
		$data['title']="Mantenimiento de usuaios";
		$data['template']="sistema";
		$data['contenido']="users/list_users";
		
		$data['listado']=$this->users_model->obtener_usuarios();

		$this->load->view('template',$data);

	}

	public function nuevo()
	{
		$data['roles']=$this->users_model->obtener_roles();
		
		$this->load->view('users/form_nuevo',$data);
	}

	public function ajax_cooperativas()
	{
		$post=$this->input->post();
		if($post)
		{
			$data['cooperativas']=$this->users_model->obtener_cooperativas();
			$this->load->view('users/ajax_cooperativas',$data);
		}
		
	}

	public function ajax_sucursales()
	{
		$post=$this->input->post();
		if($post)
		{
			$data['sucursales']=$this->users_model->obtener_sucursales($post['id_cooperativa']);
			$this->load->view('users/ajax_sucursales',$data);
		}
		
	}

	public function insertar_usuario()
	{
		$post=$this->input->post();
		if($post)
		{
			/*if($post['id_rol']!=2 && $post['id_cooperativa']==0 && $post['id_sucursal']==0)
			{
				$post['id_subrol']=1;
			}*/

			
			$guardar=$this->db->insert('usu_usuario',$post);

			if($guardar)
			{
				echo "ok";
			}else{

				echo "Error al guardar Usuario.";
			}

			//print_r($post);
		}

	}

	public function editar($id=0)
	{
		$data['roles']=$this->users_model->obtener_roles();
		
		$data['datos_usuario']=$this->users_model->obtener_datos_usuario($id);

		$this->load->view('users/form_editar',$data);
	}

	public function editar_usuario()
	{
		$post=$this->input->post();
		if($post)
		{
			$id=$post['id_usuario'];
			unset($post['id_usuario']);
			if($post['clave']!="")
			{
				$post['clave']=md5($post['clave']);
			}else{
				unset($post['clave']);
			}

			
			$resultado = $this->db->update('usu_usuario',$post,array('id_usuario'=>$id));

			if($resultado)
			{
				echo "ok";

			}else{
				echo "Error al actualizar el usuario";
			}
		}
	}

	public function eliminar($id=0)
	{
		if ($id!=0)
		{
			$resultado=$this->db->update('usu_usuario', array('estado'=>$this->input->post('activo')),array('id_usuario'=>$id));
		}
		if($resultado)
		{
			echo "<h1>Usuario Actualizado Correctamente</h1>";
		}else{
			echo "<h1>Error al actualizar el usuario</h1>";
		}
	}


	/**
	 * LLama a la vista para cambiar contraseña
	 */
	public function cambiar_pass_form(){
		
		$data['title']      = "Cambiar contraseña";
		$data['id_usuario'] = $this->input->post('id_usuario');

		$this->load->view('users/cambiar_pass', $data);
	}

	/**
	 * sirve para cambiar contraseña
	 */
	public function cambiar_pass(){
		$data = array();

		$this->form_validation->set_rules('clave','Contraseña',"required|matches[confirma_clave]|xss_clean|min_length[6]|md5");
		$this->form_validation->set_message('matches',"Las contraseñas no coinciden");

		if( $this->form_validation->run() ){

			$data['error'] = false;
			$post          = $this->input->post();
			
			$this->users_model->cambiar_pass( $post );

		}else{

			$data['error']   = true;
			$data['mensaje'] = traer_errores_form();
		}

		$this->output->set_content_type('application/json')->set_output( json_encode( $data ) );
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */