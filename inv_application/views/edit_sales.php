<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('includes/header');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        BIMS
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
          <!-- ================================== DATA TABLE SHOW ==============================================-->
          <div class="box box-info">
             <div class="box-header with-border">
              <h3 class="box-title">Edit Sales</h3>
            </div>
            <div class="box-body">
            <?php  if (count( $this->cart->contents()) > 0 ){ ?>
            <form method="post" action="<?php echo base_url().'sales/update_sales_cart/'.$this->uri->segment(3);?>">

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
                <tbody>
                <?php  $grand_total = 0; $num=1; foreach($this->cart->contents() as $items){ 

                  echo form_hidden('cart[' . $items['id'] . '][id]', $items['id']);
                  echo form_hidden('cart[' . $items['id'] . '][rowid]', $items['rowid']);
                  echo form_hidden('cart[' . $items['id'] . '][name]', $items['name']);
                  echo form_hidden('cart[' . $items['id'] . '][price]', $items['price']);
                  echo form_hidden('cart[' . $items['id'] . '][qty]', $items['qty']);
            ?>
                <tr>
                
                  <td><?php echo $num;?></td>
                  <td><?php echo $items['name'];?></td>
                  <td><?php echo $items['price'];?></td>
                  <td><input type="text" data-itemid="<?php echo $items['id'];?>" id="item_qty" value="<?php echo $items['qty'];?>" name="cart[<?php echo $items['id'];?>][qty]" size="3"></td>
                  <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                  <td><?php echo $option_value; ?></td>
                   <?php endforeach; ?>
                  <td><?php echo $items['subtotal'];?></td>
                  
                <td width="100">
                  <div class="btn-group">
                  <a href="<?php echo base_url().'sales/delete/'.$items['rowid'];?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </div>
                </td>
                </tr>
                <?php 
                $grand_total = $grand_total + $items['subtotal'];
                $num++; 

                } ?>
                
                </tfoot>
              </table>
              <div class="box-footer text-right">
              <button type="submit" class="btn btn-primary ">Update Items</button>
              </button>
              </form>
              <hr>
               <!-- ======================== PURCHASE SBMIT FORM =================================== -->
               <?php $row = $query->result();?>
              <form class="form-horizontal" method="post" id="purchase_item_form" action="<?php echo base_url().'sales/update_sales/'.$row[0]->transactionid;?>">
              <div class="box-body">
              

              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Customer</label>

                  <div class="col-sm-8">
                    <select name="customer_id" class="form-control" required="TRUE" id="supplier">
                      <option>Select Customer</option>
                     <?php $this->inventory->get_customer($row[0]->customer_id);?>
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
             
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Grand Total</label>

                  <div class="col-sm-8">
                    <input class="form-control" id="total" type="number" name="grand-total" readonly="" value="<?php echo $grand_total; ?>">
                  </div>
                </div>
                </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Payment</label>

                  <div class="col-sm-8">
                    <input class="form-control" value="<?php echo $row[0]->payment; ?>" id="payment" name="payment" type="number" required="TRUE">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Due/Return</label>

                  <div class="col-sm-8">
                    <input class="form-control" id="payment_return" readonly="" name="exchange" value="<?php echo $row[0]->due; ?>" type="number">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Account</label>

                  <div class="col-sm-8">
                    <select name="account_id" id="account" class="form-control" required="true">
                      <option value="">Select account</option>
                      <?php $this->inventory->get_accounts($row[0]->account_id);?>
                    </select>
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Mood</label>

                  <div class="col-sm-8">
                    <select name="payment-mood" class="form-control">
                      <option <?php echo ($row[0]->mode == "Cash" ? "selected" : ""); ?> value="Cash">Cash</option>
                      <option <?php echo ($row[0]->mode == "Cheque" ? "selected" : ""); ?> value="Cheque">Cheque</option>
                      <option <?php echo ($row[0]->mode == "Other" ? "selected" : ""); ?> value="Other">Other</option>
                    </select>
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Note</label>

                  <div class="col-sm-8">
                    <input class="form-control" value="<?php echo $row[0]->description; ?>" type="text" name="note" required="TRUE">
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
                <button type="button" id="deleteAll" data-action="sales" class="btn btn-danger">Clear All</button>&nbsp;

                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Submit Purchase</button>
              </div>
              <!-- /.box-footer -->
            </form>



              <?php }else{ ?>
              <div class="alert alert-danger text-center">Oops, Your cart is empty!</div>
               <?php } ?>
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
  <script type="text/javascript">
    document.getElementById('warehouse_id').value='<?php echo $row[0]->warehouse; ?>';
  </script>

  <?php $this->load->view('includes/footer');?>
