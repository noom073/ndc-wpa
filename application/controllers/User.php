<?php
    class User extends CI_Controller{
        function __construct(){
            parent:: __construct();
            $this->load->helper('url');
            $this->load->library('session');
			$this->load->library('check_token');
			$active = $this->check_token->check_token_active();
        }
        public function index()
        {
            $this->load->model('user_model');
            $data['course'] = $this->user_model->get_course_dist()->result_array();
            $this->load->view('basic_view/header');
            $this->load->view('user_view/user_menu');
            $this->load->view('user_view/user_index',$data);
            $this->load->view('user_view/user_footer');
        }
        public function ajax_get_student_detail()
        {
            $this->load->model('user_model');
            $id = $this->input->post('student_id');
            $detail = $this->user_model->get_user_detail($id)->row_array();
            echo json_encode($detail);
        }
        public function change_password()
		{
			$this->load->view("basic_view/header");
			$this->load->view("user_view/user_change_password");
			$this->load->view("basic_view/user_footer");
			
		}
		public function ajax_change_password()
		{
            $this->load->model("user_model");
            $token=$this->session->token;
            $user_id=$this->user_model->get_userid($token)->row_array();

            $password=$this->input->post('password');

        
			$data['id'] = $user_id['id_user'];
			$data['password'] = hash('sha384',$password);
			$update = $this->user_model->update_password($data);
			if ($update) {
				$result['status'] = true;
				$result['text'] = 'เปลี่ยนรหัสผ่านเรียบร้อย';
			} else {
				$result['status'] = false;
				$result['text'] = 'เปลี่ยนรหัสผ่านไม่สำเร็จ';
			}
			
			echo json_encode($result);
        }
    }


?>