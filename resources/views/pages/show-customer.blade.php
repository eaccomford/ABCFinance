
@extends('layouts.app')
@section('content')
    <!-- BEGIN: Content-->
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- app invoice View Page -->
                <section class="invoice-view-wrapper">
                    <div class="row">
                        <!-- invoice view page -->
                        <div class="col-xl-9 col-md-8 col-12">
                            <div class="card invoice-print-area">
                                <div class="card-content">
                                    <div class="card-body pb-0 mx-25">
                                        <!-- header section -->
                                        <div class="row">
                                            <div class="col-xl-4 col-md-12">
                                                <span class="invoice-number mr-50">Customer Information</span>
                                                <span></span>
                                            </div>
                                            <div class="col-xl-8 col-md-12">
                                                <div class="d-flex align-items-center justify-content-xl-end flex-wrap">
                                                    <div class="mr-3">
                                                        <small class="text-muted">From:</small>
                                                        <span>{{$customer->created_at}}</span>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted">To:</small>
                                                        <span>{{date('Y-m-d', strtotime(now()))}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- logo and title -->
                                        <div class="row my-3">
                                            <div class="col-6">
                                                <h4 class="text-primary">Customer Name</h4>
                                                <span>{{$customer->fname .' '. $customer->lname}}</span>
                                            </div>
                                            {{-- <div class="col-6 d-flex justify-content-end">
                                                <img src="../../../app-assets/images/pages/pixinvent-logo.png" alt="logo" height="46" width="164">
                                            </div> --}}
                                        </div>
                                        <hr>
                                        <!-- invoice address and contact -->
                                        <div class="row invoice-info">
                                            <div class="col-6 mt-1">
                                                <h6 class="invoice-from">Details</h6>
                                                <div class="mb-1">
                                                    <span>Phone</span> : {{$customer->phone}}
                                                </div>
                                                <div class="mb-1">
                                                    <span>Address</span>: {{$customer->address}}
                                                </div>
                                                <div class="mb-1">
                                                    <span>National ID Card</span>: {{$account_numbers[0]->idcard}}
                                                </div>
                                            </div>
                                            <div class="col-6 mt-1">
                                                
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <!-- product details table-->
                                    <div class="invoice-product-details table-responsive mx-md-25">
                                        <table class="table table-borderless mb-0">
                                            <thead>
                                                <tr class="border-0">
                                                    <th scope="col">Account name</th>
                                                    <th scope="col">Account Number</th>
                                                    <th scope="col" class="text-right font-weight-bold">Current Balance</th>
                                                    <th>Statement</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($account_numbers as $key => $value)
                                                <tr>
                                                    <td>{{$value->name}}</td>
                                                    <td>{{$value->acc_number}}</td>
                                                    <td class="text-primary text-right font-weight-bold">GHC{{$value->amount}}</td>
                                                    <th>
                                                        <a href="{{url('/customer-statement')}}/{{$value->acc_number}}" class="invoice-action-view mr-1">
                                                            <i class="bx bx-file"></i> 
                                                        </a>
                                                    </th>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- invoice subtotal -->
                                    <div class="card-body pt-0 mx-25">
                                        <hr>
                                        <div class="row">
                                            <div class="col-4 col-sm-6 mt-75">
                                                
                                            </div>
                                            <div class="col-8 col-sm-6 d-flex justify-content-end mt-75">
                                                <div class="invoice-subtotal">
                                                    <div class="invoice-calc d-flex justify-content-between">
                                                        <span class="invoice-title">Subtotal</span>
                                                        <span class="invoice-value pl-5">GHC 7600</span>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- invoice action  -->
                        <div class="col-xl-3 col-md-4 col-12">
                            <div class="card invoice-action-wrapper shadow-none border">
                                <div class="card-body">
                                    <div class="invoice-action-btn">
                                    <a href="{{url('/customers')}}" class="btn btn-primary btn-block invoice-send-btn">
                                            <i class="bx bx-chevron-left"></i>
                                            <span>Customers</span>
                                        </a>
                                    </div>
                                    <div class="invoice-action-btn">
                                        <button class="btn btn-light-primary btn-block invoice-print">
                                            <span>print</span>
                                        </button>
                                    </div>
                                    <div class="invoice-action-btn">
                                        <a href="app-invoice-edit.html" class="btn btn-light-primary btn-block">
                                            <span>save pdf</span>
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

@endsection