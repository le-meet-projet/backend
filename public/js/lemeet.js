$(function() {
    //----- OPEN
    $('[pd-popup-open]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('pd-popup-open');
        $('[pd-popup="' + targeted_popup_class + '"]').fadeIn(100);
 
        e.preventDefault();
    });
 
    //----- CLOSE
    $(document).on('click', 'body [pd-popup-close]', function (e) {
        var targeted_popup_class = jQuery(this).attr('pd-popup-close');
        $('[pd-popup="' + targeted_popup_class + '"]').fadeOut(200);

        e.preventDefault();
    });
});

(function($){

$.fn.conditionalFields = function (action) {
    var $base = $(this);
    function toggle_field($field, trigger_value, val) {
        if ($.inArray(trigger_value, val) !== -1) {
            if ($field.css('display') === 'none')
                $field.slideDown(1);
        }
        else {
            if ($field.css('display') !== 'none') {
                $field.slideUp(1);
            }
        }
    }
    function update_fields() {
        var $fields = $base.find('[data-condition][data-condition-value]');
        var $field, condition, condition_values, $trigger, trigger_value;
        $.each($fields, function () {
            $field = $(this);
            condition = $field.attr('data-condition');
            condition_values = $field.attr('data-condition-value').toString().split(';');
            $trigger = $('[name="' + condition + '"]');
            if($trigger.is('[type="radio"]')){
                $trigger = $('[name="' + condition + '"]:checked');
            }
            if ($trigger.length) {
                if($trigger.length === 1){
                    trigger_value = $trigger.val().toString();
                    if($trigger.is('[type="checkbox"]')){
                        trigger_value = $trigger.prop( "checked" ) ? '1' : '0';
                    }
                    toggle_field($field, trigger_value, condition_values);
                }
                else {
                    var or = '0';
                    var and = '1';
                    $.each($trigger, function (id, trigger_instance) {
                        trigger_value = $(trigger_instance).val().toString();
                        if($trigger.is('[type="checkbox"]')){
                            trigger_value = $trigger.prop( "checked" ) ? '1' : '0';
                        }
                        if ($.inArray(trigger_value, condition_values) !== -1) {
                            or = '1';
                        }
                        else {
                            and = '0';
                        }
                    });
                    if($field.hasClass('condition-logical-or')){
                        trigger_value = or;
                    }
                    else {
                        trigger_value = and;
                    }
                    toggle_field($field, trigger_value, ['1']);
                }
            }
            else {
                if ($field.css('display') !== 'none'){
                    $field.slideUp(500);
                }
            }
        });
    }
    function init_events(){
        $base.on('change', '.condition-trigger', function () {
            update_fields();
        });
        $base.on('click', '.condition-trigger-delayed', function () {
            var delay = $(this).attr('data-delay');
            setTimeout(function () {
                update_fields();
            }, delay);
        });
    }
    if(action === 'init'){
        init_events();
        update_fields();
    }
    if(action === 'update'){
        update_fields();
    }
}

}(jQuery));

    $(function(){
        $('body').conditionalFields('init');

        $(document).ready(function() {
        $('div#details').click(function(e) {
            const token = $('meta[name="csrf-token"]').attr('content');
            const date = $(this).attr('data-date');
            const from = $(this).attr('data-from');
            const name = $(this).attr('data-name');

            var formData = new FormData();
            formData.append('_token', token);
            formData.append('date', date);
            formData.append('from', from);
            formData.append('name', name);

            $.ajax({
                url: '/order-details',
                type: 'POST',
                processData: false, // important
                contentType: false, // important
                data: formData,
                cache: false,
                dataType: "HTML",
                success: function (response) {
                    $('body .popup .popup-inner').html(response);
                },
                error: function (response) {
                    console.log('error');
                    console.log(response);
                }
            });
        });
    });
});

$(() => {
    const wallet = $(".wallet").find(".total:last h3 span.money").html();
    const invoice = $(".invoice").find(".total:last h3 span.money").html();
    let balance = wallet - invoice;
    if(isNaN(balance)){
        balance = 0;
    }
    $(".total-sold span.money").html(balance.toFixed(2));
})