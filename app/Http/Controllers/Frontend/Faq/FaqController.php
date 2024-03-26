<?php

namespace App\Http\Controllers\Frontend\Faq;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        return view('frontend.pages.faqs', ['faqs' => $faqs]);
    }
}
