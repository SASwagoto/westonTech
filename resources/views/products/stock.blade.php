@extends('layouts.admin')

@section('title')
    Add Stocks
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
    Add Stocks
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body justify-content-start">
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
                    <div class="ms-3 float-start">
                        <h4>Stock: {{ $product->stocks }} pcs</h4>
                        <h5>Specifications: {{ $product->specification }}</h5>
                    </div>
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{route('stock.list', $product->slug)}}">Add Stocks</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6>Add Stock</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('stock.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label text-primary">Product Serial Number<span
                                            class="required">*</span>
                                        @error('barcode')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input type="text" class="form-control" name="barcode" placeholder="Scan Barcode"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="specification" class="form-label text-primary">Product Color </label>
                                    <input type="color" name="color" class="form-control">
                                </div>
                                <div class="mt-5">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="unit" class="form-label text-primary">Product Unit</label>
                                    <input type="text" name="unit" placeholder="Enter Product unit"
                                        value="{{ old('unit') }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="purchase_price" class="form-label text-primary">Other's Features </label>
                                    <input type="text" name="others" placeholder="Others Features"
                                        value="{{ old('others') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
