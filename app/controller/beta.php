<?php


class beta extends Controller
{
	
	public function index()
	{
		
		$this->load->view('themes/beta/header.php');
				
		$this->load->view('themes/beta/index.php');

	}
	public function history()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/about.php');
	}
	
	public function mission_and_vision()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/about2.php');
	}
	
	public function board_of_trustees()
	
	{

		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/about3.php');
	}
	
     public function clients_served()
	
	{
		
		$this->load->view('themes/beta/header.php');		
		
		$this->load->view('themes/beta/about4.php');
	}
	
	public function about_beta()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/about5.php');
	}
	
	public function message_from_chairman()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/about6.php');
	}

	public function message_from_ceo()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/about7.php');
	}
	
	public function basic_english_course()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/courses.php');
	}

	public function professional_jewelry_designing_program()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/courses2.php');
	}

	public function graphology_first_level()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/courses.php');
	}

	public function graphology_second_level()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/courses3.php');
	}

	public function fundamentals_of_media()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/courses4.php');
	}

	public function performance_excellence()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/courses5.php');
	}

	public function drawing_analysis()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/courses6.php');
	}

	public function auto_cad()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/courses7.php');
	}


	public function business_administration()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/diplomas.php');
	}

	public function marketing()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/diplomas2.php');
	}

	public function information_management_system()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/diplomas3.php');
	}

	public function tracks()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/admission.php');
	}


	public function general_admission()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/admission2.php');
	}


	public function certificates_required()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/admission3.php');
	}


	public function bachelor_degree()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/admission4.php');
	}


	public function other_requirements()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/admission5.php');
	}
	

	public function contact()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/contact.php');
	}

	public function our_campus()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/campus.php');
	}
	
	
	public function on_campus()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/campus2.php');
	}
	public function campus_service()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/campus3.php');
	}
	public function near_campus()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/campus4.php');
	}
	
	public function gallery()
	
	{
		$this->load->view('themes/beta/header.php');		

		$this->load->view('themes/beta/gallery.php');
	}
	
	public function calender()
	
	{
		$data['script'] = "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js'></script>";
		
		$this->load->view('themes/beta/header.php',$data);		

		$this->load->view('themes/beta/calender.php');
	}
	public function virtual_hospital()
	
	{
		$data['script'] = "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js'></script>";
		
		$this->load->view('themes/beta/header.php',$data);		

		$this->load->view('themes/beta/virtual.php');
	}
	public function training()
	
	{
		$data['script'] = "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js'></script>";
		
		$this->load->view('themes/beta/header.php',$data);		

		$this->load->view('themes/beta/virtual2.php');
	}


	public function education()
	
	{
		$data['script'] = "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js'></script>";
		
		$this->load->view('themes/beta/header.php',$data);		

		$this->load->view('themes/beta/virtual3.php');
	}

	

}



?>