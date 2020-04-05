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
                    <div class="row pt-5">
                      <div class="col-md-12 pr-3">
                        <div class="table-responsive">
                          <table class="table table-bordered display table-dynamic text-center" id="table-po" style="width:99%">
                            <thead>
                              <tr>
                                <th>Items</th>
                                <th style="width:100px;">Quantity</th>
                                <th style="width:100px;">Price</th>
                                <th style="width:100px;">Amount</th>
                                <th style="width:80px;">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($items as $i => $item)
                              <tr>
                                <td>
                                  {{ $item->unit }}
                                </td>
                                <td>
                                  <input style="width:100px" type="number" name="items[0][quantity]" class="form-control input-quantity" >
                                </td>
                                <td><input style="width:100px" type="number" name="items[0][price]" class="form-control input-price">
                                </td>
                                <td>
                                  <input style="width:100px" type="number" name="items[0][amount]" class="form-control input-amount" readonly>
                                </td>
                                <td>
                                  <button name="add" class="delete btn btn-sm btn-primary"><i class="icofont icofont-plus"></i>Add Item</button>
                                </td>
                              </tr>
                              @endforeach
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
                          <h4 class="text-primary">TOTAL AMOUNT : <span id="total">0.00</span></h4>
                          <input type="hidden"  name="total_amount">
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
    $('#table-po').DataTable();
  });

  $('#table-po').on('input', '.input-price', function(){
    var val = parseFloat(this.value);
    var row = $(this).closest('tr');
    var price = parseFloat(val || 0);
    var qty = parseFloat(row.find('.input-quantity').val() || 0);
    var amount = qty * price;

    row.find('.input-amount').val(amount);
    updateSummary();
  });

  function updateSummary()
  {
    var table = $('#table-po');
    var subtotal = 0;
    table.find('.input-amount').each(function(){
      subtotal += parseFloat($(this).val());
    });


    var vatable = subtotal / 1.12;
    var vat_amount= subtotal - vatable;
    $('[name="total_amount"]').val(subtotal.toFixed(2));
    $('[name="subtotal"]').val(subtotal.toFixed(2));
    $('[name="vatable"]').val(vatable.toFixed(2));
        $('[name="vat_amount"]').val(vat_amount.toFixed(2))

    var st = subtotal - vatable;

    $('#subtotal').html(vatable.toFixed(2));
    $('#vat').html(st.toFixed(2));
    $('#total').html(subtotal.toFixed(2));
  }

</script>

@endsection