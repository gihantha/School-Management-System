<?php

class Usermodel extends CI_Model{


    
    function get_user($username){

        $this->db->select('user_id,user_name,password');
        $this->db->from('users');
        $this->db->where('user_name', $username);
        $query = $this->db->get();

        return $query->result();

    }

    function get_user_profile($user_id){
        $s = "SELECT users.user_name, users.phone, users.email, users.address FROM users WHERE users.user_id = '".$user_id."'";

        $query = $this->db->query($s);

        return $query->result();
    }

    function get_user_profile_from_aj($user_id){
        $s = "SELECT users.user_name, users.phone, users.email, users.address FROM users WHERE users.user_id = '".$user_id."'";

        $query = $this->db->query($s);

        $ret['profile'] = $query->result();

        return  $ret;
    }

    function get_user_password($user_id){
        $s = "SELECT users.password FROM users WHERE users.user_id ='".$user_id."'";

        $query = $this->db->query($s);

        return $query->result();
    }

    function get_all_teachers(){
        $s = "SELECT teachers.`name`, teachers.`phone`,teachers.email,teachers.address FROM `teachers`";

        $query = $this->db->query($s);

        return $query->result();
    }

    function get_all_users($search, $limit,$offset){
        $s = "SELECT users.user_id, users.name, users.user_name, users.phone, users.email, users.address FROM users WHERE users.name LIKE '%".$search."%' OR users.user_name  LIKE '%".$search."%' OR users.phone LIKE '%".$search."%' OR users.email LIKE '%".$search."%' OR users.address  LIKE '%".$search."%'" ;

        $query = $this->db->query($s."LIMIT $limit OFFSET $offset");

        $ret['all_users'] = $query->result();

        $query1 = $this->db->query($s);

        $ret['rowcount'] =$query1->num_rows();
        // $ret['rowcount'] =$query->num_rows();


        return $ret;
    }

    function all_students_count(){
        $s = "SELECT count(*) AS 'datacount' FROM students";

        $query = $this->db->query($s);

        return $query->result();
    }

    function all_students($limit, $start, $order, $dir){
        $s = "SELECT students.`name`, students.`phone`,students.email,students.address 
        FROM students  ORDER BY $order $dir LIMIT $limit OFFSET $start";

        $query = $this->db->query($s);

        return $query->result();
    }

    function search_students($search,$limit, $start,$order, $dir ){
        $s = "SELECT students.`name`, students.`phone`,students.email,students.address 
        FROM `students` 
        WHERE students.name  LIKE  '".$search."%' ORDER BY $order $dir LIMIT $limit OFFSET $start  ";

        $query = $this->db->query($s);

        return $query->result();
    }

    function students_filtered_count($search){
        $s = "SELECT count(*) AS 'datacount' FROM students
            WHERE students.name  LIKE  '".$search."%' ";

        $query = $this->db->query($s);

        return $query->result();
    }

    function get_all_users_for_excel(){

        $s = "SELECT users.user_id, users.name, users.user_name, users.phone, users.email, users.address FROM users " ;

        $query = $this->db->query($s);

        return $query->result(); 
    }

    function user_access($user_id){

        $s = "SELECT * FROM user_access WHERE user_access.user_id='".$user_id."'" ;

        $query = $this->db->query($s);

        return $query->result(); 

    }

    function all_students_pdf(){

        $s = "SELECT * FROM students " ;

        $query = $this->db->query($s);

        return $query->result(); 
    }
} 
