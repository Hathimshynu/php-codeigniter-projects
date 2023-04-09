<?php
error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');
class Admin_model extends CI_Model
{

    public function get_user($email, $userid)
    {
        $query = $this->db->where('useremail', $email)->where('userid', $userid)->count_all_results('flat')+0;;

        if ($query->num_rows() == 1) {
            return $query->row();
        }

        return false;
    }



    // -----------------------------------------------------------------------------------------------------------
    public function shynu()
    {

        $id = "SH" . rand(0000, 9999);

        $datas = array(

            'user_id' => $id,
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'pwd' => $this->input->post('pwd'),
            'ref_id' => $this->input->post('ref_id'),
            'mobile' => $this->input->post('mobile'),
        );

        $res = $this->db->insert('flat', $datas);

        if ($res) {
            $result['user_id'] = $id;
            $result['username'] = $this->input->post('username');
            $result['email'] = $this->input->post('email');
            $result['pwd'] = $this->input->post('pwd');
            $result['status'] = true;
            return $result;
        } else {
            return false;
        }
    }
    // --------------------------------------------------------------------------------------------------
    public function signin($username, $pwd)
    {

        $this->db->where('pwd', $pwd);
        $this->db->where('username', $username);
        $result = $this->db->get('flat')->row_array();
        // log_message('error',$username."username");
        // log_message('error',$pwd."pwd");
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    // ----------------------------------------------------------------------------------------------------
    public function trans()
    {

        $this->db->trans_begin();
        $data1 = array(
            'user_id' => $this->session->userdata('user_id'),
            'debit' => $this->input->post('amount'),
            'description' => 'selftransfer',

        );
        $inn = $this->db->insert('myaccount', $data1);
        $data2 = array(
            'user_id' => $this->session->userdata('user_id'),
            'credit' => $this->input->post('amount'),
            'entry_date' => date('Y-m-d H:i:s'),
            'remarks' => 'selftransfer',
        );
        $inn = $this->db->insert('wallet', $data2);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function get_user_id($user_id)
    {

        $this->db->where('user_id', $user_id);
        $result = $this->db->get('flat')->row_array();
        log_message('error', $user_id . "user_id");
        // log_message('error',$pwd."pwd");
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    // --------------------------------------------------------------------------------------------------------------

    public function accept_user($id = "")
    {
        $this->db->trans_begin();
        $data = array('status' => 'Accepted');
        $this->db->where('id', $id);
        $this->db->update('admin_request', $data);
        $sin = $this->db->where('id', $id)->get('admin_request')->row_array();
        $walletdata = array(
            'user_id' => $sin['user_id'],
            'credit' => $sin['amount'],
            'entry_date' => date('Y-m-d H:i:s'),
            'remarks' => 'Deposit',
        );

        $this->db->insert('wallet', $walletdata);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


    // ---------------------------------------------------------------------------------------------------
    public function accept_purchase($order_id = "")
    {

        $data = array('status' => 'Accepted');
        $this->db->where('order_id', $order_id);
        $inn = $this->db->update('purchase', $data);
        if ($inn) {
            return true;
        } else {
            return false;
        }
    }

    // -------------------------------------------------------------------------------------------



    public function get_total_investments($user_id = "")
    {
        $this->db->select_sum('amount');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('admin_request');
        return $query->row()->amount;
    }




    // ----------------------------------------------------------------------------------------------------


    public function reject_user($id = "")
    {
        $data = array(
            'status' => 'Rejected'
        );
        $this->db->where('id', $id);
        $this->db->update('admin_request', $data);
        return true;
    }

    // ---------------------------------------------------------------------------------------------------
    public function reject_purchase($order_id = "")
    {
        $data = array(
            'status' => 'Rejected'
        );
        $this->db->where('order_id', $order_id);
        $this->db->update('purchase', $data);
        return true;
    }


    // ------------------------------------------------------------------------------------------------------------

    public function order_items()
    {
        $this->db->trans_begin();
        $order_id = "ORDER" . rand(0000, 9999);
        $data1 = array(
            'user_id' => $this->session->userdata('user_id'),
            'order_id' => $order_id,
            'amount' => $this->input->post('amount'),
            'status' => 'processing',
            'product_name' => $this->input->post('product_name'),
        );
        $inn = $this->db->insert('purchase', $data1);

        $data2 = array(
            'user_id' => $this->session->userdata('user_id'),
            'remarks' => 'purchased',
            'debit' => $this->input->post('amount'),
            'entry_date' => date('Y-m-d H:i:s')
        );
        $inn = $this->db->insert('wallet', $data2);
        $data3 = array(
            'user_id' => $this->session->userdata('user_id'),
            'status' => 'completed',
            'created_at' => date('Y-m-d H:i:s'),
            'order_id' => $order_id,
        );
        $inn = $this->db->where('user_id', $this->session->userdata('user_id'))
            ->where('status', 'new')->update('cart', $data3);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


}