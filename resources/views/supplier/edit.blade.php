@extends('layouts.admin')

@section('title')
    Edit Supplier
@endsection
@push('css')
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
    {{$sup->name}}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('sup.update', $sup->slug)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label text-primary">Supplier Name / Shop Name <span class="required">*</span>
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </label>
                                    <input class="form-control" type="text" name="name" id="name" value="{{$sup->name}}" placeholder="Enter Supplier Name / Shop Name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label text-primary">Supplier Email
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </label>
                                    <input class="form-control" type="email" name="email" id="email" value="{{$sup->email}}" placeholder="Enter Supplier Email" >
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="mb-3">
                                    <label for="phone" class="form-label text-primary">Supplier Phone <span class="required">*</span>
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </label>
                                    <input class="form-control" type="tel" id="phone" value="{{$sup->phone}}" name="phone" placeholder="e.g., 017XXXXXXXX" pattern="^(\+88)?01[3-9]\d{8}$" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label text-primary">Suplier Address </label>
                                    <input type="text" name="address" value="{{$sup->address}}" class="form-control" placeholder="Bangla Motor, Dhaka. ">
                                </div>
                                
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <label class="form-label text-primary">Upload Image or Logo @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror</label>
                                <input type="file" name="image" class="form-control" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                                <div class="image-preview mt-3">
                                    @if ($sup->image != null)
                                    <img id="preview" src="{{asset('storage/supplier/'.$sup->image)}}" class="w-100" alt="image-previewer">
                                    @else
                                    <img id="preview" src="{{asset('assets')}}/images/avatar.jpg" class="w-100" alt="image-previewer">
                                    @endif
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
