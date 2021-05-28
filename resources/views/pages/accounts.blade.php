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
                    <!-- create invoice button-->
                    
                    <div class="invoice-create-btn mb-1 pl-3 pt-3">
                        <div class="row">
                            <h2>Accounts Setup</h2>
                        </div>
                        <hr>
                    <a href="{{url('new-account')}}" class="btn btn-primary glow invoice-create" role="button" aria-pressed="true">New Account</a>
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
                                    <th><span class="align-middle">ID</span></th>
                                    <th>Account Name</th>
                                    <th>Account Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                    <td><a href="app-invoice.html">{{ $account->id }}</a></td>
                                    <td><span class="invoice-amount">{{ $account->name }}</span></td>
                                    <td><small class="text-muted">{{ $account->code }}</small></td>
                                    <td>
                                        <div class="invoice-action">
                                            <a href="#" class="invoice-action-view mr-1">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <a href="#" class="invoice-action-edit cursor-pointer" onclick="deleteAccount({{ $account->id }})">
                                                <i class="bx bx-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
    </div>
    <!-- END: Content-->


    @endsection