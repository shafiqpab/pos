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
        <li class="active">Edit Expense </li>
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
              <h3 class="box-title">Edit Expense</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php $row = $query->result();?>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'transaction/update_expense/'.$row[0]->id;?>">
              <div class="box-body">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Account</label>

                  <div class="col-sm-9">
                    <select name="account_id" class="form-control" required="TRUE">
                      <option value="">Select account</option>
                      <?php $this->inventory->get_accounts( $row[0]->account_id );?>
                    </select>
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Mode</label>

                  <div class="col-sm-9">
                    <select name="mode" class="form-control">
                      <option <?php echo ($row[0]->mode == "Cash" ? "selected" : ""); ?> value="Cash">Cash</option>
                      <option <?php echo ($row[0]->mode == "Cheque" ? "selected" : ""); ?> value="Cheque">Cheque</option>
                      <option <?php echo ($row[0]->mode == "Others" ? "selected" : ""); ?> value="Others">Others</option>
                    </select>
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Amount</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="number" name="amount" required="TRUE" value="<?php echo $row[0]->payment;?>">
                  </div>
                </div>
                </div>
                
                
             <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Date</label>

                  <div class="col-sm-9">
                    <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                       <input class="form-control form_datetime" name="date" type="text" required="TRUE" value="<?php echo $row[0]->date;?>">
                    </div>
                  </div>
                </div>
                </div>

                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Description</label>

                  <div class="col-sm-9">
                    <input class="form-control"  type="text" name="note" required="TRUE" value="<?php echo $row[0]->note;?>">
                  </div>
                </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-danger">Cancel</button>
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Update Now</button>
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
