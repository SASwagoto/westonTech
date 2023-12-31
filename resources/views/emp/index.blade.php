@extends('layouts.admin')

@section('title')
    Employee list
@endsection

@section('header_title')
    Employee List
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-end">
                    <a href="{{route('emp.add')}}" class="btn btn-primary">+ Add Employee</a>
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
                                        <ul class="action_btn">
                                            <li>
                                                <a href="{{route('emp.edit', $emp->id)}}" class="edit-button">
                                                    <i class="fa-solid fa-pen-to-square fa-xl" style="color: #347af4;"></i>
                                                </a>
                                            </li>
                                            <li><a href="javascript:void(0);"
                                                    onclick="document.getElementById('deleteForm{{$emp->id}}').submit()"><i
                                                        class="fa-solid fa-trash fa-xl" style="color: #ff0000;"></i></a>
                                            </li>
                                            <form id="deleteForm{{$emp->id}}" action="{{route('emp.delete', $emp->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{$emp->id}}">
                                            </form>
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
