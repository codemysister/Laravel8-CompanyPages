<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllCategories()
    {
        // // $categories = DB::table('categories')
        //     ->join('users', 'categories.user_id', 'users.id')
        //     ->select('categories.*', 'users.name')
        //     ->latest()->paginate(2);

        $categories = Category::latest()->paginate(2);
        $trash = Category::onlyTrashed()->latest()->paginate(2);
        // $categories = DB::table('categories')->latest()->paginate(2);
        return view('admin.categories.index', compact('categories', 'trash'));
    }

    public function addCategories(Request $request)
    {
        $validated = $request->validate(
            [
                'category_name' => 'required|unique:categories|max:255'
            ],
            [
                'category_name.required' => 'Please Fill The Categories Name!'
            ]
        );

        // ELOQUENT ORM
        // Category::create([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now()
        // ]);

        // $category = new Category();
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        // QUERY BUILDER
        $data = [
            'category_name' => $request->category_name,
            'user_id'   => Auth::user()->id,
            'created_at' => Carbon::now()
        ];

        DB::table('categories')->insert($data);

        return Redirect()->back()->with('success', 'Insert Category Successfully!');
    }


    public function editCategories($id)
    {
        // $categories = Category::find($id);
        $categories = DB::table('categories')->where('id', $id)->first();

        return view('admin.categories.edit', compact('categories'));
    }

    public function updateCategories(Request $request, $id)
    {
        $categories = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);

        // $data = [
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id
        // ];

        // DB::table('categories')->where('id', $id)->update($data);

        return Redirect()->route('category')->with('success', 'Update Category Successfully!');
    }

    public function softDelete($id)
    {
        $deleted = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Soft Delete Sucessfully');
    }


    public function restoreCategories($id)
    {
        Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Restore Category Successfully');
    }

    public function permanentDelete($id)
    {
        Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Delete Permanent Successfully');
    }
}
