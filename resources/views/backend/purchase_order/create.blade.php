@extends('backend.layouts.adminty')

@section('title', 'Create PO')

@section('content')

<div class="page-wrapper">
    <div class="page-header">
          <div class="row align-items-end">
              <div class="col-lg-6">
                  <div class="page-header-title">
                      <div class="d-inline">
                          <h4>Create Purchase Order</h4>
                      </div>
                  </div>
                  <a href="{{ url('admin/list')}}" class="btn btn-inverse btn-sm m-l-10">
                      <i class="fa fa-arrow-left"></i> Back
                  </a>
              </div>
              <div class="col-lg-6">
                  <div class="page-header-breadcrumb">
                      <ul class="breadcrumb-title">
                          <li class="breadcrumb-item">
                              <a href="{{ url('admin/dashboard') }}"> <i class="fa fa-tachometer"></i>&nbsp; Dashboard</a>
                          </li>
                          <li class="breadcrumb-item">
                              <a href="{{ url('admin/list') }}">Purchase Orders</a>
                          </li>
                          <li class="breadcrumb-item">
                              <a href="#!">Create PO</a>
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
                <div class="card-block">
                  <form method="POST" action="{{ url('admin/list') }}" id="submit">
                  @csrf                      
                    <div class="row">
                      <div class="col-xl-6">
                        <div class="form-group">
                          <label class="col-form-label">Lot Number *</label>
                          <input type="text" name="lot_number" class="form-control" required placeholder="e.g. 1" value="">
                        </div>
                      </div>

                      <div class="col-xl-6">
                        <div class="form-group">
                          <label class="col-form-label">Supplier *</label>
                          <select class="form-control" name="supplier_id">
                            @foreach($suppliers as $supplier)
                              <option value="{{$supplier->id}}">{{$supplier->supp_name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col-xl-6">
                        <div class="form-group">
                          <label class="col-form-label">PO Number *</label>
                          <input type="text" name="po_number" class="form-control" required placeholder="e.g. PO-000001" value="">
                        </div>
                      </div>
                      <div class="col-xl-6">
                        <div class="form-group">
                          <label class="col-form-label"> Order Date *</label>
                          <input type="date" name="order_date" class="form-control" required placeholder="" value="">
                        </div>
                      </div>
                    </div>
                    <hr>
                    <!-- <div class="text-center mb-3">
                      <h4>ITEMS</h4>
                    </div>
                    <table id="items1" class="table table-striped table-bordered dt-responsive nowrap text-center" style="width:100%">
                      <thead class="thead-dark">
                        <tr>
                          <th style="width:20%">Unit</th>
                          <th style="width:20%">Quantity</th>
                          <th style="width:20%">Unit Price</th>
                          <th style="width:20%">Amount</th>
                          <th style="width:15%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Mouse</td>
                          <td><input type="number" name="quantity"></td>
                          <td><input type="" name="unit_price"></td>
                          <td><input type="" name="amount"></td>
                          <td><button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add Item</button></td>
                        </tr>
                      </tbody>
                    </table> -->
                    <div class="row pt-5">
                      <div class="col-md-12 pr-3">
                        <div class="table-responsive">
                          <table class="table table-bordered display table-dynamic" id="po-table" style="width:99%">
                            <thead>
                              <tr>
                                <th>Items</th>
                                <th style="width:100px;">Quantity</th>
                                <th style="width:120px;">Price</th>
                                <th style="width:150px;">Amount</th>
                                <th style="width:70px;">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td></td>
                                <td>
                                  <input style="width: 100%" type="number" name="quantity" class="form-control quantity" value="">
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                  <button name="add" class="delete btn btn-sm btn-primary"><i class="icofont icofont-plus"></i>Add Item</button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label>Remarks</label>
                          <textarea class="form-control" name="remarks" placeholder="Optional" rows="4"></textarea>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="text-right">
                          <h4 class="text-primary">TOTAL AMOUNT : <span id="total">50.00</span></h4>
                          <input type="hidden"  name="overall_total">

                        </div>
                      </div>
                    </div>
                    <div class="card-footer border border-top text-right">
                      <button type="submit" class="btn btn-lg btn-success"><i class="feather icon-save"></i> Save</button>
                    </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#po-table').DataTable();
  });
</script>

@endsection