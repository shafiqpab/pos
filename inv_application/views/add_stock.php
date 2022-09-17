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
        <li class="active">Add Product </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Product</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo base_url().'stock/do_add'?>" id="form_handle">
              <div class="box-body">
                <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Product Name</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3" type="text" name="stock_name" required="TRUE">
                  </div>
                </div>
                </div>
                
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Product Category</label>

                  <div class="col-sm-9">
                    <select name="cat_id" class="form-control" required="TRUE">
                      <option>Select Category</option>
                     <?php $this->inventory->get_all_stock_category();?>
                    </select>
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Re-order Level</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="number" name="reorder_level" required="TRUE">
                  </div>
                </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Supplier Price</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="number" name="cost_price" required="TRUE" step="0.01" placeholder="0.00">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Sell Price</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="number" name="sell_price" required="TRUE" step="0.01" placeholder="0.00">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Carton Price </label>

                  <div class="col-sm-9">
                    <input class="form-control" type="number" name="carton_price">
                  </div>
                </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">UOM</label>

                  <div class="col-sm-9">
                    <select name="uom" class="form-control" required="TRUE">
                      <option value="pcs" selected="">pcs</option>
                      <option value="kg">kg</option>
                      <option value="gm">gm</option>
                      <option value="dzn">Dzn</option>
                    </select>
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Current Stock</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="number" name="current_stock" required="TRUE">
                  </div>
                </div>
                </div>

                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Supplier</label>

                  <div class="col-sm-9">
                    <select name="supplier_id" class="form-control" required="TRUE">
                      <option>Select Supplier</option>
                     <?php $this->inventory->get_supplier();?>
                    </select>
                  </div>
                </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Model</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="text" name="model_no" >
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Made By</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="text" name="made_by">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Remarks</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3" type="text" name="note">
                  </div>
                </div>
                </div>
             
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Save Now</button>
              </div>
              <!-- /.box-footer -->
            </form>
            <div id="response"></div>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('includes/footer');?>
