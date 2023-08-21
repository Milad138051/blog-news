<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('front.profile');
    }


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            //'email' => ['sometimes','string','email',Rule::unique('users')->ignore(auth()->user()->email), 'email'],
        ]);
        $inputs = $request->all();
        $user = auth()->user();
        $user->update($inputs);
        return redirect()->back()->with('success', 'اطلاعات حساب شما با موفقیت  ثبت شد');
    }
}
