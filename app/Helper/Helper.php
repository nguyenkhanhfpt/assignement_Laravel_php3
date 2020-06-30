<?php
namespace App\Helper;

use Illuminate\Support\Facades\Auth;

class Helper
{   
    public function time_between_two_days($dateStart) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $dateNow = date('Y-m-d H:i:s', time());

        $first_date = strtotime($dateNow);
        $second_date = strtotime($dateStart);
        $datediff = abs($first_date - $second_date) / (60*60*24);
        
        if($datediff <= 3) {
            return true;
        }
        else {
            return false;
        }
    }

    public function match_price_sale($price, $sale) {
        $result = $price - ($price / 100 * $sale);
        return $result;
    }

    public function mathTotalCart() {
        $sessionCart = session('cart', []);
        $total = 0;
        foreach($sessionCart as $key => $value) {
            $total += $value['quantity'] * $value['price_product'];
        }
        return $total;
    }

    public function displayDeleteComment($id_member) {
        if(!Auth::user()) {
            return false;
        }
        else if(Auth::user()->id_member != $id_member) {
            return false;
        }
        else {
            return true;
        }
    }

    public static function exec()
    {
        return new Helper();
    }
}

?>