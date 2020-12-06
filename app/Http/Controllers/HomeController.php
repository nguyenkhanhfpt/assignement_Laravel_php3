<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Category;
use App\User;
use App\Notification;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    protected $limit_col = 8;

    protected function index() {
        $datas = Product::allProduct()->take(config('settings.limit'))->get();

        // Select sản phẩm được đề xuất
        $nominationPro = Product::allProduct()
            ->where('nomination', 1)
            ->take(config('settings.limit'))
            ->get();
        
        // Sắp xếp theo ngày nhập
        $newProducts = Product::allProduct()
            ->orderBy('date', 'desc')
            ->take(config('settings.limit') * 2)
            ->get();

        // Sắp xếp theo view
        $productView = Product::allProduct()
            ->orderBy('view', 'desc')
            ->take(config('settings.limit'))
            ->get();

        // Select danh mục sản phẩm
        $categories = Category::with('products')->get();
        
        return view('home', compact(['datas','nominationPro','newProducts', 'productView', 'categories']));
    }

    public function getNotifications()
    {
        $notifications = [];
        $count = 0;

        if (Auth::user()) {
            $member = Auth::user();

            foreach ($member->notifications as $notify) {
                $notify->member = User::select(['name_member', 'img_member'])->find($notify->data['member_id']);
                if ($notify->type === config('settings.comment')) {
                    $notify->product = Product::select(['name_product', 'slug'])->find($notify->data['product_id']);
                }
            }

            $notifications = $member->notifications;
            $count = count($member->unreadNotifications);
        }

        $view = view('components.notifications', compact('notifications'))->render();

        return response()->json([
            'view' => $view,
            'numUnRead' => $count
        ]);
    }

    public function markReadNotify(Request $request, $id)
    {
        $notification = Notification::find($id);

        $notification->read_at = Carbon::now();
        $notification->save();

        return $notification;
    }

    public function markReadAllNotify()
    {
        $member = Auth::user();
        
        $member->unreadNotifications->markAsRead();
    }
}
