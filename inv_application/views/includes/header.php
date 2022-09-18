<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Shop Cart | Inventory Management Master</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"> -->
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/AdminLTE.min.css">
   <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css">

  <script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-3.3.1.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<script type="text/javascript">
  var baseurl = '<?php echo base_url();?>';
</script>
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url().'dashboard';?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Shop</b> Cart</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url();?>assets/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('username');?> <i class="fa fa-angle-down"></i></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url();?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->userdata('username');?>
                  
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url();?>dashboard/change_password" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url();?>login/do_signout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview <?php echo (@$page == 'dashboard' ? 'active' : '');?>">
          <a href="<?php echo base_url().'dashboard'?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <?php if( $this->inventory->check_permission('employees',$this->session->userdata('id')) ){?>
        <li class="treeview <?php echo (@$page == 'employee' ? 'active' : '');?>">
          <a href="<?php echo base_url().'employee';?>">
            <i class="fa fa-group"></i>
            <span>Employee</span>
            
          </a>
         
        </li>
        <?php } if( $this->inventory->check_permission('customer',$this->session->userdata('id')) ){?>

        <li class="treeview <?php echo (@$page == 'customer' ? 'active' : '');?>">
          <a href="#">
            <i class="fa fa-group"></i>
            <span>Customer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'customer';?>"><i class="fa fa-plus"></i> Add Customer</a></li>
            <li><a href="<?php echo base_url().'customer/view'?>"><i class="fa fa-eye"></i> Manage Customer</a></li>
          </ul>
        </li>
        <?php } if( $this->inventory->check_permission('suppliers',$this->session->userdata('id')) ){?>
        <li class="treeview <?php echo (@$page == 'supplier' ? 'active' : '');?>">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Supplier</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'supplier';?>"><i class="fa fa-plus"></i> Add Supplier</a></li>
            <li><a href="<?php echo base_url().'supplier/view';?>"><i class="fa fa-eye"></i> Manage Supplier</a></li>
          </ul>
        </li>
        <?php } if( $this->inventory->check_permission('warehouse',$this->session->userdata('id')) ){?>
        <li class="treeview <?php echo (@$page == 'warehouse' ? 'active' : '');?>">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Warehouse</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'warehouse';?>"><i class="fa fa-plus"></i> Add Warehouse</a></li>
            <li><a href="<?php echo base_url().'warehouse/view';?>"><i class="fa fa-eye"></i> Manage Warehouse</a></li>
          </ul>
        </li>
        <?php } if( $this->inventory->check_permission('stock',$this->session->userdata('id')) ){?>
        <li class="treeview <?php echo (@$page == 'stock' ? 'active' : '');?>">
          <a href="#">
            <i class="fa fa-gift"></i>
            <span>Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            <li><a href="<?php echo base_url().'stock/add_category';?>"><i class="fa fa-plus"></i> Add Products Category</a></li>
            <li><a href="<?php echo base_url().'stock/addstock';?>"><i class="fa fa-plus"></i> Add Product</a></li>
            <li><a href="<?php echo base_url().'stock';?>"><i class="fa fa-gift"></i> Manage Products</a></li>
          </ul>
        </li>
        <?php } if( $this->inventory->check_permission('purchase',$this->session->userdata('id')) ){?>
        <li class="treeview <?php echo (@$page == 'purchase' ? 'active' : '');?>">
          <a href="#">
            <i class="fa fa-shopping-cart"></i>
            <span>Purchase</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'purchase';?>"><i class="fa fa-plus"></i> New Purchase</a></li>
            <li><a href="<?php echo base_url().'purchase/view';?>"><i class="fa fa-eye"></i> Manage Purchase</a></li>
          </ul>
        </li>
        <?php } if( $this->inventory->check_permission('sales',$this->session->userdata('id')) ){?>
        <li class="treeview <?php echo (@$page == 'sales' ? 'active' : '');?>">
          <a href="#">
            <i class="fa fa-shopping-cart"></i>
            <span>Sales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'sales';?>"><i class="fa fa-plus"></i> New Sales</a></li>
            <li><a href="<?php echo base_url().'sales/view';?>"><i class="fa fa-eye"></i> Manage Sales</a></li>
          </ul>
        </li>

      <?php } if( $this->inventory->check_permission('replacement',$this->session->userdata('id')) ){?>
        <li class="treeview <?php echo (@$page == 'replacement' ? 'active' : '');?>">
          <a href="#">
            <i class="fa fa-shopping-cart"></i>
            <span>Replacement</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'replacement';?>"><i class="fa fa-plus"></i> Receive Item</a></li>
            <li><a href="<?php echo base_url().'replacement/manage_receive';?>"><i class="fa fa-eye"></i> Manage Receive</a></li>
            <li><a href="<?php echo base_url().'replacement/manage_return';?>"><i class="fa fa-eye"></i> Manage Return</a></li>
          </ul>
        </li>
        <?php } if( $this->inventory->check_permission('expense',$this->session->userdata('id')) ){?>
        <li class="treeview <?php echo (@$page == 'expense' ? 'active' : '');?>">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Expense</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'expense';?>"><i class="fa fa-plus"></i> Add Expense</a></li>
            <li><a href="<?php echo base_url().'expense/view';?>"><i class="fa fa-eye"></i> Manage Expense</a></li>
          </ul>
        </li>
        <?php } if( $this->inventory->check_permission('reports',$this->session->userdata('id')) ){?>
        <li class="treeview <?php echo (@$page == 'reports' ? 'active' : '');?>">
          <a href="#">
            <i class="fa fa-list"></i>
            <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'reports';?>"><i class="fa fa-money"></i> Sales Report</a></li>
            <li><a href="<?php echo base_url().'reports/purchase_report';?>"><i class="fa fa-shopping-cart"></i> Purchase Report</a></li>
            <li><a href="<?php echo base_url().'reports/stock_report';?>"><i class="fa fa-gift"></i> Item Stocks Report</a></li>
            <li><a href="<?php echo base_url().'reports/laser_report';?>"><i class="fa fa-th"></i> Laser Report</a></li>
            
          </ul>
        </li>
        <?php } if( $this->inventory->check_permission('settings',$this->session->userdata('id')) ){?>
        <li class="treeview <?php echo (@$page == 'settings' ? 'active' : '');?>">
          <a href="<?php echo base_url().'dashboard/settings';?>">
            <i class="fa fa-cogs"></i>
            <span>Settings</span>
          </a>
          
        </li>
        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>