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
        <li class="active">Edit Employee </li>
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
              <h3 class="box-title">Edit Employee</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php $row = $query->result();?>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'employee/do_update/'.urlencode(base64_encode($row[0]->id));?>">
              <div class="box-body">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Name</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="text" name="name" value="<?php echo $row[0]->name;?>" required="TRUE">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Designation</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="text" name="designation" value="<?php echo $row[0]->designation;?>" required="TRUE">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Email</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="email" name="email" value="<?php echo $row[0]->email;?>" required="TRUE">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Mobile</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="text" name="contact" value="<?php echo $row[0]->contact;?>" required="TRUE">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Username</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="text" name="username" value="<?php echo $row[0]->username;?>" required="TRUE">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Password</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="password" name="password">
                  </div>
                </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <input class="form-control" type="text" name="address" required="TRUE" value="<?php echo $row[0]->address;?>">
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Salary</label>

                    <div class="col-sm-9">
                      <input class="form-control" type="text" name="salary" value="<?php echo $row[0]->salary;?>">
                    </div>
                  </div>
                </div>
                             
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label red">Status</label>

                    <div class="col-sm-9">
                      <select name="status" class="form-control">
                        <option value="0">Inactive</option>
                        <option value="1" selected="">Active</option>
                      </select>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-12 privileges">
                <h3>Employee Privileges</h3>
                
                  <?php 
                   $grant_module = $this->inventory->get_modules_grants( $row[0]->id );
                   
                  foreach($this->inventory->get_module_list() as $res){  
                    echo '<div class="col-sm-1">';
                    echo '<h6>'.$res->module_id.'</h6>';
                    echo '<label class="switch">';
                    ?>
                  <input <?php if(in_array($res->module_id,$grant_module)){ echo 'checked'; } ?> type="checkbox" name="grants[]" value="<?php echo $res->module_id;?>">

                 <?php 
                  echo ' <div class="slider"></div></label>';
                  echo '</div>'; 
                 } ?>
                   
                </div>
             
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url(); ?>employee" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-user"></i> Update Now</button>
              </div>
              <!-- /.box-footer -->
            </form>
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
