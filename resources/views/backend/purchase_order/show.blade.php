@extends('backend.layouts.adminty')

@section('title', 'View PO')

@section('content')
<div class="page-wrapper">
	<div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-title">
                  	<div class="d-inline">
                        <h4>View Purchase Order</h4>
                    </div>
                </div>
                <a href="{{ url('admin/list')}}" class="btn btn-inverse btn-sm m-l-10">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
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
	                                    <img src="{{ url('img/iit.png') }}" alt="" class="img-fluid img-100">
	                                </div>
	                                <div class="col">
	                                    <h4 class="m-b-5">MSU-ILIGAN INSTITUTE OF TECHNOLOGY</h4>
	                                    <p class="mb-1">Tibanga, Iligan City</p>
	                                    <p><label>231-1234-233</label></p>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <hr>
	                    <div class="row">
	                        <div class="col-sm-12">
	                            <div class="card card-primary">
	                                <div class="card-header bg-primary py-2 text-center">
	                                    <h4 class="card-title">PURCHASE ORDER</h5>
	                                </div>
	                                <div class="card-body text-center">
	                                    <h4 class="mb-2">{{ $po->po_number }}</h4>
	                                    <p class="mb-0">Date: {{ date('F d, Y', strtotime($po->order_date)) }}</p>
	                                    <p class="mb-0">Lot Number: {{ $po->lot_number }} </p>
	                                    <p class="mb-0">Delivery Term: {{ $po->term }} days </p>
	                                    <p class="mb-0">Date of Delivery:  {{ date('F d, Y', strtotime($po->delivery_date)) }} </p>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row">
	                        <div class="col-sm-6">
	                            <div class="card card-primary">
	                                <div class="card-header bg-primary py-2">
	                                    <h4 class="card-title">Supplier :</h5>
	                                </div>
	                                <div class="card-body">
	                                    <h5 class="mb-2">{{ $po->supplier->supp_name }}</h5>
	                                    <p class="mb-0"><i class="icofont icofont-location-pin"></i>{{ $po->supplier->supp_address }}</p>
	                                    <p class="mb-0"><i class="icofont icofont-ui-cell-phone"></i>{{ $po->supplier->supp_num }}</p>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-sm-6">
	                            <div class="card card-primary">
	                                <div class="card-header bg-primary py-2">
	                                    <h4 class="card-title">Place of Delivery :</h5>
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
	                                <th>Unit</th>
	                                <th>Description</th>
	                                <th>Quantity</th>
	                                <th>Unit Price</th>
	                                <th>Total Amount</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        	@foreach($po->purchase_order_items as $i => $item)
	                            <tr>
	                                <td>{{ $i+1 }}</td>
	                                <td>{{ $item->item->code }}</td>
	                                <td>{{ $item->item->description }}</td>
	                                <td>{{ $item->quantity }}</td>
	                                <td>{{ $item->price }}</td>
	                                <td>{{ $item->amount }}</td>
	                            </tr>
	                          	@endforeach
	                        </tbody>
	                    </table>
	                    <hr>
	                    <div class="row">
	                        <div class="col-lg-6">
	                            <div class="p-2" style="border: 1px dashed #eee">
	                                <p><em>{{ $po->remarks }}</em></p>
	                            </div>
	                        </div>
	                        <div class="col-lg-6">
	                            <div class="text-right">
	                                <h4><b>GRAND TOTAL: {{ $po->total_amount }}</b></h4>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="card-footer border border-top">
	                    <div class="text-right">
                        <a href="{{url('admin/list/edit', $po->id)}}" class="btn btn-secondary"><i class="icofont icofont-edit"></i> Edit</a>
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