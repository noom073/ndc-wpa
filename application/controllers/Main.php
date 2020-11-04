<?php
	class Main extends CI_Controller{
		function __construct(){
			parent ::__construct();
			$this->load->helper('url');


		}
		public function index(){
			$this->load->model('main_model');
			$data['course']=$this->main_model->get_course_dist()->result_array();
			$this->load->view('basic_view/header',$data);
			$this->load->view('main_view/main_index',$data);
			$this->load->view('basic_view/footer',$data);
			

		}
		public function ajax_get_student_normal(){
			$this->load->model('main_model');
			$data['course'] = $this->input->post('course');
			$data['firstname'] = $this->input->post('firstname');	
			$data['lastname'] = $this->input->post('lastname');	
			$data['squad'] = $this->input->post('squad');
			$result = $this->main_model->get_student_normal($data)->result_array();
			echo json_encode($result);

		}
			
	}



?>