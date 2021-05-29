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
                                    <div class="pl-2 pt-2">
                                        <h2>New Customer</h2>
                                    </div>
                                    <hr>
                                    @if(Session::has('message'))
                                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                    @endif
                                    @if(Session::has('error'))
                                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
                                    @endif
                                    <form action="{{url('/customer')}}" method="post">
                                        @csrf
                                    <div class="card-body pb-0 mx-25">
                                        <!-- invoice address and contact -->
                                        <div class="row invoice-info">
                                            <div class="col-lg-6 col-md-12 mt-25">
                                                <h6 class="invoice-to">Customer Information</h6>
                                                <fieldset class="invoice-address form-group">
                                                    <input type="text" name="fname" class="form-control" placeholder="First Name" required autocomplete="false">
                                                </fieldset>
                                                <fieldset class="invoice-address form-group">
                                                    <input type="text" name="lname" class="form-control" placeholder="Last Name" required autocomplete="false">
                                                </fieldset>
                                                <fieldset class="invoice-address form-group">
                                                    <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                                                </fieldset>
                                                <fieldset class="invoice-address form-group">
                                                    <input type="text" name="address" class="form-control" placeholder="Address" required>
                                                </fieldset>
                                                <fieldset class="invoice-address form-group">
                                                    <input type="text" name="idcard" class="form-control" placeholder="National ID Card Number" required>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <hr>
                                        </div>
                                        <div class="card-body pt-50">
                                        <!-- product details table-->
                                        <div class="invoice-product-details ">
                                            <table class="table" id="tableExample">
                                                <thead>
                                                    <tr>
                                                        <th>Account name</th>
                                                        <th>Initial Amount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="ansrow">
                                                        <td>
                                                            <select name="account[]" id="" class="form-control">
                                                                <option value="">select account</option>
                                                                @foreach($accounts ?? '' as $key => $value)
                                                                   <option value="{{ $value->id }}">{{ $value->code.' ('.$value->name.')' }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td><input type="number" name="amount[]" class="form-control" placeholder="Initial Amount"></td>
                                                        <td>
                                                            <a href="#" class="btn btn-danger removeRow"><i class="bx bx-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                            <div class="row ml-0">
                                                <div class="col-md-6"><a href="#" class="btn btn-info addRow"><i class="bx bx-plus"></i></a></div>
                                                <div class="col-md-6">
                                                    <div class=" float-right">
                                                        <button class="btn btn-success"><i class="bx bx-save"></i> Save</button>
                                                    </div>
                                                </div>
                                            </div>
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
                                    <a class="btn btn-primary btn-block invoice-send-btn" href="{{url('/customers')}}">
                                            <i class="bx bx-chevron-left"></i>
                                            <span>Back</span>
                                        </a>
                                    </div>
                                    <div class="invoice-action-btn mb-1">
                                       <a class="btn btn-light-primary btn-block" href="{{url('/new-deposit')}}">
                                        <i class="bx bx-chevron-left"></i>
                                            <span>New Deposit</span>
                                        </a>
                                    </div>
                                    <div class="invoice-action-btn mb-1">
                                        <a class="btn btn-light-primary btn-block" href="{{url('/new-account')}}">
                                         <i class="bx bx-chevron-left"></i>
                                             <span>New Account Type</span>
                                         </a>
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