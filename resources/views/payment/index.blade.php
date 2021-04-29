<div style='margin-top: 300px'>
    <form action="{{ route('payment.success') }}" class="container paymentWidgets" data-brands="VISA MASTER AMEX"></form>
</div>
<script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{ $id }}"></script>