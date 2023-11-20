@extends('layouts.admin')

@section('title')
    Accounts
@endsection
@push('css')
@endpush
@section('header_title')
    Accounts List
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-end">
                <a href="{{route('acc.create')}}" class="btn btn-primary">Add New Account</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Account Name</th>
                                <th>Acc. Type</th>
                                <th>Acc. Number</th>
                                <th>Bank Name</th>
                                <th class="text-end">Current Balance</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($accounts as $key => $acc)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$acc->acc_name}}</td>
                                <td>{{$acc->acc_type}}</td>
                                <td>{{$acc->acc_no}}</td>
                                <td>{{$acc->bank_name}}</td>
                                <td class="text-end fw-bold">{{number_format($acc->balance, 2)}}</td>
                                <td class="d-flex justify-content-end">
                                    <a href="{{route('acc.stats', $acc->id)}}"><i class="fa-solid fa-file-invoice-dollar fa-xl"></i></a>
                                    @if ($acc->acc_type != 'Cash (Default)')
                                    <a href="javascript:void(0);" onclick="document.getElementById('deleteForm{{$key+1}}').submit();" class="ms-2"><i class="fa-solid fa-trash fa-xl text-danger"></i></a>
                                    @endif
                                    <form action="{{route('acc.delete')}}" method="POST" id="deleteForm{{$key+1}}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{$acc->id}}">
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No Accounts Found</td>
                            </tr>
                            @endforelse
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end">Total</td>
                                <td class="text-end fw-bolder">{{number_format($accounts->sum('balance'), 2)}}</td>
                                <td></td>
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
@endpush
