<?php

namespace App\Http\Controllers;

use App\Models\Multipic;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function HomeSlider()
    {
        $sliders = Slider::latest()->get();

        return view('admin.slider.index', compact('sliders'));
    }

    public function CreateSlider()
    {
        return view('admin.slider.create');
    }

    public function SaveSlider(Request $request)
    {


        $slider = $request->file('image');
        // $uniqName = hexdec(uniqid());
        // $image_extension = strtolower($image->getClientOriginalExtension());
        // $img_name = $uniqName . '.' . $image_extension;
        // $mov_dir = 'image/brand/';
        // $last_mov_dir = $mov_dir . '.' . $img_name;

        // $image->move($mov_dir, $img_name);
        $img_name = hexdec(uniqid()) . '.' . $slider->getClientOriginalExtension();
        Image::make($slider)->resize(1920, 1088)->save('image/slider/' . $img_name);
        $last_mov_dir = "image/slider/" . $img_name;

        $sliders = Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_mov_dir,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('slider')->with('success', 'Add Slider Successfully!');
    }

    public function EditSlider($id)
    {
        $sliders = Slider::find($id);
        return view('admin.slider.edit', compact('sliders'));
    }

    public function UpdateSlider(Request $request, $id)
    {

        $image = $request->file('image');

        $old_image = $request->old_image;
        if ($image) {

            $uniqName = hexdec(uniqid());
            $image_extension = strtolower($image->getClientOriginalExtension());
            $img_name = $uniqName . '.' . $image_extension;
            $img_dir = 'image/slider/' . $img_name;
            unlink($old_image);

            Image::make($image)->resize(1920, 1088)->save('image/slider/' . $img_name);

            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $img_dir,
                'created_at' => Carbon::now()
            ]);
        } else {
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $old_image,
                'created_at' => Carbon::now()
            ]);
        }

        return Redirect()->route('slider')->with('success', 'Update Slider Successfully!');
    }

    public function DeleteSlider($id)
    {
        $slider = Slider::find($id);
        $old_img = $slider->image;
        unlink($old_img);

        Slider::find($id)->delete();
        return Redirect()->route('slider')->with('success', 'Delete Slider Successfully!');
    }


    public function Portfolio()
    {
        $portfolio = Multipic::all();
        return view('pages.portfolio', compact('portfolio'));
    }
}
