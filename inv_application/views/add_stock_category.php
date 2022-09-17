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
        <li class="active">Add Product Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Product Category</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo base_url().'stock/do_add_category'?>" id="form_handle">
              <div class="box-body">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Category Name</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3" type="text" name="cat_name" required="TRUE">
                  </div>
                </div>
                </div>
                <?php if($query->num_rows() > 0 ){?>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Parent Category</label>

                  <div class="col-sm-9">
                    <select name="parent_id" class="form-control">
                      <option>Select Parent Category</option>
                      <?php foreach($query->result() as $row){?>
                        <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                </div>
                <?php } ?>
                <div class="col-md-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Remarks</label>

                  <div class="col-sm-9">
                    <input class="form-control" id="inputEmail3" type="text" name="description" required="TRUE">
                  </div>
                </div>
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
              <h3 class="box-title">Product Category List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SI</th>
                  <th>Category Name</th>
                  <th>Parent</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $num=1; foreach($query2->result() as $row){ ?>
                <tr>
                
                  <td><?php echo $num;?></td>
                  <td><?php echo $row->name;?></td>
                  <td><?php echo $this->inventory->get_parent($row->parent_id);?></td>
                  <td><?php echo $row->description;?></td>

                  <td width="100"><div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                    <?php
                      $id = urlencode(base64_encode($row->id));
                    ?>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url().'stock/cat_edit/'.$id;;?>"><i class="fa fa-edit"></i> Edit</a></li>
                    <li><a class="deletebtn" href="<?php echo base_url().'stock/cat_delete/'.$id;?>"><i class="fa fa-trash"></i> Delete</a></li>
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
