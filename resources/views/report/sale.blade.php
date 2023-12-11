@extends('layouts.admin')

@section('title')
    Sales Report
@endsection
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
<style>
    .dt-buttons{
        margin-bottom: 10px;
    }
</style>
@endpush
@section('header_title')
    Sales Report  :: From {{$starDate ?? date('Y-m-d')}} to {{$endDate ?? date('Y-m-d')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form class="form-inline d-flex justify-content-end" action="{{route('saleReportByDate')}}" method="GET">
                        <div class="form-group mb-2">
                            <label for="staticEmail2" class="sr-only">Email</label>
                            <input type="date" class="form-control" name="start_date" value="{{date('Y-m-d')}}">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="date" class="form-control" name="end_date" value="{{date('Y-m-d')}}">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Run Report</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive" id="saleReport">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice No</th>
                                    <th>Date</th>
                                    <th>Customar details</th>
                                    <th class="text-end">Total</th>
                                    <th class="text-end">Payment</th>
                                    <th class="text-end">Due</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $key => $order)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$order->invoice_id}}</td>
                                        <td>{{date('Y-m-d', strtotime($order->date))}}</td>
                                        <td class="d-flex flex-column">
                                           <span>{{$order->name}}</span> 
                                           <span>{{$order->phone}}</span>
                                        </td>
                                        <td class="text-end">{{number_format($order->total,2)}}</td>
                                        <td class="text-end">{{number_format($order->payment,2)}}</td>
                                        <td class="text-end">{{number_format($order->due,2)}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Orders Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4"></th>
                                    <th class="text-end">Total: {{number_format($orders->sum('total'),2)}}</th>
                                    <th class="text-end">Payment: {{number_format($orders->sum('payment'),2)}}</th>
                                    <th class="text-end">Due: {{number_format($orders->sum('due'),2)}}</th>
                                </tr>
                            </tfoot> 
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
{{-- @if (Session::has('url'))
<script type="text/javascript">
    // JavaScript to open a new tab with the URL specified in the header
    window.open("{{ Session::get('url') }}", '_blank');
</script>
@endif --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script>
<script>
$(document).ready(function() {
            $('#saleReport').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                filter: false,
                paginate: false
            });
        });
</script>
@endpush
