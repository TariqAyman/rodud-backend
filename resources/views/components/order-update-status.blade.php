<form id="update-order-status-{{ $status }}" method="post"
      action="{{ route('admin.orders.update',['order' => $order->id]) }}">
    @csrf
    @method('patch')
    <input type="hidden" name="status" value="{{ $status }}">
</form>
