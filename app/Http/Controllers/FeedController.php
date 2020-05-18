<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Http\Requests\FeedRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feeds = Feed::all();
        return view('feeds.index', compact('feeds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feeds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\FeedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeedRequest $request)
    {
        $feed = Auth::user()->feeds()->create($request->all());
        return redirect()->route('feeds.show', compact('feed'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function show(Feed $feed)
    {
        $response = Http::get($feed->url);

        $posts = [];
        $i = 0;

        $doc = new \DOMDocument();
        $doc->loadXML($response->body());
        $items = $doc->getElementsByTagName("item");
        foreach ($items as $item) {
            foreach($item->childNodes as $child) {
                if($child->nodeName == 'title' || $child->nodeName == 'description') {
                    $posts[$i][$child->nodeName] = $child->textContent;
                }
            }
            $i++;
        }

        $feed_data = $posts;

        return view('feeds.show', compact('feed', 'feed_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function edit(Feed $feed)
    {
        if(Auth::user() == $feed->user) {
            return view('feeds.edit', compact('feed'));
        } else {
            return redirect()->route('feeds.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\FeedRequest  $request
     * @param  \App\Models\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function update(FeedRequest $request, Feed $feed)
    {
        $feed->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feed $feed)
    {
        $feed->delete();
    }
}
