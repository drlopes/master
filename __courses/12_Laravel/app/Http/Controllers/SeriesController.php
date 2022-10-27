<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Series;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;

use function PHPUnit\Framework\returnSelf;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $series = Series::all();

        $messageSuccess = session('message.success');

        return view('series.index')
            ->with('series', $series)
            ->with('messageSuccess', $messageSuccess);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(SeriesFormRequest $request)
    {
        $series = Series::create($request->all());

        $seasons = [];
        for ($i = 1; $i <= $request->seasons; $i++) { 
            $seasons[] = [
                'series_id' => $series->id,
                'number' => $i
            ];
        }

        Season::insert($seasons);

        $episodes = [];
        foreach ($series->seasons as $season) {
            for ($j = 1; $j <= $request->episodes; $j++) {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $j
                ];
            }
        }

        Episode::insert($episodes);

        $messageType = 'message.success';
        $message = "Series '{$series->name}' created successfully";

        return to_route('series.index', [], 302)->with($messageType, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * 
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
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Series $series)
    {
        return view('series.edit')->with('series', $series);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeriesFormRequest $request, Series $series)
    {
        $series->fill($request->all());
        $series->save();
        $messageType = 'message.success';
        $message = "Series '{$series->name}' updated";

        return to_route('series.index')->with($messageType, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Series $series)
    {
        $messageType = '';
        $message = '';
        $isDeleted = $series->delete();

        if ($isDeleted) {
            $messageType = 'message.success';
            $message = "Series \"{$series->name}\" removed successfully";
        } else {
            $messageType = 'message.error';
            $message = "Series \"{$series->name}\" was not removed";
        }

        return to_route('series.index')->with($messageType, $message);
    }
}
