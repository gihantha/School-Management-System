<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->load->view('login');
	}
	function forgot_password()
	{
		$this->load->view('forgot_password');
	}
	function reset_password()
	{
		$this->load->view('reset_password');
	}

	//function login_attempt()
	// {
	// 	try {
	// 		  $username = $this->input->post('username');
	// 		$password = $this->input->post('password');
		 
		   
	// 		$result = $this->Usermodel->get_user($username);
	
	// 		if ($result) {          
	// 			$user = $result[0]->user_name; // Accessing the first (and only) result
	// 			$hashed_password = $result[0]->password;
			 
	// 			if (password_verify($password, $hashed_password)) {
	// 				$message = array("status" => "success", "message" => "Success");
				   
	// 				$this->load->view('dashboard', $message);
	// 			} else {
	// 				$message = array("status" => "error", "message" => "User Name or Password Invalid");
				 
	// 				echo json_encode($message);
	// 			}
	// 		} else {
	// 			$message = array("status" => "error", "message" => "User Name or Password Invalid");
			   
	// 			echo json_encode($message);
	// 		}
	// 	} catch (Exception $e) {      
	// 		$message = array("status" => "error", "message" => $e->getMessage());      
	// 		echo json_encode($message);
	// 	}
		
	// }
	function login_attempt()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user='';
		$pass='';
		$userid=''; 

		$result =$this->Usermodel->get_user($username);
		
		foreach($result as $row):

			$user=$row->user_name;
			$pass=$row->password;
			$userid=$row->user_id;
			
			
		endforeach;

		if( $username == $user && password_verify($password,$pass)){
			$login_data =array(
							'user_id'=>$userid,
							'user_name'=>$user
							);

			$this->session->set_userdata('loged_user',$login_data);
			$message = array("status" => "success", "message" =>"http://localhost/myweb/dashboard");
		}else{
			$message = array("status" => "error", "message" =>"User Name or Password Invalid");
		}


		echo json_encode($message);

	}

	function userlogout(){
		if ($this->session->userdata['loged_user']!=null || $this->session->userdata['loged_user'] != ''){
			$login_data =array(
				'user_id'=>'',
				'user_name'=>''
				);

				$this->session->unset_userdata($login_data);
				$this->session->sess_destroy();

				redirect(base_url('Login'));
		}
	}
	
}
