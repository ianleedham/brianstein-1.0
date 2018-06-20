<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function send(Request $request)
    {

/*        $message->from($address, $name = null);
        $message->sender($address, $name = null);
        $message->to($address, $name = null);
        $message->cc($address, $name = null);
        $message->bcc($address, $name = null);
        $message->replyTo($address, $name = null);
        $message->subject($subject);
        $message->priority($level);
        $message->attach($pathToFile, array $options = []);*/


        $title = $request->input('title');
        $content = $request->input('content');

        Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message)
        {

            $message->from('me@gmail.com', 'Christian Nwamba');

            $message->to('chrisn@scotch.io');

        });

        return response()->json(['message' => 'Request completed']);
    }

}
