<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Garage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CMSController extends Controller
{
    public function index()
    {
        // Ambil data garages berdasarkan likes terbanyak
        $garages = Garage::orderByDesc('likes')->get();

        return view('user.home', compact('garages'));
    }

    public function show(String $id)
    {
        // Retrieve the garage with the given ID
        $garage = Garage::findOrFail($id);
        $garages = Garage::orderByDesc('likes')->limit(4)->get();

        return view('user.show', compact('garages', 'garage'));
    }

    public function like($id)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to login first to like a garage.');
        }

        $garage = Garage::findOrFail($id);
        $user = Auth::user();

        // Check if the user has already liked this garage
        if (!$user->hasLikedGarage($garage)) {
            // Increment likes count
            $garage->likes++;
            $garage->save();
            // Attach user as the one who liked this garage
            $user->likedGarages()->attach($garage);
        } else {
            // User already liked this garage, so unlike it
            $garage->likes--;
            $garage->save();
            // Detach user from liked garages
            $user->likedGarages()->detach($garage);
        }

        return back(); // Redirect back to the same page
    }

    public function showCategory($category)
    {
        // Retrieve garages based on the category
        $garages = Garage::where('categories', $category)->orderByDesc('likes')->get();

        return view('user.category', compact('garages', 'category'));
    }

    public function recomendation()
    {
        // Ambil data garages berdasarkan likes terbanyak
        $garages = Garage::orderByDesc('likes')->get();

        return view('user.recomendation', compact('garages'));
    }

    public function news()
    {
        // Ambil data news
        $news = News::orderByDesc('created_at')->get();

        return view('user.news.index', compact('news'));
    }

    public function help()
    {
        return view('user.help.index');
    }
}
