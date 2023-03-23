<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Http\Requests\StoreCollectionRequest;
use App\Http\Requests\UpdateCollectionRequest;
use Illuminate\Support\Facades\Log;

class CollectionController extends Controller
{

    public function __construct ()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        try
        {
            $collections = Collection::all();
            Log::info('Fetching Collections :'.json_encode($collections));

            return response()->json([
                'status' => 'success',
                'message' => 'Getting the collections',
                'data' => $collections,
            ]);
        }catch (\Exception $e)
        {
            Log::error('Error in getting Collections :'.$e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'error is occurred, try again',
            ]);
        }
    }


    public function store(StoreCollectionRequest $request)
    {
        Log::info('Request to creating collection ');
        try
        {
            $data = $request->validated();
            $data = Collection::create($data);
            return response()->json([
                'status' => 'success',
                'message' => 'collection created with successfully',
                'collection' => $data,
            ]);
        }catch (\Exception $e)
        {
            Log::error('Error in storing Collections :'.$e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'error is occurred, try again',
            ]);
        }
    }


    public function show(Collection $collection)
    {
        Log::info('Request to getting collection by id = '.$collection->id);
        return response()->json([
            'status' => 'success',
            'message' => 'getting collection by id is successfully',
            'collection' => $collection,
        ]);
    }


    public function update(UpdateCollectionRequest $request, Collection $collection)
    {
        try
        {
            Log::info('Request to updating collection id = '.$collection->id);
            $confidential = $request->validated();
            $collection->update($confidential);

            return response()->json([
                'status' => 'success',
                'message' => 'updating collection is successful',
                'collection' => $collection,
            ]);
        }
        catch (\Exception $e)
        {
            Log::error('Error in updating Collection. \n Error: '.$e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'error is occurred when updating, try again',
            ]);
        }
    }


    public function destroy(Collection $collection)
    {
        try
        {
            Log::info('Request to deleting collection id = '.$collection->id);
            $collection->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Deleting collection is successful',
            ]);
        }
        catch (\Exception $e)
        {
            Log::error('Error in updating Collection \n Error: '.$e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'error is occurred when deleting collection, try again',
            ]);
        }
    }
}
