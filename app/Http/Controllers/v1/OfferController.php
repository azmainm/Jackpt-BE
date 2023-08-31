<?php

namespace App\Http\Controllers\v1;

use App\Constants\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Http\Resources\PostResource;
use App\Models\Offer;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class OfferController extends Controller
{
    public function view(): JsonResponse
    {
        $offers = Offer::where('user_id', auth()->user()->id)->get();
        if ($offers->count() > 0) {
            return $this->success(data: OfferResource::collection($offers));
        }
        return $this->error('Not Found', 404);

    }
    public function store(Request $request): JsonResponse
    {
        $offer = Offer::create([
            'user_id' => auth()->user()->id,
            'service_name' => $request->input('service_name'),
            'service_details' => $request->input('service_details'),
            'post_id' => $request->input('post_id'),
        ]);

        return $this->success(data: new OfferResource($offer));
    }


    public function update(Request $request, $uuid): JsonResponse
    {
        $offer = Offer::where('user_id', auth()->user()->id)->where('uuid', $uuid)->first();

        if (!$offer) {
            return $this->error(ResponseMessages::NOT_FOUND, 404);
        }
        $offer->update([
            'service_name' => $request->input('service_name'),
            'service_details' => $request->input('service_details'),
            'post_id' => $request->input('post_id'),
        ]);

        return $this->success(data: new OfferResource($offer));
    }
}
