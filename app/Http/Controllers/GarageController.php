<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use App\Models\GarageImage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GarageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $garages = Garage::all();
        return view('dashboard.garage.index', compact('garages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.garage.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:155',
            'categories' => 'required|in:matic,manual',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = 'foto_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/garage/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
        }

        Garage::create([
            'gambar' => $imageName,
            'title' => $request->input('title'),
            'categories' => $request->input('categories'),
            'description' => $request->input('description'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('garage.index')->with('success', 'Garage entry created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $garage = Garage::find($id);

        if (!$garage) {
            return redirect()->route('garage.index')->with('error', 'Garage entry not found.');
        }

        return view('dashboard.garage.show', compact('garage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $garage = Garage::find($id);

        if (!$garage) {
            return redirect()->route('garage.index')->with('error', 'Garage entry not found.');
        }

        return view('dashboard.garage.edit', compact('garage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:155',
            'categories' => 'required|in:matic,manual',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $garage = Garage::find($id);

        if (!$garage) {
            return redirect()->route('garage.index')->with('error', 'Garage entry not found.');
        }

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($garage->gambar) {
                Storage::disk('public')->delete('uploads/garage/' . $garage->gambar);
            }
            $image = $request->file('gambar');
            $imageName = 'foto_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/garage/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
            $garage->gambar = $imageName;
        }

        $garage->title = $request->input('title');
        $garage->categories = $request->input('categories');
        $garage->description = $request->input('description');
        $garage->save();

        return redirect()->route('garage.index')->with('success', 'Garage entry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $garage = Garage::find($id);

        if (!$garage) {
            return redirect()->route('garage.index')->with('error', 'Garage entry not found.');
        }

        if ($garage->gambar) {
            Storage::disk('public')->delete('uploads/garage/' . $garage->gambar);
        }
        $garage->delete();
        return redirect()->route('garage.index')->with('success', 'Garage entry deleted successfully.');
    }

    /**
     * Images for garage.
     */
    public function addImages($id)
    {
        $garage = Garage::findOrFail($id);
        return view('dashboard.garage.add-images', compact('garage'));
    }

    public function storeImage(Request $request, $garage_id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string|max:255',
        ]);

        $image = $request->file('image');
        $imageName = 'foto_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $imagePath = 'uploads/garage/' . $imageName;
        Storage::disk('public')->put($imagePath, file_get_contents($image));

        GarageImage::create([
            'garage_id' => $garage_id,
            'image_path' => $imageName,
            'description' => $request->input('description'),
        ]);

        return redirect()->back()->with('success', 'Image added successfully.');
    }

    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string|max:255',
        ]);

        $image = GarageImage::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete('uploads/garage/' . $image->image_path);

            $newImage = $request->file('image');
            $newImageName = 'foto_' . uniqid() . '.' . $newImage->getClientOriginalExtension();
            $newImagePath = 'uploads/garage/' . $newImageName;
            Storage::disk('public')->put($newImagePath, file_get_contents($newImage));

            $image->image_path = $newImageName;
        }

        $image->description = $request->input('description');
        $image->save();

        return redirect()->back()->with('success', 'Image updated successfully.');
    }

    public function deleteImage($id)
    {
        $image = GarageImage::findOrFail($id);
        Storage::disk('public')->delete('uploads/garage/' . $image->image_path);
        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}
