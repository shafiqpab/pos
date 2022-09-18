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
        <li class="active">Add Warehouse</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Warehouse</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo base_url().'warehouse/do_add'?>" id="form_handle">
              <div class="box-body">
                <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Name</label>

                    <div class="col-sm-9">
                      <input class="form-control" id="inputEmail3" type="text" name="warehouse" required="TRUE">
                    </div>
                  </div>
                  </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Mobile No</label>

                    <div class="col-sm-9">
                      <input class="form-control" id="inputEmail3" type="text" name="phone_no" required="TRUE">
                    </div>
                  </div>
                  </div>
                </div>

                <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                     <input class="form-control" id="inputEmail3" type="text" name="address" required="TRUE">
                    </div>
                  </div>
                  </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Status</label>

                    <div class="col-sm-9">
                    <select name="status" class="form-control">
                      <option value="0">Select</option>
                      <option value="1">Active</option>
                      <option value="2">Inactive</option>
                    </select>
                    </div>
                  </div>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Save</button>
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
