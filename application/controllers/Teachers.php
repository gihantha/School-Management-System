<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teachers extends CI_Controller {

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

		$data['teachers'] = $this->Usermodel->get_all_teachers();

		$acc = $this->Usermodel->user_access($user_id);
		
		$teacher='0';

		foreach($acc as $row):

			$teacher=$row->teacher;
		
		endforeach;

		if($teacher== 1){
			$this->load->view('teachers',$data);
		} else {
			$this->load->view('dashboard',$data);

		}

		
	}

	function teacher_add()
	{
		$user_id = $this->session->userdata['loged_user']['user_id'];

		$data['useraccess'] = $this->Usermodel->user_access($user_id);

		$this->load->view('teacher_add',$data);
	}

	function add_new_teacher()
	{
		$name = $this->input->post('name');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$address = $this->input->post('address');

		$this->db->trans_start();

			$teacher = array(
				'name' => $name,
				'phone' => $phone,
				'email' => $email,
				'address' => $address
			);
			
			$this->db->insert('teachers', $teacher);

		$this->db->trans_complete();

		if ($this->db->trans_status() == False) {
			$message = array("status" => "error", "message" => "Error");
		} else {
			$message = array("status" => "success", "message" => "Success!");
		}

		echo json_encode($message); 
	}

}
