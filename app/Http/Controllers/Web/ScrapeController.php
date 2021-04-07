<?php
namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goutte\Client;

class ScrapeController extends Controller
{

    private $states = [];


    public function gold_price(Request $request){
/////add .2% of price

        $client = new Client();
      //  $page = $client->request('GET', 'https://www.xe.com/currencytables/?from=XAU&date=2020-12-29');
      $page = $client->request('GET', 'http://goldpricez.com/eg/gram');
     
      $total=$page->filter('.display_rates')->text();
      $percentage = .2;
    $coldeprice = substr($total,27);
    $new_total = ($percentage / 100) * $coldeprice;
    $last_total=$coldeprice + $new_total;
      $request->session()->put('price',$last_total );
      echo $last_total;

       }

       public function gold_us_price(Request $request){


        $client = new Client();
             ////////us
      $page_us = $client->request('GET', 'http://goldpricez.com/us/gram');
      $total_us=$page_us->filter('.display_rates')->text();
      $coldeprice_us = substr($total_us,29);
      $percentage = .2;
      $new_total_us = ($percentage / 100) * $coldeprice_us;
      $last_total_us=$coldeprice_us + $new_total_us;
      $request->session()->put('price_us',$last_total_us );

      echo $last_total_us;

       }
       
}

