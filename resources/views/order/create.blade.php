@extends('layouts.admin')

@section('title')
    Create Order
@endsection
@push('css')
<link rel="stylesheet" href="{{asset('assets')}}/vendor/select2/css/select2.min.css">
@endpush
@section('header_title')
    Create Order
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <form action="{{route('order.store')}}" method="POST">
                @csrf
                <div class="card-header">
                    <h4 class="mb-0">Select Products</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- <div class="col-lg-4 col-md-5">
                            <div class="mb-3">
                                <label for="customer" class="form-label text-primary">Select Customer</label>
                                <select id="single-select" class="form-control" required>
                                    <option disabled selected value="">Select Customer</option>
                                    @forelse ($customers as $cust)
                                        <option value="{{$cust->id}}">{{$cust->phone}}</option>
                                    @empty
                                        <option value="">No Data Found</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Add New Customer</button>
                            </div>
                        </div> --}}
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="customer_details">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label text-primary">Customer Phone</label>
                                            <input class="form-control" type="tel" id="phone" name="phone" placeholder="e.g., 017XXXXXXXX" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label text-primary">Customer Name</label>
                                            <input type="text" name="name" id="name" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label text-primary">Customer Email</label>
                                            <input class="form-control" type="email" name="email" id="email" value="{{old('email')}}" placeholder="Enter Customer Email">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label text-primary">Customer Address</label>
                                            <input type="text" name="address" id="address" class="form-control" placeholder="Customer Address">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3">
                            <div class="mt-4">
                                <label for="" class="text-primary">Scan Code</label>
                                <input type="text" id="barcode" class="form-control">
                            </div>
                            <div class="mt-4">
                                <label for="" class="text-primary">Manual Select By Serial Number</label>
                                <input type="text" id="sn" class="form-control">
                                <button id="sn_btn" type="button" class="btn btn-primary float-end mt-2">Add</button>
                            </div>
                        </div>
                        <div class="col-9">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Serial No</th>
                                        <th>Qty</th>
                                        <th>price</th>
                                        <th>remove</th>
                                    </tr>
                                </thead>
                                <tbody id="cart-table">
                                    @forelse (session('cart', []) as $key => $item)
                                        <tr>
                                            <th>{{ $key + 1 }}</th>
                                            <th><input readonly type="text" name="pname" class="form-control"
                                                    value="{{ $item->name ?? ''}}">
                                                <input type="hidden" name="product_id[]" value="{{$item->id}}">
                                            </th>
                                            <th><input readonly type="text" name="barcode[]" class="form-control"
                                                    value="{{ $item->barcode ?? ''}}">
                                            </th>
                                            <th>
                                                <input type="number" name="qty[]" min="1" value="1" class="form-control" required>
                                            </th>
                                            <th>
                                                <input type="number" name="sale_price[]" class="form-control" required>
                                            </th>
                                            <th>
                                                <a href="{{ route('cart.remove', $item->barcode ?? '') }}"
                                                    class="btn btn-danger">x</a>
                                            </th>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No Item Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn d-flex justify-content-end">
                        <a href="{{route('cart.removeAll')}}" class="btn btn-danger me-3">Clear Cart</a>
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    @endsection

    @section('modal')
<div class="modal fade" id="exampleModalCenter">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="customerForm" action="{{route('customer.store')}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="name" class="form-label text-primary">Name</label>
                                <input type="text" name="name" id="name" required class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Phone" class="form-label text-primary">Phone</label>
                                <input class="form-control" type="tel" id="phone" name="phone" placeholder="e.g., 017XXXXXXXX" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="email" class="form-label text-primary">Email</label>
                                <input class="form-control" type="email" name="email" id="email" value="{{old('email')}}" placeholder="Enter Customer Email">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="address" class="form-label text-primary">Address</label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Customer Address">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

    @push('js')
    <script src="{{asset('assets')}}/vendor/select2/js/select2.full.min.js"></script>
    <script src="{{asset('assets')}}/js/plugins-init/select2-init.js"></script>
        <script>
            $(document).ready(function() {
                var timeout;

                $('#barcode').on('input', function() {
                    clearTimeout(timeout);
                    timeout = setTimeout(function() {
                        var barCode = $('#barcode').val();
                        var url = '{{ route('cart.add') }}';
                        $.ajax({
                            url: url,
                            method: 'GET',
                            data: {
                                barcode: barCode
                            },
                            success: function(response) {
                                $('#cart-table').html(response);
                                $('#barcode').val('');
                                //console.log('Search Result:', response);
                                //location.reload();
                                // Handle the database search result here
                            },
                            error: function(error) {
                                
                            }
                        });
                    }, 500);
                });
            });
        </script>
        <script>
            $(document).ready(function() {
               $('#sn_btn').on('click', function(){
                var barCode = $('#sn').val();
                var url = '{{ route('cart.add') }}';
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        barcode: barCode
                    },
                    success: function(response) {
                        $('#cart-table').html(response);
                        $('#barcode').val('');
                        //console.log('Search Result:', response);
                        //location.reload();
                        // Handle the database search result here
                    },
                    error: function(error) {
                        
                    }
                });
               });
            });
        </script>
        <script>
            $(document).ready(function(){
                $('#phone').on('keyup', function(){
                    var phone = $(this).val();
                    var url = '{{route('getCustomer')}}';
                    $.ajax({
                            url: url,
                            method: 'GET',
                            data: {
                                phone: phone
                            },
                            success: function(response) {
                                //console.log(response);
                                $('.customer_details').html(response);
                            },
                            error: function(error) {
                                
                            }
                        });
                });
            });
        </script>
        {{-- <script>
            $(document).ready(function() {
                // Submit form using Ajax
                $('#customerForm').submit(function(e) {
                    e.preventDefault(); // Prevent the default form submission
                    var formData = {
                        name: $('#name').val(),
                        phone: $('#phone').val(),
                        email: $('#email').val(),
                        address: $('#address').val(),
                        // Add other form fields as needed
                    };
                    var url = '{{route('customer.store')}}';
                    //console.log(formData);
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: formData,
                        success: function(response) {
                            $('.customer_details').html(response);
                            // Assuming your controller returns a JSON response with a success key
                        },
                        error: function(xhr, status, error) {
                            // Handle Ajax errors
                            console.error('Ajax request failed:', status, error);
                        }
                    });
                });
            });
        </script>         --}}
    @endpush
