<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscribeController extends Controller
{
    public function subscribeForm(SubscribeRequest $subscribeRequest)
    {
        \App\Models\Log::create([
            'title' => __('Subscribe'),
            'log_type' => 'subscribe',
            'log_details' => json_encode([
                'ip' => \request()->ip(),
                'user_agent' => \request()->userAgent(),
                'email' => \request()->email
            ])
        ]);

        Subscribe::updateOrCreate(
            ['email' => $subscribeRequest->email],
            ['ip' => $subscribeRequest->ip(), 'user_agent' => $subscribeRequest->userAgent(), 'status' => true]
        );

        return response()->json([
            'status' => 'success',
            'message' => [__('You have successfully subscribed')]
        ]);
    }
}
