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
        $request->merge(['subject' => 'Bilgi almak istiyorum']);

        Mail::send(new ContactForm($request->all()));

        return response()->json([
            'status' => 'success',
            'message' => [__('Mesajınız başarıyla iletişilmiştir.')]
        ]);
    }
}
