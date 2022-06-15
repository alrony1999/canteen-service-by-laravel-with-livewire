<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SellerHighChartController extends Controller
{
    public function highchart()
    {
        $users = OrderItem::select(DB::raw("COUNT(*) as count"))->where('store_id', '=', Auth::user()->store->id)
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');
        $months = OrderItem::select(DB::raw("Month(created_at) as month"))->where('store_id', '=', Auth::user()->store->id)
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('month');

        $datas = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($months as $index => $month) {
            $datas[$month] = $users[$index];
        }

        return view('livewire.seller.seller-highchart', compact('datas'));
    }
}
