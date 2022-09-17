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
        <li class="active">Add Employee </li>
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
              <h3 class="box-title">Add Employee</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo base_url().'employee/do_add'?>">
              <div class="box-body">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Name</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="text" name="name" required="TRUE">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Designation</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="text" name="designation" required="TRUE">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Email</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="email" name="email" required="TRUE">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label red">Mobile</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="text" name="contact" required="TRUE">
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label red">Username</label>

                    <div class="col-sm-9">
                      <input class="form-control" type="text" name="username" required="TRUE">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label red">Password</label>

                    <div class="col-sm-9">
                      <input class="form-control" type="password" name="password" required="TRUE">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <input class="form-control" type="text" name="address" required="TRUE">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Salary</label>

                    <div class="col-sm-9">
                      <input class="form-control" type="text" name="salary">
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
                <h3 class="red">Employee Privileges</h3>
               
                  
                  <?php foreach($this->inventory->get_module_list() as $res){  
                  echo '<div class="col-sm-1">';
                  echo '<h6>'.$res->module_id.'</h6>';
                  echo '<label class="switch">';
                  echo '<input type="checkbox" name="grants[]" value="'.$res->module_id.'">';
                  echo ' <div class="slider"></div></label>';
                  echo '</div>';
                   } ?>
                    
                  
                
                </div>
             
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i> Reset</button>
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Save Now</button>
              </div>
              <!-- /.box-footer -->
            </form>
            <div id="response"></div>
          </div>
          <!-- /.info-box -->

          <!-- ================================== DATA TABLE SHOW ==============================================-->
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Employee List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SI</th>
                  <th> Name</th>
                  <th>Designation</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $num=1; foreach($query->result() as $row){ ?>
                <tr>
                
                  <td><?php echo $num;?></td>
                  <td><?php echo $row->name;?></td>
                  <td><?php echo $row->designation;?></td>
                  <td><?php echo $row->email; ?></td>
                  <td><?php echo $row->contact;?></td>
                  <td width="100"><div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                    <?php
                      $b64_uid = urlencode(base64_encode($row->id));
                    ?>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url().'employee/edit/'.$b64_uid;?>"><i class="fa fa-edit"></i> Edit</a></li>
                    <li><a class="deletebtn" href="<?php echo base_url().'employee/delete/'.$b64_uid;?>"><i class="fa fa-trash"></i> Delete</a></li>
                  </ul>
                </div></td>
                </tr>
                <?php $num++; } ?>
                </tfoot>
              </table>
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
