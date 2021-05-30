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
                                    <div class="card-body pb-0 mx-25">
                                        <div class="pl-0 pt-2">
                                            <h2>New Deposit</h2>
                                        </div>
                                        <hr>
                                        <div id="message"></div>
                                        <form id="depositForm" method="post">
                                                @csrf
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
                                                <div class="row invoice-info" style="display: none">
                                                    <div class="col-lg-6 col-md-12 mt-25">
                                                        <h6 class="invoice-to">Account Name</h6>
                                                        <fieldset class="invoice-address form-group">
                                                            <input type="text" class="form-control" id="customerNmae" placeholder="Account Name" readonly>
                                                        </fieldset>
                                                        <fieldset class="invoice-address form-group">
                                                           <input type="text" name="date" id="date" value="{{ date('Y-m-d', strtotime(now()))}}" class="form-control" placeholder="date">
                                                        </fieldset>
                                                        <fieldset class="invoice-address form-group">
                                                            <input type="text" name="doneBy"  class="form-control" placeholder="Depositor Name" required>
                                                         </fieldset>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="card-body pt-50  depositNotesBox" style="display: none">
                                                <!-- product details table-->
                                                <div class="invoice-product-details ">
                                                    <table class="xtable" id="tableData-marketMonth">
                                                        <thead>
                                                            <tr>
                                                                <th>Note</th>
                                                                <th>Quantity</th>
                                                                <th>Total</th>
                                                                {{-- <th>Action</th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="ansrow">
                                                                <td><input type="number" name="note200" class="form-control noteValue" value="200" placeholder="200 cedi Note" readonly></td>
                                                                <td><input type="number" name="qty200" class="form-control noteQty" placeholder="Quantity"></td>
                                                                <td><div class="amtTotal">0</div></td>
                                                            </tr>
                                                            <tr class="ansrow">
                                                                <td><input type="number" name="note100" class="form-control noteValue" value="100" placeholder="100 cedi Note" readonly></td>
                                                                <td><input type="number" name="qty100" class="form-control noteQty" placeholder="Quantity"></td>
                                                                <td><div class="amtTotal">0</div></td>
                                                            </tr>
                                                            <tr class="ansrow">
                                                                <td><input type="number" name="note50" class="form-control noteValue" value="50" placeholder="50 cedi Note" readonly></td>
                                                                <td><input type="number" name="qty50" class="form-control noteQty" placeholder="Quantity"></td>
                                                                <td><div class="amtTotal">0</div></td>
                                                            </tr>
                                                            <tr class="ansrow">
                                                                <td><input type="number" name="note20" class="form-control noteValue" value="20" placeholder="20 cedi Note" readonly></td>
                                                                <td><input type="number" name="qty20" class="form-control noteQty" placeholder="Quantity"></td>
                                                                <td><div class="amtTotal">0</div></td>
                                                            </tr>
                                                            <tr class="ansrow">
                                                                <td><input type="number" name="note10" class="form-control noteValue" value="10" placeholder="10 cedi Note" readonly></td>
                                                                <td><input type="number" name="qty10" class="form-control noteQty" placeholder="Quantity"></td>
                                                                <td><div class="amtTotal">0</div></td>
                                                            </tr>
                                                            <tr class="ansrow">
                                                                <td><input type="number" name="note5" class="form-control noteValue" value="5" placeholder="5 cedi Note" readonly></td>
                                                                <td><input type="number" name="qty5" class="form-control noteQty" placeholder="Quantity"></td>
                                                                <td><div class="amtTotal">0</div></td>
                                                            </tr>
                                                            <tr class="ansrow">
                                                                <td><input type="number" name="note2" class="form-control noteValue" value="2" placeholder="2 cedi Note" readonly></td>
                                                                <td><input type="number" name="qty2" class="form-control noteQty" placeholder="Quantity"></td>
                                                                <td><div class="amtTotal">0</div></td>
                                                            </tr>
                                                            <tr class="ansrow">
                                                                <td><input type="number" name="note1" class="form-control noteValue" value="1" placeholder="1 cedi Note" readonly></td>
                                                                <td><input type="number" name="qty1" class="form-control noteQty" placeholder="Quantity"></td>
                                                                <td><div class="amtTotal">0</div></td>
                                                            </tr>

                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th  colspan="2"> <b style="font-size: 20px">TotalTotal</b></th>
                                                                <th><input type="text" name="total" id="subTotal" readonly></th>
                                                            </tr>
                                                        </tfoot>

                                                    </table>
                                                    <div class="row ml-0">
                                                        <div class="col-md-6">
                                                            {{-- <a href="#" class="btn btn-info addRow"><i class="bx bx-plus"></i></a> --}}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class=" float-right">
                                                                <button id="saveDeposit" class="btn btn-success"><i class="bx bx-save"></i> Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- invoice subtotal -->
                                                
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
                                            <span>Deposits</span>
                                        </a>
                                    </div>
                                    <div class="invoice-action-btn mb-1">
                                        <div class="row">
                                            <div class="col-md-6"><b>Current Bal: </div>
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
                                        <b>Last 5 Deposits</b>
                                        <hr>
                                        <div>
                                            <table class="table table-striped" id="curDepositTable">
                                                <thead>
                                                    <th>Date</th>
                                                    <th>Amount</th>
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
         // clone the answer row 
             $('.addRow').on('click', function() {
                 var table = $('#tableData-marketMonth'),
                 lastRow = table.find('tbody tr:last'),
                 rowClone = lastRow.clone();
                 table.find('tbody').append(rowClone);

                 // clear input
                 rowClone.find('.noteQty').val('')
                 rowClone.find('.amtTotal').html(0)

                 // recal total
                 calcSubTotal()
             });
 
             $(document).on('click', '.removeRow', function() {
                 $(this).closest('tr').remove();
                 // recal total
                 calcSubTotal()
             });

           
            

            // $(".noteValue").on("keyup", function() {
            $(document).on('keyup', '.noteQty', function() {
                let noteQty = parseFloat($(this).closest('tr').find('.noteValue').val())
                let notValue = parseFloat($(this).val());
                let total = parseFloat(noteQty * notValue)

                $(this).closest('tr').find('.amtTotal').text(total)
                calcSubTotal()
            });

            $(document).on('keyup', '.noteValue', function() {
                $(this).closest('tr').find('.noteQty').val(0)
                $(this).closest('tr').find('.amtTotal').text(0)
            });


             // sum amt entered
             function calcSubTotal(){
                var rowTotal = 0;
                $('#tableData-marketMonth tr').each(function () {
                    var row = $(this);
                    $(this).find('.amtTotal').each(function () {
                        var th = $(this);
                        if ($.isNumeric(th.text())) {
                            rowTotal += parseFloat(th.text());
                        }
                    });
                    
                    //row.find('th:last').text(rowTotal);
                });
                $('#subTotal').val(rowTotal)
             }

             // save deposit
             $(document).on('click', '#saveDeposit', function(e) {
                 e.preventDefault()
                 // valideate
                 if($('#subTotal').val() === '' && $('#acc_no').val() === '' ){
                     $('#message').html(`<div class="alert alert-danger">Currency Notes, Qty and Totals are required</div>`)
                     return false
                 }
                 $('#message').html('')


                
                $.ajax({
                    type: "POST",
                    url: "{{url('/deposit')}}",
                    data: $('#depositForm').serialize(),
                    dataType: "json",
                    success: (res) => {
                        console.log(res);
                       if (res.res==1) {
                        checkAccount($('#acc_no').val())
                        $('#message').html(`<div class="alert alert-success">Success, Deposite Completed</div>`)
                       }else{
                        $('#message').html(`<div class="alert alert-danger">Error, Deposite Failed</div>`)
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
                    url: `{{url('/check-deposit')}}/${accno}`,
                    success: (res) => {
                        $('#message').html('')
                        console.log(res.data.deposits);
                        if (res.res== 1) {
                            $('.invoice-info').show()
                            $('.depositNotesBox').show()

                            $('#customerNmae').val(res.data.accountInfo.fname+ ' ' +res.data.accountInfo.lname)
                            $('#totalDeposits').text(res.data.totalDeposits - res.data.totalWithdrawal)
                            $('#accType').text(res.data.accountInfo.name)
                            //lastFiveDeposits
                            $('#mainDepositBox').empty()
                                $.each(res.data.deposits, (i, val) => {
                                    $('#curDepositTable tbody').append( `
                                        <tr>
                                            <td>${val.created_at}</td>
                                            <td>${val.total}</td>
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