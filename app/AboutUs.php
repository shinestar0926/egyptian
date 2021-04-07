<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $fillable = [
        'about_us','about_us_image','our_team','our_team_image1','our_team_image2','our_team_image3','our_team_image4','partners1','partners2','partners3','partners4'
    ];
}
