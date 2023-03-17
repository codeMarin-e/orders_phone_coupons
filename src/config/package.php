<?php
	return [
		'install' => [
            'php artisan db:seed --class="\Marinar\OrdersPhoneCoupons\Database\Seeders\MarinarOrdersPhoneCouponsInstallSeeder"',
		],
		'remove' => [
            'php artisan db:seed --class="\Marinar\OrdersPhoneCoupons\Database\Seeders\MarinarOrdersPhoneCouponsRemoveSeeder"',
        ]
	];
