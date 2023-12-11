@extends('layouts.admin')

@section('title')
    Trash
@endsection
@push('css')
@endpush
@section('header_title')
    Trash
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-end">
                <h4>Deleted Employee</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Contacts</th>
                                <th>Total Sale</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $key => $emp)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$emp->name}}</td>
                                <td class="contacts_icon">
                                    <a href="tel:{{$emp->phone}}"><i class="fa-solid fa-phone"></i></a>
                                    <a href="mailto:{{$emp->email}}"><i class="fa-solid fa-envelope"></i></a>
                                </td>
                                <td>--</td>
                                <td>
                                    <ul class="d-flex justify-content-end">
                                        @if ($emp->trashed())
                                        {{-- Restore button --}}
                                        <form action="{{ route('emp.restore', ['id' => $emp->id]) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <button class="btn btn-success btn-sm" type="submit"><i class="fa-solid fa-arrow-rotate-left"></i></button>
                                        </form>
                                        
                                        {{-- Force delete button --}}
                                        <form action="{{ route('emp.forceDelete', ['id' => $emp->id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    @endif
                                    </ul>
                                </td>
                            </tr>  
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">NO Data Found</td>
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