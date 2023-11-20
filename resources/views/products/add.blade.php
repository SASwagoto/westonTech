@extends('layouts.admin')

@section('title')
    Add Product
@endsection
@push('css')
<link rel="stylesheet" href="{{ asset('assets') }}/vendor/select2/css/select2.min.css">
<style>
    .image-preview{
        width: 120px;
        height: 120px;
        overflow: hidden;
        border-radius: 10px;
    }
</style>
@endpush
@section('header_title')
    Add New Product
@endsection

@section('content')
   <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-end">
                <a href="{{route('product.list')}}" class="btn btn-primary">Product List</a>
            </div>
            <div class="card-body">
                <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="name" class="form-label text-primary">Product Name <span class="required">*</span>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </label>
                                <input type="text" class="form-control" name="name"  placeholder="Enter Product Name"  value="{{old('name')}}">
                            </div>
                            <div class="mb-3">
                                <label for="specification" class="form-label text-primary">Product Specification </label>
                                <textarea name="specification" class="form-control" rows="5" placeholder="Enter Product Specifications"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-primary">Upload Product Image @error('product_img')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror</label>
                                <input type="file" name="product_img" class="form-control" accept=".png, .jpg, .jpeg" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="mb-3">
                                <div class="form-check mb-2">
                                    <input type="checkbox" name="giftable" class="form-check-input" id="check1" value="1" checked="">
                                    <label class="form-check-label" for="check1">Giftable</label>
                                </div>
                            </div>
                        </div>
                        <div  class="col-lg-6 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="model" class="form-label text-primary">Product Model</label>
                                <input type="text" name="model" placeholder="Enter Product Model" value="{{old('model')}}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="purchase_price" class="form-label text-primary">Purchase Price <span class="required">*</span>
                                    @error('purchase_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror</label>
                                <input type="number" required style="text-align: right;" placeholder="0.00" class="form-control" name="purchase_price" step="0.01" min="0" pattern="^\d+(\.\d{2})?$">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-primary">Select Supplier</label>
                                <select id="select-supplier" class="form-control" name="supplier_id">
                                    <option disabled selected value="">Select Suppliers</option>
                                    @forelse ($suppliers as $supplier)
                                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                    @empty
                                    <option>No Supplier Found</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="mb-3">
                                <div class="image-preview mt-3">
                                    <img id="preview" src="{{asset('assets')}}/images/preview.png" class="w-100" alt="image-previewer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
<script src="{{ asset('assets') }}/vendor/select2/js/select2.full.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins-init/select2-init.js"></script>
<script>
    // Initialize Select2 for the "Select Sector" dropdown
    $('#select-supplier').select2();
   
</script>
@endpush