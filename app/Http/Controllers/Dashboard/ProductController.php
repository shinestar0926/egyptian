<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Product;
use App\Ingots;
use App\Coins;
use App\posts;
use App\Posts_images;
use App\Posts_vedios;
use App\FeesCaches;
use App\FeesCoins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $categories = Category::all();
        $posts = posts::all();
        $products = posts::when($request->search, function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {

                return $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        })->when($request->category_id, function ($q) use ($request) {

            return $q->where('category_id', $request->category_id);
        })->latest()->paginate(8);

        // dd();
        $image = Posts_images::with('posts')->get();

        // dd( $image);
        return view('dashboard.products.index', compact('categories', 'products'));
    } //end of index

    public function create()
    {
        //  $ingots = Ingots::get();
        //$coins= Coins::get();
        $ingots = [];
        $coins = [];
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories', 'ingots', 'coins'));
    } //end of create

    public function store(Request $request)
    {

        $rules = [
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ];


        $request->validate($rules);
        $request_data = $request->all();



        if ($request->image) {
            $img = Image::make($request->file('image')[0]);
            $img->resize(1758, 1050);

            /* Image::make($request->file('image')[0])
                        ->resize(1200, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })
                        ->save(public_path('uploads/product_images/' . $request->file('image')[0]->hashName()));*/
            $img->insert(public_path('web_files/images/mediacar-watermark.png'), 'bottom');
            $img->save(public_path('uploads/product_images/' . $request->file('image')[0]->hashName()));
            $data['default_image'] = $request->file('image')[0]->hashName();
        } //end of if



        $data['category_id'] = $request['category_id'];
        $data['title'] = $request['title'];
        $data['description'] = $request['description'];
        $data['description'] = $request['description'];
        $data['created_at'] =  date("Y-m-d");
        $data['default_vedios'] =  $request['vedios'][0];
        $post_id = posts::insertGetId($data);


        if ($request->hasfile('image')) {
            $imagename = array();

            foreach ($request->file('image') as $image) {
                $images = $image->hashName();
                $name = $image->getClientOriginalName();
                /*  Image::make($image)
                    ->resize(1200, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save(public_path('uploads/product_images/' .   $image->hashName()));*/
                $imgage = Image::make($image);
                $imgage->resize(1758, 1050);
                $imgage->insert(public_path('web_files/images/mediacar-watermark.png'), 'bottom');
                $imgage->save(public_path('uploads/product_images/' . $image->hashName()));
                array_push($imagename, $images);
            }
            for ($j = 0; $j < count($imagename); $j++) {
                $data['image'] =  $imagename[$j];


                ////////////////
                $data['posts_id'] = $post_id;

                Posts_images::create($data);
            }
        }
        for ($i = 0; $i < count($request['vedios']); $i++) {
            if ($request['vedios'][$i] != null) {
                $datavedio['vedios'] = $request['vedios'][$i];


                $datavedio['posts_id'] = $post_id;

                Posts_vedios::create($datavedio);
            }
        }



        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.products.index');
    } //end of store

    public function edit(posts $product)
    {
        //$ingots = Ingots::get();
        //$coins= Coins::get();
        $categories = Category::all();

        $images = Posts_images::where('posts_id', $product->id)->get();
        $vedios =  Posts_vedios::where('posts_id', $product->id)->get();


        return view('dashboard.products.edit', compact('categories', 'product', 'images', 'vedios'));
    } //end of edit

    public function update(Request $request, posts $product)
    {




        $rules = [
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ];



        $request->validate($rules);

        $request_data = $request->all();


        $data['category_id'] = $request['category_id'];
        $data['title'] = $request['title'];
        $data['description'] = $request['description'];
        $data['default_vedios'] =  $request['vedios'][0];
        $product->update($data);




        $Postss_images = Posts_images::where('posts_id', $product->id)->get();
        if ($request->hasfile('image')) {
            $imagename = array();
            // $imageid = array();



            foreach ($request->file('image') as $image) {
                $images = $image->hashName();
                $name = $image->getClientOriginalName();



                $imgage = Image::make($image);
                $imgage->resize(1758, 1050);
                $imgage->insert(public_path('web_files/images/mediacar-watermark.png'), 'bottom');
                $imgage->save(public_path('uploads/product_images/' . $image->hashName()));

                array_push($imagename, $images);
                //array_push($imageid, $images);
            }
            for ($j = 0; $j < count($imagename); $j++) {
                $dataimage['image'] =  $imagename[$j];
                $id =  $request->image_id[$j];
                ////////////////

                Posts_images::where('id', $id)->update($dataimage);
            }
        }

        if ($request->hasfile('image2')) {
            $imagename = array();

            foreach ($request->file('image2') as $image) {
                $images = $image->hashName();
                $name = $image->getClientOriginalName();

                $imgage = Image::make($image);
                $imgage->resize(1758, 1050);
                $imgage->insert(public_path('web_files/images/mediacar-watermark.png'), 'bottom');
                $imgage->save(public_path('uploads/product_images/' . $image->hashName()));
                array_push($imagename, $images);
            }
            for ($j = 0; $j < count($imagename); $j++) {
                $data['image'] =  $imagename[$j];


                ////////////////
                $data['posts_id'] = $product->id;

                Posts_images::create($data);
            }
        }


        $allpostsvedioss = Posts_vedios::where('posts_id', $product->id)->get();

        if ($request->vedios != null) {

            for ($i = 0; $i < count($request['vedios']); $i++) {
                if ($request['vedios'][$i] != null) {
                    $datavedio['vedios'] = $request['vedios'][$i];

                    $vid =  $request->vedio_id[$i];

                    $postsvedios = Posts_vedios::where('posts_id', $product->id)->first();


                    if (!empty($postsvedios)) {
                        if (count($allpostsvedioss) < count($request['vedios'])) {

                            $checkvedio = Posts_vedios::where(array('posts_id' => $product->id, 'vedios' => $request['vedios'][$i]))->get();
                            if (count($checkvedio) > 0) {
                                Posts_vedios::where('id',  $vid)->update($datavedio);
                            } else {
                                $datavedio['posts_id'] = $product->id;
                                Posts_vedios::create($datavedio);
                            }
                        } else {
                            Posts_vedios::where('id',  $vid)->update($datavedio);
                        }
                    } else {

                        $datavedio['posts_id'] = $product->id;

                        Posts_vedios::create($datavedio);
                    }
                }
            }
        }

        for ($i = 0; $i < count($request['vedios2']); $i++) {
            if ($request['vedios2'][$i] != null) {
                $datavedio['vedios'] = $request['vedios2'][$i];


                $datavedio['posts_id'] = $product->id;

                Posts_vedios::create($datavedio);
            }
        }



        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.products.index');
    } //end of update

    public function destroy(posts $product)
    {


        if ($product->image != 'default.png') {

            Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
        } //end of if

        $product->delete();
        Posts_images::where('posts_id', $product->id)->delete();
        Posts_vedios::where('posts_id', $product->id)->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.products.index');
    } //end of destroy



    public function getpostdetails(Request $request)
    {
        $post_id = $request->id;
        $images = Posts_images::where('posts_id', $post_id)->get();

        $vedios = Posts_vedios::where('posts_id', $post_id)->get();

        return view('dashboard.products.details', compact('images', 'vedios'));
    }
}//end of controller
