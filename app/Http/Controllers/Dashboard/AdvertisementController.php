<?php

namespace App\Http\Controllers\Dashboard;



use App\Advertise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
       
        $advertises = Advertise::when($request->search, function ($q) use ($request) {

            return $q->where('title', 'like', '%' . $request->search . '%')
           
            ->orWhere('description', 'like', '%' . $request->search . '%');
        })->latest()->paginate(8);


       
        return view('dashboard.advertise.index', compact('advertises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.advertise.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            //'title' => 'required',
           // 'description' => 'required',
        ];
        $request->validate($rules);
        $request_data = $request->all();
        if ($request->image) {

           /* Image::make($request->file('image'))
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/advertise_images/' . $request->file('image')->hashName()));*/
                $img = Image::make($request->file('image'));  
                //$img->resize(435, 882);
                $img->insert(public_path('web_files/images/mediacar-watermark.png'),'bottom'); 
                $img->save(public_path('uploads/advertise_images/' . $request->file('image')->hashName()));

            $data['image'] = $request->file('image')->hashName();
        } //end of if
        $data['title']=$request->title;
        $data['description']=$request->description;
        Advertise::insertGetId($data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.advertisement.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      

        $advertise=Advertise::where('id',$id)->first();

    
        return view('dashboard.advertise.edit', compact('advertise'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        $request->validate($rules);
        $request_data = $request->all();
        if ($request->image) {

            Image::make($request->file('image'))
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/advertise_images/' . $request->file('image')->hashName()));

            $data['image'] = $request->file('image')->hashName();
        } //end of if
        $data['title']=$request->title;
        $data['description']=$request->description;
        Advertise::where('id',$id)->update($data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.advertisement.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Advertise::where('id',$id)->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.advertisement.index');
    }
}
