<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Mail\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

/**
 * Class EmailController
 * @package App\Http\Controllers
 */
class EmailController extends Controller
{
    /**
     * @param EmailRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function contactForm(EmailRequest $request): \Illuminate\Http\JsonResponse
    {
        if (! $request->subject)
            $request->merge(['subject' => __('I want to get information')]);

        \App\Models\Log::create([
            'title' => __('Contact form sent successfully'),
            'log_type' => 'contact_form',
            'log_details' => json_encode([
                'ip' => \request()->ip(),
                'user_agent' => \request()->userAgent(),
                'request' => $request->all()
            ])
        ]);

        Mail::send(new ContactForm($request->all()));

        return response()->json([
            'status' => 'success',
            'message' => [__('Contact form sent successfully')]
        ]);
    }

}
