<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpisodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Season $season)
    {
        return view('episodes.index', [
            'episodes' => $season->episodes, 
            'seasonNumber' => $season->number,
            'messageSuccess' => session('message.success')
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Season $season)
    {
        if ($request->episodes != null) {
            $watchedEpisodes = $request->episodes;
            DB::transaction(function () use ($watchedEpisodes){
                Episode::whereIn('id', $watchedEpisodes)->update(['watched' => true]);
                Episode::whereNotIn('id', $watchedEpisodes)->update(['watched' => false]);
            });
            
            $messageType = 'message.success';
            $message = 'Watched episodes list updated';
        } else {
            DB::transaction(function () use ($season) {
                $season->episodes()->update(['watched' => false]);
            });
            $messageType = 'message.success';
            $message = 'Watched episodes list updated';
        }
        return to_route('episodes.index', $season->id)
            ->with($messageType, $message);
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
