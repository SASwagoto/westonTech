@forelse (session('cart', []) as $key => $item)
    <tr>
        <th>{{ $key + 1 }}</th>
        <th><input readonly type="text" class="form-control" value="{{ $item->pname ?? '' }}">
            <input type="hidden" name="product_id[]" value="{{$item->pid}}"></th>
        <th><input readonly type="text" name="barcode[]" class="form-control" value="{{ $item->barcode ?? '' }}"></th>
        <th>
            <input type="number" name="sale_price[]" class="form-control">
        </th>
        <th>
            <a href="{{ route('cart.remove', $item->barcode ?? '') }}" class="btn btn-danger">x</a>
        </th>
    </tr>
@empty
    <tr>
        <td colspan="5">No Item Found</td>
    </tr>
@endforelse
