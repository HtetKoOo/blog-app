<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\MusicGenre;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class MusicGenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.music_genre.index');
    }

    public function ssd()
    {
        $data = MusicGenre::query();

        return DataTables::of($data)
            ->editColumn('created_at', function ($each) {
                return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($each) {
                $edit_icon = '<a href="' . url('admin/music-genre/' . $each->id . '/edit') . '" class="text-warning"><i class="fas fa-edit"></i></a>';
                $delete_icon = '<button type="button" class="btn btn-link text-danger p-0 delete-mg" data-id="' . $each->id . '">
                <i class="fas fa-trash-alt"></i>
                </button>';
                return '<div class="action-icon">' . $edit_icon . $delete_icon . '</div>';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.music_genre.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        MusicGenre::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect('/admin/music-genre')->with('success', 'New Music Genre created successfully.');
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
        $mg = MusicGenre::findOrFail($id);
        return view('backend.music_genre.edit', compact('mg'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin_user = MusicGenre::findOrFail($id);
        $admin_user->name = $request->name;
        $admin_user->description = $request->description;
        $admin_user->update();
        return redirect('admin/music-genre')->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mg = MusicGenre::findOrFail($id);
        $mg->delete();
        return redirect()->back()->with('success', 'Music Genre deleted successfully.');
    }
}
