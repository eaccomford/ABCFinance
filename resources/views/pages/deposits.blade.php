@extends('layouts.app')
@section('content')


    <!-- BEGIN: Content-->
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- invoice list -->
                <section class="card invoice-view-wrapper">
                    <div class="pl-2 pt-2">
                        <h2> Deposits</h2>
                    </div>
                    <hr>
                    <!-- create invoice button-->
                    <div class="invoice-create-btn mb-1 p-2">
                    <a href="{{url('/new-deposit')}}" class="btn btn-primary glow invoice-create" role="button" aria-pressed="true"> <i class="bx bx-pencil"></i> New Depost</a>
                    </div>
                    <!-- Options and filter dropdown button-->
                    <div class="action-dropdown-btn d-none">
                        <div class="dropdown invoice-filter-action">
                            <button class="btn border dropdown-toggle mr-1" type="button" id="invoice-filter-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Filter Invoice
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="invoice-filter-btn">
                                <a class="dropdown-item" href="#">Downloaded</a>
                                <a class="dropdown-item" href="#">Sent</a>
                                <a class="dropdown-item" href="#">Partial Payment</a>
                                <a class="dropdown-item" href="#">Paid</a>
                            </div>
                        </div>
                        <div class="dropdown invoice-options">
                            <button class="btn border dropdown-toggle mr-2" type="button" id="invoice-options-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Options
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="invoice-options-btn">
                                <a class="dropdown-item" href="#">Delete</a>
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">View</a>
                                <a class="dropdown-item" href="#">Send</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table invoice-data-table dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        <span class="align-middle">ID</span>
                                    </th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Account Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deposits as $key => $value)
                                    <tr>
                                        <td>
                                         <a href="#">{{$key + 1}}</a>
                                        </td>
                                        <td><small class="text-muted">{{ $value->created_at }}</small></td>
                                        <td><span class="invoice-amount">{{ $value->fname.' '.$value->lname }}</span></td>
                                        <td><span class="invoice-customer">{{ $value->acc_number }}</span></td>
                                        <td>
                                            <div class="invoice-action">
                                                <a href="{{url('/show-deposit')}}/{{ $value->id }}" class="invoice-action-view mr-1">
                                                    <i class="bx bx-show-alt"></i>
                                                </a>
                                                <a href="#" class="invoice-action-edit cursor-pointer">
                                                    <i class="bx bx-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $deposits->render("pagination::bootstrap-4") }} 
                    </div>
                </section>
            </div>
    </div>
    <!-- END: Content-->


    @endsection