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
        <small>Control panel</small>
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

        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-8 connectedSortable">

              <!-- quick email widget -->
              <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-envelope"></i>

                  <h3 class="box-title">Add a new Bank Account</h3>
                  <!-- tools box -->

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ( session('status') ) 

                    @if ( session('status') == 'success' )
                        <div class="alert alert-success">
                          Bank account successfully saved!.
                         </div>
                    @else

                        <div class="alert alert-danger">
                           There was an error
                        </div>

                    @endif

                @endif

                </div>
                <div class="box-body">
                  <form action="{{ url('bank_account/add') }}" method="post">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                      <label for="banks">Select bank:</label>
                      <select class="form-control" id="banks" name="bank_id">

                        <option value=""> please select a bank </option>

                        @foreach ($banks as $bank)
                           <option value="{{ $bank->id }}"> {{ $bank->bank_name }} </option>
                        @endforeach

                      </select>
                    </div>

                    <div class="row">
                       <div class="col-md-4">
                          <div class="form-group">
                            <input type="text" value="" class="form-control" name="account_name" placeholder="Account Name" required>
                          </div>
                        </div>

                       <div class="col-md-4">
                          <div class="form-group">
                            <input type="text" value="" class="form-control" name="account_number" placeholder="Account Number" required>
                          </div>
                        </div>

                       <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                        </div>
                       </div>
                    </div>

 
                    <div class="row">

                       <div class="col-md-4">
                          <div class="form-group">
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                          </div>
                       </div>

                       <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="email" placeholder="Email" required>
                        </div>
                       </div>

                       <div class="col-md-4">
                        <div class="form-group">
                          <input type="text" class="form-control" name="phone_number" placeholder="Phone Number" required>
                        </div>
                       </div>

                    </div>
 
                    <div class="row">

                       <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" class="form-control" name="card_no" placeholder="Card no" required>
                          </div>
                       </div>

                       <div class="col-md-3">
                        <div class="form-group">
                          <input type="text" class="form-control" name="cvv" placeholder="cvv" required>
                        </div>
                       </div>

                       <div class="col-md-3">
                        <div class="form-group">
                          <input type="text" class="form-control" name="expiry_year" placeholder="expiry year" required>
                        </div>
                       </div>

                       <div class="col-md-3">
                        <div class="form-group">
                          <input type="text" class="form-control" name="expiry_month" placeholder="expiry month" required>
                        </div>
                       </div>

                    </div>

                    <div class="form-group">
                          <textarea class="form-control" name="description" placeholder="Description" required></textarea>
                    </div>

                    <div class="box-footer clearfix">
                      <button type="submit" class="pull-right btn btn-default" id="save_bank">Save
                        <i class="fa fa-arrow-circle-right"></i></button>
                    </div>

                  </form>
                </div>

              </div>

        </section>
        <!-- right col -->

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
@endsection

@section('scripts')
   @parent
   <!-- your scripts here -->
   
@endsection