<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Helper;
use App\Product;
use App\Comment;
use App\Bill;
use App\News;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    function index() 
    {
        $countProduct = Product::count();
        $countBill = Bill::count();
        $countComment = Comment::count();
        $countNews = News::count();
        $comments = Comment::with('member')->orderBy('date_comment', 'desc')->get()->take(5);

        $bills = Bill::with(['member', 'detail_bill'])
            ->orderBy('date_buy', 'desc')
            ->get()
            ->take(10);

        foreach($bills as $bill) {
            $sum = 0;
            $quantity = 0;
            foreach ($bill->detail_bill as $detail) {
                $sum += $detail->amount;
                $quantity += $detail->quantity_buy;
            }
            $bill->total = number_format($sum) . ' đ';
            $bill->detail_bill_count = $quantity;
        }

        return view('admins.admin', compact([
            'bills',
            'comments', 
            'countProduct', 
            'countBill', 
            'countComment', 
            'countNews'
        ]));
    }

    public function updateDom()
    {
        $countBill = Helper::exec()->getNumPeddingBill();

        return response()->json([
            'countBill' => $countBill
        ]);
    }

    public function statistical()
    {
        $seventDays = [];
        $arrResult = [];
        $statistical = Bill::select(DB::raw('date(date_buy) as day'), DB::raw(DB::raw('count(id) as count')))
            ->whereDate('date_buy', '>' ,Carbon::now()->subDays(7))
            ->orderBy(DB::raw('date(date_buy)'), 'desc')
            ->groupBy(DB::raw('date(date_buy)'))
            ->get();

        // Select 7 days to current day
        for ($i = 0; $i < 7; $i++) {
            $day = '-' .$i. ' day';
            $previousDate = date('Y-m-d', strtotime($day));
            array_push($seventDays, $previousDate);
        }

        foreach($seventDays as $day) {
            $count = 0;
            foreach ($statistical as $item) {
                if ($day == $item->day) {
                    $count = $item->count;
                    break;
                }
            }
            array_push($arrResult, ['day' => $day, 'count' => $count]);
        }

        return $arrResult;
    }
}
