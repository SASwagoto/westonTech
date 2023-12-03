@extends('layouts.admin')

@section('title')
    Order List
@endsection

@section('header_title')
    Order List
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-end">
                    <a href="{{route('order.add')}}" class="btn btn-primary">+ Create New Order</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice No</th>
                                    <th>Date</th>
                                    <th>Customar Name</th>
                                    <th>Customer Phone</th>
                                    <th>Balance</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $key => $order)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$order->invoice_id}}</td>
                                        <td>{{date('Y-m-d', strtotime($order->date))}}</td>
                                        <td>{{$order->name}}</td>
                                        <td>{{$order->phone}}</td>
                                        <td class="text-end">
                                            <span class="d-block text-primary">Total: {{number_format($order->total,2)}}</span> 
                                            <span class="d-block text-success">Payment: {{number_format($order->payment,2)}}</span> 
                                            <span class="d-block text-danger">Due: {{number_format($order->due,2)}}</span> 
                                        </td>
                                        <td>
                                            <div class="dropdown custom-dropdown float-end">
                                                <div class="btn sharp tp-btn " data-bs-toggle="dropdown">
                                                    <svg width="24" height="6" viewBox="0 0 24 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.0012 0.359985C11.6543 0.359985 11.3109 0.428302 10.9904 0.561035C10.67 0.693767 10.3788 0.888317 10.1335 1.13358C9.88829 1.37883 9.69374 1.67 9.56101 1.99044C9.42828 2.31089 9.35996 2.65434 9.35996 3.00119C9.35996 3.34803 9.42828 3.69148 9.56101 4.01193C9.69374 4.33237 9.88829 4.62354 10.1335 4.8688C10.3788 5.11405 10.67 5.3086 10.9904 5.44134C11.3109 5.57407 11.6543 5.64239 12.0012 5.64239C12.7017 5.64223 13.3734 5.36381 13.8686 4.86837C14.3638 4.37294 14.6419 3.70108 14.6418 3.00059C14.6416 2.3001 14.3632 1.62836 13.8677 1.13315C13.3723 0.637942 12.7004 0.359826 12 0.359985H12.0012ZM3.60116 0.359985C3.25431 0.359985 2.91086 0.428302 2.59042 0.561035C2.26997 0.693767 1.97881 0.888317 1.73355 1.13358C1.48829 1.37883 1.29374 1.67 1.16101 1.99044C1.02828 2.31089 0.959961 2.65434 0.959961 3.00119C0.959961 3.34803 1.02828 3.69148 1.16101 4.01193C1.29374 4.33237 1.48829 4.62354 1.73355 4.8688C1.97881 5.11405 2.26997 5.3086 2.59042 5.44134C2.91086 5.57407 3.25431 5.64239 3.60116 5.64239C4.30165 5.64223 4.97339 5.36381 5.4686 4.86837C5.9638 4.37294 6.24192 3.70108 6.24176 3.00059C6.2416 2.3001 5.96318 1.62836 5.46775 1.13315C4.97231 0.637942 4.30045 0.359826 3.59996 0.359985H3.60116ZM20.4012 0.359985C20.0543 0.359985 19.7109 0.428302 19.3904 0.561035C19.07 0.693767 18.7788 0.888317 18.5336 1.13358C18.2883 1.37883 18.0937 1.67 17.961 1.99044C17.8283 2.31089 17.76 2.65434 17.76 3.00119C17.76 3.34803 17.8283 3.69148 17.961 4.01193C18.0937 4.33237 18.2883 4.62354 18.5336 4.8688C18.7788 5.11405 19.07 5.3086 19.3904 5.44134C19.7109 5.57407 20.0543 5.64239 20.4012 5.64239C21.1017 5.64223 21.7734 5.36381 22.2686 4.86837C22.7638 4.37294 23.0419 3.70108 23.0418 3.00059C23.0416 2.3001 22.7632 1.62836 22.2677 1.13315C21.7723 0.637942 21.1005 0.359826 20.4 0.359985H20.4012Z" fill="#A098AE"/>
                                                    </svg>
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    @if ($order->due>0)
                                                    <a class="dropdown-item" onclick="duepay('{{$order->invoice_id}}','{{$order->id}}','{{$order->total}}','{{$order->due}}','{{$order->payment}}')" id="due" data-bs-toggle="modal" data-bs-target="#exampleModal">Due Pay</a>
                                                    
                                                    @endif
                                                    <a class="dropdown-item" href="{{route('sale.invoice', $order->id)}}">
                                                        Print Invoice
                                                    </a>
                                                    {{-- <a class="dropdown-item" onclick="openInvoiceInNewWindow('{{$order->sid}}')" data-id="{{$order->sid}}" >Print Invoice</a> --}}
                                                </div>
                                            </div>
                                            {{-- <ul class="action_btn">
                                                <li>
                                                    <a href="{{route('sale.invoice', $order->id)}}" class="print-button">
                                                        <i class="fa-solid fa-print fa-xl"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('order.checkout', $order->id)}}"><i class="fa-solid fa-credit-card"></i></a>
                                                </li>
                                                <li><a href="javascript:void(0);"
                                                        onclick="document.getElementById('').submit()"><i
                                                            class="fa-solid fa-trash fa-xl" style="color: #ff0000;"></i></a>
                                                </li>
                                            </ul> --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Orders Found</td>
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

@section('modal')
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form enctype="multipart/form-data" method="POST" action="{{route('order.duepay')}}">
        @csrf
    <div class="modal-dialog modal-dialog-center">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text" id="exampleModalLabel">Payment</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p id="student-details"></p>
          <div class="row">
            
              <div class="col-12">
                  <div class="mb-12">
                    <label for="exampleFormControlInput1" class="form-label">Amount</label>
                    <input type="text" name="payment" class="form-control" id="exampleFormControlInput1" placeholder="Type your full name">
                <input name="id" id="sid" hidden>  
                </div>

                
                  
              </div>

             
              

             
          </div>
          <br>
          <div class="mb-3">
            <label for="exampleFormControlInput9" class="form-label text-primary">Account Details</label>
            <select  class="default-select form-control wide mb-3" name="aid">
             
             @foreach ($accounts as $ac)
                 <option value="{{$ac->id}}" >{{$ac->acc_name}}</option>
             @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Payment</button>
        </div>
      </div>
    </div>
    </form>
  </div>

@endsection

@push('js')
@if (Session::has('url'))
<script type="text/javascript">
    // JavaScript to open a new tab with the URL specified in the header
    window.open("{{ Session::get('url') }}", '_blank');
</script>
@endif

<script>
    function duepay(name, id, fee, due, payment) {
    document.getElementById('exampleFormControlInput1').value = due;
    document.getElementById('sid').value = id;
    document.getElementById('student-details').innerHTML = "<p><span class='text-primary'> Invoice ID = " + name + "</span> <br><span class='text-primary'> Total Price = " + fee + " TK</span><br><span class='text-info'> Payment = " + payment + " TK </spam><br></span><span class='text-danger'> Due = " + due + " TK</span>  </p>";
}
</script>
@endpush
