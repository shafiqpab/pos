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
        <li class="active">Edit Customer</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Customer</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php $row = $query->result();?>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'customer/do_update/'.$row[0]->id;?>" id="form_handle">
              <div class="box-body">
              
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Name</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3" type="text" name="name" required="TRUE" value="<?php echo $row[0]->name;?>">
                  </div>
                </div>
                </div>
               <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Email</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3"  type="text" name="email" value="<?php echo $row[0]->email;?>">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Mobile No</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3"  type="text" name="phone" value="<?php echo $row[0]->phone;?>">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Address</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3"  type="text" name="address" value="<?php echo $row[0]->address;?>">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Note</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3" type="text" name="note" value="<?php echo $row[0]->note;?>">
                  </div>
                </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url(); ?>customer/view" type="reset" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
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
