<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form', 'url'));
    $this->load->library(array('form_validation', 'email'));
    $this->form_validation->set_error_delimiters('<span style="color:red">', '</span>');
  }

  // -----------------------------------------------------------------------------------------------------

  public function index()
  {
    if ($this->session->userdata('user_type') == 'u') {
      redirect('user/dashboard', 'refresh');

    } else {
      redirect('user/signup', 'refresh');
    }
  }
// ----------------------------------------------------------------------------------------------------------------------------------------
    public function registration()
  {
    if ($_POST) {


      $this->load->library('form_validation');
      $this->form_validation->set_rules('username', 'username', 'trim|required');
      $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[user.email]', array('is_unique' => 'Email already exists'));
      $this->form_validation->set_rules('pwd', 'pwd', 'trim|required');
      $this->form_validation->set_rules('mobile', 'mobile', 'required|min_length[10]|max_length[12]');

      if ($this->form_validation->run() == FALSE) {

        $this->load->view('user/registration');
      } else {
        $unique_code = random_string('alnum', 8); // Generate a 6-digit random number

        // Check if the generated number already exists in the database
        while ($this->db->where('verification_code', $unique_code)->get('user')->num_rows() > 0) {
          $unique_code = random_string('alnum', 8); // Generate a new random number
        }
        $datas = array(
          'username' => $this->input->post('username'),
          'email' => $this->input->post('email'),
          'pwd' => $this->input->post('pwd'),
          'mobile' => $this->input->post('mobile'),
          'verification_code' => $unique_code
        );
        $ins = $this->db->insert('user', $datas);
        echo "Registration Successfull";
        $this->session->set_userdata('username');
        if ($ins) {
          $verification_code = $this->db->select('verification_code')->where('email', $this->input->post('email'))->get('user')->row()->verification_code;
          echo "Your verification code is " . $verification_code;
          $this->load->library('email');
          // $config = array();
          $config['mailtype'] = 'html';
          $this->email->initialize($config);
          $this->email->set_newline("\r\n");
          $this->email->from('noreplay@backofficee.com', 'SQUAREMARKET');
          $this->email->reply_to('noreplay@backofficee.com', 'SQUAREMARKET');
          $this->email->to($this->input->post('email'));
          $this->email->subject("Verify Your  Details");
          $message = 'Dear ' . $this->input->post('username') . ',<br><br>';
          $message .= 'Thank you for registering Our Website !. Your email address is: ' . $this->input->post('email') . ' and your password is: ' . $this->input->post('pwd');
          $message .= 'To verify your Details, please click the following link: <br><br>';
          $message .= '<button style="background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 5px;">
          <a href="' . BASEURL . 'user/verify_link/' . $verification_code . '" style="text-decoration:none; color: white;">Verify Email Address</a></button><br><br>';
          $message .= 'Thank you,<br>';
          $message .= 'SQUAREMARKET';

          $this->email->message($message);
          $this->email->send();

          if ($this->email->send()) {
            echo "sent";
            $this->session->set_flashdata('success_message', 'Verify link sent your registered mail ID');
            $this->load->view('user/registration');
          } else {
            echo "not sent ";
            $this->session->set_flashdata('error_message', 'Verify Link Not Sent');
            $this->load->view('user/registration', 'refresh');
          }
        }
      }
    } else {
      $this->load->view('user/registration');
    }
  }
  
  
//   ------------------------------------------------------------------------------------------------------------------------------
  public function verify_link($verification_code)
  {

    log_message('error', "hii");
    $query = $this->db->where('verification_code', $verification_code)->where('is_verified', 'not_verified')->get('user')->num_rows();
    log_message('error', $query);
    if ($query > 0) {
      // If verification code is not empty and user is not verified, update the is_verified column
      $this->db->where('verification_code', $verification_code)->where('is_verified', 'verified')->update('user');
      $message = 'Your account has been verified Successfully!';
      return $message;
    } else {
      // If verification code is empty or user is already verified, display appropriate message
      $user =  $this->db->where('verification_code', $verification_code)->get('user')->row()->verification_code;

      if ($user && $user->is_verified == 'verified') {
        $message = 'Your account is already verified!';
        return $message;
      } else {
        $message = 'Invalid verification code!';
        return $message;
      }
    }
  }


  // ----------------------------------------------------------------------------------------------------


  public function refresh()
  {
    redirect('user/signup', 'refresh');
  }



  // -----------------------------------------------------------------------------------------------------

  public function dashboard()
  {
    if ($this->session->userdata('user_type') != "u")
      redirect('user', 'refresh');
    $this->load->view('user/index');
  }




  // --------------------------------------------------------------------------------------------------------

  public function signup($user_id = "")
  {
    if ($_POST) {


      $this->load->library('form_validation');
      $this->form_validation->set_rules('username', 'username', 'trim|required');
      $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_email_check');
      $this->form_validation->set_rules('pwd', 'pwd', 'trim|required|max_length[12]');
      $this->form_validation->set_rules('mobile', 'mobile', 'required|min_length[10]');
      $this->form_validation->set_rules('ref_id', 'ref_id', 'trim|callback_check_referral_limit');

      if ($this->form_validation->run() == FALSE) {

        $this->load->view('user/signup');
      } else {
        $res = $this->admin->shynu();
        if ($res['status'] == true) {
          $this->load->view('user/welcome', $res);
        } else {
          $this->load->view('user/signup');
        }

      }
    } else {

      $ref = hex2bin($user_id);
      $user = $this->db->where('user_id', $ref)->get('flat')->row_array();
      if (!empty($user)) {
        $data['ref_id'] = $user['user_id'];
      } else {
        $admin = $this->db->select('user_id')->where('user_role_id', 1)->get('flat')->row()->user_id;
        $data['ref_id'] = $admin;
      }
      $this->load->view('user/signup', $data);
    }
  }

  // --------------------------------------------------------------------------------------

  public function transaction()
  {
    if ($this->session->userdata('user_type') != "u")
      redirect('user', 'refresh');
    if ($_POST) {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('amount', 'Amount', 'required');
      $this->form_validation->set_rules('utr', 'utr', 'required|callback_utr_check');

      if ($this->form_validation->run() == FALSE) {

        $this->load->view('user/transaction');


      } else {
        $user_id = $this->session->userdata('user_id');
        $data = array(
          'user_id' => $user_id,
          'amount' => $this->input->post('amount'),
          'image' => $this->input->post('image'),
          'utr' => $this->input->post('utr'),
          'entry_date' => date('Y-m-d H:i:s'),

        );
        $inn = $this->db->insert('admin_request', $data);
        if ($inn) {
          log_message('error', 'success');
          redirect("user/dashboard", 'refresh');
        } else {
          redirect('user/userprofile/refresh');
        }
      }

    } else {
      $data['aa'] = $this->db->where('user_id', $this->session->userdata('user_id'))->where('status !=', 'Requested')->get('admin_request')->result_array();
      $this->load->view('user/transaction', $data);
    }
  }

  // --------------------------------------------------------------------------------------------------

  public function myteam()
  {
    if ($this->session->userdata('user_type') != "u")
      redirect('user', 'refresh');
    $data['aa'] = $this->db->where('ref_id', $this->session->userdata('user_id'))->get('flat')->result_array();
    $this->load->view('user/myteam', $data);
  }

  // -------------------------------------------------------------------------------------------------------------------
  public function binarytree($user_id = "")
  {
    if ($this->session->userdata('user_type') != "u")
      redirect('user', 'refresh');

    if ($user_id != "") {
      $user = $user_id;
    } else {
      $user = $this->session->userdata('user_id');
    }
    $data['rr'] = $user;
    $data['aa'] = $this->db->where('ref_id ', $user)->get('flat')->result_array();
    $this->load->view('user/binarytree', $data);
  }

  // --------------------------------------------------------------------------------------------------------------
  function check_referral_limit()
  {
    $count = $this->db->select('COUNT(ref_id) as count')->where('ref_id', $this->session->userdata("user_id"))
      ->get('flat')->result_array();

    if ($count > 10) {
      $this->form_validation->set_message('check_referral_limit', "Your Referal limit Reached You Cannot Refer new members");
      return false;
    } else {
      return true;
    }
  }

// ---------------------------------------------------------------------------------------------------------------


public function email_check()
  {
    $count = $this->db->where('email', $this->input->post('email'))
      ->get('flat')->num_rows();

    if ($count > 0) {
      $this->form_validation->set_message('email_check', "Email Already exists");
      return false;
    } else {
      return true;
    }
  }

  // -----------------------------------------------------------------------------------------------------------
  public function selftransfer()
  {
    if ($this->session->userdata('user_type') != "u")
      redirect('user', 'refresh');

    if ($_POST) {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('amount', 'Amount', 'trim|greater_than_equal_to[1]|callback_account_check|required');


      if ($this->form_validation->run() == true) {

        $inn = $this->admin->trans();

        if ($inn) {

          redirect("user/selftransfer", 'refresh');
        } else {
          redirect('user/selftransfer', 'refresh');
        }
      } else {
        $this->load->view('user/selftransfer');
      }

    } else {
      $this->load->view('user/selftransfer');

    }
  }



  // ---------------------------------------------------------------------------------------------------------------

  public function utr_check()
  {

    $regutrcheck = $this->db->where('utr', $this->input->post('utr'))->count_all_results('admin_request') + 0;

    if ($regutrcheck > 0) {
      $this->form_validation->set_message('utr_check', 'UTR already exists');
      return FALSE;
    } else {
      log_message('error', 'failed');
      return TRUE;
    }
  }

  // ----------------------------------------------------------------------------------------------------------------



  public function peer()
  {
    if ($this->session->userdata('user_type') != "u")
      redirect('user', 'refresh');
    if ($_POST) {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('user_id', 'User_id', 'required|callback_user_id_check');
      $this->form_validation->set_rules('amount', 'Amount', 'required|greater_than_equal_to[0]|callback_account_check');

      if ($this->form_validation->run() == FALSE) {

        $this->load->view('user/peer');


      } else {

        $data1 = array(
          'user_id' => $this->input->post('user_id'),
          'credit' => $this->input->post('amount'),
          'entry_date' => date('Y-m-d H:i:s'),
          'remarks' => 'peer',
        );

        $res = $this->db->insert('wallet', $data1);

        $data2 = array(
          'user_id' => $this->session->userdata('user_id'),
          'debit' => $this->input->post('amount'),
          'entry_date' => date('Y-m-d H:i:s'),
          'remarks' => 'peer',
        );
        $this->db->insert('wallet', $data2);


        if ($res) {
          redirect('user/peer');
        } else {
          redirect('user/peer');
        }
      }

    } else {
      $this->load->view('user/peer');
    }
  }

  // ------------------------------------------------------------------------------------------------------------


  public function account_check()
  {
    $balance = $this->db->select("(SUM(credit) - SUM(debit)) as balance")->where('user_id', $this->session->userdata('user_id'))->get('myaccount')->row()->balance + 0;

    $amount = $this->input->post('amount');

    if ($balance >= $amount) {
      $this->session->set_flashdata('message', ' peered success');
      return true;
    } else {
      $this->form_validation->set_message('account_check', 'Insufficient balance');
      return false;

    }
  }









  //  -------------------------------------------------------------------------------------------

  public function amount_check()
  {
    $balance = $this->db->select("(SUM(credit) - SUM(debit)) as balance")->where('user_id', $this->session->userdata('user_id'))->get('wallet')->row()->balance + 0;

    $amount = $this->input->post('amount');
    if ($balance >= $amount) {
      $this->session->set_flashdata('message', ' peered success');
      return true;
    } else {
      $this->form_validation->set_message('amount_check', 'Insufficient balance');
      return false;

    }
  }


  // -----------------------------------------------------------------------------------
  public function user_id_check($user_id)
  {
    $this->db->where('user_id', $user_id);
    $query = $this->db->get('admin_request');
    if ($query->num_rows() > 0) {
      return true;
    } else {
      $this->form_validation->set_message('user_id_check', 'user does not exists');
      return false;
    }
  }






  // ------------------------------------------------------------------------------------------------------------------

  public function get_total_investments($user_id)
  {
    $total_investments = $this->admin->get_total_investments($user_id);
    return $total_investments;
  }

  // --------------------------------------------------------------------------------------------


  public function activate($user_Id = "")
  {
    if ($this->session->userdata('user_type') != "u")
      redirect('user', 'refresh');
    if ($_POST) {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('user_id', 'User_id', 'required|callback_user_id_check|callback_active_check');
      $this->form_validation->set_rules('amount', 'Amount', 'required|greater_than_equal_to[0]|callback_amnt_check');


      if ($this->form_validation->run() == FALSE) {

        $this->load->view('user/activate');


      } else {

        $data1 = array(
          'user_id' => $this->input->post('user_id'),
          'credit' => $this->input->post('amount'),
          'entry_date' => date('Y-m-d H:i:s'),
          'remarks' => 'Activated',
        );

        $res = $this->db->insert('wallet', $data1);

        $data2 = array(
          'user_id' => $this->session->userdata('user_id'),
          'debit' => $this->input->post('amount'),
          'entry_date' => date('Y-m-d H:i:s'),
          'remarks' => 'activation',
        );
        $res = $this->db->insert('wallet', $data2);


        if ($res) {
          $this->session->set_flashdata('message', ' Account activation  success');
          redirect('user/activate', 'refresh');
        } else {
          redirect('user/activate');
        }
      }


    } else {
      $this->load->view('user/activate');
    }
  }

  // ------------------------------------------------------------------------------------------------------------
  public function active_check($user_id)
  {
    $active = $this->db->where('user_id', $this->input->post('user_id'))->where('remarks=', 'Activated')->count_all_results("wallet") + 0;

    if ($active < 0) {
      return true;
    } else {
      $this->form_validation->set_message('active_check', 'user already exists');
      return false;
    }
  }





  // --------------------------------------------------------------------------------------------------------



  public function amnt_check()
  {
    $balance = $this->db->select("(SUM(credit) - SUM(debit)) as balance")->where('user_id', $this->session->userdata('user_id'))->get('wallet')->row()->balance + 0;

    $amount = $this->input->post('amount');
    if ($balance >= $amount) {
      return true;
    } else {
      $this->form_validation->set_message('amnt_check', 'Insufficient balance');
      return false;

    }
  }




  // ------------------------------------------------------------------------------


  public function bank()
  {
    if ($this->session->userdata('user_type') != "u")
      redirect('user', 'refresh');
    $data['aa'] = $this->db->where('user_id', $this->session->userdata('user_id'))->get('flat')->row_array();

    $this->load->view('user/bank', $data);
  }

  // -----------------------------------------------------------------------------------------------
  public function bankk()
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
        redirect('user/dashboard', 'refresh');
      } else {
        redirect('user/bank', 'refresh');
      }

    } else {
      $this->load->view('user/bank');
    }
  }

  // ------------------------------------------------------------------------------------------------


  public function kyc()
  {
    if ($this->session->userdata('user_type') != "u")
      redirect('user', 'refresh');
    if ($_POST) {
      $datas = array(
        'aadhar' => $this->input->post('aadhar'),
        'pan' => $this->input->post('pan'),
      );

      $inn = $this->db->where('user_id', $this->input->post('user_id'))->update('flat', $datas);
      if ($inn) {
        redirect('user/dashboard', 'refresh');
      } else {
        redirect('user/kyc', 'refresh');
      }
    } else {
      $data['aa'] = $this->db->where('user_id', $this->session->userdata('user_id'))->get('flat')->row_array();

      $this->load->view('user/kyc', $data);
    }
  }


  // ------------------------------------------------------------------------------------------------

  public function pro_upload()
  {
    if ($this->session->userdata('usertype') != 'u')
      redirect('user/index', 'refresh');

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



  // -----------------------------------------------------------------------------------------------------


  public function userprofile()
  {
    if ($this->session->userdata('user_type') != "u")
      redirect('user', 'refresh');
    $data['aa'] = $this->db->where('user_id', $this->session->userdata('user_id'))->get('flat')->row_array();

    $this->load->view('user/userprofile', $data);
  }


  // -------------------------------------------------------------------------------------------------------------

  //  RESET Password


  public function resetpass()
  {
    if ($this->session->userdata('user_type') != "u")
      redirect('user', 'refresh');
    if ($_POST) {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('pwd', 'pwd', 'trim|required|max_length[12]|callback_passcheck');
      $this->form_validation->set_rules('npwd', 'npwd', 'trim|required|max_length[12]');
      $this->form_validation->set_rules('cpwd', 'cpwd', 'required|matches[npwd]');

      if ($this->form_validation->run() == FALSE) {

        $this->load->view('user/resetpass');
      } else {
        $datas = array(
          'pwd' => $this->input->post('npwd'),
        );

        $inn = $this->db->where('user_id', $this->session->userdata('user_id'))->update('flat', $datas);
        log_message('error', $this->db->last_query());
        if ($inn) {
          $this->session->set_flashdata('success', 'Password Updated successfully');
          $this->load->view('user/resetpass', 'refresh');
        } else {
          log_message('error', 'error');
          $this->load->view('user/resetpass', 'refresh');
        }
      }

    } else {
      $data['aa'] = $this->db->where('user_id', $this->session->userdata('user_id'))->get('flat')->row_array();

      $this->load->view('user/resetpass', $data);
    }
  }
  // ---------------------------------------------------------------------------------------------------------------------

  public function passcheck()
  {

    $query = $this->db->where('user_id', $this->session->userdata('user_id'))
      ->where('pwd', $this->input->post('pwd'))->count_all_results('flat') + 0;

    if ($query > 0) {
      return TRUE;
    } else {
      // If the user_id and password don't match, check if the user_id exists in the database

      $query = $this->db->where('user_id', $this->session->userdata('user_id'))
        ->where('pwd', $this->input->post('pwd'))->count_all_results('flat') + 0;
      if ($query > 0) {
        $this->form_validation->set_message('passcheck', 'The given user does not exist. ');
      } else {
        $this->form_validation->set_message('passcheck', 'The given password is incorrect.');
      }
      return FALSE;
    }

  }
  // -----------------------------------------------------------------------------------------------------


  public function forgetpassword()
  {
    $useremail = $this->input->post('useremail');
    $userid = $this->input->post('username');
    $user = $this->admin->get_user_by_email_and_user_id($useremail, $userid);

    if (!$user) {
      echo "User does not exists";

    } else {
      // Generate password reset token and store it in the database
      $reset_token = bin2hex(random_bytes(16));
      $token_expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));
      $this->user_model->set_password_reset_token($user->id, $reset_token, $token_expiration);

      // Send password reset email to the user
      $this->load->library('email');
      $this->email->from('your_email@example.com', 'Your Name');
      $this->email->to($user->email);
      $this->email->subject('Password Reset');
      $this->email->message('Please click on the link below to reset your password: ' . site_url('auth/reset_password/' . $reset_token));
      $this->email->send();

    }

  }
  // -------------------------------------------------------------------------------------------

  public function send_otp()
  {

    $dataemail = $this->db->select('pwd')->where('user_id', $this->input->post('user_id'))->get('flat')->row()->pwd;

    $this->load->library('email');
    $config = array();
    $config['mailtype'] = 'html';
    $this->email->initialize($config);
    $this->email->set_newline("\r\n");
    $this->email->from('noreplay@backofficee.com', 'SQUAREFX');
    $this->email->reply_to('noreplay@backofficee.com', 'SQUAREFX');
    $this->email->to($this->input->post('email'));
    $this->email->subject("Forget Password");
    $this->email->message($dataemail, true);

    if ($this->email->send()) {
      $this->session->set_flashdata('success_message', 'OTP send your registered mail ID');
      $this->load->view('user/index');

    } else {
      $this->session->set_flashdata('error_message', 'Please check your account ID');
      redirect('user/forgetpassword', 'refresh');

    }
  }




  // ------------------------------------------------------------------------------------------------



  public function profile()
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

      log_message('error', $pic);
      log_message('error', $this->input->post('user_id'));

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
      log_message('error', $this->db->last_query());

      if ($inn) {
        log_message('error', 'success');

        redirect('user/userprofile', 'refresh');
      } else {
        log_message('error', 'error');
        redirect('userprofile', 'refresh');
      }

    } else {
      log_message('error', 'not loading');
      $this->load->view('user/userprofile');

    }

  }

  // ------------------------------------------------------------------------------------------------------------






  // ---------------------------------------------------------------------------------------
  public function usersignin()
  {
    $this->load->view('user/usersignin');
  }



  // --------------------------------------------------------------------------------
  public function signin()
  {
    if ($_POST) {

      $username = $this->input->post('username');
      $pwd = $this->input->post('pwd');
      $signin = $this->admin->signin($username, $pwd);

      if ($signin != false) {
        $this->session->set_userdata('user_id', $signin['user_id']);
        $this->session->set_userdata('username', $signin['username']);
        $this->session->set_userdata('user_type', $signin['user_type']);

        redirect('user/dashboard', 'refresh', $signin);
      } else {
        log_message('error', 'some fields are empty');
        $result['error'] = 'Invalid signin';
        redirect('user', 'refresh', $result);
      }
    }
  }

  // ---------------------------------------------------------------------------------- 

  public function logout()
  {
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('user_id');
    $this->session->unset_userdata('user_type');
    $this->session->sess_destroy();
    redirect('shoppy', 'refresh');
  }



// ---------------------------------------------------------------------------------------















}
