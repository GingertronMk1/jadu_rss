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
        $feed = Auth::user()->feeds()->create($request->all());     // Store it as belonging to the logged-in user
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
        $response = Http::get($feed->url);              // First, get the feed contents.
        $posts = [];                                    // Initialise an empty array of posts
        $i = 0;                                         // and a counter at 0.

        $doc = new \DOMDocument();                      // Create a new DOMDocument
        $doc->loadXML($response->body());               // Load it up with the data from the RSS Feed
        $items = $doc->getElementsByTagName("item");    // Find the 'item' tags - these are the ones that correspond to posts
        foreach ($items as $item) {                     // For each of them, check their child nodes
            foreach($item->childNodes as $child) {      // If that child is the title or description, add it to the posts array
                if(in_array($child->nodeName, ['title', 'description'])) {
                    $posts[$i][$child->nodeName] = $child->textContent;
                }
            }
            $i++;                                       // Increment the counter
        }

        return view('feeds.show', compact('feed', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function edit(Feed $feed)
    {
        if(Auth::user() == $feed->user) {                   // A User should not be able to see the form to update a feed that is not theirs
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
        if(Auth::user() == $feed->user) {                   // A User should not be able to update a feed that is not theirs
            $feed->update($request->all());
            return redirect()->route('feeds.edit', compact('feed'));
        } else {
            return redirect()->route('feeds.index');
        }
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param  \App\Models\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function delete(Feed $feed)
    {
        if(Auth::user() == $feed->user) {                   // A User should not be able to delete a feed that is not theirs
            return view('feeds.delete', compact('feed'));
        }
        return redirect()->route('feeds.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feed $feed)
    {
        if(Auth::user() == $feed->user) {                   // A User should not be able to delete a feed that is not theirs
            $feed->delete();
        }
        return redirect()->route('feeds.index');
    }
}
