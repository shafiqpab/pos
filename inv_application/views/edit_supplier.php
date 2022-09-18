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
        <li class="active">Edit Supplier</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Supplier</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php $row = $query->result();?>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'supplier/do_update/'.urlencode(base64_encode($row[0]->id));?>" id="form_handle">
              <div class="box-body">
              
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Name</label>

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
                  <label for="inputEmail3" class="col-sm-3 control-label">Mobile No</label>

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
                  <label for="inputEmail3" class="col-sm-3 control-label">Company</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3" type="text" name="com_name" value="<?php echo $row[0]->com_name;?>">
                  </div>
                </div>
                </div>
                             
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label red">Status</label>

                    <div class="col-sm-9">
                      <select name="status" class="form-control">
                        <option <?php echo $row[0]->status==0 ? "selected" : "";?> value="0">Inactive</option>
                        <option <?php echo $row[0]->status==1 ? "selected" : "";?> value="1" >Active</option>
                      </select>
                    </div>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url(); ?>supplier/view" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-user"></i> save Now</button>
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
