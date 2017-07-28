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
        <!-- panel preview -->
        <div class="col-md-7 text-center mcontent"><br>
            <div class="panel panel-default">
                <div class="panel-body form-horizontal payment-form">
              <form id="submit_transfer" action="/transaction_process">
                 <div class="row">
                    <div class="col-md-4">
                       Select Bank
                    </div>
                    <div class="col-md-8">
                        <select class="form-control" id="parent_banks" name="parent_bank">
                           <?php foreach( $banks as $bank ):?>
                               <option value="<?= $bank ?>"> <?= $bank ?> </option>
                           <?php endforeach; ?>
                        </select>
                    </div>
                 </div><br />

                <div class="row">
                    <div class="col-md-4">
                      Account Numbers
                    </div>
                    <div class="col-md-8">
                        <select class="form-control" id="bank_accounts" name="parent_bank_account">
                            <option>Default select</option>
                        </select>
                    </div>
                 </div><br />

                 <div class="row">
                    <div class="col-md-5">
                        Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    <div class="col-md-7">
                        <div class="form-group row">
                             <input class="form-control" type="number" value="" id="example-number-input" name="amount">
                        </div>
                    </div>
                 </div>

                 <div class="row">
                    <div class="col-md-5">
                        Description &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    <div class="col-md-7">
                          <div class="form-group">
                             <textarea class="form-control" rows="3" id="comment" name="comment"></textarea>
                         </div>
                    </div>
                 </div>

                <div class="row">
                    <div class="col-md-4">
                       Target bank
                    </div>
                    <div class="col-md-8">
                        <select class="form-control" id="target_banks" name="target_bank">
                           <?php foreach( $banks as $bank ):?>
                               <option value="<?= $bank ?>"> <?= $bank ?> </option>
                           <?php endforeach; ?>
                        </select>
                    </div>
                </div><br />

                <div class="row">
                    <div class="col-md-4">
                       Account Numbers
                    </div>
                    <div class="col-md-8">
                        <select class="form-control" id="target_account_numbers" name="target_account_number">
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