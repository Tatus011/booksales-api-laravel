<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;



class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user', 'book')->get();

        if ($transactions->isEmpty()) {
            return response()->json([
                "success" => true,
                "message" => "Resource data not found!"
            ], 200);
        }

        return response()->json([
            "success" => true,
            "message" => "Get all resources",
            "data" => $transactions
        ]);
    }

    public function store(Request $request)
    {
        // Validator dan Cek validator
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 422);
        }

        // Generate orderNumber -> unique
        $uniqueCode = "ORD-" . strtoupper(uniqid());

        // Ambil user yang sedang login & cek login (apakah ada data user?)
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized!'
            ], 401);
        }

        // Mencari data buku dari request
        $book = Book::find($request->book_id);
        
        // Cek stok buku
        if ($book->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stok barang tidak cukup!'
            ], 400);
        }

        // Menghitung total harga = price * quantity
        $totalAmount = $book->price * $request->quantity;

        // Mengurangi stok buku (update)
        $book->stock -= $request->quantity;
        $book->save();

        // Menyimpan data transaksi
        $transactions = Transaction::create([
            'order_number' => $uniqueCode,
            'customer_id' => $user->id,
            'book_id' => $request->book_id,
            'total_amount' => $totalAmount
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaction created successfully!',
            'data' => $transactions
        ], 201);
    }

    public function show($id)
    {
        $transaction = Transaction::with('user', 'book')->find($id);

        if (!$transaction) {
            return response()->json([
                "success" => false,
                "message" => "Resource data not found!"
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Get detail resource",
            "data" => $transaction
        ]);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found.'
            ], 404);
        }

        $validated = $request->validate([
            'order_number' => 'required|string',
            'customer_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'total_amount' => 'required|numeric',
        ]);

        $transaction->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Transaction updated successfully.',
            'data' => $transaction->load('user', 'book')
        ]);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found.'
            ], 404);
        }

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction deleted successfully.'
        ]);
    }
}
