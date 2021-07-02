<h1>تفاصيل الحجز</h1>
@foreach($unitOrders as $unitOrder)
    <h4><span>من</span> {{ explode(' ', $unitOrder->order_from)[1] }} <span>الى:</span> {{ explode(' ', $unitOrder->order_to)[1] }}</h4>
    @if($loop->last)
        <h4>يوم {{ $unitOrder->ar_day }} - {{ str_replace('-', '/', $unitOrder->order_date) }}</h4>
    @endif
    <hr style="height: 4px;">
    <div style="text-align: right; padding: 10px 20px;">
        <h4><span class="label">رقم الحجز:</span> {{ $unitOrder->order_id }}</h4>
        <h4><span class="label">الإسم:</span> {{ $unitOrder->user->name }}</h4>
        <h4><span class="label">رقم الجوال:</span> <span dir="ltr">{{ $unitOrder->user->phone }}</span></h4>
        <h4><span class="label">الإيميل:</span> {{ $unitOrder->user->email }}</h4>
    </div>
@endforeach
<a class="popup-close" pd-popup-close="popupNew" href="#"> </a>
