<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

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

		$acc = $this->Usermodel->user_access($user_id);

		$student = '0';
		foreach($acc as $row):

			$student=$row->student;
		
		endforeach;

		if($student== 1){
			$this->load->view('student', $data);
		} else {
			$this->load->view('dashboard',$data);

		}

		
	}

	function student_add()
	{
		$user_id = $this->session->userdata['loged_user']['user_id'];

		$data['useraccess'] = $this->Usermodel->user_access($user_id);

		$this->load->view('student_add',$data);
	}

	function add_new_student()
	{
		$name = $this->input->post('name');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$address = $this->input->post('address');

		$this->db->trans_start();

			$student = array(
				'name' => $name,
				'phone' => $phone,
				'email' => $email,
				'address' => $address
			);
			
			$this->db->insert('students', $student);

		$this->db->trans_complete();

		if ($this->db->trans_status() == False) {
			$message = array("status" => "error", "message" => "Error");
		} else {
			$message = array("status" => "success", "message" => "Success!");
		}

		echo json_encode($message); 
	}

	function get_all_students(){
		$columns = array(
			0=>'name',
			1=>'phone',
			2=>'email',
			3=>'address'
		);

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];

		$totalData = 0;
		$totalDatac = $this->Usermodel->all_students_count();

		foreach($totalDatac as $row):

			$totalData = $row -> datacount;

		endforeach;
		

		$totalFiltered = $totalData;

		if(empty($this->input->post('search')['value'])){

			$students = $this->Usermodel->all_students($limit, $start, $order, $dir );

		}else {
			$search = $this->input->post('search')['value'];

			$students =  $this->Usermodel->search_students($search, $limit, $start,$order, $dir );

			$totalFilteredc = 0;

			$totalFilteredc =  $this->Usermodel->students_filtered_count($search);

			foreach($totalFilteredc as $row):

				$totalFilteredc = $row -> datacount;
	
			endforeach;
            
		}

		$data = array();
		if(!empty($students)){

			$data = $students;
		}

		$student_data = array(
							"draw" =>intval($this->input->post("draw")),
							"recordTotal"=>intval($totalData),
							"recordsFiltered"=>intval($totalFiltered),
							"data"=>$data

		);

		echo json_encode($student_data);
	}
}
