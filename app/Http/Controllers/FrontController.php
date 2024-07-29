<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ChMessage as Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FrontController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'DESC')->take(6)->get();
        $categories = Category::all();
        $doctor = Doctor::all();
        return view('front.index', [
            'products' => $products,
            'categories' => $categories,
            'doctor' => $doctor,
        ]);
    }

    public function details(Product $product)
    {

        return view('front.details', [
            'product' => $product,
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')
        ->orWhere('slug', 'LIKE', '%' . $keyword . '%')
        ->orWhere('about', 'LIKE', '%' . $keyword . '%')
        ->get();
        $doctors = Doctor::where('name', 'LIKE', '%' . $keyword . '%')->get();

        return view('front.search', [
            'products' => $products,
            'doctors' => $doctors,
            'keyword' => $keyword,
        ]);
    }

    public function category(Category $category)
    {
        $products = Product::where('category_id', $category->id)->with('category')->get();
        return view('front.category', [
            'products' => $products,
            'category' => $category,
        ]);
    }

    public function konsultasi()
    {
        // Mengambil daftar dokter dan mengurutkannya berdasarkan nama
        $doctor = DB::table('doctor')
            ->leftJoin('users', 'users.id', '=', 'doctor.user_id')
            ->orderBy('users.name', 'asc')
            ->get();

        return view('front.konsultasi', [
            'doctor' => $doctor,
        ]);
    }


    public function riwayat(Request $request)
{
    DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");

    $userId = Auth::id();
    $keyword = $request->input('keyword');

    $users = DB::table('users')
        ->leftJoin('doctor', 'users.id', '=', 'doctor.user_id')
        ->join('ch_messages', function ($join) use ($userId) {
            $join->on('users.id', '=', 'ch_messages.from_id')
                ->orOn('users.id', '=', 'ch_messages.to_id');
        })
        ->where(function ($query) use ($userId) {
            $query->where('ch_messages.from_id', $userId)
                ->orWhere('ch_messages.to_id', $userId);
        })
        ->where('users.id', '!=', $userId)
        ->where(function ($query) use ($keyword) {
            $query->where('doctor.name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('doctor.spesialis', 'LIKE', '%' . $keyword . '%');
        })
        ->select('users.*', 'doctor.photo as doctor_photo', DB::raw('MAX(ch_messages.created_at) as max_created_at'))
        ->groupBy('users.id')
        ->orderBy('max_created_at', 'desc')
        ->get();

    $users = $users->map(function ($user) use ($userId) {
        $user->latestMessage = DB::table('ch_messages')
            ->where(function ($query) use ($user, $userId) {
                $query->where('from_id', $user->id)
                    ->where('to_id', $userId)
                    ->orWhere('from_id', $userId)
                    ->where('to_id', $user->id);
            })
            ->latest('created_at')
            ->first();
        return $user;
    });

    return view('front.riwayat', [
        'users' => $users,
        'keyword' => $keyword,
    ]);
}
}