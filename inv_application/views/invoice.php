<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('includes/header');?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>#007612</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row page-header">
        <div class="col-xs-2">
          <h2 class="">
            <i class="fa fa-globe"></i> BIMS.
          </h2>
        </div>

        <div class="col-xs-10 text-right">
          <a target="_blank" href="<?php echo base_url().'purchase/invoice_print/'.$this->uri->segment(3);?>" class="btn btn-info"><i class="fa fa-print"></i> Print</a>
           <a href="<?php echo base_url().'purchase/save_as_pdf/'.$this->uri->segment(3);?>" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> PDF</a>
          <a href="javascript:void(0)" data-controller="purchase" data-tid="<?php echo $this->uri->segment(3);?>" class="btn btn-success" id="load_modal"><i class="fa fa-plus"></i> Add Payment</a>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
          <h4>Invoice To,</h4>
          <address>
          <?php $sinfo = $this->inventory->get_supplier_info($this->uri->segment(3));?>
            <strong><?php echo $sinfo[0]->name;?></strong><br>
            <?php echo $sinfo[0]->address;?><br>
            Phone: <?php echo $sinfo[0]->phone;?><br>
            Email: <?php echo $sinfo[0]->email;?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-6 invoice-col ">
          
          <address class="pull-right">
          <h4>Invoice From</h4>
            <strong><?php echo $this->inventory->get_company_info('system_name');?></strong><br>
            <?php echo $this->inventory->get_company_info('system_address');?><br>
            Phone: <?php echo $this->inventory->get_company_info('system_mobile');?><br>
            Email: <?php echo $this->inventory->get_company_info('system_email');?>
            <h4>Date : <?php echo date('F j, Y');?></h4>
          </address>
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
            <th>SI#</th>
              <th>Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <?php $grand_total = 0; $num=1; foreach($query->result() as $items){  ?>
            <tr>
             <td><?php echo $num;?></td>
                  <td><?php echo $this->inventory->get_item_name( $items->stock_id );?></td>
                  <td><?php echo $items->selling_price;?></td>
                  <td><?php echo $items->quantity;?></td>
                  <td><?php echo $items->subtotal;?></td>
            </tr>
            <?php $grand_total = $grand_total + $items->subtotal; $num++;  } ?>
            
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods: <?php echo $this->inventory->get_payment_mood($this->uri->segment(3));?></p>
          
        </div>
        <!-- /.col -->
        <div class="col-xs-6">

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td><?php echo $grand_total ?></td>
              </tr>
              <tr>
                <th>Tax <?php echo '0%'; ?></th>
                <td>0</td>
              </tr>
              
              <tr>
                <th>Total:</th>
                <td><?php echo $grand_total ?></td>
                
              </tr>
                <tr>
                <th>Payment:</th>
                <td><?php echo $paymeny = $this->inventory->get_total_payment($this->uri->segment(3)) ?></td>
                
              </tr>
              <tr>
                <th>Amount Due:</th>
                <td><?php echo $grand_total - $paymeny; ?></td>
                
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->
  <div id="modal_show" class="modal fade" tabindex="-1"></div>
    <?php $this->load->view('includes/footer');?>