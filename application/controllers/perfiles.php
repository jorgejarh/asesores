<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfiles extends CI_Controller {

	public $datos_user=array();

	function __construct()
    {
        parent::__construct();

        $this->datos_user=comprobar_login();

    }

	public function index()
	{
		
		$data['title']="Mantenimiento de Perfiles";
		$data['template']="sistema";
		$data['contenido']="perfiles/list_perfiles";
		
		$data['listado']=$this->curricula_model->obtener_perfiles();
		

		$this->load->view('template',$data);

	}
	
	public function nuevo()
	{
		$data=array();
		
		$data['curriculas']=$this->curricula_model->obtener_curricula();
		
		$this->load->view('perfiles/form_nuevo',$data);
	}
	
	public function insertar_perfil()
	{
		$post=$this->input->post();
		if($post)
		{
						
			$guardar=$this->db->insert('cu_perfil',$post);

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
		
		$data['dato']=$this->curricula_model->obtener_perfiles($id);
		
		$data['curriculas']=$this->curricula_model->obtener_curricula();
		
		$this->load->view('perfiles/form_editar',$data);
	}
	
	
	public function editar_perfil()
	{
		$post=$this->input->post();
		if($post)
		{
			$id=$post['id_perfil'];
			unset($post['id_perfil']);
						
			$resultado = $this->db->update('cu_perfil',$post,array('id_perfil'=>$id));

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
			$resultado=$this->db->delete('cu_perfil', array('id_perfil'=>$id));
		}
		if($resultado)
		{
			echo "<h1>Registro Eliminado Correctamente</h1>";
		}else{
			echo "<h1>Error al eliminar el registro</h1>";
		}
	}
	
	public function asignar($id_perfil=0)
	{
		if(is_numeric($id_perfil) && $id_perfil!=0)
		{
			$data['perfil']=$this->curricula_model->obtener_perfiles($id_perfil);
			
			if($data['perfil'])
			{
				$data['title']="Perfil - ".$data['perfil']['perfil'];
				$data['template']="sistema";
				$data['contenido']="perfiles/asignar_contenido";
				
				$data['tipos_contenido']=$this->curricula_model->obtener_tipos_contenido();
				
				$this->load->view('template',$data);
			}
			
			
		}
		
	}
	
	public function actualizar_contenido($id=0,$id_perfil=0)
	{
		if($id!=0)
		{
			$data['tipo_contenido']=$this->curricula_model->obtener_tipos_contenido($id);
			
			if($data['tipo_contenido'])
			{
				$data['listado']=$this->curricula_model->obtener_listado_contenido($data['tipo_contenido']['nombre_tabla'],$id_perfil);
				$data['id_perfil']=$id_perfil;
				$this->load->view('perfiles/actualizar_contenido',$data);
			}
			
		}
	}
	
	public function nuevo_contenido($id=0,$id_perfil=0)
	{
		if($id!=0)
		{
			$data['tipo_contenido']=$this->curricula_model->obtener_tipos_contenido($id);
			
			if($data['tipo_contenido'])
			{
				$data['id_perfil']=$id_perfil;			
				$this->load->view('perfiles/nuevo_contenido',$data);
			}
			
		}
	}
	
	public function insertar_contenido()
	{
		$post=$this->input->post();
		if($post)
		{
			$resultado=$this->db->insert($post['tabla'],array('nombre'=>$post['nombre'],'id_perfil'=>$post['id_perfil']));
			
			if($resultado)
			{
				echo "ok";
			}else{
				echo "Error en guardar el registro";
				}
			
		}
	}
	
	public function editar_contenido($id,$id_perfl)
	{
		$post=$this->input->post();
		if($id!=0)
		{
			$data['tipo_contenido']=$this->curricula_model->obtener_tipos_contenido($id);
			
			if($data['tipo_contenido'])
			{
				$data['dato']=$this->curricula_model->obtener_contenido($data['tipo_contenido']['nombre_tabla'],$post['id']);
				$data['id_perfil']=$id_perfl;
				$this->load->view('perfiles/editar_contenido',$data);
			}
			
		}
	}
	
	
	public function editar_y_actualizar_contenido()
	{
		$post=$this->input->post();
		if($post)
		{
			$resultado=$this->db->update($post['tabla'],array('nombre'=>$post['nombre']),array('id'=>$post['id']));
			
			if($resultado)
			{
				echo "ok";
			}else{
				echo "Error en guardar el registro";
				}
			
		}
	}
	
	public function eliminar_contenido()
	{
		$post=$this->input->post();
		if($post)
		{
			$resultado=$this->db->delete($post['tabla'],array('id'=>$post['id']));
			
			if($resultado)
			{
				echo "ok";
			}else{
				echo "Error en eliminar el registro";
				}
			
		}
	}
	
	public function ver_perfil($id_perfil=0)
	{
		$data['perfil']=$this->curricula_model->obtener_perfiles($id_perfil);
		
		$data['curricula']=$this->curricula_model->obtener_curricula($data['perfil']['id_curricula']);
		
		$data['tipos_contenido']=$this->curricula_model->obtener_tipos_contenido();
		
		foreach($data['tipos_contenido'] as $indice=>$valor)
		{
			$data['tipos_contenido'][$indice]['lista_contenido']=$this->curricula_model->obtener_listado_contenido($valor['nombre_tabla'],$id_perfil);
		}
		/*
		$this->output
		->set_content_type('application/msword');
		//->set_output(json_encode(array('foo' => 'bar')));
		
		$this->output->set_header("Content-Disposition: inline; filename=perfil.doc");*/
		
		$this->load->view('perfiles/ver_perfil',$data);
	}
	
}