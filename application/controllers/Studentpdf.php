<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Studentpdf extends CI_Controller {

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
		$this->load->add_package_path(APPPATH . 'third_party/fpdf');
		$this->load->library('pdf');

		$pdf = new PDF('L', 'mm');

		$pdf->SetFont('Arial', 'B', 10);


		

		$result = $this->Usermodel->all_students_pdf();

		foreach($result as $row):

		$stname = $row->name;
		$stphone = $row->phone;
		$staddress = $row->address;


		$pdf->AddPage('L', array(80,200));

		$pdf->Cell(14, 0, $pdf->Image("assets/img/pdflogo.png",100,5,25 ));

		$pdf->Ln();

		$pdf->Cell(30, 10,'Student Name :', 0, 0, false);
		$pdf->Cell(8, 10,$stname, 0, 0, false);

		$pdf->Ln();

		$pdf->Cell(30, 12,'Student Phone :', 0, 0, false);
		$pdf->Cell(8, 12,$stphone, 0, 0, false);

		$pdf->Ln();

		$pdf->Cell(35, 14,'Student Address :', 0, 0, false);
		$pdf->Cell(8, 14,$staddress, 0, 0, false);

		

		endforeach;

		$pdf->output();
	}
}
