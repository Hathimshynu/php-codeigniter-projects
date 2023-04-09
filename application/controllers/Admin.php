<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper(array('form', 'url'));
    $this->load->library(array('form_validation', 'email'));
    $this->form_validation->set_error_delimiters('<span style="color:red">', '</span>');
  }

  // -------------------------------------------------------------------------------------------------



  public function index()
  {

    if ($this->session->userdata('auser_type') == 'a') {

      redirect('admin/dashboard', 'refresh');
    } else {
      redirect('admin/signin', 'refresh');
    }
  }

  // -------------------------------------------------------------------------------------------------


  public function dashboard()
  {

    $this->load->view('admin/index');
  }


  // -------------------------------------------------------------------------------------------------


  // -------------------------------------------------------------------------------------------------

  public function signin()
  {
    $this->load->view('admin/signin');
  }

  // -------------------------------------------------------------------------------------------------

  public function signinn()
  {
    if (!empty($_POST)) {

      $username = $this->input->post('username');
      $pwd = $this->input->post('pwd');
      $result = $this->admin->signin($username, $pwd);


      if ($result != false) {
        $this->session->set_userdata('auser_id', $result['user_id']);
        $this->session->set_userdata('ausername', $result['username']);
        $this->session->set_userdata('auser_type', $result['user_type']);

        redirect('admin', 'refresh');
      } else {
        $result['error'] = 'Invalid signin';
        redirect('admin/signin', 'refresh');
      }
    } else {
      redirect('admin/signin', 'refresh');
    }
  }

  // -------------------------------------------------------------------------------------------------

  public function dataview()
  {
    if ($this->session->userdata('auser_type') != "a")
      redirect('admin', 'refresh');
    $data['flatdata'] = $this->db->where('user_type !=', 'a')->get('flat')->result_array();
    $this->load->view('admin/dataview', $data);
  }

  // -------------------------------------------------------------------------------------------------


  public function userprofile($user_id = '')
  {
    if ($this->session->userdata('user_type') != "a")
      redirect('admin', 'refresh');
    $data['aa'] = $this->db->where('user_id', $this->session->userdata('user_id'))->get('flat')->row_array();

    $this->load->view('admin/userprofile', $data);
  }

  // ------------------------------------------------------------------------------



  public function profile($user_id = "")
  {

    if ($_POST) {

      $config['file_name'] = rand(000, 111);
      $config['upload_path'] = 'assets/img/';
      $config['allowed_types'] = 'gif|jpg|png';

      $this->load->library('upload', $config);
      $image = $this->db->where('user_id', $this->input->post('user_id'))->get('flat')->row_array();

      $this->upload->do_upload('image');

      if ($this->upload->data('file_name') != "") {
        //  $error = array('error' => $this->upload->display_errors());
        $pic = $this->upload->data('file_name');
      } else {
        // $this->load->view('form', $error);
        // echo $this->upload->display_errors();
        $pic = $image['image'];
      }



      $datas = array(
        'username' => $this->input->post('username'),
        'email' => $this->input->post('email'),
        'mobile' => $this->input->post('mobile'),
        'dob' => $this->input->post('dob'),
        'pwd' => $this->input->post('pwd'),
        'gender' => $this->input->post('gender'),
        'image' => $pic,
        'country' => $this->input->post('country'),
        'qualification' => $this->input->post('qualification'),
        'address' => $this->input->post('address'),
      );


      $inn = $this->db->where('user_id', $this->input->post('user_id'))->update('flat', $datas);

      if ($inn) {
        redirect('admin/dashboard', 'refresh');
      } else {
        redirect('userprofile', 'refresh');
      }
    } else {
      $this->load->view('admin/userprofile');
    }
  }
  // -------------------------------------------------------------------------------------------------------

  public function viewuser($user_id = "")
  {
    if ($this->session->userdata('auser_type') != "a")
      redirect('admin', 'refresh');
    $data['aa'] = $this->db->get_where('flat', array('user_id' => $user_id))->row_array();
    $this->load->view('admin/viewuser', $data);
  }



  // ------------------------------------------------------------------------------------------------------------
  public function userupdate()
  {

    if ($_POST) {

      $config['file_name'] = rand(000, 111);
      $config['upload_path'] = 'assets/img/';
      $config['allowed_types'] = 'gif|jpg|png';

      $this->load->library('upload', $config);
      $image = $this->db->where('user_id', $this->input->post('user_id'))->get('flat')->row_array();

      $this->upload->do_upload('image');

      if ($this->upload->data('file_name') != "") {

        $pic = $this->upload->data('file_name');
      } else {

        $pic = $image['image'];
        echo $this->upload->display_errors();
      }



      $datas = array(
        'username' => $this->input->post('username'),
        'email' => $this->input->post('email'),
        'mobile' => $this->input->post('mobile'),
        'dob' => $this->input->post('dob'),
        'pwd' => $this->input->post('pwd'),
        'gender' => $this->input->post('gender'),
        'image' => $pic,
        'country' => $this->input->post('country'),
        'qualification' => $this->input->post('qualification'),
        'address' => $this->input->post('address'),
      );


      $inn = $this->db->where('user_id', $this->input->post('user_id'))->update('flat', $datas);

      if ($inn) {
        log_message('error', $inn);

        redirect('admin/dashboard', 'refresh');
      } else {
        redirect('admin/viewuser', 'refresh');
      }
    } else {
      log_message('error', 'not loading');
      $this->load->view('admin/viewuser');
    }
  }

  // ---------------------------------------------------------------------------------------------------------------------------------


  public function bank()
  {
    if ($_POST) {
      $datas = array(
        'accountno' => $this->input->post('accountno'),
        'ifsc' => $this->input->post('ifsc'),
        'bankname' => $this->input->post('bankname'),
        'branch' => $this->input->post('branch'),

      );
      $inn = $this->db->where('user_id', $this->input->post('user_id'))->update('flat', $datas);
      if ($inn) {
        redirect('admin/dashboard', 'refresh');
      } else {
        redirect('admin/bank', 'refresh');
      }
    } else {
      $data['aa'] = $this->db->where('user_id', $this->session->userdata('user_id'))->get('flat')->row_array();

      $this->load->view('admin/bank', $data);
    }
  }

  // ------------------------------------------------------------------------------------------------


  public function kyc()
  {
    if ($_POST) {
      $datas = array(
        'aadhar' => $this->input->post('aadhar'),
        'pan' => $this->input->post('pan'),
      );

      $inn = $this->db->where('user_id', $this->input->post('user_id'))->update('flat', $datas);
      if ($inn) {
        redirect('admin/dashboard', 'refresh');
      } else {
        redirect('admin/kyc', 'refresh');
      }
    } else {
      $data['aa'] = $this->db->where('user_id', $this->session->userdata('user_id'))->get('flat')->row_array();

      $this->load->view('admin/kyc', $data);
    }
  }

  // ------------------------------------------------------------------------------------------------------



  public function admin_panel()
  {
    if ($this->session->userdata('auser_type') != "a")
      redirect('admin', 'refresh');
    $data['aa'] = $this->db->where('status=', 'Requested')->get('admin_request')->result_array();
    $this->load->view('admin/admin_panel', $data);
  }

  // ------------------------------------------------------------------------------------------------
  public function purchase_request()
  {
    if ($this->session->userdata('auser_type') != "a")
      redirect('admin', 'refresh');
    $data['aa'] = $this->db->where('status=', 'processing')->get('purchase')->result_array();
    $this->load->view('admin/purchase_request', $data);
  }


  // -------------------------------------------------------------------------------------------


  public function accept($id = " ")
  {
    $accept = $this->admin->accept_user($id);
    if ($accept) {
      $this->session->set_flashdata('Success', 'Request Accepted');
      redirect('admin/admin_panel', 'refresh');
    } else {
      $this->session->set_flashdata('error', 'something went wrong');
      redirect('admin/admin_panel', 'refresh');
    }
  }

  // ----------------------------------------------------------------------------------------------------

  // Purchase Accept

  public function accept_order($order_id = "")
  {
    $accept = $this->admin->accept_purchase($order_id);
    if ($accept) {
      redirect('admin/purchase_request', 'refresh');
    } else {
      redirect('admin/purchase_request', 'refresh');
    }
  }


  // ------------------------------------------------------------------------------------------------------------



  public function reject($id = "")
  {
    $reject = $this->admin->reject_user($id);
    if ($reject) {
      redirect('admin/admin_panel', 'refresh');
    } else {
      redirect('admin/admin_panel', 'refresh');
    }
  }

  // --------------------------------------------------------------------------------------------------------------


  // purchase Reject

  public function reject_order($order_id = "")
  {
    $reject = $this->admin->reject_purchase($order_id);
    if ($reject) {
      redirect('admin/purchase_request', 'refresh');
    } else {
      redirect('admin/purchase_request', 'refresh');
    }
  }


  // -----------------------------------------------------------------------------------------------------------


  public function delete($id = "")
  {
    $inn = $this->db->where('id', $id)->delete('flat');


    if ($inn) {
      redirect('admin/viewuser', 'refresh');
    } else {
      redirect('admin/viewuser', 'refresh');
    }
  }

  // -----------------------------------------------------------------------------------------------------------------------



  public function product()
  {

    if ($_POST) {
      $datas = array(
        'product_name' => $this->input->post('product_name'),
        'product_id' => "PROD" . rand(0000, 9999),
        'main_id' => $this->input->post('main_id'),
        'sub_id' => $this->input->post('sub_id'),
        'mrp' => $this->input->post('mrp'),
        'image' => $this->input->post('image'),
        'selling' => $this->input->post('selling'),
        'gst' => $this->input->post('gst'),
        'delivery_charge' => $this->input->post('delivery_charge'),

      );
      $inn = $this->db->insert('product', $datas);
      if ($inn) {
        redirect('admin/product', 'refresh');
      } else {
        redirect('admin/product');
      }
    } else {
      $this->load->view('admin/product');
    }
  }

  // -----------------------------------------------------------------------------------------------------
  public function maincategory()
  {
    if ($_POST) {
      $mainid = 'MAIN' . rand(0000, 9999);
      $datas = array(
        'main_id' => $mainid,
        'name' => $this->input->post('name'),

      );
      $inn = $this->db->insert('main', $datas);
      if ($inn) {
        redirect('admin/maincategory', 'refresh');
      } else {
        redirect('admin/maincategory');
      }
    } else {
      $this->load->view('admin/maincategory');
    }
  }

  // -----------------------------------------------------------------------------------------------------

  public function subcategory()
  {
    if ($_POST) {
      $datas = array(
        'sub_id' => "SUB" . rand(0000, 9999),
        'main_id' => $this->input->post('main_id'),
        'sub_category_name' => $this->input->post('name'),
      );
      $inn = $this->db->insert('sub', $datas);
      if ($inn) {
        redirect('admin/subcategory', 'refresh');
      } else {
        redirect('admin/subcategory');
      }
    } else {
      $this->load->view('admin/subcategory');
    }
  }



  // --------------------------------------------------------------------------------------------------------

  public function pro_upload()
  {

    if (isset($_FILES["pro_upload"]["name"])) {
      $config['file_name'] = time();
      $config['upload_path'] = 'assets/img';
      $config['allowed_types'] = 'jpg|jpeg|png|gif';
      $config['overwrite'] = true;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('pro_upload')) {
        echo $this->upload->display_errors();
      } else {
        $data = $this->upload->data();
        echo $data["file_name"];
      }
    }
  }

  // -----------------------------------------------------------------------------------------------------------------------

  public function logout()
  {
    $this->session->unset_userdata('ausername');
    $this->session->unset_userdata('auser_id');
    $this->session->unset_userdata('auser_type');
    $this->session->sess_destroy();
    redirect('admin/signin', 'refresh');
  }




  // -------------------------------------------------------------------------------

  public function get_sub_menus()
  {
    // $get_cat = $this->db->select('name')->where('main_id', $this->input->post('main_id'))->get('main')->row();

    //log_message('error',$this->input->post('m_menu_id')."Got IT");
    $sub_menus = $this->db->where('main_id', $this->input->post('m_menu_id'))->get('sub')->result_array();

    if (!empty($sub_menus)) {

      $value = array();

      foreach ($sub_menus as $key => $sub_menu) {
        if (!empty($sub_menus)) {

          $cartvalue = array_push($value, $sub_menu['sub_category_name']);
        }
      }
      echo json_encode($value);
    } else {
      echo "empty";
    }
  }







  // ---------------------------------------------------------------------------------------------------------------------------------





  public function login()
  {

    $this->form_validation->set_rules('email', 'email', 'required');
    $this->form_validation->set_rules('password', 'password', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('login');
    } else {

      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $user = $this->db->get_where('users', ['email' => $email])->row();

      if (!$user) {
        $this->session->set_flashdata('login_error', 'Please check your email or password and try again.', 300);
        redirect(uri_string());
      }


      if (!password_verify($password, $user->password)) {
        $this->session->set_flashdata('login_error', 'Please check your email or password and try again.', 300);
        redirect(uri_string());
      }

      $data = array(
        'user_id' => $user->user_id,
        'first_name' => $user->first_name,
        'last_name' => $user->last_name,
        'email' => $user->email,
      );


      $this->session->set_userdata($data);

      //redirect('/'); // redirect to home
      echo 'Login success!';
      exit;
    }
  }




  // Existing email check during validation 
  public function email_check($str)
  {
    $con = array(
      'returnType' => 'count',
      'conditions' => array(
        'email' => $str
      )
    );
    $checkEmail = $this->user->getRows($con);
    if ($checkEmail > 0) {
      $this->form_validation->set_message('email_check', 'The given email already exists.');
      return FALSE;
    } else {
      return TRUE;
    }
  }




  // -------------------------------------------------------------------------------------------------------------

  public function country()
  {
    $this->load->view('country');
  }



  //  ----------------------------------------------------------------------------------------------------





  // getting data

  public function getdata()
  {

    $data['records'] = $this->admin->get_data();
    echo json_encode($data);
  }

  public function updatedata($id)
  {
    $this->load->view('updatedata');
  }

  public function updatedatas($id)
  {
    if ($_POST) {
      $data = [
        'name' => $this->input->post('name'),
        'email' => $this->input->post('email')
      ];

      $this->db->set($data, $id);
      $result = $this->db->where('id', $id)->update('ajax', $data);
      return $result;
      if ($result) {
        $this->load->view('dataview');
      } else {
        $this->load->view('updatedata');
      }
    }
  }


  public function deletedata($id)
  {
    $result = $this->db->delete('ajax', array('id' => $id));
    return $result;
  }
}