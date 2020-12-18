<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
class BookController extends Controller
{
    public function getAllBooks() {
        $books = Book::get()->toJson();
        return response($books, 200);
      }

    public function getBook($id) {
        if (Book::where('id', $id)->exists()) {
          $book = Book::where('id', $id)->get()->toJson();
          return response($book, 200);
        } else {
          return response()->json([
            "message" => "Book not found"
          ], 404);
        }
      }
    public function createBook(Request $request) {
        $book = new Book;
        $book->name = $request->name;
        $book->author = $request->author;
        $book->save();
  
        return response()->json([
          "message" => "Book record created"
        ], 201);
      }
      public function updateBook(Request $request, $id) {
      
          $book = Book::find($id);
  
          $book-> name = $request-> name;
          $book->author = $request->author;
          $book->save();
  
          return response()->json([
            "message" => "records updated successfully"
          ], 200);
       
      }
      public function deleteBook ($id) {
        if(Book::where('id', $id)->exists()) {
          $book = Book::find($id);
          $book->delete();
  
          return response()->json([
            "message" => "records deleted"
          ], 202);
        } else {
          return response()->json([
            "message" => "Book not found"
          ], 404);
        }
      }
}
