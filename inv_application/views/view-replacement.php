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
        <li class="active">View Replacement</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Replacement Item List </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped" width="100%">
                <thead>
                <tr>
                  <th width="3%">SI</th>
                  <th width="28%">Name</th>
                  <th width="10%">Mobile</th>
                  <th width="25%">Item</th>
                  <th width="5%">Qty</th>
                  <th width="10%">Rcv. Date</th>
                  <th width="10%">Rtn. Date</th>
                  <th width="10%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $num=1; foreach($query->result() as $row){ ?>
                <tr>
                  <td><?php echo $num;?></td>
                  <td><?php echo $row->customer_name;?></td>
                  <td><?php echo $row->mobile;?></td>
                  <td><?php echo $row->product_name;?></td>
                  <td align="right"><?php echo $row->item_qnty;?></td>
                  <td align="center"><?php echo date('d-M-Y',strtotime($row->receive_date));?></td>
                  <td align="center"><?php echo date('d-M-Y',strtotime($row->delivery_date));?></td>
                  <td><div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <?php
                      $cid = urlencode(base64_encode($row->id));
                    ?>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url().'replacement/view/'.$cid;?>"><i class="fa fa-edit"></i> Details</a></li>
                    <li><a href="<?php echo base_url().'replacement/return/'.$cid;?>"><i class="fa fa-edit"></i> Return</a></li>
                    <li><a href="<?php echo base_url().'replacement/edit/'.$cid;?>"><i class="fa fa-edit"></i> Edit</a></li>
                    <li><a class="deletebtn" href="<?php echo base_url().'replacement/delete/'.$cid;?>"><i class="fa fa-trash"></i> Delete</a></li>
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
