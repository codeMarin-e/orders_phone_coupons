<?php
    namespace Marinar\OrdersPhoneCoupons\Database\Seeders;

    use Illuminate\Database\Seeder;
    use Marinar\OrdersPhoneCoupons\MarinarOrdersPhoneCoupons;

    class MarinarOrdersPhoneCouponsRemoveSeeder extends Seeder {

        use \Marinar\Marinar\Traits\MarinarSeedersTrait;

        public static function configure() {
            static::$packageName = 'marinar_orders_phone_coupons';
            static::$packageDir = MarinarOrdersPhoneCoupons::getPackageMainDir();
        }

        public function run() {
            if(!in_array(env('APP_ENV'), ['dev', 'local'])) return;

            $this->autoRemove();

            $this->refComponents->info("Done!");
        }
    }
