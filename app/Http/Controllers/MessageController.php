<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Thread;

class MessageController extends Controller
{
    // public function __construct() {
    //     $this->authorizeResource(Message::class, 'message');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thread = Thread::with(['user'])->where('user_id', '=', auth()->user()->id)->orWhere('to_user_id', '=', auth()->user()->id)->get();
        return $thread;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
            Find thread where current thread's user_id = current user and to_user_id = $request->to_user_id

            If True, use the thread to generate a new message.
            else, create a new thread and insert a message.
        */

        $thread = auth()->user()->threads()->create([
            'to_user_id',
        ]);

        return $thread;
    }

    public function message(Request $request) {
        $message = auth()->user()->messages()->create([
            'thread_id' => $request->thread_id,
            'body' => $request->body,
        ]);

        return $message;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $messages = Message::where('thread_id', '=', $id)->get();
        return $messages;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
