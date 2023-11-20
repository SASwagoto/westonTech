@extends('layouts.admin')

@section('title')
    Statement
@endsection
@push('css')
@endpush
@section('header_title')
    {{$acc->acc_name ?? ''}} Statement
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-end">
                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Source/Payee</th>
                                <th>Notes</th>
                                <th>Description</th>
                                <th class="text-end">Amount</th>
                                <th class="text-end">Curent Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stats as $key => $stat)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$stat->date}}</td>
                                <td>{{$stat->source ?? $stat->payee ?? ''}}</td>
                                <td>{{$stat->notes}}</td>
                                <td>{{$stat->idesc ?? $stat->edesc ?? ''}}</td>
                                @if ($stat->notes == 'Expense')
                                <td class="text-end text-danger fw-bold">-{{number_format($stat->amount, 2)}}</td>
                                @else
                                <td class="text-end text-info fw-bold">{{number_format($stat->amount, 2)}}</td>
                                @endif
                                <td class="text-end text-primary fw-bold">{{number_format($stat->current_balance, 1)}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No Data Found</td>
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

@push('js')
@endpush