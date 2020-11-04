<?php

    class Check_token {
        protected $CI;
        public function __construct(){
            $this->CI =& get_instance();

            $this->CI->load->database();
            $this->CI->load->library('session');
        }

        public function check_token_active(){

            $session = $this->CI->session->token;
            $this->CI->db->where("token", $session);
            $this->CI->db->where("active",'y');
            $result = $this->CI->db->get("wpa_token")->row_array();
            $timecurrent = time();
            $tokentime = strtotime($result['time_create']);
            if ($timecurrent-$tokentime>3600) {
                redirect('login_wpa'); 
            } else {
                return true;
            }
        }

        public function check_admin_type(){

            $session = $this->CI->session->token;
            $this->CI->db->where("token", $session);
            $this->CI->db->where("active",'y');
            $this->CI->db->where("type_user",'admin');
            $result = $this->CI->db->get("wpa_token")->num_rows();
            if ($result == 1) {
                return true;
            } else {
                redirect('login_wpa'); 
            }
           


        }
    }



?>