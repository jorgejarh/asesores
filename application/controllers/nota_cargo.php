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
		
		$post=$this->input->post();
		
		if($post)
		{
			$post['id_cooperativa']=$post['cooperativa'];
			unset($post['cooperativa']);
			$post['id_usuario_creado']=$this->datos_user['id_usuario'];
			$post['fecha_creacion']=date("Y-m-d H:i:s");
			$this->nota_cargo_model->guardar_nota_cargo($post);
			
			redirect('nota_cargo/index');
		}
		
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
			//echo $this->db->last_query();
			$json['capacitaciones']="";
			foreach($capacitaciones as $valor)
			{
				$json['capacitaciones'].='<option value="'.$valor['id_capacitacion'].'">'.$valor['nombre_capacitacion'].'</option>';
			}
			
			echo json_encode($json);
		}
		
		//print_r($post);
	}
	
	public function ajax_personas_x_capacitacion()
	{
		$post=$this->input->post();
		
		if($post)
		{
			$json=array();
			
			$personas=$this->nota_cargo_model->personas_x_capacitacion($post);
			
			$json['personas']="<ul class='lista_participantes'>";
			foreach($personas as $valor)
			{
				$json['personas'].='<li>'.$valor['nombres']." ".$valor['apellidos'].'</li>';
			}
			$json['personas'].="</ul>";
			echo json_encode($json);
		}
	}
	
	public function ajax_letras()
	{
		$post=$this->input->post();
		
		if($post)
		{
			$letra= new EnLetras();
			
			echo $letra->ValorEnLetras($post['num'],"Dolares");
		}
	}
	
	public function ajax_datos_capacitacion()
	{
		$post=$this->input->post();
		if($post)
		{
			$this->load->model("inscripcion_temas_personas_model");
			$this->load->model("pl_modulos_model");
			$modulos=$this->pl_modulos_model->lista($post['id_capacitacion']);
			$total_afiliado=0;
			$total_afiliado_no=0;
			$total_afiliado_ex=0;
			foreach($modulos as $mod)
			{
				$total_afiliado+=$mod['precio_venta'];
				$total_afiliado_no+=$mod['precio_venta_no'];
				$total_afiliado_ex+=$mod['precio_venta_ex'];
			}
			
			if($post['tipo_persona']!="C")
			{
				$persona=$this->inscripcion_temas_personas_model->obtener_uno($post['id_cooperativa']);
				if($persona)
				{
					if($persona['tipo_persona']=="NA")
					{
						echo $total_afiliado_no;
					}else{
						echo $total_afiliado_ex;
						}
				}else{
					echo "0";
					}
				
			}else{
				echo $total_afiliado;
				}
			
			//echo json_encode($data);
		}
	}
	
	
	public function imprimir($id_nota_cargo=0)
	{
		
		$data['datos']=$this->nota_cargo_model->obtener_una_nota($id_nota_cargo);
		$data['persona']="";
		if($data['datos']['tipo_persona']=="C")
		{
			
			$data['lista_personas']=$this->nota_cargo_model->obtener_cooperativas();
			foreach($data['lista_personas'] as $val)
			{
				if($val['id_cooperativa']==$data['datos']['id_cooperativa'])
				{
					$data['persona']=$val['cooperativa'];
					break;
				}
				
			}
		}else{
			$data['lista_personas']=$this->nota_cargo_model->obtener_no_afiliadas();
			
				foreach($data['lista_personas'] as $val)
				{
					if($val['dui']==$data['datos']['id_cooperativa'])
					{
						$data['persona']=$val['apellidos'].', '.$val['nombres'];
						break;
					}
					
				}
			}	
		
		$data['personas']=$this->nota_cargo_model->personas_x_capacitacion(array('id_cooperativa'=>$data['datos']['id_cooperativa'],'tipo_persona'=>$data['datos']['tipo_persona']));
		
		$data['titulo']="Imprimir";
		
		$this->load->view('nota_cargo/imprimir',$data);
		
	}
	
}