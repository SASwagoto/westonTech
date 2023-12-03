@extends('layouts.admin')

@section('title')
    Order Checkout
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
</style>
@endpush
@section('header_title')
Order Checkout
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body justify-content-start">
                    <div class="ms-3 float-start">
                        <h5>Customer Name: {{$saleInfo->name}}</h5>
                        <h5>Customer Phone: {{$saleInfo->phone}}</h5>
                        <h5>Customer Email: {{$saleInfo->email}}</h5>
                        <h5>Customer Address: {{$saleInfo->address}}</h5>
                    </div>
                    <div class="float-end text-end">
                        <h5>{!! DNS1D::getBarcodeSVG($saleInfo->invoice_id, 'C39+', 1, 50) !!}</h5>
                        <h5>Invoice No: {{$saleInfo->invoice_id}}</h5>
                        <h5>Date : {{date('Y-m-d', strtotime($saleInfo->date))}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6>Product Info</h6>
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Serial No</th>
                                <th>price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $key => $item)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->barcode}}</td>
                                    <td class="text-end">{{number_format($item->sale_price, 2)}}</td>
                                </tr>
                            @empty
                                
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end">Total:</td>
                                <td colspan="3" class="text-end fw-bolder">{{number_format($saleInfo->total, 2)}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{route('order.sold')}}" method="POST">
                    @csrf
                    <input type="hidden" name="sale_id" value="{{$saleInfo->id}}">
                    <div class="card-header">
                        Payment
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="acc" class="form-lable text-primary">Select Account</label>
                                    <select name="aid" class="form-control" required>
                                        <option disabled selected value="">Select Account</option>
                                        @forelse ($accs as $acc)
                                            <option value="{{$acc->id}}">{{$acc->acc_name}}</option>
                                        @empty
                                            <option disabled value="">No Data Found</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="seller" class="form-lable text-primary">Select Seller</label>
                                    <select name="seller_id" class="form-control" required>
                                        <option disabled selected value="">Select Seller</option>
                                        @forelse ($emps as $emp)
                                            <option value="{{$emp->id}}">{{$emp->name}}</option>
                                        @empty
                                            <option disabled value="">No Data Found</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-5">
                                    <label class="text-primary form-label">Pay Amount</label>
                                    <input type="number" class="form-control" step="0.01" name="payment">
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-primary float-end mt-3">Create Invoice</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
