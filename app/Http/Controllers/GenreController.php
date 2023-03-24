<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use Illuminate\Support\Facades\Log;

class GenreController extends Controller
{

    public function __construct ()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $this->authorize('view', Genre::class);
        try
        {
            $genres = Genre::all();
            Log::info('Fetching Genres :'.json_encode($genres));

            return response()->json([
                'status' => 'success',
                'message' => 'Getting the genres',
                'data' => $genres,
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
        $this->authorize('create', Genre::class);

        Log::info('Request to creating genre ');
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
        $this->authorize('view', Genre::class);

        Log::info('Request to getting genre by id = '.$genre->id);
        return response()->json([
            'status' => 'success',
            'message' => 'getting genre by id is successfully',
            'genre' => $genre,
        ]);
    }


    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        $this->authorize('update', Genre::class);
        try
        {
            Log::info('Request to updating genre id = '.$genre->id);
            $confidential = $request->validated();
            $genre->update($confidential);

            return response()->json([
                'status' => 'success',
                'message' => 'updating genre is successful',
                'genre' => $genre,
            ]);
        }
        catch (\Exception $e)
        {
            Log::error('Error in updating Genre. \n Error: '.$e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'error is occurred when updating, try again',
            ]);
        }
    }


    public function destroy(Genre $genre)
    {
        $this->authorize('delete', Genre::class);
        try
        {
            Log::info('Request to deleting genre id = '.$genre->id);
            $genre->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Deleting genre is successful',
            ]);
        }
        catch (\Exception $e)
        {
            Log::error('Error in updating Genre \n Error: '.$e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'error is occurred when deleting genre, try again',
            ]);
        }
    }
}
