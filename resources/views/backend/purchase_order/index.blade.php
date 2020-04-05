@extends('backend.layouts.adminty')

@section('title', ' PO List')

@section('content')
<div class="page-wrapper">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Purchase Order Management</h4>
                    </div>
                </div>
                <a href="{{ url('admin/list/create') }}" class="btn btn-outline-primary btn-sm b-radius-5 m-l-10">
                    <i class="icofont icofont-plus"></i> Create PO
                </a>
            </div>
            <div class="">
                
            </div>
            <div class="col-sm-6">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/dashboard') }}"> <i class="fa fa-tachometer"></i>&nbsp; Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#!">Purchase Orders</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
    <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
    @endif

    <div class="page-body">
        <div class="card">
            <div class="card-header table-card-header">
                <h5>Purchase Order Lists</h5>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="base-style" class="table table-hover table-bordered rounded no-wrap">
                        <thead>
                            <tr>
                                <th>Order Date</th>
                                <th>PO Number</th>
                                <th>Lot Number</th>
                                <th>Supplier</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
         
                            @foreach($po as $row)
                            <tr>
                                <td>{{ date('F d, Y', strtotime($row->order_date)) }}</td>
                                <td>{{$row->po_number}}</td>
                                <td>{{$row->lot_number}}</td>
                                <td>{{$row->supplier->supp_name}}</td>                         
                                <td>{{$row->total_amount}}</td>
                                <td>
                                    <div class="dropdown-info dropdown open">
                                        <button class="btn btn-info btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-options"></i></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown-4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start">

                                        <a class="dropdown-item waves-light waves-effect" 
                                        href=""><span class="feather icon-box"></span> View PO</a>

                                        <a class="dropdown-item waves-light waves-effect" 
                                        href=""><span class="icofont icofont-edit"></span> Edit PO</a>

                                        <a class="dropdown-item waves-light waves-effect" 
                                        href=""><span class="icofont icofont-trash"></span> Delete PO</a>

                                            
                                        </div>
                                    </div> 
                                </td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection