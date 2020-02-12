<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Food extends Model
{
    //
    protected $fillable = ['category_id', 'image', 'name', 'slug', 'components', 'notes', 'description', 'price', 'vat', 'is_offer', 'is_special', 'status'];
    public function category()
    {
        return $this->belongsTo('App\Category');
    }



    public function delete()
    {
        if ($this->image != 'image/logo.png') {
            if(File::exists(public_path($this->image)))
                File::delete(public_path($this->image));
        }
        // dd($this->image);
        return parent::delete();
    }
}
