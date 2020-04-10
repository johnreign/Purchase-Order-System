@extends('backend.layouts.adminty')

@section('title', 'Edit PO')

@section('content')

<div class="page-wrapper">
    <div class="page-header">
          <div class="row align-items-end">
              <div class="col-lg-6">
                  <div class="page-header-title">
                      <div class="d-inline">
                          <h4>Edit Purchase Order</h4>
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
                              <a href="#!">Edit PO</a>
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
                  <form method="POST" action="{{ url('admin/list/edit',$po->id) }}" id="submit">
                    @csrf  
                    <div class="row">
                      <div class="col-xl-6">
                        <div class="form-group">
                          <label class="col-form-label">Lot Number *</label>
                          <input type="text" name="lot_number" class="form-control" required placeholder="e.g. 1" value="{{$po->lot_number}}">
                        </div>
                      </div>

                      <div class="col-xl-6">
                        <div class="form-group">
                          <label class="col-form-label">Supplier *</label>
                          <select class="form-control" name="supplier_id">
                            @foreach(\App\Models\Supplier::all() as $i => $v)
                              <option value="{{$v->id}}" {{{ $v->id==$po->supplier_id ?
                              'selected':'' }}}> {{ $v->supp_name }} </option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col-xl-6">
                        <div class="form-group">
                          <label class="col-form-label">PO Number *</label>
                          <input type="text" name="po_number" class="form-control" required placeholder="" value="{{$po->po_number}}">
                        </div>
                      </div>
                      <div class="col-xl-6">
                        <div class="form-group">
                          <label class="col-form-label"> Order Date *</label>
                          <input type="date" name="order_date" class="form-control" 
                          value="{{$po->order_date}}">
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row pt-5">
                      <div class="col-md-12 pr-3">
                        <div class="table-responsive">
                          <table class="table table-bordered display table-dynamic text-center" id="table-po">
                            <thead>
                              <tr>
                                <th width="45%">Items</th>
                                <th width="15%">Quantity</th>
                                <th width="15%">Price</th>
                                <th width="15%">Amount</th>
                                <th width="10%">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($po->purchase_order_item as $i=>$item)
                                <tr>
                                  <td>
                                    <input type="text" class="code autocomplete form-control" placeholder="Type the item here and select" value="{{ $item->item->code }}">
                                    <input type="hidden" name="items[{{$i}}][item_id]" class="item_id" required>
                                  </td>
                                  <td>
                                    <input type="number" name="items[{{$i}}][quantity]" class="form-control input-quantity" value="{{ $item->quantity }}">
                                  </td>
                                  <td><input type="number" name="items[{{$i}}][price]" class="form-control input-price" value="{{ $item->price }}">
                                  </td>
                                  <td>
                                    <input type="number" name="items[{{$i}}][amount]" class="form-control input-amount" value="{{ $item->amount }}" readonly>
                                  </td>
                                  <td>
                                    <button type="button" class="delete btn btn-sm btn-danger"><i class="icofont icofont-trash"></i></button>
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="5" class="text-left">
                                  <a href="#!" class="btn btn-primary add-row"><i class="feather icon-plus"></i> Add Row</a>
                                </td>
                              </tr>
                            </tfoot>
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
                          <h4 class="text-primary">TOTAL AMOUNT : <span id="total">{{$po->total_amount}}</span></h4>
                          <input type="hidden"  name="total_amount">
                        </div>
                      </div>
                    </div>
                    <div class="card-footer border border-top text-right">
                      <button type="submit" class="btn btn-lg btn-success"><i class="feather icon-save"></i> Update</button>
                    </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection