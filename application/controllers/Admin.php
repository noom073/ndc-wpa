<?php

	class Admin extends CI_Controller
	{
		
		function __construct() {
			parent:: __construct();
			$this->load->helper('url');
			$this->load->library('session');
			$this->load->library('check_token');
			$active = $this->check_token->check_token_active();
			if($active) {
				$this->check_token->check_admin_type();
			}
		}

		public function index() {
			$this->load->model('admin_model');
			$data['course'] = $this->admin_model->get_course_dist()->result_array();
			$this->load->view("basic_view/admin_header");
			$this->load->view("admin_view/admin_menu");
			$this->load->view("admin_view/admin_index",$data);
			$this->load->view("basic_view/admin_footer");
		}
		public function ajax_get_student_detail(){
			$this->load->model('admin_model');
			$student_id = $this->input->post('student_id');
			$result = $this->admin_model->get_student_detail($student_id)->row_array();
			echo json_encode($result);

		}
		public function ajax_update_student(){
			$this->load->model('admin_model');
			$data = $this->input->post();
			$update = $this->admin_model->update_student($data);
			if ($update) {
				$result['status'] = true;
				$result['text'] = 'บันทึกข้อมูลเรียบร้อย';
			} else {
				$result['status'] = false;
				$result['text'] = 'บันทึกข้อมูลไม่ได้';
				
			}
			echo json_encode($result);
		}
		public function ajax_delete_student()
		{
			$this->load->model('admin_model');
			$row_id = $this->input->post('row_id');
			$delete = $this->admin_model->delete_student($row_id);
			if ($delete) {
				$result['status'] = true;
				$result['text'] = 'ลบข้อมูลเรียบร้อย';
			} else {
				$result['status'] = false;
				$result['text'] = 'ลบข้อมูลไม่สำเร็จ';
			}
			


			echo json_encode($result);
		}
		public function ajax_uploadfile()
		{
			$this->load->model('admin_model');
			$config['upload_path'] 		= './assets/uploadfile';
			$config['allowed_types'] 	= 'xls|xlsx';
			$config['max_size']     	= '25000';
			$config['file_name']     	= md5(uniqid(rand(), true));

			$this->load->library('upload');
			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('file')){
				$result['status'] = false;
				$result['text'] =  $this->upload->display_errors();
			} else {
				$data = array('upload_data' => $this->upload->data());
			}

			if ($data['upload_data']) {
				$inputFileName = $data['upload_data']['file_path'].'/'.$data['upload_data']['file_name'];				
				$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
				$xls_data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
				array_shift($xls_data);
				foreach ($xls_data as $r) {
					$num = $this->admin_model->dup_student($r)->num_rows();
					if ($num == 0) {
						$insert = $this->admin_model->insert_students($r);
						if ($insert) {
							$std['id'] = $r['B']; 
							$std['name'] = "{$r['D']} {$r['E']}  {$r['F']}"; 
							$result['pass_student'][] = $std;
							
						} else {
							$std['id'] = $r['B']; 
							$std['name'] = "{$r['D']} {$r['E']}  {$r['F']}"; 
							$result['err_student'][] = $std;
						}			
						
					} else {
						$std['id'] = $r['B']; 
						$std['name'] = "{$r['D']} {$r['E']}  {$r['F']}"; 
						$result['dup_student'][] = $std;
					}				
				
				}

				$result['status'] 	= true;
				$result['text'] 	= "อัพโหลดข้อมูลเรียบร้อย";
				unlink($inputFileName);
			} 
			
			echo json_encode($result);
		}

		public function ajax_list_user()
		{
			$this->load->model('admin_model');
			$users = $this->admin_model->get_users()->result_array();
			
			echo json_encode($users);
		}
		public function list_user()
		{
			$this->load->view("basic_view/admin_header");
			$this->load->view("admin_view/admin_menu");
			$this->load->view("admin_view/admin_list_user");
			$this->load->view("basic_view/admin_footer");
		}
		public function ajax_get_oneuser()
		{
			$this->load->model('admin_model');
			$id = $this->input->post('user_id');
			$user = $this->admin_model->get_oneuser($id)->row_array();
			
			echo json_encode($user);
		}
		public function ajax_update_user()
		{
			$this->load->model('admin_model');
			$data = $this->input->post();
			$update = $this->admin_model->update_user($data);

			if ($update) {
				$result['status'] = true;
				$result['text'] = 'บันทึกสำเร็จ';
			} else {
				$result['status'] = false;
				$result['text'] = 'บันทึกไม่สำเร็จ';
			}
			
			echo json_encode($result);
			 
		}
		public function ajax_delete_user()
		{
			$this->load->model('admin_model');
			$id = $this->input->post('row_id');
			$delete = $this->admin_model->delete_user($id);
			if ($delete) {
				$result['status'] = true;	
				$result['text'] = 'ลบข้อมูลเรียบร้อย';		
			} else {
				$result['status'] = false;	
				$result['text'] = 'ลบข้อมูลไม่สำเร็จ';	
			}
			
			echo json_encode($result);
		}
		public function change_password()
		{
			$this->load->view("basic_view/admin_header");
			$this->load->view("admin_view/admin_menu");
			$this->load->view("admin_view/admin_change_password");
			$this->load->view("basic_view/admin_footer");
		}
		public function ajax_change_password()
		{
			$this->load->model('admin_model');
			$data['id'] = $this->input->post('id');
			$data['password'] = hash('sha384',$this->input->post('password'));
			$update = $this->admin_model->update_password($data);
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