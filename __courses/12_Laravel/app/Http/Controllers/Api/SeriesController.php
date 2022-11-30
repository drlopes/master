<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Jobs\DeleteSeriesCover;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use App\Events\SeriesCreated as SeriesCreatedEvent;

class SeriesController extends Controller
{
    public function __construct(
        private SeriesRepository $repository 
    )
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Series::query();

        if ($request->has('name')) {
            $query->where('name', $request->name);
        } 

        return response()->json(
            $query->paginate(2),
            200 // Response Code 200 OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeriesFormRequest $request)
    {
        $series = $this->repository->add($request);
        SeriesCreatedEvent::dispatch(
            $series->id,
            $request->name,
            $request->seasons,
            $request->episodes
        );

        return response()->json(
            $series,
            201 // Response Code 201 Created
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $series = Series::whereId($id)->with('seasons.episodes')->first();
        
        if (!$series) {
            return response()->json(
                ['message' => 'Series not found'],
                404 // Response Code 404 Not Found
            );
        }
        
        return response()->json(
            $series,
            200 // Response Code 200 OK
        );
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
        Series::where('id', $id)->update($request->all());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Series $series)
    {
        DeleteSeriesCover::dispatch($series->cover_path);
        $series->delete();

        return response()->noContent();
    }
}
