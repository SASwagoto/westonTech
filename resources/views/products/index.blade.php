@extends('layouts.admin')

@section('title')
    Product list
@endsection
@push('css')
    <style>
       .center-content {
        display: flex;
        align-items: center;
        justify-content: left;
        text-align: center;
        height: 100%;
    }
    .center-content h6{
        margin-bottom: 0px;
    }

    .center-content>.img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 10px;
    }
    .img img{
        vertical-align: middle;
    }
    </style>
@endpush
@section('header_title')
    Product List
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-end">
                    <a href="{{route('product.add')}}" class="btn btn-primary">+ Add New Product</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive border">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Barcode</th>
                                    <th>Model</th>
                                    <th>Specification</th>
                                    <th>Stocks</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $key => $product)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>
                                            <div class="center-content">
                                                <div class="img">
                                                    @if ($product->product_img)
                                                    <img src="{{ asset('storage/products/' . $product->product_img) }}" class="w-100" alt="">
                                                @else
                                                    <img src="{{ asset('assets') }}/images/avatar.jpg" class="w-100" alt="">
                                                @endif
                                                </div>
                                                <h6>{{ $product->name }}</h6>
                                            </div>
                                        </td>
                                        <td>{{$product->barcode}}</td>
                                        <td>{{$product->model}}</td>
                                        <td title="{{$product->specification}}">{!! \Illuminate\Support\Str::words($product->specification, 4,'....')  !!}</td>
                                        <td>{{$product->stocks}}</td>
                                        <td>
                                            <ul class="action_btn">
                                                <li>
                                                    <a href="{{route('product.edit', $product->slug)}}" class="edit-button">
                                                        <i class="fa-solid fa-pen-to-square fa-xl" style="color: #347af4;"></i>
                                                    </a>
                                                </li>
                                                <li><a href="javascript:void(0);"
                                                        onclick="document.getElementById('deleteForm{{$key+1}}').submit()"><i
                                                            class="fa-solid fa-trash fa-xl" style="color: #ff0000;"></i></a>
                                                </li>
                                                <form action="{{route('product.delete', $product->slug)}}" id="deleteForm{{$key+1}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                </form>
                                            </ul>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Product Found</td>
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
