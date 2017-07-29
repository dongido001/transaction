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
              <form id="submit_transfer" action="/transfer/single" method="POST">

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
                   <button id="submit_button" type="submit" role="button" class="btn btn-primary btn-block" >SUBMIT</button><br />
            </form> 
            </div>  
                   
        </div> <!-- / panel preview -->

        <div class="col-md-5 mcontent"><br>
            <h5> Transaction Processes ...</h5> <br />
            <div class="row">
                <div class="col-md-12 text-left">       
                     sending 1000 to 1000 Account Number ..                  
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

@endsection

@section('scripts')
   @parent
   <!-- your scripts here -->
   
@endsection