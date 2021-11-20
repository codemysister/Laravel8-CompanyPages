<?php


namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getBrands()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brands.index', compact('brands'));
    }

    public function addBrand(Request $request)
    {
        $validated = $request->validate(
            [
                'brand_name' => 'required|unique:brands|min:4',
                'brand_image' => 'required|mimes:jpg,jpeg,png',
            ],
            [
                'brand_name.required' => 'Please Fill The Brand Name!',
                'brand_name.min' => 'Brand Name Must Be 4 Longer!'
            ]
        );

        $image = $request->file('brand_image');
        // $uniqName = hexdec(uniqid());
        // $image_extension = strtolower($image->getClientOriginalExtension());
        // $img_name = $uniqName . '.' . $image_extension;
        // $mov_dir = 'image/brand/';
        // $last_mov_dir = $mov_dir . '.' . $img_name;

        // $image->move($mov_dir, $img_name);
        $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 200)->save('image/brand/' . $img_name);
        $last_mov_dir = "image/brand/" . $img_name;

        $brands = Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_mov_dir,
            'created_at' => Carbon::now()
        ]);

        $notification = [
            'message' => "Add Brand Successfully!",
            'alert-type' => 'success'
        ];

        return Redirect()->back()->with($notification);
    }


    public function editBrand($id)
    {
        $brands = Brand::find($id);
        return view('admin.brands.edit', compact('brands'));
    }

    public function updateBrand(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'brand_name' => 'required|min:4',
                'brand_image' => 'mimes:jpg,jpeg,png',
            ],
            [
                'brand_name.required' => 'Please Fill The Brand Name!',
                'brand_name.min' => 'Brand Name Must Be 4 Longer!'
            ]
        );

        $image = $request->file('brand_image');

        if ($image) {
            $old_image = $request->old_image;
            $uniqName = hexdec(uniqid());
            $image_extension = strtolower($image->getClientOriginalExtension());
            $img_name = $uniqName . '.' . $image_extension;
            $mov_dir = 'image/brand/';
            $last_mov_dir = $mov_dir . $img_name;

            unlink($old_image);

            $image->move($mov_dir, $img_name);

            $brands = Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_mov_dir,
                'created_at' => Carbon::now()
            ]);
        } else {
            $brands = Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);
        }

        return Redirect()->back()->with('success', 'Update Brand Successfully!');
    }


    public function deleteBrand($id)
    {
        $image = Brand::find($id);
        $img_old = $image->brand_image;
        unlink($img_old);
        Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Delete Brand Successfully!');
    }

    public function multiPic()
    {
        $images = Multipic::all();
        return view('admin.multipic.index', compact('images'));
    }

    public function addMultiPic(Request $request)
    {
        $images = $request->file('multipic');

        foreach ($images as $img) {


            $img_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(300, 300)->save('image/multi/' . $img_name);
            $last_mov_dir = "image/multi/" . $img_name;

            $multi = Multipic::insert([
                'image' => $last_mov_dir,
                'created_at' => Carbon::now()
            ]);
        }
        return Redirect()->back()->with('success', 'Add Image Successfully!');
    }

    public function logout()
    {
        Auth::logout();
        return Redirect()->route('login');
    }
}
