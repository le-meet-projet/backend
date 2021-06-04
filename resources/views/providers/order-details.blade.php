<h1>تفاصيل الحجز</h1>
<h2>قاعة المكان</h2>
@foreach($unitOrders as $unitOrder)
    <h4><span>من</span> {{ explode(' ', $unitOrder->order_from)[1] }} <span>الى:</span> {{ explode(' ', $unitOrder->order_to)[1] }}</h4>
    @if($loop->last)
        <h4>{{ $unitOrder->order_date }}</h4>
    @endif
@endforeach
<div class="form-group">
    <button class="btn"><span>اضافة حجز</span></button>
    <button class="btn"><span>مشغول</span></button>
</div>
<a class="popup-close" pd-popup-close="popupNew" href="#"> </a>