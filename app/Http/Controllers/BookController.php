<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class BookController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $this->authorize('view', Book::class);
        try
        {
            $books = Book::all();
            Log::info('Fetching Books :'.json_encode($books));

            return response()->json([
                'status' => 'success',
                'message' => 'fetching books is successful',
                'data' => $books,
            ]);
        }catch (\Exception $e)
        {
            Log::error('Error in getting Books :'.$e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'error is occurred, try again',
            ]);
        }
    }


    public function store(StoreBookRequest $request)
    {
        $this->authorize('create', Book::class);

        Log::info('Request to creating book ');
        try
        {
            $user = JWTAuth::user();
            $confidential = $request->validated();

            $book = $user->books()->create($confidential);

            return response()->json([
                'status' => 'success',
                'message' => 'book created with successfully',
                'book' => $book,
            ]);
        }catch (\Exception $e)
        {
            Log::error('Error in storing Books :'.$e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'error is occurred when creating the book, try again',
            ]);
        }
    }

    public function show(Book $book)
    {
        $this->authorize('view', $book);

        Log::info('Request to getting book by id = '.$book->id);
        $book->load(['genre', 'collection']);

        return response()->json([
            'status' => 'success',
            'message' => 'getting book by id is successfully',
            'book' => $book,
        ]);
    }


    public function update(StoreBookRequest $request, Book $book)
    {
        $this->authorize('update', $book);

        try
        {
            Log::info('Request to updating book id = '.$book->id);
            $confidential = $request->validated();
            $book->update($confidential);
            $book->load(['genre', 'collection']);

            return response()->json([
                'status' => 'success',
                'message' => 'updating book is successful',
                'book' => $book,
            ]);
        }
        catch (\Exception $e)
        {
            Log::error("Error in updating Book. \n Error: ".$e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'error is occurred when updating, try again',
            ]);
        }
    }


    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);

        try
        {
            Log::info('Request to deleting book id = '.$book->id);
            $book->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Deleting book is successful',
            ]);
        }
        catch (\Exception $e)
        {
            Log::error("Error in updating Book \n Error: ".$e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'error is occurred when deleting book, try again',
            ]);
        }
    }
}
