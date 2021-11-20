<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Carbon;


class HomeAboutController extends Controller
{
    public function HomeAbout()
    {
        $homeabout = About::latest()->get();
        return view('admin.home_about.index', compact('homeabout'));
    }

    public function AddAbout()
    {
        return view('admin.home_about.create');
    }

    public function StoreAbout(Request $request)
    {
        About::insert([
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.about')->with('success', 'Add About Successfully');
    }

    public function EditAbout($id)
    {
        $abouts = About::find($id);
        return view('admin.home_about.edit', compact('abouts'));
    }

    public function UpdateAbout(Request $request, $id)
    {
        About::find($id)->update([
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.about')->with('success', 'Update About Successfully');
    }

    public function DeleteAbout($id)
    {
        About::find($id)->delete();
        return Redirect()->back()->with('success', 'Delete About Successfully');
    }
}
