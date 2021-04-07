<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Mainmenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');
        })->latest()->paginate(8);


      
       
        return view('dashboard.categories.index', compact('categories'));
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
        $rules = [
            'name' => 'required'
        ];

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
       
         $categories = Category::all();
        return view('dashboard.categories.showheader', compact('categories','allmunes'));
    } //end of edit

    public function mainmenu(Request $request)
    {
        $allmunes=Mainmenu::all();
     
        if(count( $allmunes) <8){
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

}//end of controller
