<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BookedDirectSale;

class posts extends Model
{

    protected $fillable = ['category_id', 'title','description','slideshow','default_image','default_vedios','checked','vediochecked','impchecked'];


    public function category()
    {
        return $this->belongsTo(Category::class)->with('CategoryTranslation');

    }//end fo category


    public function Slideshow()
    {
        return $this->hasMany(Slideshow::class,'posts_id','id');

    }//end of Mainmenu



    public function ImportantShow()
    {
        return $this->hasMany(ImportantShow::class,'posts_id','id');

    }//end of Mainmenu


    public function VedioSlider()
    {
        return $this->hasMany(VedioSlider::class,'posts_id','id');

    }//end of Mainmenu

    public function Posts_images()
    {
        return $this->hasMany(Posts_images::class);

    }

    public function Posts_vedios()
    {
        return $this->hasMany(Posts_vedios::class);

    }
    public function Postscomments()
    {
        return $this->hasMany(Postscomments::class);

    }


}
