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
        <li class="active">View Customer</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Supplier List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SI</th>
                  <th> Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Company</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $num=1; foreach($query->result() as $row){ ?>
                <tr>
                  <td><?php echo $num;?></td>
                  <td><?php echo $row->name;?></td>
                  <td><?php echo $row->email;?></td>
                  <td><?php echo $row->phone;?></td>
                  <td><?php echo $row->address;?></td>
                  <td><?php echo $row->com_name;?></td>
                  <td><div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                    <?php
                      $id = urlencode(base64_encode($row->id));
                    ?>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url().'supplier/edit/'.$id;;?>"><i class="fa fa-edit"></i> Edit</a></li>
                    <li><a class="deletebtn" href="<?php echo base_url().'supplier/delete/'.$id;?>"><i class="fa fa-trash"></i> Delete</a></li>
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
