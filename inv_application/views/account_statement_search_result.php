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
        <li class="active">Account Statement </li>
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
              <h3 class="box-title"> Search Account Statement</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo base_url().'reports/do_search'?>">
              <div class="box-body">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Account</label>

                  <div class="col-sm-9">
                    <select name="account_id" class="form-control">
                      <option value="">Select account</option>
                      <?php $this->inventory->get_accounts();?>
                    </select>
                  </div>
                </div>
                </div>
                
              
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">From Date</label>

                  <div class="col-sm-9">
                    <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                       <input class="form-control form_datetime" name="from_date" type="text">
                    </div>
                  </div>
                </div>
                </div>

                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">To Date</label>

                  <div class="col-sm-9">
                    <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                       <input class="form-control form_datetime" name="to_date" type="text">
                    </div>
                  </div>
                </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-danger">Cancel</button>
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-user"></i> Search Now</button>
              </div>
              <!-- /.box-footer -->
            </form>
            <div id="response"></div>
          </div>
          <!-- /.info-box -->

          <!-- ================================== DATA TABLE SHOW ==========================================-->
          <?php if($query->num_rows() > 0){?>
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Account Statement List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SI</th>
                  <th>Date</th>
                  <th>Description</th>
                  <th>Balance</th>
                </tr>
                </thead>
                <tbody>
                <?php $num=1; foreach($query->result() as $row){ ?>
                <tr>
                
                  <td><?php echo $num;?></td>
                  <td><?php echo $row->date; ?></td>
                  <td><?php echo $row->note;?></td>
                  <td><?php echo $row->balance; ?></td>
                  
                </tr>
                <?php $num++; } ?>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.info-box -->
          <?php }else{ ?> 
          <div class="alert alert-danger text-center">Oops, Information not available!</div>
          <?php } ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('includes/footer');?>
