@extends('layouts.app')

    @section('title', 'Empty Page ...')

    @section('styles')
       @parent
       <!-- your styles here -->

    @endsection

@section('content')
    <section class="content-header">
      <h1>
        Dashboard
        <small> Bank Accounts </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->

      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Bank accounts </h3>
            </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <table class="table table-striped">
                    <tr>
                      <th style="width: 20px">#</th>
                      <th>Bank Code</th>
                      <th>Bank Name</th>
                      <th>Action</th>
                    </tr>

                  @foreach ($banks as $bank)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $account->bank_code }}</td>
                      <td>{{ $account->bank_name }}</td>
                      <td> Edit | Delete </td>
                    </tr>
                  @endforeach

                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
        </section>
        <!-- /.Left col -->

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
@endsection

@section('scripts')
   @parent
   <!-- your scripts here -->
   
@endsection