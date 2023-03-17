@pushonceOnReady('below_js_on_ready')
<script>
    $(document).on('refresh_coupon', function() {
        var $container = $('#js_coupon_form');
        $container.html( $('#js_loader').html() );
        $.ajax({
            method: 'GET',
            timeout: 0,
            data: {
                'refresh_coupon': 1,
            },
            dataType: 'html',
            error: function(jqXHR, textStatus, errorThrown){
                if(jqXHR.responseJSON.message) alert(jqXHR.responseJSON.message);
                else alert('Error');
            },
            success: function(response) {
                $container.html( $(response).filter('#js_coupon_form').first().html() );
            }
        });
    });
    $('#js_table_container').on('DOMSubtreeModified', function(){
        $(document).trigger('refresh_coupon');
    });

    var changingCoupon = false;
    $(document).on('click', '#js_coupon', function() {
        if(changingCoupon) return;
        changingCoupon = true;
        var $this = $(this);
        var oldHtml = $this.html();
        $this.html( $("#js_loader").html() );
        $.ajax({
            url: $this.attr('data-src'),
            method: 'PATCH',
            timeout: 0,
            data: ($this.attr('data-remove')? {} : JSON.stringify({
                'code': $("input[name='{{$inputBag}}\\[coupon_code\\]").first().val(),
            })),
            dataType: 'json',
            contentType: "application/json",
            error: function(jqXHR, textStatus, errorThrown){
                if(jqXHR.responseJSON && jqXHR.responseJSON.message) alert(jqXHR.responseJSON.message);
                else alert('Error');
                changingCoupon = false;
                $this.html( oldHtml );
                $(document).trigger('refresh_coupon');
                $(document).trigger('refresh_table');
            },
            success: function(response) {
                changingCoupon = false;
                $this.html( oldHtml );
                $("input[name='{{$inputBag}}\\[coupon_code\\]").first().val('');
                $(document).trigger('refresh_table');
            }
        });
    });
</script>
@endpushonceOnReady

<div class="form-group row" id="js_coupon_form">
    <div class="col-lg-8">
        <div class="input-group">
            <div class="input-group-prepend" >
                @if($chOrderCouponCampaign = $chOrder->couponCampaign())
                    <label class="input-group-text"
                           for="{{$inputBag}}[coupon_code]">{{$chOrderCouponCampaign->aVar('name')}}[{{$chOrderCouponCampaign->owner->code}}]:</label>
                @else
                    <label class="input-group-text"
                           for="{{$inputBag}}[coupon_code]">@lang('admin/orders_phone/orders_phone.coupon_code'):</label>
                @endif
            </div>
            <input type="text"
                   name="{{$inputBag}}[coupon_code]"
                   id="{{$inputBag}}[coupon_code]"
                   value="{{ old("{$inputBag}.coupon_code", (isset($chOrder)? $chOrder->coupon_code: '')) }}"
                   onkeyup="this.classList.remove('is-invalid')"
                   class="form-control @if($errors->$inputBag->has('coupon_code')) is-invalid @endif"
            />
            <div class="input-group-append">
                @if($chOrderCouponCampaign)
                    <button type="button"
                            data-src="{{route("{$route_namespace}.orders_phone.change_coupon")}}"
                            class="btn btn-danger"
                            data-remove="1"
                            id="js_coupon"
                    >@lang('admin/orders_phone/orders_phone.coupon_code_remove')</button>
                @else
                    <button type="button"
                            data-src="{{route("{$route_namespace}.orders_phone.change_coupon")}}"
                            class="btn btn-success"
                            id="js_coupon"
                    >@lang('admin/orders_phone/orders_phone.coupon_code_check')</button>
                @endif
            </div>
        </div>
    </div>
</div>
{{-- @HOOK_AFTER_COUPON_CODE --}}
