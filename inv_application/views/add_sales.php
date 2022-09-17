<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('includes/header');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Shop Cart
        <small>Version 1.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
        <?php echo $this->session->flashdata('msg');?>
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Sales</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" id="cart_form" action="<?php echo base_url().'sales/add_to_cart'?>">
              <div class="box-body">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Find / Scan Item</label>

                  <div class="col-sm-4">
                    <input class="form-control" id="item" type="text" name="item" autocomplete="off">
                    <div id="suggesstion-box"></div>
                  </div>
                </div>
                </div>
               
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.info-box -->

          <!-- ================================== DATA TABLE SHOW ==============================================-->
          <div class="box box-info">
            
            <div class="box-body">
            <?php  //if (count( $this->cart->contents()) > 0 ){ ?>
            <form method="post" action="<?php echo base_url().'sales/update_cart'?>" id="update_cart">

              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Item #</th>
                  <th>Item Name</th>
                  <th>Price</th>
                  <th>Qty.</th>
                  <th>Stock</th>
                  <th>Total</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody id="detail_cart">                
                
                </tbody>
              </table>
              <div class="box-footer text-right">
              <button type="submit" class="btn btn-primary ">Update Items</button>
              </button>
              </form>
              <hr> <!-- ======================== PURCHASE SBMIT FORM =================================== -->
              <form class="form-horizontal" method="post" id="purchase_item_form" action="<?php echo base_url().'sales/save_sales';?>">
              <div class="box-body">
              <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Customer</label>

                  <div class="col-sm-8">
                    <select name="customer_id" class="form-control" required="TRUE" id="supplier">
                      <option>Select Customer</option>
                     <?php $this->inventory->get_customer();?>
                    </select>
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Contact </label>

                  <div class="col-sm-8">
                    <input class="form-control"  type="text" name="contact" id="scontact">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Address</label>

                  <div class="col-sm-8">
                    <input class="form-control" type="text" name="address" id="saddress">
                  </div>
                </div>
                </div>
              </div>
             <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Total Amount</label>

                  <div class="col-sm-8">
                    <input class="form-control" id="total" type="number" name="grand-total" readonly="" value="<?php echo @$grand_total; ?>">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Discount</label>

                  <div class="col-sm-8">
                    <input class="form-control" id="discount_amount" name="discount_amount" type="number">
                  </div>
                </div>
                </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Payment</label>

                  <div class="col-sm-8">
                    <input class="form-control" id="payment" name="payment" type="number" required="TRUE">
                  </div>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Due/Return</label>

                  <div class="col-sm-8">
                    <input class="form-control" id="payment_return" readonly="" name="exchange" type="number">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Pay Mood</label>

                  <div class="col-sm-8">
                    <select name="payment-mood" class="form-control">
                      <option value="Cash">Cash</option>
                      <option value="Cheque">Cheque</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Remarks</label>

                  <div class="col-sm-8">
                    <input class="form-control" id="" type="text" name="note">
                  </div>
                </div>
                </div>
              </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" id="deleteAll" data-action="sales" class="btn btn-danger">Clear All</button>&nbsp;

                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Submit Purchase</button>
              </div>
              <!-- /.box-footer -->
            </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.info-box -->


        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('includes/footer');?>
