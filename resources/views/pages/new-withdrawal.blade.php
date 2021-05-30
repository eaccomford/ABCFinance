@extends('layouts.app')
@section('content')

    <!-- BEGIN: Content-->
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- app invoice View Page -->
                <section class="invoice-edit-wrapper">
                    <div class="row">
                        <!-- invoice view page -->
                        <div class="col-xl-9 col-md-8 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <form id="saveWithdrawalForm" method="post">
                                        @csrf
                                            <div class="card-body pb-0 mx-25">
                                                <div class="pl-0 pt-2">
                                                    <h2>New Withdrawal</h2>
                                                </div>
                                                <hr>
                                                <!-- logo and title -->
                                                <div id="message"></div>
                                                    <div class="row my-2 py-50">
                                                        <div class="col-sm-6 col-12 order-2 order-sm-1">
                                                            <h4 class="text-primary">Account No.</h4>
                                                                    <div style="display: flex">
                                                                        <input type="text" name="acc_no" id="acc_no" class="form-control mr-1" placeholder="Account Number" required> 
                                                                        <a href="#" class="btn btn-info"> <i class="bx bx-check" onclick="checkAccount($('#acc_no').val())"></i> </a>
                                                                    </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <!-- invoice address and contact -->
                                                    <div class="row invoice-info mb-5">
                                                        <div class="col-lg-6 col-md-12 mt-25">
                                                            <h6 class="invoice-to">Account Name</h6>
                                                            <fieldset class="invoice-address form-group">
                                                                <input type="text" class="form-control" id="customerNmae" placeholder="Account Name" readonly>
                                                            </fieldset>
                                                            <fieldset class="invoice-address form-group">
                                                            <input name="date" type="text" value="{{ date('Y-m-d', strtotime(now()))}}" class="form-control" placeholder="date" required>
                                                            </fieldset>
                                                            <fieldset class="invoice-address form-group">
                                                                <input type="number" name="amount" class="form-control" placeholder="Amount" required>
                                                            </fieldset>
                                                            <fieldset class="invoice-address form-group">
                                                                <input type="text" name="doneBy"   class="form-control" placeholder="Withdrawers Name" required>
                                                             </fieldset>
                                                        </div>
                                                    </div>

                                                    <div class="row invoice-info mb-5">
                                                    <button class="btn btn-success">Save</button>
                                                    </div>
                                            </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <!-- invoice action  -->
                        <div class="col-xl-3 col-md-4 col-12"> 
                            <div class="card invoice-action-wrapper shadow-none border">
                                <div class="card-body">
                                    <div class="invoice-action-btn mb-1">
                                    <a href="{{url('/deposits')}}" class="btn btn-primary btn-block invoice-send-btn">
                                            <i class="bx bx-chevron-left"></i>
                                            <span>Withdrawals</span>
                                        </a>
                                    </div>
                                    <div class="invoice-action-btn mb-1">
                                        <div class="row">
                                            <div class="col-md-6"><b>Account Bal: </div>
                                            <div class="col-md-6"> GHC<span id="totalDeposits" class="text-right">0</span></b></div>
                                        </div>
                                    </div>
                                    <div class="invoice-action-btn mb-1">
                                        <div class="row">
                                            <div class="col-md-6"><b>Current Type: </div>
                                            <div class="col-md-6"> <span id="accType" class="text-right"></span></b></div>
                                        </div>
                                    </div>
                                    <div class="invoice-action-btn mb-1">
                                        <b>Last 5 Withdrawals</b>
                                        <hr>
                                        <div>
                                            <table class="table table-striped" id="curDepositTable">
                                                <thead>
                                                    <th>Date</th>
                                                    <th>Amount (GHC)</th>
                                                </thead>
                                            <tbody  id="mainDepositBox">
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </section>

            </div>
    </div>
    <!-- END: Content-->

     <!-- END: Content--> 
     <script src="{{asset('/')}}app-assets/js/core/libraries/jquery.min.js"></script>
     <script>

          // save deposit
          $(document).on('submit', '#saveWithdrawalForm', function(e) {
                 e.preventDefault()
                 // valideate
                 if($('#amount').val() === '' && $('#acc_no').val() === '' ){
                     $('#message').html(`<div class="alert alert-danger">Account number and Amount are required</div>`)
                     return false
                 }
                 $('#message').html('')
                
                $.ajax({
                    type: "POST",
                    url: "{{url('/withdrawal')}}",
                    data: $('#saveWithdrawalForm').serialize(),
                    dataType: "json",
                    success: (res) => {
                        console.log(res);
                       if (res.res==1) {
                        checkAccount($('#acc_no').val())
                        $('#message').html(`<div class="alert alert-success">Success, Withdrawal Completed</div>`)
                       }else{
                        $('#message').html(`<div class="alert alert-danger">Error, Withdrawal Failed</div>`)
                       }
                    },
                    dataType: 'json',
                });
             })


         // check account
         function checkAccount(accno) {
                 if (accno === '') {
                    $('#message').html(`<div class="alert alert-danger">Enter Account Number</div>`)
                    return false
                 }
                 $.ajax({
                    type: "GET",
                    url: `{{url('/check-withdrawal')}}/${accno}`,
                    success: (res) => {
                        $('#message').html('')
                        console.log(res.data.deposits);
                        if (res.res== 1) {
                            $('.invoice-info').show()
                            $('.depositNotesBox').show()

                            $('#customerNmae').val(res.data.accountInfo.fname+ ' ' +res.data.accountInfo.lname)
                            $('#totalDeposits').text(res.data.totalDeposit  - res.data.totalWithdrawal)
                            $('#accType').text(res.data.accountInfo.name)
                            //lastFiveDeposits
                            $('#mainDepositBox').empty()
                                $.each(res.data.withdrawals, (i, val) => {
                                    $('#curDepositTable tbody').append( `
                                        <tr>
                                            <td>${val.created_at}</td>
                                            <td>${val.amount}</td>
                                        </tr>
                                    `)
                                })
                        }else{
                            $('#message').html(`<div class="alert alert-info">No record Found</div>`)
                            $('.invoice-info').hide()
                            $('#mainDepositBox').empty()
                            $('.depositNotesBox').hide()
                        }
                    },
                    dataType: 'json'
                });
             }
     </script>

    @endsection