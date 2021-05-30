
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
                                                <span class="invoice-number mr-50">Withdrawal Details</span>
                                                <span></span>
                                            </div>
                                            <div class="col-xl-8 col-md-12">
                                                <div class="d-flex align-items-center justify-content-xl-end flex-wrap">
                                                    <div class="mr-3">
                                                        {{-- <small class="text-muted">From:</small>
                                                        <span>08/10/2019</span> --}}
                                                    </div>
                                                    <div>
                                                        <small class="text-muted">Date:</small>
                                                        <span>{{ date('d-m-Y', strtotime(now()))}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- logo and title -->
                                        <div class="row my-3">
                                            <div class="col-6">
                                                <h4 class="text-primary">Customer Name</h4>
                                                <span>{{ $withdrawal->fname.' '.$withdrawal->lname }}</span>
                                            </div>
                                            <div class="col-6">
                                                <div class="float-right">
                                                    <h4 class="text-primary">Account Type</h4>
                                                    <span>{{ $withdrawal->accname }}</span>
                                                </div>
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
                                                    <span>Phone</span> : {{ $withdrawal->phone }}
                                                </div>
                                                <div class="mb-1">
                                                    <span>Address</span>: {{ $withdrawal->address }}
                                                </div>
                                                <hr>
                                                <div class="invoice-subtotal">
                                                    <div class="invoice-calc d-flex justify-content-between">
                                                        <span class="invoice-title">Subtotal</span>
                                                        <span class="invoice-value pl-5">GHC {{ $withdrawal->amount }}</span>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-6 mt-1">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <!-- invoice subtotal -->
                                    <div class="card-body pt-0 mx-25">
                                        <hr>
                                        <div class="row">
                                            <div class="col-4 col-sm-6 mt-75">
                                                
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
                                    <a href="{{url('/withdrawals')}}" class="btn btn-primary btn-block invoice-send-btn">
                                            <i class="bx bx-chevron-left"></i>
                                            <span>Withdrawals</span>
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