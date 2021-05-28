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
                                            <h2>New Withdrawal</h2>
                                        </div>
                                        <hr>
                                        <!-- logo and title -->
                                        <div class="row my-2 py-50">
                                            <div class="col-sm-6 col-12 order-2 order-sm-1">
                                                <h4 class="text-primary">Account No.</h4>
                                                <input type="text" name="accno" class="form-control" placeholder="Account Number">
                                            </div>
                                        </div>
                                        <hr>
                                        <!-- invoice address and contact -->
                                        <div class="row invoice-info mb-5">
                                            <div class="col-lg-6 col-md-12 mt-25">
                                                <h6 class="invoice-to">Account Name</h6>
                                                <fieldset class="invoice-address form-group">
                                                    <input type="text" class="form-control" placeholder="Account Name" readonly>
                                                </fieldset>
                                                <fieldset class="invoice-address form-group">
                                                <input type="text" value="{{ date('Y-m-d', strtotime(now()))}}" class="form-control" placeholder="date">
                                                </fieldset>
                                                <fieldset class="invoice-address form-group">
                                                    <input type="text" class="form-control" placeholder="Amount">
                                                </fieldset>
                                            </div>
                                        </div>

                                        <div class="row invoice-info mb-5">
                                           <button class="btn btn-success">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- invoice action  -->
                        <div class="col-xl-3 col-md-4 col-12"> 
                            <div class="card invoice-action-wrapper shadow-none border">
                                <div class="card-body">
                                    <div class="invoice-action-btn mb-1">
                                    <a href="{{url('/withdrawals')}}" class="btn btn-primary btn-block invoice-send-btn">
                                            <i class="bx bx-chevron-left"></i>
                                            <span>Withdrawals</span>
                                        </a>
                                    </div>
                                    <div class="invoice-action-btn mb-1">
                                        <b>Current Bal: 2000GH</b>
                                    </div>
                                    <div class="invoice-action-btn mb-1">
                                        <b>Last Withdrawal: 2010-2-2</b>
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
                 var table = $('#tableExample'),
                 lastRow = table.find('tbody tr:last'),
                 rowClone = lastRow.clone();
 
                 table.find('tbody').append(rowClone);
             });
 
             $(document).on('click', '.removeRow', function() {
                 $(this).closest('tr').remove();
             });
     </script>

    @endsection