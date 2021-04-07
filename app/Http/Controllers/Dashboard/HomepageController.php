<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Mainmenu;
use App\Slideshow;
use App\ImportantShow;
 use App\VedioSlider;
use App\Product;
use App\posts;
use App\Posts_images;
use App\Posts_vedios;
 use App\Importantselectionposts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        $allmunes=Mainmenu::with('category')->get();
       
         $categories = Category::all();


      
         $importantposts=Importantselectionposts::with('category')->get();
        return view('dashboard.homepage.index', compact('categories','allmunes','importantposts'));
    } //end of index

    public function create()
    {
        return view('dashboard.categories.create');
    } //end of create

    public function store(Request $request)
    {
        //$rules = [];

        /* foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')]];
        } //end of for each*/
        $rules = [
            'name' => 'required'
        ];
        $request->validate($rules);

        Category::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.categories.index');
    } //end of store

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    } //end of edit

    public function update(Request $request, Category $category)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')]];
        } //end of for each

        $request->validate($rules);

        $category->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.categories.index');
    } //end of update

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.categories.index');
    } //end of destroy









    ///////////////////show header 
    public function showheader()
    {
        $allmunes=Mainmenu::with('category')->get();
        $importantposts=Importantselectionposts::with('category')->get();
       
         $categories = Category::all();
        return view('dashboard.categories.showheader', compact('categories','allmunes','importantposts'));
    } //end of edit

    public function mainmenu(Request $request)
    {
        $allmunes=Mainmenu::all();
    
        if(count( $allmunes) <1){
          ////////////add check/////////////////
        if ($request['ids'] > 0) {
            for ($j = 0; $j < count($request['ids']); $j++) {
                $allmunes=Mainmenu::where('categories_id',$request['ids'][$j]  )->get();
               if(count($allmunes)>0){
                }else{
                    $data['categories_id'] = $request['ids'][$j];
                    $data['created_at'] = date('Y-m-d H:i:s');
                    Mainmenu::create($data);
                    $data2['checked']="checked";
                    Category::where('id',$request['ids'][$j])->update($data2);
                }
            }
        }
    }else{
        echo 'error';
        }
        ////////////remove check/////////////////
           if ($request['unchecked'] > 0) {
                for ($i = 0; $i < count($request['unchecked']); $i++) {
                    $allmuness=Mainmenu::where('categories_id',$request['unchecked'][$i]  )->get();
                    if(count($allmuness) >0){ 
                        $data2['checked']="";
                        Category::where('id',$request['unchecked'][$i])->update($data2);
                    Mainmenu::where('categories_id',$request['unchecked'][$i])->delete();
                    }
                }
            }
       
     
    }

   

    public function get_postsbycategories(Request $request)
    {     
        $posts = posts::all();
        $products = posts::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('name', '%' . $request->search . '%');
        })->when($request->id, function ($q) use ($request) {

            return $q->where('category_id', $request->id);
        })->latest()->paginate(1000);
       

     
       return view('dashboard.homepage.loadposts', compact('posts', 'products'));
    }


    public function slideshow(Request $request)
    {

        $allmunes=Slideshow::all();
    
        if(count( $allmunes) <5){
          ////////////add check/////////////////
        if ($request['ids'] > 0) {
            for ($j = 0; $j < count($request['ids']); $j++) {
                $allmunes=Slideshow::where('posts_id',$request['ids'][$j]  )->get();
               if(count($allmunes)>0){
                }else{
                    $data['posts_id'] = $request['ids'][$j];
                    $data['created_at'] = date('Y-m-d H:i:s');
                    echo $data['posts_id'];
                    Slideshow::insertGetId($data);
                    $data2['checked']="checked";
                    posts::where('id',$request['ids'][$j])->update($data2);
                }
            }
        }

      
    }else{
        echo 'error';
        }
        ////////////remove check/////////////////
           if ($request['unchecked'] > 0) {
               
                for ($i = 0; $i < count($request['unchecked']); $i++) {
                    $allmuness=Slideshow::where('posts_id',$request['unchecked'][$i]  )->get();
                //dd($allmuness);
                    if(count($allmuness) >0){ 
                        $data2['checked']="";
                       posts::where('id',$request['unchecked'][$i])->update($data2);
                       Slideshow::where('posts_id',$request['unchecked'][$i])->delete();
                    }
                }
            }
        
     
    }
//////////////////////////////

    public function vediosdata(Request $request)
    {     
        $posts = posts::all();
        $products = posts::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('name', '%' . $request->search . '%');
        })->when($request->id, function ($q) use ($request) {

            return $q->where('category_id', $request->id);
        })->latest()->paginate(10000);

      //  dd($products );
       return view('dashboard.homepage.loadvedios', compact('posts', 'products'));
    }

    public function vedioshow(Request $request)
    {
        $allmunes=VedioSlider::all();
  
        if(count( $allmunes) <5){
       
          ////////////add check/////////////////
        if ($request['ids'] > 0) {
            for ($j = 0; $j < count($request['ids']); $j++) {
                $allmunes=VedioSlider::where('posts_id',$request['ids'][$j]  )->get();
               if(count($allmunes)>0){
                }else{
                    $data['posts_id'] = $request['ids'][$j];
                    $data['created_at'] = date('Y-m-d H:i:s');
                    VedioSlider::create($data);
                    $data2['vediochecked']="checked";
                    posts::where('id',$request['ids'][$j])->update($data2);
                }
            }
        }

    }else{
        echo 'error';
        }

        ////////////remove check/////////////////
           if ($request['unchecked'] > 0) {
               
                for ($i = 0; $i < count($request['unchecked']); $i++) {
                    $allmuness=VedioSlider::where('posts_id',$request['unchecked'][$i]  )->get();
                //dd($allmuness);
                    if(count($allmuness) >0){ 
                        $data2['vediochecked']="";
                       posts::where('id',$request['unchecked'][$i])->update($data2);
                       VedioSlider::where('posts_id',$request['unchecked'][$i])->delete();
                    }
                }
            }
       
    }

    public function importantposts(Request $request)
    {     
        $posts = posts::all();
        $products = posts::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('name', '%' . $request->search . '%');
        })->when($request->id, function ($q) use ($request) {

            return $q->where('category_id', $request->id);
        })->latest()->paginate(1000);

       return view('dashboard.homepage.loadimportantposts', compact('posts', 'products'));
    }


    
    public function importantshow(Request $request)
    {

        $allmunes=ImportantShow::all();
  
        if(count( $allmunes) <3){
          ////////////add check/////////////////
        if ($request['ids'] > 0) {
            for ($j = 0; $j < count($request['ids']); $j++) {
                $allmunes=ImportantShow::where('posts_id',$request['ids'][$j]  )->get();
               if(count($allmunes)>0){
                }else{
                    $data['posts_id'] = $request['ids'][$j];
                    $data['created_at'] = date('Y-m-d H:i:s');
                    ImportantShow::create($data);
                    $data2['impchecked']="checked";
                    posts::where('id',$request['ids'][$j])->update($data2);
                }
            }
        }

    }else{
        echo 'error';
        }
        ////////////remove check/////////////////
           if ($request['unchecked'] > 0) {
               
                for ($i = 0; $i < count($request['unchecked']); $i++) {
                    $allmuness=ImportantShow::where('posts_id',$request['unchecked'][$i]  )->get();
                //dd($allmuness);
                    if(count($allmuness) >0){ 
                        $data2['impchecked']="";
                       posts::where('id',$request['unchecked'][$i])->update($data2);
                       ImportantShow::where('posts_id',$request['unchecked'][$i])->delete();
                    }
                }
            }

        
     
    }
/////////////////////important selected category

    public function selectedcat(Request $request)
    {

        $allmunes=Importantselectionposts::all();
  
        if(count( $allmunes) <2){
          ////////////add check/////////////////
        if ($request['ids'] > 0) {
            for ($j = 0; $j < count($request['ids']); $j++) {
                $allmunes=Importantselectionposts::where('categories_id',$request['ids'][$j]  )->get();
               if(count($allmunes)>0){
                }else{
                    $data['categories_id'] = $request['ids'][$j];
                    $data['created_at'] = date('Y-m-d H:i:s');
                    Importantselectionposts::create($data);
                    $data2['importantchecked']="checked";
                    Category::where('id',$request['ids'][$j])->update($data2);
                }
            }
        }
    }else{
        echo 'error';
        }
        ////////////remove check/////////////////
           if ($request['unchecked'] > 0) {
                for ($i = 0; $i < count($request['unchecked']); $i++) {
                    $allmuness=Importantselectionposts::where('categories_id',$request['unchecked'][$i]  )->get();
                    if(count($allmuness) >0){ 
                        $data2['importantchecked']="";
                        Category::where('id',$request['unchecked'][$i])->update($data2);
                        Importantselectionposts::where('categories_id',$request['unchecked'][$i])->delete();
                    }
                }
            }

       
     
    }











}//end of controller
