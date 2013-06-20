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
			$guardar = $this->cooperativa_model->insertar_cooperativa($post);
			$id_cooperativa = $this->db->insert_id();
			$obtener_cooperativa = $this->cooperativa_model->obtener_cooperativa($id_cooperativa);
			if($guardar)
			{
				$data['cooperativa'] = $obtener_cooperativa['cooperativa'];
				$data['id_cooperativa'] = $id_cooperativa;
				$this->load->view('cooperativas/sube_arc',$data);
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

	public function cambiar_imagen($id_cooperativa=0){
		$obtener_cooperativa = $this->cooperativa_model->obtener_cooperativa($id_cooperativa);
		$data['cooperativa'] = $obtener_cooperativa['cooperativa'];
		$data['id_cooperativa'] = $id_cooperativa;
		$this->load->view('cooperativas/sube_arc', $data);
	}
	
	
	public function editar_cooperativa()
	{
		$post=$this->input->post();
		if($post)
		{
			$id=$post['id_cooperativa'];
			unset($post['id_cooperativa']);		
			$resultado = $this->cooperativa_model->editar_cooperativa($post, $id);
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
			$obtener_cooperativa = $this->cooperativa_model->obtener_cooperativa($id);
			$resultado = $this->cooperativa_model->eliminar($id);
			$logotipo = $obtener_cooperativa['logotipo'];
		}
		if($resultado)
		{
			if($logotipo){
				$existeArc = $this->cooperativa_model->existeArc('public/img/'.$logotipo);
				if($existeArc){
					$eliminarArc = $this->cooperativa_model->eliminarArc('public/img/'.$logotipo);
					if($eliminarArc){
						echo "Cooperativa Eliminada";
					}else{
						echo "Cooperativa Eliminada. El logo no pudo ser eliminado";
					}
				}
			}else{
				echo "Cooperativa Eliminada";
			}
		}else{
			echo "Error! No se pudo Eliminar la Cooperativa";
		}
	}

	function do_upload(){
		/*$config['upload_path'] = 'public/img/logos/';
	    $config['allowed_types'] = 'gif|jpg|png|bmp|GIF|JPG|PNG|BMP';
	    $config['max_size'] = '100';
	    $config['max_width'] = '1024';
	    $config['max_height'] = '768';
	 
	    $this->load->library('upload', $config);
	    $subido = $this->upload->do_upload();*/

		$id_cooperativa      = $this->input->post('id_cooperativa');
		$obtener_cooperativa = $this->cooperativa_model->obtener_cooperativa($id_cooperativa);
		$logotipo            = $obtener_cooperativa['logotipo'];
		$error               = false;
		$msj                 = '';
		$max                 = 650000;
		$arc                 = $_FILES["file"]["name"];
		$size                = $_FILES["file"]["size"];
		$dirTemp             = $_FILES["file"]["tmp_name"];
		$extension           = '';
		$dirAct              = "public/img/logos/";
		$subido              = false;
		$existeArc           = $this->cooperativa_model->existeArc($dirAct.$arc);

   		if($arc){
			$archivo_array = explode('.', $arc);
			$count         = count($archivo_array);
			$extension     = $archivo_array[$count-1];
		} 

		if(!$arc){
			$error = true;
			$msj = "No ha seleccionado Ningun Arhivo.";
		}else if( !($extension=='png') && !($extension=='PNG') && !($extension=='jpg') && !($extension=='JPG') && !($extension=='bmp') && !($extension=='BMP') ){
			$error = true;
			$msj = "Solo se permiten extensiones *.png, *.jpg ó *.bmp";
		}else if( strpos( $arc, '(') || strpos( $arc, ')' ) ){
			$error = true;
			$msj = "El nombre del Archivo posee caractéres no validos, Puede solucionar esto renombrando el Archivo.";
		}else if(strpos($arc, ' ')){
			$error = true;
			$msj = "El nombre del Archivo no debe contener espacios en blanco.";
		}else if($size > $max){
			$error = true;
			$msj = "El tamaño del archivo sobrepase el maximo permitido.";
		}else if($existeArc){
			$error = true;
			$msj = "Ya existe un Archivo con ese Nombre.";
		}else{

			$subido = $this->cooperativa_model->subeArc($dirTemp, $dirAct, $arc);

			if($subido){

				$insertArc = $this->cooperativa_model->insertArc($id_cooperativa, $arc);
				if($insertArc){
					
					if($logotipo){/*Si ya tenia un logo anteriormente*/
						$existeArcAnterior = $this->cooperativa_model->existeArc('public/img/'.$logotipo);
						if($existeArcAnterior){
							$this->cooperativa_model->eliminarArc('public/img/'.$logotipo);
						}
					}
					
					$error = false;
					$msj = "El archivo ".$arc." fue subido.";
				
				}else{
					$error = true;
					$msj = "El archivo no pudo ser Guardado.";
				}
			
			}else{
				$error = true;
				$msj = "El archivo no pudo ser Subido, Contacte con el Administrador.";
			}

		}
		
		if($error){
			echo "<script>";
			echo "parent.document.getElementById('error').innerHTML = 'Error: ".$msj."';";
			echo "parent.document.getElementById('error').style.display = 'block';";
			echo "parent.document.getElementById('cerrar').style.display = 'block';";
			echo "parent.document.getElementById('ok').style.display = 'none';";
			echo "</script>";
		}else{
			echo "<script>";
			echo "parent.document.getElementById('ok').innerHTML = '".$msj."';";
			echo "parent.document.getElementById('ok').style.display = 'block';";
			echo "parent.document.getElementById('cerrar').style.display = 'block';";
			echo "parent.document.getElementById('error').style.display = 'none';";
			echo "parent.document.getElementById('subir').style.display = 'none';";
			echo "</script>";
		}

	}/* Fin de la Función do_upload.*/




}