<?php
return [
    implode(DIRECTORY_SEPARATOR, [ base_path(), 'config','marinar_orders_phone.php']) => [
        "// @HOOK_CONFIGS_ADDONS" => "\t\t\\Marinar\\OrdersPhoneCoupons\\MarinarOrdersPhoneCoupons::class, \n",
    ],
    implode(DIRECTORY_SEPARATOR, [ base_path(), 'resources', 'views', 'admin', 'orders_phone', 'orders_phone.blade.php']) => [
        "{{-- @HOOK_AFTER_ADD_PRODUCT --}}" => "\t@include('admin/orders_phone/orders_phone_coupon_code') \n",
    ],
    implode(DIRECTORY_SEPARATOR, [ base_path(), 'lang', 'en', 'admin', 'orders_phone', 'orders_phone.php']) => [
        "//@HOOK_LANG" => "\t'coupon_code' => 'Coupon code', \n \t'coupon_code_check' => 'Check', \n 'coupon_code_remove' => 'Remove', \n",
    ],
    implode(DIRECTORY_SEPARATOR, [ base_path(), 'routes', 'admin', 'orders_phone.php']) => [
        "//@HOOK_ROUTES" => "Route::patch('code', 'changeCoupon')->name('change_coupon'); \n",
    ],
    implode(DIRECTORY_SEPARATOR, [ base_path(), 'app', 'Http', 'Controllers', 'Admin', 'OrdersPhoneController.php']) => [
        "// @HOOK_INDEX" => implode(DIRECTORY_SEPARATOR, [__DIR__, 'HOOK_INDEX.php']),
        "// @HOOK_METHODS" => implode(DIRECTORY_SEPARATOR, [__DIR__, 'HOOK_METHODS.phptpl']),
    ],
];
