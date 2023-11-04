@extends('layouts.admin')

@section('title')
    Supplier list
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
    Supplier List
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-end">
                    <a href="{{route('sup.add')}}" class="btn btn-primary">+ Add Supplier</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive border">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Supplier/Shop</th>
                                    <th>Address</th>
                                    <th>Contacts</th>
                                    <th>Total purchase</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($suppliers as $key => $sup)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>
                                            <div class="center-content">
                                                <div class="img">
                                                    @if ($sup->image)
                                                    <img src="{{ asset('storage/supplier/' . $sup->image) }}" class="w-100" alt="">
                                                @else
                                                    <img src="{{ asset('assets') }}/images/avatar.jpg" class="w-100" alt="">
                                                @endif
                                                </div>
                                                <h6>{{ $sup->name }}</h6>
                                            </div>
                                        </td>
                                        <td>{{$sup->address}}</td>
                                        <td class="contacts_icon">
                                            <a href="tel:{{$sup->phone}}"><i class="fa-solid fa-phone"></i></a>
                                            <a href="mailto:{{$sup->email}}"><i class="fa-solid fa-envelope"></i></a>
                                        </td>
                                        <td>
                                            2,90,000.00
                                        </td>
                                        <td>
                                            <span class="badge {{ $sup->isActive ? 'badge-success' : 'badge-danger' }} light">{{ $sup->isActive ? 'Active' : 'Inactive' }}</span>
                                        </td>
                                        <td>
                                            <ul class="action_btn">
                                                <li>
                                                    <a href="javascript:void(0);" class="edit-button">
                                                        <i class="fa-solid fa-pen-to-square fa-xl" style="color: #347af4;"></i>
                                                    </a>
                                                </li>
                                                <li><a href="javascript:void(0);"
                                                        onclick="document.getElementById('').submit()"><i
                                                            class="fa-solid fa-trash fa-xl" style="color: #ff0000;"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @empty
                                    
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
