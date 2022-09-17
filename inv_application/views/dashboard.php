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
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-building"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Warehouse</span>
              <span class="info-box-number">
              <?php echo $this->db->get('tbl_warehouse')->num_rows();?>
                
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-group"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tatal Supplier</span>
              <span class="info-box-number">
                <?php echo $this->db->get('tbl_supplier')->num_rows();?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Customer</span>
              <span class="info-box-number">
                <?php echo $this->db->get('tbl_customer')->num_rows();?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Employee</span>
              <span class="info-box-number">
                <?php echo $this->db->get('tbl_supplier')->num_rows();?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-6">
          <div id="g_render"  class="left">
          <?php if (isset($charts)) echo $charts; ?>
         
        </div>
        </div>
        <div class="col-md-6">
          <div id="g_render"  class="left">
          <?php if (isset($balance)) echo $balance; ?>
         
        </div>
        </div>
        <div style="margin: 15px 0"></div>
        <div class="col-md-12">
          
          <div id="g_render"  class="right">
          <?php if (isset($bar)) echo $bar; ?>

        </div>

        </div>
      </div>
      <div style="margin: 15px 0"></div>
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
          <!-- TABLE: LATEST ORDERS -->
          <?php if($query->num_rows() > 0){?>
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Search Result</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SI</th>
                  <th>Account Name</th>
                  <th>Quantity</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $num=1; foreach($query->result() as $row){ ?>
                <tr>
                  <td><?php echo $num;?></td>
                  <td><?php echo $this->inventory->get_single_accounts( $row->account_id );?></td>
                  <td><?php echo $row->quantity;?></td>
                  <td><?php echo $row->grand_total;?></td>
                  <td><?php echo $this->inventory->check_payment_status($row->transactionid, 'sales');?></td>
                  <td><?php echo $row->date;?></td>
                  <td><div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url().'sales/invoice/'.$row->transactionid;?>"><i class="fa fa-eye"></i> View</a></li>
                    <li><a href="<?php echo base_url().'sales/edit/'.$row->id;?>"><i class="fa fa-edit"></i> Edit</a></li>
                    <li><a class="deletebtn" href="<?php echo base_url().'sales/delete_sale/'.$row->id;?>"><i class="fa fa-trash"></i> Delete</a></li>
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
          <?php }else{ ?> 
          <div class="alert alert-danger">Information not available!</div>
          <?php }?>
          <?php //print_r($this->inventory->get_month_name());?>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('includes/footer');?>
