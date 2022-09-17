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
        <li class="active">Add Replacement</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Replacement</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo base_url().'replacement/do_add'?>" id="form_handle">
              <div class="box-body">
                <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Customer Name</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3" type="text" name="cname" required="TRUE">
                  </div>
                </div>
                </div>
               <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Email</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3"  type="email" name="email">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Mobile No</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3"  type="text" name="mobile" required="TRUE">
                  </div>
                </div>
                </div>
              </div>
               <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Address</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3"  type="text" name="address">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Item Name</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3"  type="text" name="item_name">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Model</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3"  type="text" name="model">
                  </div>
                </div>
                </div>
              </div>

               <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Item Code</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3"  type="text" name="item_code">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Quantity</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3"  type="number" name="quantity">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Replacement Charge</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3"  type="number" name="charge">
                  </div>
                </div>
                </div>
              </div>
               <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Receive Date</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3"  type="text" name="receive_date">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Delivery Date</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3"  type="text" name="delivery_date">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Rearks</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3" type="text" name="remarks">
                  </div>
                </div>
                </div>
              </div>
              

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url(); ?>customer" type="reset" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Save Now</button>
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

  <?php $this->load->view('includes/footer');?>
