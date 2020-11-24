<?php
use Illuminate\Support\Facades\Auth;
use App\Bill;

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
        else if(Auth::user()->id != $id_member) {
            return false;
        }
        else {
            return true;
        }
    }


    public function getFirstImage($images)
    {
        if (count($images)) {
            return asset('images/products') . '/' . $images[0]->image;
        } else {
            return asset('images/products') . '/' . config('settings.default_product');
        }
    }

    public function getNumPeddingBill()
    {
        return Bill::where('status', config('settings.pedding'))->get()->count();
    }

    public static function exec()
    {
        return new Helper();
    }
}

?>