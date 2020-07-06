<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;

class TicketController extends Controller
{
    public function addTickets(Request $request)
    {
        $local_id = $request->input('local_id');
        $is_bought = 0;
        $price = $request->input('price');
        $hall_id = $request->input('hall_id');
        $event_id = $request->input('event_id');

        $data = [
            ['local_id' => $local_id,'is_bought' => $is_bought,'price' => $price,'event_id' => $event_id, 'hall_id' => $hall_id]
        ];

        $people = array(
            array('name' => 'Kalle', 'salt' => 856412),
            array('name' => 'Pierre', 'salt' => 215863)
        );

        for($i = 0, $size = count($people); $i < $size; ++$i) {
            $people[$i]['salt'] = mt_rand(000000, 999999);
        }

        $tickets = Ticket::create($data);
        $theater = Theater::find($hall_id);

        if ($theater === null) {
            return response()->json([
                'errors' => [
                    'type' => 'TheaterNotFound',
                    'message' => 'Театр с таким id не найден.'],
                'message' => 'В процессе добавления зала возникли ошибки.'
            ], 404);}
        else {
            return response()->json([
                'hall' => [
                    'id' => $hall->id],
                'message' => 'Зал успешно добавлен.'
            ], 201);
        }
    }
}
