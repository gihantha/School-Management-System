<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
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
		$acc = $this->Usermodel->user_access($user_id);
		
		$settings='0';
		$user_excel_download = '0';

		foreach($acc as $row):

			$settings=$row->settings;
			$user_excel_download=$row->user_excel_download;

		endforeach;

		$data['user_excel_download'] = $user_excel_download;

		if($settings ==1){
			$this->load->view('user', $data);

		}else{
			$this->load->view('dashboard', $data);

		}

	}

	function user_add()
	{
		$user_id = $this->session->userdata['loged_user']['user_id'];

		$data['useraccess'] = $this->Usermodel->user_access($user_id);

		$this->load->view('user_add', $data);
	}
	function user_profile()
	{
		$user_id = $this->session->userdata['loged_user']['user_id'];

		$result = $this->Usermodel->get_user_profile($user_id);

		$data['profiledata'] = $result;

		$this->load->view('user_profile', $data);
	}

	function updateprofile()
	{

		$user_id = $this->session->userdata['loged_user']['user_id'];

		$phone = $this->input->post('phone');
		$address = $this->input->post('address');

		$this->db->trans_start();

		$userdata = array(
			'phone' => $phone,
			'address' => $address
		);

		$this->db->where('user_id', $user_id);
		$this->db->update('users', $userdata);

		$this->db->trans_complete();

		if ($this->db->trans_status() == False) {
			$message = array("status" => "error", "message" => "Error");
		} else {
			$message = array("status" => "success", "message" => "Profile Updated");
		}




		echo json_encode($message);
	}

	function read_profile()
	{

		$user_id = $this->session->userdata['loged_user']['user_id'];

		$result = $this->Usermodel->get_user_profile_from_aj($user_id);

		echo  json_encode($result);
	}

	function changepass()
	{

		$oldpass = $this->input->post('oldpass');
		$newpass = $this->input->post('newpass');

		$user_id = $this->session->userdata['loged_user']['user_id'];

		$result = $this->Usermodel->get_user_password($user_id);

		foreach ($result as $row) :

			$pass = $row->password;

		endforeach;

		if (password_verify($oldpass, $pass)) {

			$passencrypted = password_hash(trim($newpass), PASSWORD_DEFAULT);

			$userdata = array(
				'password' => $passencrypted
			);

			$this->db->where('user_id', $user_id);
			$this->db->update('users', $userdata);

			$message = array("status" => "success", "message" => "Password Updated $pass");
		} else {
			$message = array("status" => "error", "message" => "Invalid old Password $pass ");
		}



		echo json_encode($message);
	}

	function get_all_users()
	{

		$search = $this->input->post('search');
		$limit = $this->input->post('limit');
		$offset = $this->input->post('offset');

		$result = $this->Usermodel->get_all_users($search, $limit, $offset);

		echo  json_encode($result);
	}

	function download_all_users()
	{

		$myexcel = $this->Usermodel->get_all_users_for_excel();

		$colHeader = "User ID" . "\t" .
			"Name" . "\t" .
			"User Name" . "\t" .
			"Phone Number" . "\t" .
			"Email" . "\t" .
			"Address";

		$value = '';
		foreach ($myexcel as $rowdata) :

			$value .=
				'"' . $rowdata->user_id . '"' . "\t" .
				'"' . $rowdata->name . '"' . "\t" .
				'"' . $rowdata->user_name . '"' . "\t" .
				'"' . $rowdata->phone . '"' . "\t" .
				'"' . $rowdata->email . '"' . "\t" .
				'"' . $rowdata->address . '"' . "\n";

		endforeach;

		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=all_users.xls");

		echo ucwords($colHeader) . "\n" . $value . "\n";
	}

	function add_new_user()
	
	{

		$name = $this->input->post('name');
		$username = $this->input->post('username');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$address = $this->input->post('address');
		$passencrypted = password_hash(trim($username), PASSWORD_DEFAULT);

		$result = $this->Usermodel->get_user($username);

		if (!$result) {

			$this->db->trans_start();

			$users = array(
				'name' => $name,
				'user_name' => $username,
				'password' => $passencrypted,
				'phone' => $phone,
				'email' => $email,
				'address' => $address
			);

			$this->db->insert('users', $users);
			$userID = $this->db->insert_id();

			$usersacc = array(
				'user_id' => $userID
				
			);

			$this->db->insert('user_access', $usersacc);

			$this->db->trans_complete();

			if ($this->db->trans_status() == False) {
				$message = array("status" => "error", "message" => "Error");
			} else {
				$message = array("status" => "success", "message" => "Success!");
			}

			echo json_encode($message);
		} else {

			$message = array("status" => "error", "message" => "User Name Already Exists...");
		
		}
	}
}
