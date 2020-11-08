<?php
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

    public static function vn_to_eng($str)
    {
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',            
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',           
            'i'=>'í|ì|ỉ|ĩ|ị',           
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',           
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',          
            'y'=>'ý|ỳ|ỷ|ỹ|y',          
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',           
            'D'=>'Đ',        
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',      
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',     
        );
             
        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(' ', '-', $str); 
        
        return $str;
    }

    public function getFirstImage($images)
    {
        if (count($images)) {
            return asset('images/products') . '/' . $images[0]->image;
        } else {
            return asset('images/products') . '/' . config('settings.default_product');
        }
    }

    public function getSecondImage($images)
    {
        if (count($images) > 1) {
            return asset('images/products') . '/' . $images[0]->image;
        } else {
            return asset('images/products') . '/' . config('settings.default_product');
        }
    }

    public function getThirdImage($images)
    {
        if (count($images) > 2) {
            return asset('images/products') . '/' . $images[0]->image;
        } else {
            return asset('images/products') . '/' . config('settings.default_product');
        }
    }

    public static function exec()
    {
        return new Helper();
    }
}

?>