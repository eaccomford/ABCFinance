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
                                        <div class="">
                                            <h2>New Account Setup</h2>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="card-body pt-50">
                                        <!-- product details table-->
                                        <div class="invoice-product-details ">
                                            @if(Session::has('message'))
                                               <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                            @endif
                                            <form action="{{url('/account')}}" method="post">
                                                @csrf
                                                <table class="table" id="tableExample">
                                                    <thead>
                                                        <tr>
                                                            <th>Account name</th>
                                                            <th>Account Code</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="ansrow">
                                                            <td><input type="text" name="name[]" class="form-control" placeholder="Account name" required></td>
                                                            <td><input type="text" name="code[]" class="form-control" placeholder="Account code" required></td>
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
                                                            <button type="submit" class="btn btn-success"><i class="bx bx-save"></i> Save</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- invoice action  -->
                        <div class="col-xl-3 col-md-4 col-12">
                            <div class="card invoice-action-wrapper shadow-none border">
                                <div class="card-body">
                                    <h4>Account Information</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
    </div>
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