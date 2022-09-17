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
        <li class="active">Add Expense </li>
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
              <h3 class="box-title">Add Expense</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo base_url().'transaction/add_expense'?>">
              <div class="box-body">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Account</label>

                  <div class="col-sm-9">
                    <select name="account_id" class="form-control" required="TRUE">
                      <option value="">Select account</option>
                      <?php $this->inventory->get_accounts();?>
                    </select>
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Mode</label>

                  <div class="col-sm-9">
                    <select name="mode" class="form-control" required="TRUE">
                      <option value="">Select payment mode</option>
                      <option value="Cash">Cash</option>
                      <option value="Cheque">Cheque</option>
                      <option value="Othres">Othres</option>
                    </select>
                  </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Amount</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="number" name="amount" required="TRUE">
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
                       <input class="form-control form_datetime" name="date" type="text" required="TRUE">
                    </div>
                  </div>
                </div>
                </div>
                
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Description</label>

                  <div class="col-sm-9">
                    <input class="form-control"  type="text" name="note" required="TRUE">
                  </div>
                </div>
                </div>
             
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-danger">Cancel</button>
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-user"></i> Add Now</button>
              </div>
              <!-- /.box-footer -->
            </form>
            <div id="response"></div>
          </div>
          <!-- /.info-box -->

          <!-- ================================== DATA TABLE SHOW ==============================================-->
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Expense List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SI</th>
                  <th>Description</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $num=1; foreach($query->result() as $row){ ?>
                <tr>
                
                  <td><?php echo $num;?></td>
                  <td><?php echo $row->note;?></td>
                  <td><?php echo $row->payment;?></td>
                  <td><?php echo $row->date; ?></td>
                  
                  <td width="100"><div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url().'transaction/expense_edit/'.$row->id;;?>"><i class="fa fa-edit"></i> Edit</a></li>
                    <li><a class="deletebtn" href="<?php echo base_url().'transaction/delete/'.$row->id;?>"><i class="fa fa-trash"></i> Delete</a></li>
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
