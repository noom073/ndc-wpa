 <?php 
 class Main_model extends CI_Model{
 	function __construct(){
 		$this->load->database();
 		
 	}
 	
 	public function get_course_dist(){
 		$this->db->select('DISTINCT(course_name) as course');
 		$this->db->order_by('course');
 		$result = $this->db->get('wpa_student');
		return $result;

 	}

 	public function get_student_normal($data){
 		$this->db->select("student_id,course_name,title,first_name,last_name,position_name,email,squad_name,row_id");
 		if ($data['course'] != ''){
 			$this->db->where("course_name",$data['course']);
 		}
 		if ($data['firstname'] != ''){
 			$this->db->like("first_name",$data['firstname']);
 		}
 		if ($data['lastname'] != ''){
 			$this->db->like("last_name",$data['lastname']);
 		}
 		if ($data['squad'] != ''){
 			$this->db->where("squad_name",$data['squad']);
 		}
 		$result = $this->db->get('wpa_student');
 		// echo $this->db->lastnamest_query();

 		return $result;
 	}
 	public function insert_log ($array){
 		$field['ip'] = $array['ip'];
 		$field['input_data'] = $array['input_data'];
 		$field['time_create'] = date("Y-m-d H:i:s");
		$result = $this->db->insert('wpa_log',$field);

 		return $result;
 	}

 }
 ?>