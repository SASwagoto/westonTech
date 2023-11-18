@extends('layouts.admin')

@section('title')
    Incomes
@endsection
@push('css')
@endpush
@section('header_title')
    Incomes List
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-end">
                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Add Income</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Source</th>
                                <th>Account</th>
                                <th>Description</th>
                                <th class="text-end">Amount</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($incomes as $key => $income)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$income->date}}</td>
                                <td>{{$income->source}}</td>
                                <td>{{$income->acc_name}}</td>
                                <td>{{$income->description}}</td>
                                <td class="text-end fw-bold">{{number_format($income->amount, 2)}}</td>
                                <td class="d-flex justify-content-end">
                                    <a href="#"><i class="fa-solid fa-file-invoice-dollar fa-xl"></i></a>
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
                                <td class="text-end fw-bolder">{{number_format($incomes->sum('amount'), 2)}}</td>
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

@section('modal')
<div class="modal fade" id="exampleModalCenter">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{route('acc.addIncome')}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Income</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="source" class="form-label text-primary">Source</label>
                                <input type="text" name="source" id="source" required class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="amount" class="form-label text-primary">Amount</label>
                                <input type="number" name="amount" step="0.01" id="amount" required class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="date" class="form-label text-primary">Date</label>
                                <input type="date" name="date" id="date" required class="form-control" value="{{date('Y-m-d')}}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="aid" class="form-label text-primary">Select Account</label>
                                <select name="aid" id="aid" class="form-control" required>
                                    @forelse ($accounts as $acc)
                                       <option value="{{$acc->id}}">{{$acc->acc_name}}</option> 
                                    @empty
                                        <option value="">No Accounts Found</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="description" class="form-label text-primary">Description</label>
                                <input type="text" name="description" id="description" class="form-control">
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
@endpush
