@extends('layouts.admin')

@section('title')
    Stocks Details
@endsection
@push('css')
<style>
    .product_img{
        width: 50px;
        height: 50px;
        border-radius: 10px;
        overflow: hidden;
    }
    .product_img img{
        width: 100%;
        height: 100%;
    }
    .back-btn {
        width: 30px;
        height: 55px;
        display: flex;
        align-items: center; /* Center vertically */
        justify-content: center; /* Center horizontally */
    }

    .center-icon {
        display: flex;
        flex-direction: column;
        align-items: center; /* Center horizontally within .center-icon */
        justify-content: center; /* Center vertically within .center-icon */
        width: 100%;
        height: 100%;
    }

    @media print {
    @page {
        size: A4; /* Specify the page size as A4 */
        margin: 0.5cm; /* Set margins as needed */
    }
    body {
        text-align: center;
        font-size: 18px;
    }
    .print_row{
        text-align: center;
    }
    .dn,
    .action_btn{
        display: none;
    }
    
}
</style>
@endpush
@section('header_title')
    Stocks Details
@endsection

@section('content')
    <div class="row product_details">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body justify-content-start">
                    <div class="float-start back-btn">
                        <a href="{{ route('product.list') }}">
                            <div class="center-icon">
                                <i class="fa-solid fa-caret-left fa-2x"></i>
                            </div>
                        </a>
                    </div>
                    <div class="product_img float-start">
                        @if ($product->product_img)
                        <img src="{{ asset('storage/products/' . $product->product_img) }}" width="50" alt="image-preview">
                    @else
                        <img src="{{ asset('assets') }}/images/preview.png" width="50" alt="image-preview">
                    @endif
                    </div>
                    <div class="ms-3 float-start">
                        <h4>Name: {{ $product->name }}</h4>
                        <h5>Model: {{ $product->model }}</h5>
                    </div>
                    <div class="ms-5 float-start">
                        <h4>Stock: {{ $product->stocks }} pcs</h4>
                        <h5>Specifications: {{ $product->specification }}</h5>
                    </div>
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{route('stock.add', $product->slug)}}">Add Stocks</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row stock_details">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6>Stock List</h6>
                </div>
                <div class="card-body">
                   <div class="table-responsive">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Barcode</th>
                                <th>Color</th>
                                <th>Entry Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stocks as $key => $stock)
                                <tr class="print_row" id="{{$key + 1}}">
                                    <td>{{$key + 1}}</td>
                                    <td>{!! DNS1D::getBarcodeSVG($stock->barcode, 'C39+', 1, 50) !!}
                                    </td>
                                    <td>{{$stock->color}}</td>
                                    <td>{{$stock->created_at}}</td>
                                    <td>
                                        <ul class="action_btn">
                                            <li>
                                                <a href="javascript:void(0);" class="print-button" onclick="printRow('{{$key + 1}}');">
                                                    <i class="fa-solid fa-print fa-xl"></i>
                                                </a>
                                            </li>
                                            <li><a href="javascript:void(0);"
                                                    onclick="document.getElementById('deleteForm{{$key+1}}').submit()"><i
                                                        class="fa-solid fa-trash fa-xl" style="color: #ff0000;"></i></a>
                                            </li>
                                            <form action="{{route('stock.delete', $stock->id)}}" id="deleteForm{{$key+1}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            </form>
                                        </ul>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Stock Out</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
  function printRow(elem) {
  var header_str = '<html><head><title>' + document.title  + '</title></head><body>';
  var footer_str = '</body></html>';
  var new_str = document.getElementById(elem).innerHTML;
  var old_str = document.body.innerHTML;
  document.body.innerHTML = header_str + new_str + footer_str;
  window.print();
  document.body.innerHTML = old_str;
  return false;
}  
</script>
@endpush
