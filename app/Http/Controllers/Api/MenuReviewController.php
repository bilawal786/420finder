<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\RetailerReview;
use App\Http\Controllers\Controller;
use App\Http\Resources\RatingResource;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\MenuRatingResource;

class MenuReviewController extends Controller
{
    public function getRetailerReviews($id) {

        $reviewPag = RetailerReview::where('retailer_id', $id)
                      ->whereNull('product_id')
                      ->join('users', 'users.id',
                      '=', 'retailer_reviews.customer_id')
                      ->select([
                          'retailer_reviews.*',
                          'users.id',
                          'users.name',
                          'users.email',
                          'users.profile'
                      ])
                      ->latest()
                      ->paginate(50);

        $reviews = RetailerReview::where('retailer_id', $id)->whereNull('product_id')->get();

        $reviewTotalRating = $reviews->count();
        $reviewAvgRating = number_format($reviews->avg('rating'), 1);
        $reviewFiveRating = $this->filterRatingResolver($reviews, 5, 6);
        $reviewFourRating = $this->filterRatingResolver($reviews, 4, 5);
        $reviewThreeRating = $this->filterRatingResolver($reviews, 3, 4);
        $reviewTwoRating = $this->filterRatingResolver($reviews, 2, 3);
        $reviewOneRating = $this->filterRatingResolver($reviews, 1, 2);

        $reviewNumbers = [
            'reviewTotalRating' => $reviewTotalRating,
            'reviewAvgRating' => $reviewAvgRating,
            'reviewFiveRating' => $reviewFiveRating,
            'reviewFourRating' => $reviewFourRating,
            'reviewThreeRating' => $reviewThreeRating,
            'reviewTwoRating' => $reviewTwoRating,
            'reviewOneRating' => $reviewOneRating
        ];

        return MenuRatingResource::collection($reviewPag)->additional(['reviewsNumbers' => $reviewNumbers]);

    }

    private function filterRatingResolver($reviews, $numStart, $numEnd ) {

        $reviewCount = $reviews->filter(function($review) use ($numStart, $numEnd){

            return  $review->rating >= $numStart && $review->rating < $numEnd;

        })->count();

        return $reviewCount;
    }

    /*
    *  Submit Review
    */
    public function submitReview(Request $request) {

        $retailerId = $request->retailer_id;
        $ratingNum = $request->rating_num;
        $ratingDesc = $request->rating_desc;

        if(Session::has('customer_id')) {

            $customerId = Session::get('customer_id');

            $created = RetailerReview::create([
                'customer_id' => $customerId,
                'retailer_id' => $retailerId,
                'rating' => $ratingNum,
                'description' => $ratingDesc
            ]);

            if($created) {
                return response()->json([
                    'message' => 'Review Added',
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'message' => 'Sorry something went wrong',
                    'status' => 201
                ]);
            }

        } else {
            return;
        }

    }

    public function getProductReviews($retailerId, $productId) {

        $reviewPag = RetailerReview::where('product_id', $productId)
                      ->join('users', 'users.id',
                      '=', 'retailer_reviews.customer_id')
                      ->select([
                        'retailer_reviews.*',
                        'users.id',
                        'users.name',
                        'users.email',
                        'users.profile'
                      ])
                      ->latest()
                      ->paginate(50);

        $reviews = RetailerReview::where('product_id', $productId)->get();

        $reviewTotalRating = $reviews->count();
        $reviewAvgRating = number_format($reviews->avg('rating'), 1);
        $reviewFiveRating = $this->filterRatingResolver($reviews, 5, 6);
        $reviewFourRating = $this->filterRatingResolver($reviews, 4, 5);
        $reviewThreeRating = $this->filterRatingResolver($reviews, 3, 4);
        $reviewTwoRating = $this->filterRatingResolver($reviews, 2, 3);
        $reviewOneRating = $this->filterRatingResolver($reviews, 1, 2);

        $reviewNumbers = [
            'reviewTotalRating' => $reviewTotalRating,
            'reviewAvgRating' => $reviewAvgRating,
            'reviewFiveRating' => $reviewFiveRating,
            'reviewFourRating' => $reviewFourRating,
            'reviewThreeRating' => $reviewThreeRating,
            'reviewTwoRating' => $reviewTwoRating,
            'reviewOneRating' => $reviewOneRating
        ];

        return MenuRatingResource::collection($reviewPag)->additional(['reviewsNumbers' => $reviewNumbers]);

    }


    public function submitProductReview(Request $request) {

        $retailerId = $request->retailer_id;
        $productId = $request->product_id;
        $ratingNum = $request->rating_num;
        $ratingDesc = $request->rating_desc;

        if(Session::has('customer_id')) {

            $customerId = Session::get('customer_id');

            $created = RetailerReview::create([
                'customer_id' => $customerId,
                'retailer_id' => $retailerId,
                'product_id' => $productId,
                'rating' => $ratingNum,
                'description' => $ratingDesc
            ]);

            if($created) {
                return response()->json([
                    'message' => 'Review Added',
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'message' => 'Sorry something went wrong',
                    'status' => 201
                ]);
            }

        } else {
            return;
        }

    }

}
