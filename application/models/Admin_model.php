<?php
    class Admin_model extends CI_Model{
        function __construct(){
            $this->load->database();

        }

        public function get_course_dist(){
            $this->db->select('DISTINCT(course_name) as course');
            $this->db->order_by('course');
            $result = $this->db->get('wpa_student');
           return $result;
   
        }
        public function get_student_detail($id){
            $this->db->where("student_id",$id);
            $result = $this->db->get("wpa_student");
            return $result;
        }
        public function update_student($array){
            $field['title']             = $array['title'];
            $field['course_name']       = $array['course'];
            $field['spouse']            = $array['spouse'];
            $field['tel1']              = $array['tel1'];
            $field['work_tel']          = $array['tel2'];
            $field['mobile']            = $array['mobile'];
            $field['fax']               = $array['fax'];
            $field['email']             = $array['email'];
            $field['birth_day']         = $array['birthday'];
            $field['nick_name']         = $array['nickname'];
            $field['last_name']         = $array['lastname'];
            $field['first_name']        = $array['firstname'];
            $field['squad_name']        = $array['squad'];
            $field['address_province']  = $array['province'];
            $field['address1']          = $array['addr1'];
            $field['address2']          = $array['addr2'];
            $field['student_id']        = $array['student_id'];
            $field['position_name']     = $array['position'];
            $field['time_update']       = date("Y-m-d H:i:s");
            $this->db->where("row_id",$array['id']);
            $result = $this->db->update("wpa_student",$field);

            return $result;
        }

        public function delete_student($row_id)
        {
            $this->db->where("row_id",$row_id);
            $result = $this->db->delete('wpa_student');

            return $result;
        }
        public function insert_students($array)
        {
            $field['student_id']        = $array['B'];
            $field['course_name']       = $array['C'];
            $field['title']             = $array['D'];
            $field['first_name']        = $array['E'];
            $field['last_name']         = $array['F'];
            $field['position_name']     = $array['G'];
            $field['address1']          = $array['H'];
            $field['address2']          = $array['I'];
            $field['address_province']  = $array['J'];
            $field['tel1']              = $array['K'];
            $field['work_tel']          = $array['L'];
            $field['fax']               = $array['M'];
            $field['mobile']            = $array['N'];
            $field['email']             = $array['O'];
            $field['birth_day']         = $array['P'];
            $field['spouse']            = $array['Q'];
            $field['nick_name']         = $array['R'];
            $field['squad_name']        = $array['S'];
            $field['time_create']       = date("Y-m-d H:i:s");
            $result = $this->db->insert('wpa_student',$field);

            return $result;
        }
        public function dup_student($array)
        {
            $this->db->where("student_id", $array['B']);
            $result = $this->db->get('wpa_student');
            // echo $this->db->last_query();
            return $result;
        }
        public function get_users()
        {
            //$this->db->where("username != 'admin'");
            $result = $this->db->get('wpa_user');

            return $result;
        }
        public function get_oneuser($id)
        {
            $this->db->where("row_id",$id);
            $result = $this->db->get('wpa_user');

            return $result;
        }
        public function update_user($array)
        {
            $field['title']         = $array['title'];
            $field['first_name']    = $array['first_name'];
            $field['last_name']     = $array['last_name'];
            $field['course_name']   = $array['course_name'];
            $field['active']        = $array['active'];
            $field['student_id']        = $array['student_id'];
            $field['tel_num']        = $array['tel_num'];
            $field['type']          = $array['type'];
            $field['time_update']   = date("Y-m-d H:i:s");

            $this->db->where('row_id',$array['id']);
            $result = $this->db->update('wpa_user',$field);

            return $result;
        }
        public function delete_user($id)
        {
            $this->db->where('row_id',$id);
            $result = $this->db->delete('wpa_user');

            return $result;
        }
        public function update_password($array)
        {
            $field['password'] = $array['password'];
            $this->db->where("row_id",$array['id']);
            $result = $this->db->update('wpa_user',$field);

            return $result;

        }
    }

?>