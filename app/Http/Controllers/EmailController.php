<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Class EmailController
 * @package App\Http\Controllers
 */
class EmailController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contactForm(Request $request): \Illuminate\Http\RedirectResponse
    {
        Mail::send(new ContactForm($request->all()));

        return back()->with([
            'status' => 'success',
            'message' => __('Mesajınız başarıyla iletişilmiştir.')
        ]);
    }
}
