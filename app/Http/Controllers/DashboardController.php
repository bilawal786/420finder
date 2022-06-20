<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Image;

use App\Models\Strain;

use App\Models\Order;

use App\Models\RetailerReview;

use App\Models\DealsClaimed;

use App\Models\RecentlyViewed;

class DashboardController extends Controller {

    public function profile() {

        $user = User::where('id', session('customer_id'))
            ->select('name', 'profile')
            ->first();

        return view('profile.index')
            ->with('user', $user);

    }

    public function orderhistory() {

        $user = User::where('id', session('customer_id'))
            ->select('name', 'profile')
            ->first();

        $orders = Order::where('customer_id', session('customer_id'))
            ->groupBy('tracking_number')
            ->latest()->get();

        return view('profile.orderhistory')
            ->with('user', $user)
            ->with('orders', $orders);

    }

    public function orderdetails($tracking_number) {

        $user = User::where('id', session('customer_id'))
            ->select('name', 'profile')
            ->first();

        $orders = Order::where('tracking_number', $tracking_number)
            ->get();

        return view('profile.orderdetails')
            ->with('user', $user)
            ->with('orders', $orders)
            ->with('tracking_number', $tracking_number);

    }

    public function recentlyviewed() {

        $user = User::where('id', session('customer_id'))
            ->select('name', 'profile')
            ->first();

        $recentlyvieweds = RecentlyViewed::where('customer_id', session('customer_id'))->get();

        return view('profile.recentlyviewed')
            ->with('user', $user)
            ->with('recentlyvieweds', $recentlyvieweds);

    }

    public function removerecentproduct($id) {

        $product = RecentlyViewed::find($id);

        $product->delete();

        return redirect()->back()->with('error', 'Product Removed.');

    }

    public function dealsclaimed() {

        $user = User::where('id', session('customer_id'))
            ->select('name', 'profile')
            ->first();

        $deals = DealsClaimed::where('customer_id', session('customer_id'))->get();

        return view('profile.dealsclaimed')
            ->with('user', $user)
            ->with('deals', $deals);

    }

    public function myreviews() {

        $user = User::where('id', session('customer_id'))
            ->select('name', 'profile')
            ->first();

        $reviews = RetailerReview::where('customer_id', session('customer_id'))->get();

        return view('profile.myreviews')
            ->with('user', $user)
            ->with('reviews', $reviews);

    }

    public function removereview($id) {

        $review = RetailerReview::find($id);

        $review->delete();

        return redirect()->back()->with('info', 'Review removed successfully.');

    }

    public function accountsettings() {

        $user = User::where('id', session('customer_id'))->first();

        return view('profile.accountsettings')
            ->with('user', $user);

    }

    public function savename(Request $request) {

        $user = User::find(session('customer_id'));

        $user->name = $request->name;

        if ($user->save()) {

            $response = ['statuscode'=> 200, 'message'=> 'Name Saved.'];

            echo json_encode($response);

        } else {

            $response = ['statuscode'=> 400, 'message'=> 'Problem saving name.'];

            echo json_encode($response);

        }

    }

    public function savephonenumber(Request $request) {

        $user = User::find(session('customer_id'));

        $user->phone = $request->phone_number;

        if ($user->save()) {

            $response = ['statuscode'=> 200, 'message'=> 'Phone Number Saved.'];

            echo json_encode($response);

        } else {

            $response = ['statuscode'=> 400, 'message'=> 'Problem saving phone number.'];

            echo json_encode($response);

        }

    }

    public function savedateofbirth(Request $request) {

        $user = User::find(session('customer_id'));

        $user->dateofbirth = $request->dateofbirth;

        if ($user->save()) {

            $response = ['statuscode'=> 200, 'message'=> 'Date of birth Saved.'];

            echo json_encode($response);

        } else {

            $response = ['statuscode'=> 400, 'message'=> 'Problem saving date of birth.'];

            echo json_encode($response);

        }

    }

    public function savedeliveryaddress(Request $request) {

        $user = User::find(session('customer_id'));

        $user->delivery_address = $request->delivery_address;

        if ($user->save()) {

            $response = ['statuscode'=> 200, 'message'=> 'Delivery Address Saved.'];

            echo json_encode($response);

        } else {

            $response = ['statuscode'=> 400, 'message'=> 'Problem saving delivery address.'];

            echo json_encode($response);

        }

    }

    public function saveabout(Request $request) {

        $user = User::find(session('customer_id'));

        $user->about = $request->about;

        if ($user->save()) {

            $response = ['statuscode'=> 200, 'message'=> 'About Description Saved.'];

            echo json_encode($response);

        } else {

            $response = ['statuscode'=> 400, 'message'=> 'Problem saving about description.'];

            echo json_encode($response);

        }

    }

    public function saveprofilepicture(Request $request) {

        $profile = User::find(session('customer_id'));

                // $imageName = time().'.'.request()->picture->getClientOriginalExtension();

                // request()->picture->move(public_path('images/seller/products'), $imageName);

                // $product->picture = asset("images/seller/products/" . $imageName);

        $avatar = $request->file('profile');
        $filename = time() . '.' . $avatar->GetClientOriginalExtension();

        $avatar_img = Image::make($avatar);
        $avatar_img->resize(222,147)->save(public_path('images/profile/' . $filename));

        $profile->profile = asset("images/profile/" . $filename);

        if ($profile->save()) {

            return redirect()->back()->with('info', 'Profile Picture Updated.');

        } else {

            return redirect()->back()->with('error', 'Problem updating profile picture.');

        }

    }

}
