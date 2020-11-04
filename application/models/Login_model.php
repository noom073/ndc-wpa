 <?php 
 class Login_model extends CI_Model{
 	function __construct(){
 		$this->load->database();
 		
 	}
 	
 	public function get_user($array){
 		$this->db->where('username',$array['username']);
 		$this->db->where('password',$array['password']);
 		$this->db->where('active','y');
 		$result = $this->db->get('wpa_user');
		return $result;

 	}
 	public function insert_token ($array){
 		$field['id_user'] 		= $array['id_user'];
 		$field['type_user']		= $array['type'];
 		$field['token'] 		= $array['token'];
 		$field['time_create'] 	= date("Y-m-d H:i:s");
 		$field['active'] 		= 'y';
 		$result = $this->db->insert('wpa_token',$field);

 		return $result;

	}
	public function insert_register($array)
	{
		$field['title'] 		= $array['title'];
		$field['course_name'] 	= $array['course_name'];
		$field['first_name'] 	= $array['first_name'];
		$field['last_name'] 	= $array['last_name'];
		$field['username'] 		= $array['username'];
		$field['password'] 		= $array['password'];
		$field['student_id'] 	= $array['student_id'];
		$field['tel_num'] 	= $array['tel_num'];
		$field['active'] 		= 'n';
		$field['type'] 			= 'normal';
		$field['time_create'] 	= date("Y-m-d H:i:s");

		$result = $this->db->insert('wpa_user',$field);

		return $result;
	}
	public function check_dup_username($array)
	{
		$this->db->where('username',$array['username']);
		$result = $this->db->get('wpa_user');

		return $result;
	}
	public function get_course_dist(){
		$this->db->select('DISTINCT(course_name) as course');
		$this->db->order_by('course');
		$result = $this->db->get('wpa_student');
	   return $result;

	}
 	
 }



 ?>