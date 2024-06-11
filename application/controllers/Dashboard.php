<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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



		if ($this->session->userdata['loged_user']==null || $this->session->userdata['loged_user'] == ''){
			
			redirect(base_url(Login));
		
		}
	 }
	 
	public function index()
	{
		$user_id = $this->session->userdata['loged_user']['user_id'];

		$data['useraccess'] = $this->Usermodel->user_access($user_id);

		$this->load->view('dashboard',$data);
	}
}
