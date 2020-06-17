<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    public function addEvent(Request $request, $spectacle_id, $hall_id)
    {
        $dated_at = $request->input('dated_at');
        $name = $request->input('name');
        $description = $request->input('description');
        $is_premiere = $request->input('is_premiere');
        $is_chosen_for_main_page = $request->input('is_chosen_for_main_page');
        $available_seats_number = $request->input('available_seats_number');

        $data = array(
            'dated_at' => $dated_at,
            'name' => $name,
            'description' => $description,
            'is_premiere' => $is_premiere,
            'is_chosen_for_main_page' => $is_chosen_for_main_page,
            'available_seats_number' => $available_seats_number,
            'spectacle_id' => $spectacle_id,
            'hall_id' => $hall_id
        );

        $event = Event::create($data);

        if ($event) {
            return response()->json([
                'errors' => array(),
                'event' => [
                    'id' => $event->id,
                ],
                'message' => 'Событие успешно добавлено.'
            ], 201);
        } else if ($spectacle_id == null) {
            return response()->json([
                'errors' => 'sd',
                'message' => 'В процессе добавления события возникли ошибки.'
            ], 400);
        } else if ($hall_id == null) {
            return response()->json([
                'er' => 'sd'
            ],400);
        }
    }
    public function getEvents($name, $date_range_start, $date_range_end)
    {
        {
            $events = Event::where('name', 'like', '%' .$name. '%')
                ->whereBetween('dated_at', [$date_range_start, $date_range_end])
                ->with('spectacle')
                ->with('hall')
                ->get();

            if($events){
            return response()->json([
                'events' => $events
            ], 200);
            }
        }
    }

    public function getEvent($event_id)
    {
        $event = Event::find($event_id);

        if ($event) {
            return response()->json([
                'has_errors' => false,
                'errors' => array(),
                'theater' => [
                    'attributes' => $event
                ]
            ], 200);
        } else {
            return response()->json([
                'has_errors' => true,
                'errors' => [
                    'type' => 'TheaterNotFound',
                    'message' => 'Театр с таким ID не найден.'],
                'message' => 'В процессе получения информации о театре возникли ошибки'
            ], 404);
        }
    }

    public function deleteEvent($event_id)
    {
        $event = Event::find($event_id);

        if ($event) {
            $event->delete();

            return response()->json([
                'has_errors' => true,
                'errors' => array(),
                'message' => 'Событие успешно удалено.'
            ], 204);
        } else {
            return response()->json([
                'type' => 'EventNotFound',
                'message' => 'Событие с таким id не найдено.'
            ], 404);
        }
    }

    public function updateSpectacle(Request $request, $event_id)
    {
        $event = Event::find($event_id)->first();

        if ($event) {
            $event->name = $request->input('name');
            $event->description = $request->input('description');
            $event->address = $request->input('address');
            $event->logo = $request->input('logo');
            $event->preview = $request->input('preview');
            $event->cash_desk_phone_number = $request->input('cash_desk_phone_number');
            $event->phone_number_for_reference = $request->input('phone_number_for_reference');
            $event->save();

            return response()->json([
                'errors' => array(),
                'message' => 'Театр успешно обновлен.'
            ],201);
        } else {
            return response()->json([
                'errors' => [
                    'type' => 'TheaterNotFound',
                    'message' => 'Театр с таким id не найден.'],
                'message' => 'В процессе обновления информации о театре возникли ошибки.'],404);
        }
    }
}
