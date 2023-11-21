@extends('layouts.admin')

@section('title')
    Edit Employee
@endsection
@push('css')
    <style>
        .image-preview{
            width: 120px;
            height: 150px;
            margin-bottom: 15px;
        }
    </style>
@endpush
@section('header_title')
    Add New Employee
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header justify-content-end">
                    <a href="{{route('emp.list')}}" class="btn btn-primary">Employee List</a>
                </div>
                <div class="card-body">
                    <form action="{{route('emp.update', $employee->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <label class="form-label text-primary">Upload Image @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror</label>
                                <div class="image-preview">
                                    @if ($employee->image)
                                    <img id="preview" src="{{asset('storage/uploads/'.$employee->image)}}" class="w-100" alt="image-previewer">
                                    @else
                                    <img id="preview" src="{{asset('assets')}}/images/avatar.jpg" class="w-100" alt="image-previewer">
                                    @endif
                                </div>
                                <input type="file" name="image" class="form-control" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label text-primary">Name <span class="required">*</span>
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </label>
                                    <input class="form-control" type="text" name="name" id="name" value="{{$employee->name}}" placeholder="Enter Employee Name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label text-primary">Phone <span class="required">*</span>
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </label>
                                    <input class="form-control" type="tel" id="phone" name="phone" value="{{$employee->phone}}" placeholder="e.g., 017XXXXXXXX" pattern="^(\+88)?01[3-9]\d{8}$" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label text-primary">Email <span class="required">*</span>
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </label>
                                    <input class="form-control" type="email" name="email" id="email" value="{{$employee->email}}" placeholder="Enter Employee Email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label text-primary">Select Role 
                                        @error('role')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </label>
                                    <select class="form-control" name="role" id="" required>
                                     <option disabled selected value="">Select roles</option>
                                     @foreach ($roles as $role)
                                         <option value="{{$role->name}}" @if($employee->roles[0]->name == $role->name) selected @endif >{{$role->name}}</option>
                                     @endforeach
                                    </select>
                                 </div>
                                <div>
                                    <button type="submit" class="btn btn-primary float-end mt-5">Submit</button>
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
    <script>
         $(document).ready(function(){
            $('#c_pass').on('keyup', function() {
            var pwd2 = $(this).val();
            var pwd1 = $('#pass').val();
                if (pwd1 == pwd2) {
                    $('#pass_check_msg').html(" Password Matched");
                    $('#pass_check_msg').addClass('text-success');
                    $('#pass_check_msg').removeClass('text-danger');

                } else {
                    $('#pass_check_msg').html(" Password did not matched");
                    $('#pass_check_msg').addClass('text-danger');
                    $('#pass_check_msg').removeClass('text-success');
                }
            });
         });
    </script>
@endpush
