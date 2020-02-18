<?php

namespace App\Http\Controllers;

use App\Category;
use App\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    //

    public function create()
    {
        $categories = Category::all();
        return view('create_food', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:foods',
            'description' => 'string|nullable',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
            'other_category' => 'nullable|string',
            'components' => 'required|nullable|string'
        ]);
        $category_id = 0;
        if (Category::find($request->category_id)) {
            $category = $request->category_id;
        } else {
            $cat = $request->other_category;
            if ($cat == null) {
                return back()->with('message', 'Please enter category');
            }
            if (Category::where('name', $cat)->first()) {
                $category_id = Category::where('name', $cat)->first()->id;
            } else {
                $category_id = Category::create([
                    'name' => $cat,
                    'status' => 0,
                    'is_offer' => 0,
                ])->id;
            }
        }

        if ($request->image) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('/uploads'), $imageName);
            $imageName = "/uploads/" . $imageName;
        } else {
            $imageName = 'image/logo.png';
        }
        $food = Food::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName,
            'components' => $request->components,
            'category_id' => $category_id
        ]);


        return back()->with('message', 'Successfully added food items');
    }

    public function destroy($id){
        if($this->authorize('modify')){
           $food =  Food::findOrFail($id);
           $food->delete();
           return back()->with('message','Successfully deleted food items');
        }

        abort(404);
    }
}
