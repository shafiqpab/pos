<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-2">
          <h2 class="">
            <i class="fa fa-globe"></i> BIMS.
          </h2>
        </div>      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-6 invoice-col">
          <h4>Invoice To,</h4>
          <address>
          <?php $sinfo = $this->inventory->get_customer_info($this->uri->segment(3));?>
            <strong><?php echo @$sinfo[0]->name;?></strong><br>
            <?php echo $sinfo[0]->address;?><br>
            Phone: <?php echo $sinfo[0]->phone;?><br>
            Email: <?php echo $sinfo[0]->email;?>
          </address>

        </div>
      <!-- /.col -->
      <div class="col-sm-6 invoice-col ">
          
          <address class="pull-right">
          <h4>Invoice From</h4>
            <strong><?php echo $this->inventory->get_company_info('system_name');?></strong><br>
            <?php echo $this->inventory->get_company_info('system_address');?><br>
            Phone: <?php echo $this->inventory->get_company_info('system_mobile');?><br>
            Email: <?php echo $this->inventory->get_company_info('system_email');?>
            <h4 class="">Date: <?php echo date('F j, Y');?></h4>
          </address>

        </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
            <th>SI#</th>
              <th>Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <?php $grand_total = 0; $num=1; foreach($query->result() as $items){  ?>
            <tr>
             <td><?php echo $num;?></td>
                  <td><?php echo $this->inventory->get_item_name( $items->stock_id );?></td>
                  <td><?php echo $items->selling_price;?></td>
                  <td><?php echo $items->quantity;?></td>
                  <td><?php echo $items->subtotal;?></td>
            </tr>
            <?php $grand_total = $grand_total + $items->subtotal; $num++;  } ?>
            
            </tbody>
          </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
          <p class="lead">Payment Methods: <?php echo $this->inventory->get_payment_mood_sales($this->uri->segment(3));?></p>
          
        </div>
      <!-- /.col -->
      <div class="col-xs-6">

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td><?php echo $grand_total ?></td>
              </tr>              
              <tr>
                <th>Total:</th>
                <td><?php echo $grand_total ?></td>
                
              </tr>
                <tr>
                <th>Payment:</th>
                <td><?php echo $paymeny = $this->inventory->get_total_payment($this->uri->segment(3)) ?></td>
                
              </tr>
              <tr>
                 <th><?php echo $grand_total - $paymeny >0 ? "Due " : "Return "; ?> Amount:</th>
                <td><?php echo $grand_total - $paymeny; ?></td>
                
              </tr>
            </table>
          </div>
        </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<script type="text/javascript">
  window.print();
  window.onfocus=function(){ window.close();}
</script>
</body>
</html>
