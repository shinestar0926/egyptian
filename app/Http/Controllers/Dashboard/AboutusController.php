<?php

namespace App\Http\Controllers\Dashboard;

use App\AboutUs;
use App\ContactsEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AboutusController extends Controller
{
    public function index(Request $request)
    {
        $categories = AboutUs::when($request->search, function ($q) use ($request) {

            return $q->where('about_us', 'like', '%' . $request->search . '%');
        })->latest()->paginate(8);



        return view('dashboard.about_us.index', compact('categories'));
    } //end of index





    public function create()
    {
        return view('dashboard.about_us.create');
    } //end of create




    public function store(Request $request)
    {
        $rules = [
            'about_us' => 'required',
            'our_team' => 'required',
        ];
        $request->validate($rules);

        $data = $request->all();


        //aboutus image
        if ($request->about_us_image) {

            Image::make($request->about_us_image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/about_us/' . $request->about_us_image->hashName()));

            $data['about_us_image'] = $request->about_us_image->hashName();
        } //end of aboutus image

        //our_team_image1
        if ($request->our_team_image1) {

            Image::make($request->our_team_image1)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/about_us/' . $request->our_team_image1->hashName()));

            $data['our_team_image1'] = $request->our_team_image1->hashName();
        } //end of our_team_image1

        //our_team_image2
        if ($request->our_team_image2) {

            Image::make($request->our_team_image2)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/about_us/' . $request->our_team_image2->hashName()));

            $data['our_team_image2'] = $request->our_team_image2->hashName();
        } //end of our_team_image2

        //our_team_image3
        if ($request->our_team_image3) {

            Image::make($request->our_team_image3)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/about_us/' . $request->our_team_image3->hashName()));

            $data['our_team_image3'] = $request->our_team_image3->hashName();
        } //end of our_team_image3

        //our_team_image4
        if ($request->our_team_image4) {

            Image::make($request->our_team_image4)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/about_us/' . $request->our_team_image4->hashName()));

            $data['our_team_image4'] = $request->our_team_image4->hashName();
        } //end of our_team_image4

        //our_team_image1
        if ($request->our_team_image1) {

            Image::make($request->our_team_image1)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/about_us/' . $request->our_team_image1->hashName()));

            $data['our_team_image1'] = $request->our_team_image1->hashName();
        } //end of our_team_image1

        //our_team_image2
        if ($request->our_team_image2) {

            Image::make($request->our_team_image2)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/about_us/' . $request->our_team_image2->hashName()));

            $data['our_team_image2'] = $request->our_team_image2->hashName();
        } //end of our_team_image2

        //our_team_image3
        if ($request->our_team_image3) {

            Image::make($request->our_team_image3)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/about_us/' . $request->our_team_image3->hashName()));

            $data['our_team_image3'] = $request->our_team_image3->hashName();
        } //end of our_team_image3

        //our_team_image4
        if ($request->our_team_image4) {

            Image::make($request->our_team_image4)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/about_us/' . $request->our_team_image4->hashName()));

            $data['our_team_image4'] = $request->our_team_image4->hashName();
        } //end of our_team_image4






        //partners1_image1
        if ($request->partners1) {

            Image::make($request->partners1)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/about_us/' . $request->partners1->hashName()));

            $data['partners1'] = $request->partners1->hashName();
        } //end of partners1

        //partners2
        if ($request->partners2) {

            Image::make($request->partners2)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/about_us/' . $request->partners2->hashName()));

            $data['partners2'] = $request->partners2->hashName();
        } //end of partners2

        //partners3
        if ($request->partners3) {

            Image::make($request->partners3)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/about_us/' . $request->partners3->hashName()));

            $data['partners3'] = $request->partners3->hashName();
        } //end of partners3

        //partners4
        if ($request->partners4) {

            Image::make($request->partners4)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/about_us/' . $request->partners4->hashName()));

            $data['partners4'] = $request->partners4->hashName();
        } //end of our_team_image4





        AboutUs::create($data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.aboutus.index');
    } //end of store

    public function edit($id)
    {
        $category = ContactsEmail::where('id', $id)->first();

        return view('dashboard.contacts_info.edit', compact('category'));
    } //end of edit

    public function update(Request $request, $id)
    {
        $rules = [
            'mobile' => 'required|numeric',
            'email' => 'required',
            'password' => 'required',
        ];
        $request->validate($rules);


        $data['mobile'] = $request->mobile;
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        ContactsEmail::where('id', $id)->update($data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.contacts_info.index');
    } //end of update

    public function destroy($id)
    {
        AboutUs::where('id', $id)->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.aboutus.index');
    } //end of destroy

}//end of controller
