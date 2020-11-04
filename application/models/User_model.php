<?php
    class user_model extends CI_Model{
        function __construct()
        {
            parent::__construct();
            $this->load->database();
        }
        public function get_course_dist(){
            $this->db->select('DISTINCT(course_name) as course');
            $this->db->order_by('course');
            $result = $this->db->get('wpa_student');
           return $result;
   
        }
        public function get_user_detail($id)
        {
            $this->db->where("row_id",$id);
            $result = $this->db->get('wpa_student');

            return $result;
        }
        public function get_userid($token)
        {
            $this->db->select("id_user,token");
            $this->db->where("token",$token);
            $result=$this->db->get("wpa_token");
            
            return $result;
        }
        public function update_password($array)
        {
            $field['password'] = $array['password'];
            $this->db->where("row_id",$array['id']);
            $result=$this->db->update('wpa_user',$field);

        return $result;

        }
    }
?>