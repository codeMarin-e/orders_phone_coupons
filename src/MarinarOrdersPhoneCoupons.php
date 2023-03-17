<?php
namespace Marinar\OrdersPhoneCoupons;

use Marinar\OrdersPhoneCoupons\Database\Seeders\MarinarOrdersPhoneCouponsInstallSeeder;

class MarinarOrdersPhoneCoupons {

    public static function getPackageMainDir() {
        return __DIR__;
    }

    public static function injects() {
        return MarinarOrdersPhoneCouponsInstallSeeder::class;
    }
}
