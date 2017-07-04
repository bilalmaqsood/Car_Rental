<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\Faq;

class FaqController extends Controller
{
    /**
     * FaqController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['update', 'destroy']);

        $this->middleware('admin')->only(['update', 'destroy']);
    }

    public function index()
    {
        return api_response(Faq::whereNotNull('answer')->get());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required|string'
        ]);

        $faq = Faq::firstOrCreate($request->all());

        return api_response($faq);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'answer' => 'required|string'
        ]);

        $faq = Faq::findOrFail($id);

        $faq->answer = $request->answer;

        $request->user()->faq()->save($faq);

        return api_response($faq);
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);

        $faq->delete();

        return api_response($faq);
    }
}
