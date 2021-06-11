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

<script>
    $(function() {
        //----- OPEN
        $('[pd-popup-open]').on('click', function(e)  {
            var targeted_popup_class = jQuery(this).attr('pd-popup-open');
            $('[pd-popup="' + targeted_popup_class + '"]').fadeIn(100);
    
            e.preventDefault();
        });
    
        //----- CLOSE
        $('[pd-popup-close]').on('click', function(e)  {
            console.log("Closed");
            var targeted_popup_class = jQuery(this).attr('pd-popup-close');
            $('[pd-popup="' + targeted_popup_class + '"]').fadeOut(200);
    
            e.preventDefault();
        });
});
</script>