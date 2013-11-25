<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Respaldo_datos extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// Load the DB utility class
		$this->load->dbutil();
		
		
		$prefs = array(
                'ignore'      => array(),           // List of tables to omit from the backup
                'format'      => 'zip',             // gzip, zip, txt
                'filename'    => 'respaldo_datos_'.date('d_m_Y').'.sql',    // File name - NEEDED ONLY WITH ZIP FILES
                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
              );

		$this->dbutil->backup($prefs); 
		
		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup();
		
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('respaldo_datos_'.date('d_m_Y').'.zip', $backup);
		
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('respaldo_datos_'.date('d_m_Y').'.zip', $backup); 
		
		delete_file('respaldo_datos_'.date('d_m_Y').'.zip');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */