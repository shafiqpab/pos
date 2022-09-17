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
        <li class="active">All Transactions </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
        <?php echo $this->session->flashdata('msg');?>
          
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">All Transactions List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SI</th>
                  <th>Date</th>
                  <th>Account</th>
                  <th>Amount</th>
                  <th>Type</th>
                  <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <?php $total=0; $num=1; foreach($query->result() as $row){ ?>
                <tr>
                
                  <td><?php echo $num;?></td>
                  <td><?php echo $row->date;?></td>
                  <td><?php echo $this->inventory->get_single_accounts( $row->account_id );?></td>
                  <td><?php echo $row->payment;?></td>
                  <td><?php echo $row->transaction_type; ?></td>
                  <td><?php echo $row->note; ?></td>
                </tr>
                <?php $total+=$row->payment; $num++; } ?>
                </tfoot>
              </table>
              <h4>Total : <?php echo $total; ?></h4>
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
