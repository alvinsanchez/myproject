<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  Class Admin_model extends CI_Model{

    public function getStudents(){
      $query = $this->db->get('students');
      if($query->num_rows() > 0){
        return $query->result();
      }
      else{
        return false;
      }
    }

    public function getModal(){
      $id = $this->input->get('id');
      $this->db->where('student_id', $id);
      $query = $this->db->get('students');
      if($query->num_rows() > 0){
        return $query->row();
      }
      else{
        return false;
      }
    }

    public function logind($username, $password){
      $this->db->where("username", $username);
      $this->db->where("password", $password);
      $result = $this->db->get('students');
      if($result->num_rows() > 0){
        return $result->row();
      }
      else{
        return false;
      }
    }

    public function getStudentInfo($student_code){
      $query = $this->db->query("SELECT student_no FROM student WHERE student_no LIKE '%$student_code%'");
      if($query->num_rows() > 0){
        foreach($query->result_array() as $row){
          $row_set[] = htmlentities(stripslashes($row['student_no']));
        }
        echo json_encode($row_set);
      }
    }

    public function getStudentFullInfo(){
      $stud_code = $this->input->post('student_code');
      $this->db->where("student_no", $stud_code);
      $query = $this->db->get('student');
      if($query->num_rows() > 0){
        return $query->row();
      }
    }

    public function getOrganization(){
      $accept = $this->input->get('accept');
      $this->db->where('status', $accept);
      $query = $this->db->get('tbl_group_info');
      if($query->num_rows() > 0){
        return $query->result();
      }
      else{
        return false;
      }
    }

    public function loginAttempt($data){
      $username = $data['username'];
      $password = md5($data['password']);
      $query = $this->db->query("SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'");
      if($query->num_rows() > 0){
        return $query->result();
      }
      else{
        return false;
      }
    }

    public function loadPendingOrgs(){
      $acceptNo = $this->input->get('statusNumber');
      $this->db->where('status', $acceptNo);
      $query = $this->db->get('tbl_group_info');
      if($query->num_rows() > 0){
        return $query->result();
      }
      else{
        return false;
      }
    }

    public function insertOrganization(){
      $data = array(
        'org_name' => $this->input->post('organization'),
        'purpose' => $this->input->post('purpose'),
        'date_created' => date('Y-m-d H:i:s'),
        'date_requested' => date('Y-m-d H:i:s'),
        'applicant' => $this->input->post('student_code'),
        'position' => $this->input->post('position'),
        'status' => "0",
        'group_id_key' => "ASDGDXDR",
        'description' => $this->input->post('description'),
        'department' => $this->input->post('department')
      );
      $this->db->insert('tbl_group_info', $data);
      return true;
    }

    public function acceptPendingOrgs(){
      $org_id = $this->input->post('org_id');
      $query = $this->db->query("UPDATE tbl_group_info set status='1' WHERE org_id='$org_id'");
      if($this->db->affected_rows() > 0){
        return true;
      }
    }

    public function ignorePendingOrgs(){
      $org_id = $this->input->post('org_id');
      $query = $this->db->query("UPDATE tbl_group_info set status='2' WHERE org_id='$org_id'");
      if($this->db->affected_rows() > 0){
        return true;
      }
    }

    public function groupInfo(){
      $org_id = $this->input->get('org_id');
      $this->db->where('org_id', $org_id);
      $query = $this->db->get('tbl_group_info');
      if($query->num_rows() > 0){
        return $query->row();
      }
      else{
        return false;
      }
    }

    public function updateOrg(){
      $orgId = $this->input->post('orgId');
      $orgName = $this->input->post('orgName');
      $selectDepartment = $this->input->post('selectDepartment');
      $textDescription = $this->input->post('textDescription');

      $query = $this->db->query("UPDATE tbl_group_info set org_name='$orgName', department='$selectDepartment', description='$textDescription' WHERE org_id='$orgId'");
      if($this->db->affected_rows() > 0){
        return true;
      }
    }

    public function getDeleteInfo(){
      $org_id = $this->input->post('org_id');
      $this->db->where('org_id', $org_id);
      $query = $this->db->get('tbl_group_info');
      if($query->num_rows() > 0){
        return $query->row();
      }
      else{
        return false;
      }
    }

    public function deleteOrg(){
      $orgID = $this->input->post('orgID');
      $query = $this->db->query("DELETE FROM tbl_group_info WHERE org_id='$orgID'");
      if($this->db->affected_rows() > 0){
        return true;
      }
    }
  }
?>
