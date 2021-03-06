  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ session('auth_user')['picture'] }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> {{ session('auth_user')['name'] }} </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
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
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Transaction</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('transactions') }}"><i class="fa fa-circle-o"></i> Transactions</a></li>
            <li><a href="{{ url('prepayments') }}"><i class="fa fa-circle-o"></i> Prepayments </a></li>
            <li><a href="{{ url('successfulPrepayment') }}"><i class="fa fa-circle-o"></i> Successful Prepayments </a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Banks</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('banks') }}"><i class="fa fa-circle-o"></i> Banks </a></li>
            <li><a href="{{ url('bank_account/add') }}"><i class="fa fa-circle-o"></i> Add new bank account </a></li>
            <li><a href="{{ url('bank_accounts') }}"><i class="fa fa-circle-o"></i> List Bank Account </a></li>
          </ul>
        </li>

         <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Transfer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('transfer') }}"><i class="fa fa-circle-o"></i> Transfer </a></li>
            <li><a href="{{ url('transfer/single') }}"><i class="fa fa-circle-o"></i> New Transfer </a></li>
            <li><a href="{{ url('transfer/history') }}"><i class="fa fa-circle-o"></i> Transfer History </a></li>
            <li><a href="{{ url('transfer/bulk') }}"><i class="fa fa-circle-o"></i> Bulk Transfer </a></li>
          </ul>
        </li>

        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>