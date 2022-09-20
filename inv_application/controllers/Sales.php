<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('cart');
        if( !$this->inventory->check_permission('sales',$this->session->userdata('id')) ){
            redirect(base_url().'no_access', 'refresh');
        }
    }

    public function index(){
        if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = 'sales';
        $this->load->view('add_sales', $data);
    }

    public function search_item(){
        if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $keyword = $this->input->post('keyword');
        $this->db->select('id, stock_name'); 
        $this->db->from('tbl_stock_details');
        $this->db->where('stock_quatity >= ','1');
        $this->db->like('stock_name', $keyword);
        $this->db->limit('5');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            echo '<ul id="item-list">';
            foreach($query->result() as $row){
                echo '<li onClick="selectItem('.$row->id.')">'.$row->stock_name.'</li>';
            }

            echo '<ul>';
        }

    }

    public function add_to_cart(){
        if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $id = $this->input->post('item');
        $query = $this->db->get_where('tbl_stock_details', array('id'=>$id));
        $row = $query->result();
        $data = array(
        'id'      => $row[0]->id,
        'qty'     => 1,
        'price'   => $row[0]->selling_price,
        'name'    => $row[0]->stock_name,
        'options' => array('stock' => $row[0]->stock_quatity)
        );

        $this->cart->insert($data);
        echo $this->show_cart();
        // redirect(base_url().'sales', 'refresh');

    }

    function update_cart()
    {
        if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }       
        // Recieve post values,calcute them and update
        $cart_info =  $_POST['cart'] ;
        foreach( $cart_info as $id => $cart)
        {   
            $rowid = $cart['rowid'];
            $price = $cart['price'];
            $amount = $price * $cart['qty'];
            $qty = $cart['qty'];
                    
            $data = array(
                    'rowid'   => $rowid,
                    'price'   => $price,
                    'amount' =>  $amount,
                    'qty'     => $qty
            );
             
            $this->cart->update($data);
        }
        echo $this->show_cart();
        // redirect(base_url().'sales', 'refresh');     
    }

    function show_cart()
    {
        $output = '';
        $grand_total = 0; 
        $num=1; 
        if(count($this->cart->contents())>0)
        {
            foreach($this->cart->contents() as $items)
            { 

                echo form_hidden('cart[' . $items['id'] . '][id]', $items['id']);
                echo form_hidden('cart[' . $items['id'] . '][rowid]', $items['rowid']);
                echo form_hidden('cart[' . $items['id'] . '][name]', $items['name']);
                echo form_hidden('cart[' . $items['id'] . '][price]', $items['price']);
                echo form_hidden('cart[' . $items['id'] . '][qty]', $items['qty']);
            
                $output .='<tr>        
                <td>'.$num.'</td>
                <td> '.$items['name'].'</td>
                <td> '.$items['price'].'</td>
                <td><input type="text" value="'.$items['qty'].'" name="cart['.$items['id'].'][qty]" size="3"></td>';
                foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): 
                $output .='<td>'.$option_value.'</td>';
                endforeach; 
                $output .='<td>'.$items['subtotal'].'</td>
              
                <td width="100">
                    <div class="btn-group">
                    <a href="javascript:void(0)" id="'.$items['rowid'].'" data-action="'.base_url().'sales/delete/'.$items['rowid'].'" class="btn btn-danger romove_cart"><i class="fa fa-trash"></i></a>
                    </div>
                </td>
                </tr>';
            
                // $grand_total = $grand_total + $items['subtotal'];
                $num++; 

            } 
            $output .= '
            <tr>
                <th colspan="5" align="right">Total</th>
                <th align="right">'.number_format($this->cart->total()).'</th>
                <th><input type="hidden" id="grand_total" value="'.$this->cart->total().'"></th>
            </tr>
        ';           
        }
        else
        {
            $output .='<tr><td colspan="7"><div class="alert alert-danger text-center">Oops, Your cart is empty!</div></td></tr>';
        }   
        return $output; 
    }

    function load_cart(){ 
        echo $this->show_cart();
    }   

    public function delete($rowid) {
        if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        // Check rowid value.
        if ($rowid==="all"){
            // Destroy data which store in  session.
            $this->cart->destroy();
        }else{
            // Destroy selected rowid in session.
            $data = array(
                'rowid'   => $rowid,
                'qty'     => 0
            );
            // Update cart data, after cancle.
            $this->cart->update($data);
        }
        
        // This will show cancle data in cart.
        redirect(base_url().'sales', 'refresh');
    }

    public function save_sales(){
        if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }

        $this->form_validation->set_rules('payment','Payment','required');
        $this->form_validation->set_rules('payment-mood','Payment Mood','required');
        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('msg','<div class="alert alert-danger"><i class="icon fa fa-ban"></i> Please fill up all fields carefully.</div>');
        }else{

            $grand_total = $this->input->post('grand-total');
            $customer_id = $this->input->post('customer_id');
            $discount = $this->input->post('discount');
            $payment = $this->input->post('payment');
            $exchange = $this->input->post('exchange');
            $account_id = 0;//$this->input->post('account_id');
            $mood = $this->input->post('payment-mood');
            $note = $this->input->post('note');
            $sales_id = uniqid();

            if ($cart = $this->cart->contents()):
                foreach ($cart as $item):
                    $data = array(
                        'transactionid'         => $sales_id,
                        'account_id'            => $account_id,
                        'stock_id'              => $item['id'],
                        'stock_name'            => $item['name'],
                        'category'              => $item['name'],
                        'selling_price'         => $item['price'],
                        'quantity'              => $item['qty'],
                        'amount'                => $grand_total,
                        'date'                  => date('Y-m-d H:i:s'),
                        'username'              => $this->session->userdata('username'),
                        'customer_id'           => $customer_id,
                        'subtotal'              => $item['subtotal'],
                        'payment'               => $payment,
                        'grand_total'           => $grand_total,
                        'due'                   => $exchange,
                        'mode'                  => $mood,
                        'description'           => $note

                    );      

                    // Insert product imformation with order detail, store in cart also store in database. 
                    
                     $this->db->insert('tbl_stock_sales', $data);

                     // UPDATE STOCK QUANTITY
                     $sql = $this->db->get_where('tbl_stock_details',array('id'=>$item['id']));
                     $row = $sql->result();
                     $stock = $row[0]->stock_quatity - $item['qty'];

                     $this->db->where('id',$item['id']);
                     $this->db->update('tbl_stock_details', array('stock_quatity'=>$stock));

                endforeach;

                // store info into transaction table.
                $balance = $this->inventory->get_balance($account_id);
                $new_balance = ($balance - $payment);
                $tran_data = array(
                    'account_id'=>$account_id,
                    'transaction_id'=>$sales_id,
                    'party_code'=>$customer_id,
                    'subtotal'=>$grand_total,
                    'payment'=>$payment,
                    'balance'=>$new_balance,
                    'due'=>$exchange,
                    'transaction_type'=>'sales',
                    'mode'=>$mood,
                    'note'=>$note,
                    'date'=>date('Y-m-d H:i:s'),

                    );
                $success = $this->db->insert('tbl_transactions', $tran_data);
                if($success){
                    $this->db->where('account_id',$account_id);
                    $this->db->update('tbl_accounts', array('initial_balance'=>$new_balance));
                }
            endif;
             // Destroy data which store in  session.
            $this->cart->destroy();

            $this->session->set_flashdata('msg','<div class="alert alert-success"><i class="icon fa fa-check"></i> Sale has been completed.</div>');

            redirect(base_url().'sales/invoice/'.$sales_id, 'refresh');
        }
    }

    public function get_supplier(){
        if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        
        $id = $this->input->post('id');
        $sql = $this->db->get_where('tbl_supplier',array('id'=>$id));
        $row = $sql->result();
        //var_dump($row);
        $data = array(
                'contact'=>$row[0]->phone,
                'address'=>$row[0]->address
            );
        header('Content-Type: application/json');
        echo json_encode($data);
        //echo 'hi';

    }

    public function view(){
        if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $this->cart->destroy();
        $data['page'] = 'sales';
        $this->db->group_by('transactionid');
        $data['query'] = $this->db->get('tbl_stock_sales');
        $this->load->view('view_sale',$data);

    }

    public function check_item_stock(){
        $item_id = $this->input->post('item_id');
        $qty = $this->input->post('qty');
        $curent_qty = $this->input->post('curent_qty');

        $query = $this->db->get_where('tbl_stock_details', array('id'=>$item_id));
        $res = $query->result();
        $in_stoke = $res[0]->stock_quatity;
        $total =  $qty + $curent_qty;
        if( $total <= $in_stoke ){
            echo 1;
        }
        else{
            echo 0;
        }
    }

    public function delete_sale(){
        if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $id = $this->uri->segment(3);
            $this->db->where('id', $id);
            $this->db->delete('tbl_stock_sales');
        }

    }

    public function invoice(){
        $tid = $this->uri->segment(3);
        $data['page'] = "sales";
        $data['query'] = $this->db->get_where('tbl_stock_sales',array('transactionid'=>$tid));
        $this->load->view('invoice_for_sale',$data);
    }

    public function save_as_pdf(){
        $tid = $this->uri->segment(3);
        $data['page'] = "sales";
        $data['query'] = $this->db->get_where('tbl_stock_sales',array('transactionid'=>$tid));
        //load the view and saved it into $html variable
        $html=$this->load->view('pdf/invoice', $data, true);
        $fname = 'Sales_report_'.date('Y-m-d').'.pdf';
        $this->inventory->generate_pdf($html,$fname);
    }

    public function invoice_print(){
        $tid = $this->uri->segment(3);
        $data['page'] = "sales";
        $data['query'] = $this->db->get_where('tbl_stock_sales',array('transactionid'=>$tid));
        $this->load->view('pdf/sales-invoice-print', $data);
    }

    public function edit(){
        $tid = $this->uri->segment(3);
        $query = $this->db->get_where('tbl_stock_sales', array('transactionid'=>$tid));
        $row = $query->result();
        foreach ($row as $rows) {
        $cart_data = array(
        'id'      => $rows->stock_id,
        'qty'     => $rows->quantity,
        'price'   => $rows->selling_price,
        'name'    => $rows->stock_name,
        'options' => array('stock' => $this->inventory->get_stock($rows->stock_id))
        );

        $this->cart->insert($cart_data);
        }

        $data['page'] = 'sales';
        $this->db->group_by('transactionid');
        $data['query'] = $this->db->get_where('tbl_stock_sales', array('transactionid'=>$tid));

        $this->load->view('edit_sales', $data);
    }

    function update_sales_cart(){
         if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }       
        // Recieve post values,calcute them and update
        $tid = $this->uri->segment(3);
        $cart_info =  $_POST['cart'] ;
        foreach( $cart_info as $id => $cart)
        {   
            $rowid = $cart['rowid'];
            $price = $cart['price'];
            $amount = $price * $cart['qty'];
            $qty = $cart['qty'];
                    
            $data = array(
                    'rowid'   => $rowid,
                    'price'   => $price,
                    'amount' =>  $amount,
                    'qty'     => $qty
            );
             
            $this->cart->update($data);
        }
        redirect(base_url().'sales/edit/'.$tid, 'refresh');     
    }  

    public function update_sales(){
        if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }

        $this->form_validation->set_rules('payment','Payment','required');
        $this->form_validation->set_rules('payment-mood','Payment Mood','required');
        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('msg','<div class="alert alert-danger"><i class="icon fa fa-ban"></i> Please fill up all fields carefully.</div>');
        }else{

            $grand_total = $this->input->post('grand-total');
            $customer_id = $this->input->post('customer_id');
            $payment = $this->input->post('payment');
            $exchange = $this->input->post('exchange');
            $account_id = 0;//$this->input->post('account_id');
            $mood = $this->input->post('payment-mood');
            $note = $this->input->post('note');
            $sales_id = $this->uri->segment(3);

            if ($cart = $this->cart->contents()):
                foreach ($cart as $item):
                    $data = array(
                        'account_id'            => $account_id,
                        'stock_id'              => $item['id'],
                        'stock_name'            => $item['name'],
                        'category'              => $item['name'],
                        'selling_price'         => $item['price'],
                        'quantity'              => $item['qty'],
                        'amount'                => $grand_total,
                        'username'              => $this->session->userdata('username'),
                        'customer_id'           => $customer_id,
                        'subtotal'              => $item['subtotal'],
                        'payment'               => $payment,
                        'grand_total'           => $grand_total,
                        'due'                   => $exchange,
                        'mode'                  => $mood,
                        'description'           => $note

                    );      

                    // Insert product imformation with order detail, store in cart also store in database. 
                    
                    $this->db->where('transactionid',$sales_id);
                    $this->db->update('tbl_stock_sales', $data);

                     // UPDATE STOCK QUANTITY
                     $sql = $this->db->get_where('tbl_stock_details',array('id'=>$item['stock_id']));
                     $row = $sql->result();
                     $stock = $row[0]->stock_quatity - $item['qty'];

                     $this->db->where('id',$item['stock_id']);
                     $this->db->update('tbl_stock_details', array('stock_quatity'=>$stock));

                endforeach;

                // store info into transaction table.
                $balance = $this->inventory->get_balance($account_id);
                $new_balance = ($balance - $payment);
                $tran_data = array(
                    'account_id'=>$account_id,
                    'transaction_id'=>$sales_id,
                    'party_code'=>$customer_id,
                    'subtotal'=>$grand_total,
                    'payment'=>$payment,
                    'balance'=>$new_balance,
                    'mode'=>$mood,
                    'due'=>$exchange,
                    'note'=>$note,

                    );
                $this->db->where('transaction_id',$sales_id);
                $success = $this->db->update('tbl_transactions', $tran_data);
                if($success){
                    $this->db->where('account_id',$account_id);
                    $this->db->update('tbl_accounts', array('initial_balance'=>$new_balance));
                }
            endif;
             // Destroy data which store in  session.
            $this->cart->destroy();

            $this->session->set_flashdata('msg','<div class="alert alert-success"><i class="icon fa fa-check"></i> Sale has been completed.</div>');

            redirect(base_url().'sales/invoice/'.$sales_id, 'refresh');
        }
    }

    public function show_modal(){
        if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $this->load->view('modal/modal');
    }

    public function add_payment(){
        if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        
        $this->form_validation->set_rules('account_id', 'Account Name', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        $this->form_validation->set_rules('mode', 'Payment mode', 'required');
        $this->form_validation->set_rules('note', 'Description', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        
        if($this->form_validation->run() == FALSE){
            echo '<div class="alert alert-danger"><i class="icon fa fa-ban"></i> '.validation_errors().'</div>';
         
        }else{

            $tid = $this->input->post('tid');
            $data=array(
                'account_id'=>0,//$this->input->post('account_id'),
                'transaction_id'=>$this->input->post('tid'),
                'payment'=>$this->input->post('amount'),
                'transaction_type'=>'sales',
                'note'=>$this->input->post('note'),
                'date'=>$this->input->post('date')
                );
            $success = $this->db->insert('tbl_transactions',$data);

           
           // redirect(base_url().'transaction/payment','refresh');
            if($success){
                $this->db->group_by('transactionid');
                $sql = $this->db->get_where('tbl_stock_sales',array('transactionid'=>$tid));
                $res = $sql->result();
                
                $due = $res[0]->due;
                $payment = $res[0]->payment;
                $new_payment = $payment + $this->input->post('amount');

                $due = $due - $this->input->post('amount');
                $this->db->where('transactionid',$tid);
                $this->db->update('tbl_stock_sales',array(
                    'payment'=>$new_payment,
                    'due'=>$due
                    ));

                 echo '<div class="alert alert-success"><i class="icon fa fa-check"></i> Done, Payment Added.</div>';
            }
        }
        
    }
}