<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_MODEL {

    function check_login($email)
    {
        $where = "email='".$email."' AND status='on'";
        $query = $this->db->select('*');
        $query = $this->db->from('tbl_employee');
        $query = $this->db->where($where);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        { 
            return $query->row(); 
        }
        else
        {
            return false;
        }
    }

    function department_head($user_id)
    {
        $query = $this->db->select('*');
        $query = $this->db->from('tbl_department department');
        $query = $this->db->join('tbl_employee emplyoee', 'emplyoee.id = department.user_id');
        $query = $this->db->where('department.user_id', $user_id);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        { 
            return $query->row(); 
        }
        else
        {
            return false;
        }
    }

    function get_department_details($department_id)
    {
        $query = $this->db->select('*');
        $query = $this->db->from('tbl_department department');
        $query = $this->db->join('tbl_employee emplyoee', 'emplyoee.id = department.user_id');
        $query = $this->db->where('department.id', $department_id);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        { 
            return $query->row(); 
        }
        else
        {
            return false;
        }
    }

    function get_all_timesheet($user_id)
    {
        $query = $this->db->select('*');
        $query = $this->db->from('tbl_timesheet timesheet');
        $query = $this->db->where('timesheet.user_id', $user_id);
        $query = $this->db->order_by("datecreated", "desc"); 
        $query = $this->db->get();

        if($query->num_rows() > 0)
        { 
            return $query->result(); 
        }
        else
        {
            return false;
        }
    }

    function insert_timesheet($time_status)
    {
        $user_id = $this->session->userdata('user_id');

        if($time_status == "time_in"){

            $time_in = date("h:ia");
            $data = array(
               'user_id' => $user_id,
               'time_in' => $time_in,
               'time_out' => '',
               'datecreated' => date("Y-m-d")
           );

            $this->db->insert('tbl_timesheet', $data); 
            return 'time_in';

        }else{

            if($time_status == "time_out"){
                $time_out = date("h:ia");

                $data = array(
                 'time_out' => $time_out
                );

                $this->db->where('datecreated', date("Y-m-d"));
                $this->db->where('user_id', $user_id);
                $this->db->update('tbl_timesheet', $data);
                return 'time_out';
            }   
        }
    }

}

?>