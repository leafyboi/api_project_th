<?php

namespace App\Http\Controllers;

use App\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SeatsController extends Controller
{
    public function addSeats(Request $request) // api/seats?count=10
    {
        $count = $request->input('count');
        $name = $request->input('name');

        $seats = [];
        for($i=1; $i <= $count; $i++) {

            $dataInput = [
                'local_id' => $i,
                'name' => $name,
            ];

            $data = Seat::create($dataInput);

            // $result = Arr::prepend($seats, [$i=>$data]); // Успешно
        }

            return response()->json([
                Seat::orderBy('id', 'desc')->limit($count)->get()

        ]);

    }
}
