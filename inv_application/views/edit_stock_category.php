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
        <li class="active">Edit Stock Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Stock Category</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php $row = $query->result(); ?>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'stock/do_update_cat/'.urlencode(base64_encode($row[0]->id)); ?>" id="form_handle">
              <div class="box-body">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Category Name</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3" value="<?php echo $row[0]->name;?>" type="text" name="cat_name" required="TRUE">
                  </div>
                </div>
                </div>
                <?php if($row[0]->parent_id != 0 ){?>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Parent Category</label>

                  <div class="col-sm-9">
                    <select name="parent_id" class="form-control">
                      <option value="">Select Parent Category</option>
                      <?php $this->inventory->get_stock_category($row[0]->parent_id); ?>
                    </select>
                  </div>
                </div>
                </div>
                <?php } ?>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Description</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3" type="text" value="<?php echo $row[0]->name;?>" name="description" required="TRUE">
                  </div>
                </div>
                </div>
             
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?php echo base_url().'stock/add_category'?>" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Save Now</button>
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
