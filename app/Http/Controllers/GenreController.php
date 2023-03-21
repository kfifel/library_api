<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use Illuminate\Support\Facades\Log;

class GenreController extends Controller
{

    public function index()
    {
        try
        {
            $genres = Genre::all();
            Log::info('Fetching Genres :'.json_encode($genres));

            return response()->json([
                'status' => 'success',
                'message' => 'Getting the genres',
                'data' => Genre::all(),
            ]);
        }catch (\Exception $e)
        {
           Log::error('Error in getting Genres :'.$e->getMessage());
           return response()->json([
               'status' => 'error',
               'message' => 'error is occurred, try again',
           ]);
        }
    }


    public function store(StoreGenreRequest $request)
    {
        try
        {
            $data = $request->validated();
            $data = Genre::create($data);
            return response()->json([
                'status' => 'success',
                'message' => 'genre created with successfully',
                'genre' => $data,
            ]);
        }catch (\Exception $e)
        {
            Log::error('Error in storing Genres :'.$e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'error is occurred, try again',
            ]);
        }
    }


    public function show(Genre $genre)
    {
        Log::info('getting genre by id = '.$genre->id);
        return response()->json([
            'status' => 'success',
            'message' => 'getting genre by id is successfully',
            'genre' => $genre,
        ]);
    }


    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        //
    }


    public function destroy(Genre $genre)
    {
        //
    }
}
