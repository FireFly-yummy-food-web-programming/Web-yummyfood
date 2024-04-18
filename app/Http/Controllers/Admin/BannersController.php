<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannersController extends Controller
{
    public function index(Request $request)
    {
        $title = 'List of Banners';
        $banners = Banner::all();

        return view('admin.dashboard.banners', compact('title', 'banners'));
    }

    public function create()
    {
        $title = "Add new Banner";
        return view('admin.banner.add', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:IsActive,InActive',
        ]);

        $name = $request->name;
        $description = $request->description;
        $status = $request->status;
        $fileName = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('images', $fileName, 'public');
        $banner = [
            'name' => $name,
            'image' => $fileName,
            'description' => $description,
            'status' => $status,
        ];

        Banner::create($banner);

        return redirect()->route('manage-banners')->with('success', 'Banner created successfully.');
    }


    public function edit($id)
    {
        $title = "Edit banner";
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('title', 'banner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:IsActive,InActive',
        ]);

        $name = $request->name;
        $description = $request->description;
        $status = $request->status;

        if ($request->hasFile('image')) {
            $fileName = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images', $fileName, 'public');
        } else {
            return redirect()->back()->withInput()->withErrors(['image' => 'Please upload an image.']);
        }

        $banner = Banner::findOrFail($id);
        $banner->name = $name;
        $banner->image = $fileName;
        $banner->description = $description;
        $banner->status = $status;
        $banner->save();

        return redirect()->route('manage-banners')->with('success', 'Banner updated successfully.');
    }


    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()->route('manage-banners')->with('success', 'Banner deleted successfully.');
    }

    public function softDelete($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()->back()->with('success', 'Banner soft deleted successfully.');
    }

    public function restore($id)
    {
        $banner = Banner::onlyTrashed()->findOrFail($id);
        $banner->restore();
        return redirect()->back()->with('success', 'Banner restored successfully.');
    }

    public function permanentDelete($id)
    {
        $banner = Banner::onlyTrashed()->findOrFail($id);
        $banner->forceDelete();
        return redirect()->back()->with('success', 'Banner permanently deleted successfully.');
    }
}
