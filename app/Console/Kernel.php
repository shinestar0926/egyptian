<?php

namespace App\Console;
use Carbon\Carbon;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Web\ProfileController;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        
    
     $schedule->call(function () {
            DB::table('user_shoping_carts')->where('created_at','<=', date("Y-m-d H:i:s", strtotime("-2 hours")))->delete();
        })->everyMinute();

        $schedule->call(function () {
            DB::table('virtual_details')->delete();
        })->everyMinute();

       

       ///////dedect point every month/////////
        $schedule->call('App\Http\Controllers\Web\ProfileController@dedectpointsmonthly')->monthly();


        
    // to run -> php artisan schedule:run

       /* $schedule->call(function () {
            $date  = Carbon::now()->subMinutes( 120 );
            DB::table('user_shoping_carts')->whereRaw('created_at', '<=', $date)->delete();
        })->everyMinute();*/
       
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
