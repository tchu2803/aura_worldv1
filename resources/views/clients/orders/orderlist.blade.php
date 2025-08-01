@extends('clients.layouts.default')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center mb-4" style="font-weight:700; font-size:2rem;">Đơn hàng của tôi</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-hover shadow-sm rounded" style="background:#fff;">
                <thead style="background:#4cd964; color:#fff; font-weight:700; text-align:center;">
                    <tr class="text-center align-middle">
                        <th style="min-width:50px;">STT</th>
                        <th style="min-width:120px;">Name</th>
                        <th style="min-width:120px;">Phone</th>
                        <th style="min-width:200px;">Address</th>
                        <th style="min-width:120px;">Total</th>
                        <th style="min-width:120px;">Status</th>
                        <th style="min-width:150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $i => $order)
                        <tr class="text-center align-middle" style="vertical-align:middle;">
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $order->user->name ?? '-' }}</td>
                            <td>{{ $order->user_phone }}</td>
                            <td>{{ $order->user_address }}</td>
                            <td style="font-weight:600;">{{ number_format($order->total_price, 0, ',', '.') }} vnd</td>
                            <td>
                                @if ($order->status_order === 'pending')
                                    <span class="badge bg-warning text-dark px-3 py-2" style="font-size:1em;">CHỜ XÁC
                                        NHẬN</span>
                                @elseif($order->status_order === 'completed')
                                    <span class="badge bg-success px-3 py-2" style="font-size:1em;">HOÀN THÀNH</span>
                                @elseif($order->status_order === 'confirmed')
                                    <span class="badge bg-success px-3 py-2" style="font-size:1em;">ĐÃ XÁC NHẬN</span>
                                @elseif($order->status_order === 'shipping')
                                    <span class="badge bg-success px-3 py-2" style="font-size:1em;">ĐANG GIAO HÀNG</span>
                                @elseif($order->status_order === 'shipped')
                                    <span class="badge bg-success px-3 py-2" style="font-size:1em;">ĐÃ GIAO HÀNG</span>
                                @elseif($order->status_order === 'received')
                                    <span class="badge bg-success px-3 py-2" style="font-size:1em;">ĐÃ NHẬN HÀNG</span>
                                @elseif($order->status_order === 'shipped')
                                    <span class="badge bg-success px-3 py-2" style="font-size:1em;">ĐÃ GIAO HÀNG</span>
                                @elseif($order->status_order === 'cancelled')
                                    <span class="badge bg-danger px-3 py-2" style="font-size:1em;">ĐÃ HỦY</span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2"
                                        style="font-size:1em;">{{ strtoupper($order->status_order) }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    @if ($order->status_order === 'pending')
                                        <button type="button" class="btn btn-sm btn-danger" onclick="showCancelModal({{ $order->id }})">Hủy Đơn Hàng</button>
                                    @endif
                                    <a href="{{ route('client.orders.detail', $order->id) }}" class="btn btn-sm btn-success">Order Detail</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Bạn chưa có đơn hàng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

<!-- Modal nhập lý do hủy đơn -->
<div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="cancelOrderForm" method="POST" action="{{ route('client.orders.cancel') }}">
      @csrf
      <input type="hidden" name="order_id" id="cancel_order_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Lý do hủy đơn</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <textarea name="cancel_reason" class="form-control" required placeholder="Nhập lý do hủy đơn..."></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-danger">Xác nhận hủy</button>
        </div>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
function showCancelModal(orderId) {
    document.getElementById('cancel_order_id').value = orderId;
    var myModal = new bootstrap.Modal(document.getElementById('cancelOrderModal'));
    myModal.show();
}
</script>
@endpush
