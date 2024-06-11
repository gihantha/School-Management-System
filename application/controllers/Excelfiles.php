<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Excelfiles extends CI_Controller
{

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model("Usermodel");

		if ($this->session->userdata['loged_user'] == null || $this->session->userdata['loged_user'] == '') {
			redirect(base_url(Login));
		}
	}
	public function index()
	{
		$user_id = $this->session->userdata['loged_user']['user_id'];

		$data['useraccess'] = $this->Usermodel->user_access($user_id);

		
		
		$this->load->view('excelfiles', $data);
		

	}



	function upload_excel()
	{
		$file_info = pathinfo($_FILES['excelinput']['name']);
		$file_directory  = "uploads/excel/";

		$new_file_name = date("Y-m-d")."-".rand(00000,999999).".".$file_info["extension"];

		if(move_uploaded_file($_FILES['excelinput']['tmp_name'],$file_directory.$new_file_name)){
			 
			$this->load->library('Excel');

			$file_type = PHPExcel_IOFactory::identify($file_directory.$new_file_name);
			$objReader = PHPExcel_IOFactory::createReader($file_type);
			$objPHPExcel = $objReader->load($file_directory.$new_file_name);
			$sheet_data = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

			$sheet_data=array_slice($sheet_data,1);

			$message = array();

			if($sheet_data){

				foreach($sheet_data as $data){
					$i = 1;
					$colA = $data['A'];

					$colA = str_replace('S', 'X', $colA);
					

					if(is_numeric($colA)){


						$data = array(

							'cola' => $data['A'],
							'colb' => $data['B']
						);

						$this->db->insert('excel',$data);

						$message = array_merge($message,array($i=>(array("status"=>"success","message"=>"$colA"))));
					
						

						//$message = array("status" => "success", "message" => "Success!");

				

					
					}else{

						$message = array_merge($message,array($i=>(array("status"=>"error","message"=>"$colA"))));

					}
						$i++;

				}
				

			}


		} else {
			$message = array("status" => "error", "message" => "Error on Upload!");
		}

		echo json_encode($message); 
	}
}
