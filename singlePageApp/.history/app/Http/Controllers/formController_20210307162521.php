<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\Mail\formUser;
use App\form;

class formController extends Controller
{
    /**
     * Show the application
     *
     * @return \Illuminatey\Http\Response
     */

    public function form()
    {
        return view('form-user');
    }

    /**
     * Show the application
     *
     * @return \Illuminatey\Http\Response
     */

    public function formSaveData(Request $request)

    {
        $this->validate($request, [
            'name'   => 'required',
            'email'  => 'required|email',
            'mobile' => 'required',
        ]);
        // $contactInfo = array(
        //     'name' => $request->get('name'),
        //     'mobile' => $request->get('mobile'),
        //     'email' => $request->get('email'),
        // );
        $contactInfo = form::create($request->all());
        die($contactInfo);
        Mail::send(
            'form-user',
            array(
                'name' => $request->get('name'),
                'mobile' => $request->get('mobile'),
                'email' => $request->get('email'),
            ),
            function ($message) use ($request) {
                $message->from('abdaljawad.ayah94@gmail.com');
                $message->to("", 'Admin')->subject($request->get('subject'));
            }
        );
        return back()->with('success', 'Thanks for contact us!');
    }
}