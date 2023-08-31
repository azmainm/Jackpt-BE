<?php

namespace App\Http\Controllers\v1;

use App\Constants\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Models\Offer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OfferController extends Controller
{
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
