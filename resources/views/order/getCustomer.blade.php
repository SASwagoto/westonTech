<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <label for="" class="form-label text-primary">Customer Name</label>
            <input type="text" disabled class="form-control" value="{{$customer->name}}">
            <input type="hidden" name="customer_id" value="{{$customer->id}}">
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label for="" class="form-label text-primary">Customer Phone</label>
            <input type="text" disabled class="form-control" value="{{$customer->phone}}">
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label for="" class="form-label text-primary">Customer Email</label>
            <input type="text" disabled class="form-control" value="{{$customer->email}}">
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label for="" class="form-label text-primary">Customer Address</label>
            <input type="text" disabled class="form-control" value="{{$customer->address}}">
        </div>
    </div>
</div>