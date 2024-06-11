<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
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
	}
	public function index()
	{
		$this->load->view('register');
	}

	function register_user()
	{
		try {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			// var_dump($username, $password);

			if (empty($username) || empty($password)) {
				$message = array("status" => "error", "message" => "Username and Password are required");
				echo json_encode($message);
				return;
			}

			$existing_user = $this->Usermodel->get_user($username);
			// var_dump($existing_user);
			if ($existing_user) {
				$message = array("status" => "error", "message" => "Username already exists");
				echo json_encode($message);
				return;
			}

			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			
			$data = array(
				'user_name' => $username,
				'password' => $hashed_password
			);
			$this->db->insert('users', $data);

			$message = array("status" => "success", "message" => "User registered successfully");
			echo json_encode($message);
		} catch (Exception $e) {
			$message = array("status" => "error", "message" => $e->getMessage());
			echo json_encode($message);
		}
	}
}
