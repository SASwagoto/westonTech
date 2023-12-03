@extends('layouts.admin')

@section('title')
    Add Account
@endsection
@push('css')
@endpush
@section('header_title')
    Create New Account
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-end">
                    <a href="{{ route('acc.index') }}" class="btn btn-primary">Accounts List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('acc.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label text-primary">Accounts Name</label>
                                    <input type="text" name="acc_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label text-primary">Accounts Type</label>
                                    <select name="acc_type" id="accType" class="form-control" required>
                                        <option disabled selected value="">Select Type</option>
                                        <option disabled value="Cash">Cash</option>
                                        <option value="Bank">Bank</option>
                                        <option value="Mobile Banking">Mobile Banking</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="text-primary form-label">Initial Balance</label>
                                <input type="number" class="form-control" step="0.01" name="init_balance" value=0.00>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-primary">Bank Name</label>
                                    <input type="text" disabled id="bank" name="bank_name" class="form-control" required> 
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label text-primary">Accounts No</label>
                                    <input type="text" disabled id="accNo" name="acc_no" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="float-end mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
        $(document).ready(function() {
            $('#accType').on('change', function() {
                var num = $(this).val();
                console.log(num);
                if (num == 'Bank' || num == 'Mobile Banking') {
                    $('#bank').removeAttr('disabled');
                    $('#accNo').removeAttr('disabled');
                } else {
                    $('#bank').attr('disabled');
                    $('#accNo').attr('disabled');
                }
            });
        });
    </script>
@endpush
