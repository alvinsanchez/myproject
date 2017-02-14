<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  Class Admin extends CI_Controller{
    function __construct(){
      parent:: __construct();
    }

    function index(){
      $this->load->view('admin/header');
      $this->load->view('admin/login');
      $this->load->view('admin/footer');
    }

    function dashboard(){
      if(!isset($this->session->userdata['logged_in'])){
        redirect('admin/Admin/index','refresh');
      }
      else{
        $this->load->view('admin/header');
        $this->load->view('admin/side-bar');
        $this->load->view('admin/index');
        $this->load->view('admin/footer');
      }
    }

    public function manageStudentsLink(){
      if(!isset($this->session->userdata['logged_in'])){
        redirect('admin/Admin/index','refresh');
      }
      else{
        $this->load->view('admin/header');
        $this->load->view('admin/side-bar');
        $this->load->view('admin/manage-students');
        $this->load->view('admin/footer');
      }
    }

    public function college(){
      if(!isset($this->session->userdata['logged_in'])){
      	redirect('admin/Admin/index','refresh');
      }
      else{

      $this->load->view('admin/header');
      $this->load->view('admin/college-side-bar');
      $this->load->view('admin/college');
      $this->load->view('admin/footer');
      }
    }

    public function getStudents(){
        $result = $this->Admin_model->getStudents();
        echo json_encode($result);
    }

    public function getModal(){
      $result = $this->Admin_model->getModal();
      echo json_encode($result);
    }

    public function login(){
        $val = 0;
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username','Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password','Password','trim|required|xss_clean');

        if($this->form_validation->run() == FALSE){
          echo validation_errors();
          redirect('admin/Admin/index', 'refresh');
        }
        else{
          $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
          );

          $result = $this->Admin_model->loginAttempt($data);
            if($result == true){
              $session_data = array(
                'username' => $result[0]->admin_id
              );

              $this->session->set_userdata('logged_in', $session_data);
              $val = 1;
              echo json_encode($val);
            }
            else{
              echo "Wrong username or password. Try Again!";
            }
          }
        }

    public function getStudentInfo(){
      $student_code = strtolower($this->input->post("student_code"));
      if(isset($student_code)){
        $this->Admin_model->getStudentInfo($student_code);
      }
    }

    public function getStudentFullInfo(){
      $result = $this->Admin_model->getStudentFullInfo();
      echo json_encode($result);
    }

    public function getOrganization(){
      $result = $this->Admin_model->getOrganization();
      echo json_encode($result);
    }

    public function logout() {
      $sess_array = array(
        'username' => ''
      );
      $this->session->unset_userdata('logged_in', $sess_array);
      redirect('admin/Admin/index', 'refresh');
    }

    public function loadPendingOrgs(){
      $result = $this->Admin_model->loadPendingOrgs();
      echo json_encode($result);
    }

    public function insertOrganization(){
      $val = 0;
      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');

      $this->form_validation->set_rules('organization','Organization', 'trim|required');
      $this->form_validation->set_rules('purpose','Purpose','trim|required');
      $this->form_validation->set_rules('student_code','Student Code','trim|required');
      $this->form_validation->set_rules('description','Description','trim|required');

      if($this->form_validation->run() == FALSE){
        $result = validation_errors();
        echo json_encode($result);
      }
      else{
        $result = $this->Admin_model->insertOrganization();
        echo json_encode($result);
        $val = 1;
      }
    }

    public function acceptPendingOrgs(){
      $result = $this->Admin_model->acceptPendingOrgs();
      echo json_encode($result);
    }

    public function ignorePendingOrgs(){
      $result = $this->Admin_model->ignorePendingOrgs();
      echo json_encode($result);
    }

    public function groupInfo(){
      $result = $this->Admin_model->groupInfo();
      echo json_encode($result);
    }

    public function updateOrg(){
      $result = $this->Admin_model->updateOrg();
      echo json_encode($result);
    }

    public function getDeleteInfo(){
      $result = $this->Admin_model->getDeleteInfo();
      echo json_encode($result);
    }

    public function deleteOrg(){
      $result = $this->Admin_model->deleteOrg();
      echo json_encode($result);
    }
  }

?>
