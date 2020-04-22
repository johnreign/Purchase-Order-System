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
      <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                  <form method="POST" action="{{ url('admin/list',$po->id) }}" id="submit">
                    @method('PATCH')
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
                      <div class="col-xl-6">
                        <div class="form-group">
                          <label class="col-form-label"> Date of Delivery *</label>
                          <input type="date" name="delivery_date" class="form-control" value="{{$po->delivery_date}}">
                        </div>
                      </div>
                      <div class="col-xl-6">
                        <div class="form-group">
                          <label class="col-form-label"> Terms (in days) *</label>
                          <input type="text" name="term" class="form-control" value="{{$po->term}}">
                        </div>
                      </div>
                    </div>
                    <hr>
                    <p><em>*Note: Make sure to add the existing product to this Purchase Order.</em></p>
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
                              @foreach($po->purchase_order_items as $i => $po_item)
                                <tr>
                                  <td>
                                    <input type="text" class="code autocomplete form-control" placeholder="Type the item here and select" value="{{ $po_item->item->code }}">
                                    <input type="hidden" name="items[{{$i}}][id]" value="{{ $po_item->id }}">
                                    <input type="hidden" name="items[{{$i}}][item_id]" class="item_id" value="{{ $po_item->item->id }}" required>
                                  </td>
                                  <td>
                                    <input type="number" name="items[{{$i}}][quantity]" class="form-control input-quantity" value="{{ $po_item->quantity }}">
                                  </td>
                                  <td><input type="number" name="items[{{$i}}][price]" class="form-control input-price" value="{{ $po_item->price }}">
                                  </td>
                                  <td>
                                    <input type="number" name="items[{{$i}}][amount]" class="form-control input-amount" value="{{ $po_item->amount }}" readonly>
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
                          <textarea class="form-control" name="remarks" placeholder="Optional" rows="4">
                            {{ $po->remarks }}</textarea>
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

@section('scripts')

<script type="text/javascript">

  $(document).ready(function() {
    // $('#table-po').DataTable();

    $(document).on('click', '.add-row', function(){
      var rowCount = $('#table-po tr').length;
        $(this).closest('table').each(function () {                
            $('tbody', this).append('<tr>'+
              '<td>'+
                '<input type="text" class="code autocomplete form-control" placeholder="Type the item here and select">'+
                '<input type="hidden" name="items['+rowCount+'][item_id]" class="item_id">'+
              '</td>'+
              '<td>'+
                '<input type="number" name="items['+rowCount+'][quantity]" class="form-control input-quantity" value="1">'+
              '</td>'+
              '<td><input type="number" name="items['+rowCount+'][price]" class="form-control input-price" placeholder="e.g. 99">'+
              '</td>'+
              '<td>'+
                '<input type="number" name="items['+rowCount+'][amount]" class="form-control input-amount" placeholder="e.g. 99" readonly>'+
              '</td>'+
              '<td>'+
                '<button type="button" class="delete btn btn-sm btn-danger"><i class="icofont icofont-trash"></i></button>'+
              '</td>'+
            '</tr>');
        });
    });

    $(document).on('click', '.delete', function(){
      $(this).closest("tr").remove();
    });

    $(document).on("click.autocomplete",".autocomplete",function(e){
      $(this).autocomplete({
          source: function (request, response) {
              $.getJSON("{!! url('admin/items/search') !!}?keyword=" + request.term, function (data) {
                  response($.map(data, function (value, key) {
                    
                      return {
                          label:value['code'] +' '+value['description'],
                          value:value['code'],
                          code : value['code'],
                          description: value['description'],
                          id:value['id']
                      };
                  }));
              });
          },
          select: function (event, ui) {           
              var id = $(this).next('input');
              var description = $(this).closest('tr').find('.description');

              selectReference(event, ui, id, description);
              
          },
          minLength:2,
          delay:0
          }
      );
      
    }); 

    function selectReference(event, ui, id, description)
    {    
        var array = [];            
        var selectedObj = ui.item;
        $(id).val(selectedObj.id);
        $(description).val(selectedObj.description);
    }
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