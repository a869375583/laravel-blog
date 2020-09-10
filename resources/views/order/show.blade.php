<div>
    <span>订单状态：</span>
</div>
<!-- 支付按钮开始 -->
@if(!$order->paid_at && !$order->closed)
    <div class="payment-buttons">
        <a class="btn btn-primary btn-sm" href="{{ route('payment.alipay', ['order' => $order->id]) }}">支付宝支付</a>
    </div>
@endif
<!-- 支付按钮结束 -->
