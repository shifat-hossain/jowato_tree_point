<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessSetting;
use App\ClubPointDetail;
use App\ClubPoint;
use App\Product;
use App\Wallet;
use App\Order;
use App\User;
use App\Tree;
use Auth;

class ClubPointController extends Controller
{
    public function configure_index()
    {
        return view('club_points.config');
    }

    public function index()
    {
        $club_points = ClubPoint::latest()->paginate(15);
        return view('club_points.index', compact('club_points'));
    }

    public function userpoint_index()
    {
        $club_points = ClubPoint::where('user_id', Auth::user()->id)->latest()->paginate(15);
        return view('club_points.frontend.index', compact('club_points'));
    }

    public function set_point()
    {
        $products = Product::latest()->paginate(15);
        return view('club_points.set_point', compact('products'));
    }

    public function set_products_point(Request $request)
    {
        $products = Product::whereBetween('unit_price', [$request->min_price, $request->max_price])->get();
        foreach ($products as $product) {
            $product->earn_point = $request->point;
            $product->save();
        }
        flash(translate('Point has been inserted successfully for ').count($products).translate(' products'))->success();
        return redirect()->route('set_product_points');
    }

    public function set_all_products_point(Request $request)
    {
        $products = Product::all();
        foreach ($products as $product) {;
            $product->earn_point = $product->unit_price * $request->point;
            $product->save();
        }
        flash(translate('Point has been inserted successfully for ').count($products).translate(' products'))->success();
        return redirect()->route('set_product_points');
    }

    public function set_point_edit($id)
    {
        $product = Product::findOrFail(decrypt($id));
        return view('club_points.product_point_edit', compact('product'));
    }

    public function update_product_point(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->earn_point = $request->point;
        $product->save();
        flash(translate('Point has been updated successfully'))->success();
        return redirect()->route('set_product_points');
    }

    public function store_convert_donate_to_point(Request $request)
    {
        $donate_amount_convert_rate = BusinessSetting::where('type', $request->type)->first();
        if ($donate_amount_convert_rate != null) {
            $donate_amount_convert_rate->value = $request->value;
        }
        else {
            $donate_amount_convert_rate = new BusinessSetting;
            $donate_amount_convert_rate->type = $request->type;
            $donate_amount_convert_rate->value = $request->value;
        }
        $donate_amount_convert_rate->save();

        flash(translate('Donate convert to point has been updated successfully'))->success();
        return redirect()->route('club_points.configs');
    }

    public function convert_rate_store(Request $request)
    {
        $club_point_convert_rate = BusinessSetting::where('type', $request->type)->first();
        if ($club_point_convert_rate != null) {
            $club_point_convert_rate->value = $request->value;
        }
        else {
            $club_point_convert_rate = new BusinessSetting;
            $club_point_convert_rate->type = $request->type;
            $club_point_convert_rate->value = $request->value;
        }
        $club_point_convert_rate->save();
        flash(translate('Point convert rate has been updated successfully'))->success();
        return redirect()->route('club_points.configs');
    }

    public function processClubPoints(Order $order)
    {
        //Update club point convert status
        $club_point = ClubPoint::where('user_id', $order->user_id)->where('order_id', $order->id)->first();
        $club_point->convert_status = 1;
        $club_point->save();

        $user = User::findOrFail($order->user_id);
        foreach ($order->orderDetails as $key => $orderDetail) {
            $total_pts = ($orderDetail->product->earn_point * $orderDetail->quantity) + 
                            ($order->donate_amount / get_setting('donate_amount_convert_rate'));
            $user->tree_points += $total_pts;
        }

        $user->save();
        if($user->tree_points >= get_setting('club_point_convert_rate')) {
            for($i = 0; $i < ($user->tree_points / get_setting('club_point_convert_rate')); $i++) {
                $tree           = new Tree;
                $tree->user_id  = $user->id;
                $tree->code     = time(). $i .$user->id;

                $tree->save();

                $user->tree_points -= get_setting('club_point_convert_rate');
                $user->save();
            }

        }
        
    }

    public function store_club_point(Order $order)
    {
        $club_point = new ClubPoint;
        $club_point->user_id = $order->user_id;
        $club_point->points = 0;
        $club_point->convert_rate = get_setting('point_multiply');
        foreach ($order->orderDetails as $key => $orderDetail) {
            $total_pts = ($orderDetail->product->earn_point * $orderDetail->quantity) +
                ($order->donate_amount / get_setting('donate_amount_convert_rate'));
            $club_point->points += $total_pts;
        }

        $club_point->order_id = $order->id;
        $club_point->save();

        foreach ($order->orderDetails as $key => $orderDetail) {
            $club_point_detail = new ClubPointDetail;
            $club_point_detail->club_point_id = $club_point->id;
            $club_point_detail->product_id = $orderDetail->product_id;
            $club_point_detail->point = ($orderDetail->product->earn_point) * $orderDetail->quantity;
            $club_point_detail->save();
        }
    }

    public function club_point_detail($id)
    {
        $club_point_details = ClubPointDetail::where('club_point_id', decrypt($id))->paginate(12);
        return view('club_points.club_point_details', compact('club_point_details'));
    }

    // public function convert_point_into_wallet(Request $request)
    // {
    //     $club_point_convert_rate = BusinessSetting::where('type', 'club_point_convert_rate')->first()->value;
    //     $club_point = ClubPoint::findOrFail($request->el);
    //     $wallet = new Wallet;
    //     $wallet->user_id = Auth::user()->id;
    //     $wallet->amount = floatval($club_point->points / $club_point_convert_rate);
    //     $wallet->payment_method = 'Club Point Convert';
    //     $wallet->payment_details = 'Club Point Convert';
    //     $wallet->save();
    //     $user = Auth::user();
    //     $user->balance = $user->balance + floatval($club_point->points / $club_point_convert_rate);
    //     $user->save();
    //     $club_point->convert_status = 1;
    //     if ($club_point->save()) {
    //         return 1;
    //     }
    //     else {
    //         return 0;
    //     }
    // }
}
