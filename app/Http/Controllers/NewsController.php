<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();
        return view('dashboard.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'link_news' => 'required|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = 'news_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/news/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
        }

        News::create([
            'gambar' => $imageName,
            'title' => $request->input('title'),
            'link_news' => $request->input('link_news'),
        ]);

        return redirect()->route('news.index')->with('success', 'News entry created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::find($id);

        if (!$news) {
            return redirect()->route('news.index')->with('error', 'News entry not found.');
        }

        return view('dashboard.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = News::find($id);

        if (!$news) {
            return redirect()->route('news.index')->with('error', 'News entry not found.');
        }

        return view('dashboard.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'link_news' => 'required|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $news = News::find($id);

        if (!$news) {
            return redirect()->route('news.index')->with('error', 'News entry not found.');
        }

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($news->gambar) {
                Storage::disk('public')->delete('uploads/news/' . $news->gambar);
            }
            $image = $request->file('gambar');
            $imageName = 'news_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/news/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
            $news->gambar = $imageName;
        }

        $news->title = $request->input('title');
        $news->link_news = $request->input('link_news');
        $news->save();

        return redirect()->route('news.index')->with('success', 'News entry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::find($id);

        if (!$news) {
            return redirect()->route('news.index')->with('error', 'News entry not found.');
        }

        if ($news->gambar) {
            Storage::disk('public')->delete('uploads/news/' . $news->gambar);
        }
        $news->delete();
        return redirect()->route('news.index')->with('success', 'News entry deleted successfully.');
    }
}
