<?php  
	
	class Login_wpa extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->helper('url');
			$this->load->library('session');
		}
		function index(){
			$this->load->model('login_model');
			$data['course'] = $this->login_model->get_course_dist()->result_array();
			$this->load->view('basic_view/header');
			$this->load->view('login_view/login_index',$data);
		}
		function ajax_login_process(){
			$this->load->model('login_model');
			$this->load->model('main_model');

			$input['name'] = $this->input->post('name');
			$input['password'] = $this->input->post('password');

			$log['ip'] = $this->input->ip_address();
			$log['input_data'] = json_encode($input);
			$this->main_model->insert_log($log);

			$data['username'] = $input['name'];
			$data['password'] = hash('sha384',$input['password']);
			$result = $this->login_model->get_user($data)->num_rows();
			
			if ($result==1) {
				$user = $this->login_model->get_user($data)->row_array();
				$session_data['type'] = $user['type'];
				$session_data['id_user'] = $user['row_id'];
				$session_data['token'] = hash('sha384',time());

				$insert_token = $this->login_model->insert_token($session_data);
				if ($insert_token) {
					$this->session->set_userdata('token', $session_data['token']);
					$res['status']	= true;
					$res['type']	= $session_data['type'];
					$res['text']	= 'เข้าสู่ระบบสำเร็จ';
				} else {
					$res['status']= false;
					$res['text']= 'เข้าสู่ระบบไม่สำเร็จ ไม่สามารถบันทึกข้อมูลได้';
				}
				
			} else {
				$res['status']= false;
				$res['text']= 'เข้าสู่ระบบไม่สำเร็จ';
			}
			
			echo json_encode($res);
		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect(site_url('login_wpa'));
		}
		public function ajax_register_process()
		{
			$secret = '6LdFrMEUAAAAAAfWgJsEcf6CMVVHUK4pvjYv82si';
			$response = $this->input->post('g-recaptcha-response');
			$ip = $this->input->ip_address();
			$url= "https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}&remoteip={$ip}";
			$googledata = json_decode(file_get_contents($url),true);

			if($googledata['success']) {
				$this->load->model('login_model');
				$data['title']			= $this->input->post('title');
				$data['first_name']		= $this->input->post('first_name');
				$data['last_name']		= $this->input->post('last_name');
				$data['course_name']	= $this->input->post('course');
				$data['username']		= $this->input->post('user');
				$data['student_id']		= $this->input->post('student_id');
				$data['tel_num']		= $this->input->post('tel_num');
				$data['password']		= hash('sha384',$this->input->post('password'));
	
				$check_username = $this->login_model->check_dup_username($data)->num_rows();
				if ($check_username == 0) {
					$insert = $this->login_model->insert_register($data);
					if ($insert) {
						$result['status'] = true;
						$result['text'] = 'บันทึกเรียบร้อย';
					} else {
						$result['status'] = false;
						$result['text'] = 'บันทึกข้อมูลไม่สำเร็จ';
					}
				} else {
					$result['status'] = false;
					$result['text'] = 'มีรหัสผู้ใช้นี้แล้ว';
				}
			} else {
				$result['status'] = false;
				$result['text'] = $googledata['error-codes'];
			}
			
			
			
			
			echo json_encode($result);
			
		}

	}



?>