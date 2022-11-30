<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'cover' => ['required', 'image'],
        ]);

        $coverPath = $request->file('cover')->store('series_cover', 'public');

        return response(
            $coverPath,
            201 // Response code 201 created
        );
    }
}
