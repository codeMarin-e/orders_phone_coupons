<?php
if(request()->has('refresh_coupon')) {
    return view('admin/orders_phone/orders_phone_coupon_code', $viewData?? []);
}
