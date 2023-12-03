@extends('layouts.admin')

@section('title')
    Home
@endsection

@section('header_title')
    Dashboard
@endsection

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="card">
            <div class="card-body text-center">
                <h3>{{$products->sum('stocks')}}</h3>
                <h4>Total Stocks</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="card">
            <div class="card-body text-center">
                @php
                    $totalSum = $products->sum(function ($product) {
                    $stock = $product->stocks ?? 0;
                    $purchasePrice = $product->purchase_price ?? 0;
                    return $stock * $purchasePrice;
                    });
                @endphp
                <h3>{{number_format($totalSum,2)}}</h3>
                <h4>Total Stock Value</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="card">
            <div class="card-body text-center">
                <h3>{{number_format($sales->sum('total'),2)}}</h3>
                <h4>Total Sale Value</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="card">
            <div class="card-body text-center">
                <h3>{{$sales->count()}}</h3>
                <h4>Total Sale</h4>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="card">
            <div class="card-body text-center">
                <h3>{{$todayS->count()}}</h3>
                <h4>Today Sale</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="card">
            <div class="card-body text-center">
                <h3>{{number_format($todayS->sum('total'),2)}}</h3>
                <h4>Today Sale value</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="card">
            <div class="card-body text-center">
                <h3>{{number_format($todayP->sum('purchase_price'),2)}}</h3>
                <h4>Today Purchase Value</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="card">
            <div class="card-body text-center">
                <h3>{{number_format($sales->sum('due'),2)}}</h3>
                <h4>Total Due</h4>
            </div>
        </div>
    </div>
</div>
   
@endsection