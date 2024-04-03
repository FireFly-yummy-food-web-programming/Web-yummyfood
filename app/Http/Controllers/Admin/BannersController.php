<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannersController extends Controller
{
    public function index()
    {
        $title = 'List of Banners';
        $banners = Banner::all();

        return view('admin.dashboard.banners', compact('title', 'banners'));
    }

    public function create()
    {
        return view('admin.banner.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'status' => 'required|in:IsActive,InActive',
        ]);

        Banner::create($request->all());

        return redirect()->route('manage-banners')->with('success', 'Banner created successfully.');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'status' => 'required|in:IsActive,InActive',
        ]);

        $banner = Banner::findOrFail($id);
        $banner->update($request->all());

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
