<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\HTTP\Request;
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
            'email'  => 'required',
            'mobile' => 'required',
        ]);

        form::create($request->all());

        \Mail::send('emails.form',
        array(
            'name' => $request->get('name'),
            'mobile' => $request->get('mobile'),
            'email'  => $request->get('email')
        )), function($message) use ($request)
       {
          $message->form('onlineuser@gmail.com');
          $message->to('abdaljawad.ayah94@gmail.com' , 'Admin')
       }
        return back()->with('success', 'Thanks for contact us!');
    }
}