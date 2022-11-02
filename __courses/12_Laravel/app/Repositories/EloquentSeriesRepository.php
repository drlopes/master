<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\{Episode, Season, Series};
use Illuminate\Support\Facades\DB;
use App\Repositories\SeriesRepository;

class EloquentSeriesRepository implements SeriesRepository
{
    function add(SeriesFormRequest $request): Series
    {
        $series = DB::transaction(function () use ($request) {
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

            return $series;
        });

        return $series;
    }
}