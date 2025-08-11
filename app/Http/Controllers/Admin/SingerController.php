<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Singer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Yajra\DataTables\Facades\DataTables;

class SingerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.singer.index');
    }

    public function ssd()
    {
        $data = Singer::query();

        return DataTables::of($data)
            ->editColumn('photo_url', function ($each) {
                if ($each->photo_url) {
                    return '<img src="' . $each->photo_url . '" alt="' . e($each->name) . '" width="100" height="100" style="object-fit:cover; border-radius:5px;">';
                }
                return '-';
            })
            ->addColumn('action', function ($each) {
                $edit_icon = '<a href="' . url('admin/singer/' . $each->id . '/edit') . '" class="text-warning"><i class="fas fa-edit"></i></a>';
                $delete_icon = '<button type="button" class="btn btn-link text-danger p-0 delete-singer" data-id="' . $each->id . '">
                <i class="fas fa-trash-alt"></i>
                </button>';
                return '<div class="action-icon">' . $edit_icon . $delete_icon . '</div>';
            })
            ->rawColumns(['photo_url', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.singer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // Handle photo upload
        if ($request->hasFile('photo')) {
            $uploadedPhotoUrl = Cloudinary::upload($request->file('photo')->getRealPath())->getSecurePath();
        } else {
            $uploadedPhotoUrl = null; // Handle case where no photo is uploaded
        }
        Singer::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'photo_url' => $uploadedPhotoUrl,
        ]);
        return redirect('/admin/singer')->with('success', 'New Singer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $singer = Singer::findOrFail($id);
        return view('backend.singer.edit', compact('singer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $singer = Singer::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:30',
            'gender' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);
        if($request->hasFile('photo')){
            // Handle photo upload
            if ($singer->photo_url) {
                Cloudinary::destroy($singer->photo_url); // Delete old photo if exists
            }
            $uploadedFileUrl = Cloudinary::upload($request->file('photo')->getRealPath())->getSecurePath();
        } else {
            $uploadedFileUrl = $singer->photo_url; // Keep the old photo if no new one is uploaded
        }
        $singer->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'photo_url' => $uploadedFileUrl,
        ]);
        return redirect('admin/singer')->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $singer = Singer::findOrFail($id);
        if ($singer->photo_url) {
            Cloudinary::destroy($singer->photo_url); // Use public_id, not URL
        }
        $singer->delete();
        return redirect()->back()->with('success', 'Singer deleted successfully.');
    }
}