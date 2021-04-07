<?php

namespace App\Http\Controllers\Web;

use App\Category;
use App\Mainmenu;
use App\User;
use App\posts;
use App\Slideshow;
use App\ImportantShow;
use App\Posts_images;
use App\Posts_vedios;
use App\VedioSlider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use App\Advertise;
use App\AboutUs;
use App\Postscomments;
use App\Replaycomments;
use App\Cart;
use Carbon\Carbon;
use App\Archives;
use App\Alerts;
use App\UserShopingCart;
use App\Importantselectionposts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Scheduling\Schedule;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {


        $allmunes = Mainmenu::with('category')->with('CategoryTranslation')->get();
        $allmunesids = array();
        foreach ($allmunes as $row) {
            array_push($allmunesids, $row->categories_id);
        }
        $categories = Category::with('CategoryTranslation')->whereNotIn('id', $allmunesids)->get();

        $posts = posts::with('category')->get();
        $slideshows = Slideshow::with('posts')->take(5)->get();
        $importantposts = ImportantShow::with('posts')->take(3)->get();
        $latestposts = posts::with('category')->orderBy('id', 'DESC')->paginate(8);
        $vedioSlider= VedioSlider::with('posts')->take(5)->get();
        $importantselectcategory=Importantselectionposts::with('category')->take(2)->get();
        $Archives=Archives::orderBy('id', 'DESC')->take(1)->first();
        
        $Advertises=Advertise::orderBy('id', 'DESC')->take(1)->first();
        //dd($vedioSlider);
      //  dd($latestposts);
        return view('web.welcome', compact('allmunes', 'categories','slideshows','importantposts','latestposts','vedioSlider','importantselectcategory','Archives','Advertises'));
    } //end of index


    public function details($id)
    {
    
        $allmunes = Mainmenu::with('category')->with('CategoryTranslation')->get();
        $allmunesids = array();
        foreach ($allmunes as $row) {
            array_push($allmunesids, $row->categories_id);
        }
        $categories = Category::with('CategoryTranslation')->whereNotIn('id', $allmunesids)->get();;


        $posts = posts::where('id',$id)->with('category')->first();
       
        $samecategories =posts::where('category_id', $posts->category_id)->with('category')->get();
        $images=Posts_images::where('posts_id',$id)->get();
        $archives=Archives::all();
        $Archives=Archives::orderBy('id', 'DESC')->take(1)->first();
        $comments=Postscomments::where('approve',1)->where('posts_id',$id)->with('posts')->with('Client')->with('Replaycomments')->orderBy('id', 'ASC')->get();
        $replaies = array();
        foreach($comments as $comment){
            $replaycomments=Replaycomments::where('postscomments_id',$comment->id)->where('approve',1)->with('Postscomments')->with('Client')->orderBy('id', 'ASC')->get();
            array_push($replaies,$replaycomments);
        }
   
        $vidioes=Posts_vedios::where('posts_id',$id)->get();
        $Advertises=Advertise::orderBy('id', 'DESC')->take(1)->first();
      //  dd($vidioes);
        return view('web.products.productsdetails', compact('replaies','allmunes', 'categories','posts','images','samecategories','archives','Archives','comments','Advertises','vidioes'));
    }


    public function about_us(Request $request)
    {
        $allmunes = Mainmenu::with('category')->with('CategoryTranslation')->get();
        $allmunesids = array();
        foreach ($allmunes as $row) {
            array_push($allmunesids, $row->categories_id);
        }
        $categories = Category::with('CategoryTranslation')->whereNotIn('id', $allmunesids)->get();;

        $posts = posts::with('category')->get();
        $slideshows = Slideshow::with('posts')->take(5)->get();
        $importantposts = ImportantShow::with('posts')->take(3)->get();
        $latestposts = posts::with('category')->take(8)->get();

        $archives=Archives::all();
          $Archives=Archives::orderBy('id', 'DESC')->take(1)->first();
         
        return view('web.about_us', compact('allmunes', 'allmunesids', 'categories', 'posts', 'slideshows','importantposts','latestposts','archives','Archives'));
    } //






    public function categoriesflater($id)
    {

     
        $slideshows = Slideshow::with('posts')->take(5)->get();
       

        $allmunes = Mainmenu::with('category')->with('CategoryTranslation')->get();
        $allmunesids = array();
        foreach ($allmunes as $row) {
            array_push($allmunesids, $row->categories_id);
        }
        $categories = Category::with('CategoryTranslation')->whereNotIn('id', $allmunesids)->get();;



        $latestposts = posts::where('category_id',$id)->with('category')->get();
        $posts = posts::where('category_id',$id)->with('category')->first();
        $cate = Category::where('id',$id)->with('CategoryTranslation')->first();
        $images=Posts_images::where('posts_id',$id)->get();
        $allcategories = Category::with('CategoryTranslation')->get();
      $Advertises=Advertise::orderBy('id', 'DESC')->take(1)->first();
      $Archives=Archives::orderBy('id', 'DESC')->take(1)->first();
        return view('web.products.productscategories', compact('cate','allmunes', 'Archives','categories','posts','images','slideshows','latestposts','allcategories','Advertises'));
    }









    public function archives()
    {

     
        $slideshows = Slideshow::with('posts')->take(5)->get();
       

        $allmunes = Mainmenu::with('category')->with('CategoryTranslation')->get();
        $allmunesids = array();
        foreach ($allmunes as $row) {
            array_push($allmunesids, $row->categories_id);
        }
        $categories = Category::with('CategoryTranslation')->whereNotIn('id', $allmunesids)->get();
        $allcategories = Category::with('CategoryTranslation')->get();
        $archives=Archives::all();
        return view('web.archives', compact('allmunes', 'categories','slideshows','allcategories','archives'));
    }




    public function savecomment(Request $request)
    {
        $data['posts_id']=$request->post_id;
        $data['clients_id']=$request->clients_id;
        $data['comment']=$request->comment;
        Postscomments::create($data);
    }
    public function replaycomment(Request $request)
    {

   
        $data['postscomments_id']=$request->comment_id;
        $data['replaytext']=$request->replaytext;
        $data['clients_id']=$request->clients_id;
        Replaycomments::create($data);
    }
    




    public function archivesdetails($id)
    {
    
    
        $allmunes = Mainmenu::with('category')->with('CategoryTranslation')->get();
        $allmunesids = array();
        foreach ($allmunes as $row) {
            array_push($allmunesids, $row->categories_id);
        }
        $categories = Category::with('CategoryTranslation')->whereNotIn('id', $allmunesids)->get();;


        $Archives=Archives::orderBy('id', 'DESC')->take(1)->first();
   
        $archives_details=Archives::where('id',$id)->first();
   
       // dd($archives_details);
        return view('web.archivesdetails', compact('archives_details','allmunes', 'categories','Archives'));
    }



    public function Alerts(Request $request)
    {

   
     

        $data['email']=$request->email;
        Alerts::create($data);
    }







}//end of controller
