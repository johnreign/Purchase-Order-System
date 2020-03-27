@extends('backend.layouts.adminty')

@section('content')
<div class="page-wrapper">
    <div class="page-body">
        <div class="row">

            <div class="col-xl-3 col-md-6">
                <div class="card bg-c-yellow update-card">
                    <div class="card-block">
                        <div class="row align-items-end">
                            <div class="col-4">
                                <h1><span class="icofont icofont-cart"></span></h1>
                            </div>
                            <div class="col-8">
                                <h3 class="text-white font-weight-bold">5<h3>
                                <h6 class="text-white m-b-0">Total Purchase Orders</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<script type="text/javascript">
    

   
</script>
@endsection