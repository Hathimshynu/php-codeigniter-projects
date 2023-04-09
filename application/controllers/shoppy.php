<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Shoppy extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper(array('form', 'url'));
    $this->load->library(array('form_validation', 'email'));
    $this->form_validation->set_error_delimiters('<span style="color:red">', '</span>');
  }

  public function index()
  {
    if ($this->session->userdata('user_type') != 'u')
      redirect('user/usersignin', 'refresh');
    $data['products'] = $this->db->get('product')->result_array();
    $this->load->view('shoppy/index', $data);
  }

  // ---------------------------------------------------------------------------------------------------
  public function shop()
  {

    $this->load->view('shoppy/shop');
  }


  // ---------------------------------------------------------------------------------------------------
  public function detail($product_id = "")
  {
    if ($this->session->userdata('user_type') != 'u')
      redirect('user/usersignin', 'refresh');

    $cartitems['bb'] = $this->db->where('product_id', $product_id)->get('product')->row_array();
    $this->load->view('shoppy/detail', $cartitems);
  }

  // ---------------------------------------------------------------------------------------------------

  public function cart_items()
  {
    if ($_POST) {
      $data = array(
        'qty' => $this->input->post('qty'),
      );
      $inn = $this->db->where('user_id', $this->session->userdata('user_id'))->where('product_id', $this->input->post('product_id'))
        ->where('status', 'new')->update('cart', $data);
      if ($inn) {
        redirect(current_url());
      } else {
        redirect(current_url());
      }

    } else {

      $cart['cartitems'] = $this->db->where('user_id', $this->session->userdata('user_id'))->where('status', 'new')->get('cart')->result_array();
      $this->load->view('shoppy/cart', $cart);
    }
  }

  // -----------------------------------------------------------------------------------------------


  public function cartview($product_id = "")
  {
    if ($this->session->userdata('user_type') != 'u')
      redirect('user/usersignin', 'refresh');
    $aa = $this->db->where('product_id', $this->input->post('product_id'))->get('product')->row_array();
    if ($_POST) {
      $count = $this->db->where('user_id', $this->session->userdata('user_id'))->where('product_id', $this->input->post('product_id'))->where('status', 'new')->count_all_results('cart') + 0;
      if ($count > 0) {

        $this->db->set('qty', 'qty+' . $this->input->post('qty'), false);
        $inn = $this->db->where('user_id', $this->session->userdata('user_id'))->where('product_id', $this->input->post('product_id'))->where('status', 'new')->update('cart');
        redirect('shoppy', 'refresh');
      } else {

        $data = array(

          'user_id' => $this->session->userdata('user_id'),
          'cart_id' => "CART" . rand(0000, 9999),
          'product_id ' => $this->input->post('product_id'),
          'product_name' => $aa['product_name'],
          'qty' => $this->input->post('qty'),
          'amount' => $aa['mrp'],

        );
        log_message('error', 'hii');
        $inn = $this->db->insert('cart', $data);
        if ($inn) {
          redirect("shoppy");
        } else {
          // $cartitems = $this->db->where('user_id', $this->session->userdata('user_id'))->get('cart')->result_array();
          redirect("shoppy/cart_items");
        }
      }
    } else {
      redirect('shoppy/index', 'refresh');
    }
  }
  // ----------------------------------------------------------------------------------------------------------
  public function remove_cart_item($product_id = "")
  {
    $del = $this->db->where('product_id', $product_id)->where('user_id', $this->session->userdata('user_id'))->delete('cart');
    log_message('error', $this->db->last_query());
    if ($del) {
      redirect('shoppy/cart_items', 'refresh');
    } else {
      redirect('shoppy/cart_items', 'refresh');
    }
  }


  // ---------------------------------------------------------------------------------------------------
  public function checkout()
  {
    if ($this->session->userdata('user_type') != 'u')
      redirect('user/usersignin', 'refresh');

    if ($_POST) {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('amount', 'amount', 'required|greater_than[0]|callback_wallet_check');


      if ($this->form_validation->run() == FALSE) {
        $data['cartitems'] = $this->db->where('user_id', $this->session->userdata('user_id'))->where('status', 'new')->get('cart')->result_array();
        $this->load->view('shoppy/checkout', $data);

      } else {
        $inn = $this->admin->order_items($this->session->userdata('user_id'));
        if ($inn) {
          $this->session->set_flashdata('success', 'Your order request has been submitted successfully.');
          redirect('shoppy/orders');
        } else {
          redirect('shoppy/orders');
        }
      }
    } else {
      $data['cartitems'] = $this->db->where('user_id', $this->session->userdata('user_id'))->where('status', 'new')->get('cart')->result_array();
      $this->load->view('shoppy/checkout', $data);
    }
  }

  // ---------------------------------------------------------------------------------------------------
  public function contact()
  {

    $this->load->view('shoppy/contact');
  }


  // ---------------------------------------------------------------------------------------------------
  public function wallet_check()
  {
    $balance = $this->db->select("(sum(credit) - sum(debit)) as balance")->where('user_id', $this->session->userdata('user_id'))->get('wallet')->row()->balance + 0;

    $amount = $this->input->post('amount');
    if ($amount <= $balance) {
      return true;
    } else {
      $this->form_validation->set_message('wallet_check', 'Insufficient balance');
      return false;

    }
  }

  // ---------------------------------------------------------------------------------------------------

  public function orders()
  {
    if ($this->session->userdata('user_type') != 'u')
      redirect('user/usersignin', 'refresh');
    $data['orders'] = $this->db->where('user_id', $this->session->userdata('user_id'))
      ->where('status', 'processing')->get('purchase')->result_array();
    $this->load->view('shoppy/orders', $data);
  }


  // ---------------------------------------------------------------------------------------------------

  public function orderdetails()
  {


    $cart['cartitems'] = $this->db->where('user_id', $this->session->userdata('user_id'))->get('purchase')->result_array();
    $this->load->view('shoppy/orderdetails', $cart);
  }









}