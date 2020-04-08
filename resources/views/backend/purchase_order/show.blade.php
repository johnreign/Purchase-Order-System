@extends('backend.layouts.adminty')

@section('title', 'View PO')

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
            </div>
            <div class="col-sm-6">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/dashboard') }}"> <i class="fa fa-tachometer"></i>&nbsp; Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/list') }}">Purchase Orders</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#!">View PO</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="page-body">
    	<div class="row">
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-block printableArea">
	                    <div class="row m-b-25">
	                        <div class="col-lg-6">
	                            <div class="row">
	                                <div class="col-auto p-r-0">
	                                    <img src="" alt="" class="img-fluid img-100">
	                                </div>
	                                <div class="col">
	                                    <h4 class="m-b-5">PO</h4>
	                                    <p class="mb-1">Order Date:</p>
	                                    <p><label>Lot #: </label></p>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <hr>
	                    <div class="row">
	                        <div class="col-sm-6">
	                            <div class="card card-primary">
	                                <div class="card-header bg-primary py-2">
	                                    <h4 class="card-title">Supplier :</h5>
	                                </div>
	                                <div class="card-body">
	                                    <h5 class="mb-2">SUPP NAME</h5>
	                                    <p class="mb-0"><i class="icofont icofont-location-pin"></i> Tambo, Hinaplanon</p>
	                                    <p class="mb-0"><i class="icofont icofont-ui-cell-phone"></i> 09559771627</p>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-sm-6">
	                            <div class="card card-primary">
	                                <div class="card-header bg-primary py-2">
	                                    <h4 class="card-title">From :</h5>
	                                </div>
	                                <div class="card-body">
	                                    <h5 class="mb-2">MSU-Iligan Institute of Technology</h5>
	                                    <p class="mb-0"><i class="icofont icofont-location-pin"></i> Tibanga, Iligan City</p>
	                                    <p class="mb-0"><i class="icofont icofont-ui-cell-phone"></i> 09559771627</p>
	                                </div>
	                            </div>
	                        </div>
	                    </div>

	                    <table class="table table-bordered">
	                        <thead>
	                            <tr>
	                                <th>#</th>
	                                <th>Item Description</th>
	                                <th>Quantity</th>
	                                <th>Price</th>
	                                <th>Amount</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        	
	                            <tr>
	                                <td></td>
	                                <td></td>
	                                <td></td>
	                                <td></td>
	                                <td></td>
	                            </tr>
	                          
	                        </tbody>
	                    </table>
	                    <hr>
	                    <div class="row">
	                        <div class="col-lg-6">
	                            <div class="p-2" style="border: 1px dashed #eee">
	                                <p><em>No comment</em></p>
	                            </div>
	                        </div>
	                        <div class="col-lg-6">
	                            <div class="text-right">
	                                <h4><b>GRAND TOTAL:</b></h4>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="card-footer border border-top">
	                    <div class="text-right">
	                        <a href="#!" class="btn btn-secondary" disabled><i class="icofont icofont-email"></i> Send Email</a>
	                        <a href="#!" class="btn btn-primary" id="print"><i class="icofont icofont-print"></i> Print</a>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
    </div>
</div>
@endsection



@section('scripts')
<script src="{{ url('/js/inventory.js') }}?{{ mt_rand() }}"></script>
<script src="{{ url('/js/jquery.PrintArea.js') }}"></script>

<script>
    $(function() {
        $("#print").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
    });
</script>

@endsection