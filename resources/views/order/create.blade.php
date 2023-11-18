@extends('layouts.admin')

@section('title')
    Create Order
@endsection
@push('css')
@endpush
@section('header_title')
    Create Order
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <form action="{{route('cart.updatePrice')}}" method="POST">
                @csrf
                <div class="card-header">
                    <h4>Select Products</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="mt-4">
                                <label for="" class="text-primary">Scan Code</label>
                                <input type="text" name="barcode" id="barcode" class="form-control">
                            </div>
                        </div>
                        <div class="col-9">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Serial No</th>
                                        <th>price</th>
                                        <th>remove</th>
                                    </tr>
                                </thead>
                                <tbody id="cart-table">
                                    @forelse (session('cart', []) as $key => $item)
                                        <tr>
                                            <th>{{ $key + 1 }}</th>
                                            <th><input readonly type="text" name="pname" class="form-control"
                                                    value="{{ $item->pname ?? ''}}">
                                                <input type="hidden" name="product_id[]" value="{{$item->pid}}">
                                                </th>
                                            <th><input readonly type="text" name="barcode[]" class="form-control"
                                                    value="{{ $item->barcode ?? ''}}"></th>
                                            <th>
                                                <input type="number" name="sale_price[]" class="form-control">
                                            </th>
                                            <th>
                                                <a href="{{ route('cart.remove', $item->barcode ?? '') }}"
                                                    class="btn btn-danger">x</a>
                                            </th>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">No Item Found</td>
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

    @push('js')
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
    @endpush
