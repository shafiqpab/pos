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
        <li class="active">System Settings</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">System Settings</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo base_url().'dashboard/do_settings_update'?>">
              <div class="box-body">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="text" name="system_name" value="<?php echo $this->db->get_where('tbl_settings' , array('type' =>'system_name'))->row()->description;?>">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Title</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="text" name="system_title" value="<?php echo $this->db->get_where('tbl_settings' , array('type' =>'system_title'))->row()->description;?>">
                  </div>
                </div>
                </div>
               <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Email</label>

                  <div class="col-sm-9">
                   <input class="form-control" type="text" name="system_email" value="<?php echo $this->db->get_where('tbl_settings' , array('type' =>'system_email'))->row()->description;?>">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Contact</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="text" name="system_mobile" value="<?php echo $this->db->get_where('tbl_settings' , array('type' =>'system_mobile'))->row()->description;?>">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Address</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="text" name="system_address" value="<?php echo $this->db->get_where('tbl_settings' , array('type' =>'system_address'))->row()->description;?>">
                  </div>
                </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <!-- <button type="reset" class="btn btn-danger">Cancel</button> -->
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

  <?php $this->load->view('includes/footer');?>
