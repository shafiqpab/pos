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
        <li class="active">Edit Products </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Products</h3>
            </div>
            <!-- /.box-header -->
            <?php $row = $query->result();?>
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo base_url().'stock/do_update/'.urlencode(base64_encode($row[0]->id));?>" id="form_handle">
              <div class="box-body">
                <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Product Name</label>

                  <div class="col-sm-9">
                    <input class="form-control" value="<?php echo $row[0]->stock_name; ?>" type="text" name="stock_name" required="TRUE">
                  </div>
                </div>
                </div>
                
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Product Category</label>

                  <div class="col-sm-9">
                    <select name="cat_id" class="form-control" required="TRUE">
                      <option>Select Category</option>
                     <?php $this->inventory->get_all_stock_category( $row[0]->category );?>
                    </select>
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Re-order Level</label>

                  <div class="col-sm-9">
                    <input class="form-control" value="<?php echo $row[0]->reorder_level; ?>" type="number" name="reorder_level" required="TRUE">
                  </div>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Supplier Price</label>

                  <div class="col-sm-9">
                    <input class="form-control" value="<?php echo $row[0]->company_price; ?>" type="number" name="cost_price" required="TRUE">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Sell Price</label>

                  <div class="col-sm-9">
                    <input class="form-control" value="<?php echo $row[0]->selling_price; ?>" type="number" name="sell_price" required="TRUE">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Carton Price </label>

                  <div class="col-sm-9">
                    <input class="form-control" type="number" name="carton_price" value="<?php echo $row[0]->unit_price_carton; ?>">
                  </div>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">UOM</label>

                  <div class="col-sm-9">
                    <select name="uom" id="uom" class="form-control" required="TRUE">
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
                    <input class="form-control" type="number" name="current_stock" value="<?php echo $row[0]->stock_quatity; ?>" required="TRUE">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Supplier</label>

                  <div class="col-sm-9">
                    <select name="warehouse" class="form-control" required="TRUE">
                      <option>Select Supplier</option>
                     <?php $this->inventory->get_supplier($row[0]->supplier_id);?>
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
                    <input class="form-control" type="text" name="model_no" value="<?php echo $row[0]->model_no; ?>">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Made By</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="text" name="made_by" value="<?php echo $row[0]->made_by; ?>">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Remarks</label>

                  <div class="col-sm-9">
                    <input class="form-control" value="<?php echo $row[0]->note; ?>" type="text" name="note">
                  </div>
                </div>
                </div>
              </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url().'stock'?>" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-user"></i> Update Now</button>
              </div>
              <!-- /.box-footer -->
            </form>
            <div id="response"></div>
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
    document.getElementById('uom').value='<?php echo $row[0]->uom; ?>';
  </script>
  <?php $this->load->view('includes/footer');?>
