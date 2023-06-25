<?php

namespace App\Repositories\AdminRepositories;

use App\Models\Reserve;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\AdminInterfaces\ReservationRepositoryInterface;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function getTotalReservation()
    {
        $totalReservation = Reserve::count();
        $totalProfit = Reserve::all()->sum('price');

        return response([
            'totalReservation' => $totalReservation,
            'totalProfit' => $totalProfit
        ],200);
    }

    public function testCase()
    {
        // switch($dayOfWeek)
        // {
        //     case 'Sunday':

                // $data = DB::table('reserves')
                //             ->whereRaw('DAYOFWEEK(created_at) = 1')
                //             ->get();
                
        //         return response([
        //             'data' => $data
        //         ],200);
            
        //     case 'Monday':

        //         $data = DB::table('reserves')
        //                     ->whereRaw('DAYOFWEEK(created_at) = 2')
        //                     ->get();
                
        //         return response([
        //             'data' => $data
        //         ],200);

        //     case 'Tuesday':

        //         $data = DB::table('reserves')
        //                     ->whereRaw('DAYOFWEEK(created_at) = 3')
        //                     ->get();
                
        //         return response([
        //             'data' => $data
        //         ],200);

        //     case 'Wednesday':

        //         $data = DB::table('reserves')
        //                     ->whereRaw('DAYOFWEEK(created_at) = 4')
        //                     ->get();
                
        //         return response([
        //             'data' => $data
        //         ],200);

        //     case 'Thursday':

        //         $data = DB::table('reserves')
        //                     ->whereRaw('DAYOFWEEK(created_at) = 5')
        //                     ->get();
                
        //         return response([
        //             'data' => $data
        //         ],200);

        //     case 'Friday':

        //         $data = DB::table('reserves')
        //                     ->whereRaw('DAYOFWEEK(created_at) = 6')
        //                     ->get();
                
        //         return response([
        //             'data' => $data
        //         ],200);

        //     case 'Saturday':

        //         $data = DB::table('reserves')
        //                     ->whereRaw('DAYOFWEEK(created_at) = 7')
        //                     ->get();
                
        //         return response([
        //             'data' => $data
        //         ],200);
        // }

        $sundayDataCount = DB::table('reserves')
                        ->whereRaw("day_of_week = 'Sunday'")
                        ->count();
        
        $mondayDataCount = DB::table('reserves')
                        ->whereRaw("day_of_week = 'Monday'")
                        ->count();

        $tuesdayDataCount = DB::table('reserves')
                        ->whereRaw("day_of_week = 'Tuesday'")
                        ->count();

        $wednesdayDataCount = DB::table('reserves')
                        ->whereRaw("day_of_week = 'Wednesday'")
                        ->count();

        $thursdayDataCount = DB::table('reserves')
                        ->whereRaw("day_of_week = 'Thursday'")
                        ->count();

        $fridayDataCount = DB::table('reserves')
                        ->whereRaw("day_of_week = 'Friday'")
                        ->count();

        $saturdayDataCount = DB::table('reserves')
                        ->whereRaw("day_of_week = 'Saturday'")
                        ->count();
        
        return response([
            'sundayCount' => $sundayDataCount,
            'mondayCount' => $mondayDataCount,
            'tuesdayCount' => $tuesdayDataCount,
            'wednesdayCount' => $wednesdayDataCount,
            'thursdayCount' => $thursdayDataCount,
            'fridayCount' => $fridayDataCount,
            'saturdayCount' => $saturdayDataCount
        ],200);
    }
}

?>