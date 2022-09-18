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
        <li class="active">Add Purchase</li>
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
              <div class="col-md-3">
                <h3 class="box-title"><i class="fa fa-plus-circle"></i> Add Purchase</h3>
              </div>
              <div class="col-md-9">
                
              </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" id="cart_form" action="<?php echo base_url().'purchase/add_to_cart'?>">
              <div class="box-body">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Find / Scan Item</label>

                  <div class="col-sm-4">
                    <input class="form-control" id="items" type="text" name="item" autocomplete="off">
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
            
            <form method="post" action="<?php echo base_url().'purchase/update_cart'?>" id="update_cart">

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
              <button type="submit" class="btn btn-primary "><i class="fa fa-edit"></i> Update Items</button>
              </button>
              </form>
              <hr> <!-- ======================== PURCHASE SBMIT FORM =================================== -->
              <form class="form-horizontal" method="post" id="purchase_item_form" action="<?php echo base_url().'purchase/save_purchase';?>">
              <div class="box-body">
                <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label red">Supplier</label>

                    <div class="col-sm-8">
                      <select name="supplier_id" class="form-control" required="TRUE" id="supplier">
                        <option>Select Supplier</option>
                      <?php $this->inventory->get_supplier();?>
                      </select>
                    </div>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Mobile </label>

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
                  <label for="inputEmail3" class="col-sm-4 control-label">Grand Total</label>

                  <div class="col-sm-8">
                    <input class="form-control" id="total" type="number" name="grand-total" readonly="" value="<?php echo @$grand_total; ?>">
                  </div>
                </div>
                </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label red">Payment</label>

                  <div class="col-sm-8">
                    <input class="form-control" id="payment" name="payment" type="number" required="TRUE">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Due/Return</label>

                  <div class="col-sm-8">
                    <input class="form-control" id="payment_return" readonly="" name="exchange" type="number">
                  </div>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label red">Receiving Mode</label>

                  <div class="col-sm-8">
                      <select name="transaction_type" class="form-control" required="true">
                      <option value="return">Return</option>
                      <option value="receive" selected="selected">Receive</option>
                      <option value="requisition">Requisition</option>
                    </select>
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label red">Pay Mood</label>

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
                    <input class="form-control" id="" type="text" name="note" required="TRUE">
                  </div>
                </div>
                </div>
              </div>
              <div class="row">                
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label red">Warehouse</label>

                  <div class="col-sm-8">
                    <select name="warehouse_id" class="form-control" required="TRUE">
                      <option>Select Warehouse</option>
                     <?php $this->inventory->get_warehouse();?>
                    </select>
                  </div>
                </div>
                </div>
              </div>
              
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" id="deleteAll" data-action="purchase" class="btn btn-danger"><i class="fa fa-trash"></i> Clear All</button>&nbsp;

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
