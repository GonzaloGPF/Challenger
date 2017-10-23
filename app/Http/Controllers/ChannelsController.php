<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Filters\ChannelFilters;
use App\Http\Requests\CreateChannel;
use App\Http\Requests\EditChannel;
use Symfony\Component\HttpFoundation\Response;

class ChannelsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
        $this->middleware('email-confirmed')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @param ChannelFilters $filters
     * @return \Illuminate\Http\Response
     */
    public function index(ChannelFilters $filters)
    {
        $channels = $this->getChannels($filters);

        if(request()->wantsJson()){
            return $channels;
        }

        return view('channels.index', compact('channels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateChannel $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateChannel $request)
    {
        $channel = auth()->user()->channels()->create($request->all());

        if(request()->wantsJson()){
            return response($channel, Response::HTTP_CREATED);
        }

        return redirect('chat')
            ->with('flash', 'New Channel created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditChannel $request
     * @param Channel $channel
     * @return \Illuminate\Http\Response
     */
    public function update(EditChannel $request, Channel $channel)
    {
        $channel->update($request->all());

        if(request()->wantsJson()){
            return response($channel, Response::HTTP_OK);
        }

        return redirect('chat')
            ->with('flash', 'Channel updated!');
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

    private function getChannels(ChannelFilters $filters)
    {
        return Channel::public()->filter($filters)
            ->paginate(15);
    }
}
