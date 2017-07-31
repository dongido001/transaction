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
        <small>Transfer Money</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

        <!-- Main content -->
    <section class="content">

	<div class="row">

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

        <!-- panel preview -->
        <div class="col-md-7 text-center mcontent"><br>
            <div class="panel panel-default">
                <div class="panel-body form-horizontal payment-form">
              <form action="/transfer/single" method="POST" id="form_single_transfer_submit">

                 <input type="hidden" name="_token" value="{{ csrf_token() }}">

                 <div class="row">
                    <div class="col-md-4">
                       Select Bank
                    </div>
                    <div class="col-md-8">
                        <select class="form-control" id="parent_banks" name="parent_bank" required>
                           <?php foreach( $banks as $bank ):?>
                               <option value="<?= $bank->id ?>"> <?= $bank->bank_name ?> </option>
                           <?php endforeach; ?>
                        </select>
                    </div>
                 </div><br />

                <div class="row">
                    <div class="col-md-4">
                      Account Numbers
                    </div>
                    <div class="col-md-8">
                        <select class="form-control" id="parent_bank_account" name="parent_bank_account"  required>
                            <option>Please select</option>
                        </select>
                    </div>
                 </div><br />

                 <div class="row">
                    <div class="col-md-5">
                        Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    <div class="col-md-7">
                        <div class="form-group row">
                             <input class="form-control" type="number" value="" id="example-number-input" name="amount"  required>
                        </div>
                    </div>
                 </div>

                 <div class="row">
                    <div class="col-md-5">
                        Description &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    <div class="col-md-7">
                          <div class="form-group">
                             <textarea class="form-control" rows="3" id="comment" name="comment"  required></textarea>
                         </div>
                    </div>
                 </div>

                <div class="row">
                    <div class="col-md-4">
                       Target bank
                    </div>
                    <div class="col-md-8">
                        <select class="form-control" id="target_banks" name="target_bank"  required>
                           <?php foreach( $banks as $bank ):?>
                               <option value="<?= $bank->id ?>"> <?= $bank->bank_name ?> </option>
                           <?php endforeach; ?>
                        </select>
                    </div>
                </div><br />

                <div class="row">
                    <div class="col-md-4">
                       Account Numbers
                    </div>
                    <div class="col-md-8">
                        <select class="form-control" id="target_account_numbers" name="target_account_number"  required>
                            <option>Default select</option>
                        </select>
                    </div>
                </div><br />

                </div>
                   <button id="single_transfer_submit" type="submit" role="button" class="btn btn-primary btn-block" >SUBMIT</button><br />
            </form> 
            </div>  
                   
        </div> <!-- / panel preview -->

        <div class="col-md-5 mcontent"><br>
            <h5> Current Transactions: </h5> <br />
            <div class="row">
                <div class="col-md-12 text-left" id="transfer_status">       
         
                </div>
            </div>
            <div class="row text-left">
                <div class="col-md-12">
                    <h4>Total : <strong><span class="preview-total"></span></strong></h4>
                </div>
            </div>
        </div>
	</div>

  </section>


  <!-- Modal -->
  <div class="modal fade" id="OTP_FORM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Enter OTP</h4>
        </div>
        <div class="modal-body">
            <form id="OTP_COMFIRM_MODAL" method="POST" action="">
              
              <input type="hidden" value="" id="transaction_ref" name="transaction_ref">

              <input type="hidden" value="OTP" id="auth_type" name="auth_type">

              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group">
                <label for="exampleInputEmail1">OTP</label>
                <input type="text" class="form-control" id="auth_value" placeholder="1234" name="auth_value">
                <small id="authType__" class="form-text text-muted">Enter the OTP that was sent to your email or phone.</small>
              </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="OTP_COMFIRM_SUBMIT">Send</button>
        </div>

            </form>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
   @parent
   <!-- your scripts here -->
   
@endsection