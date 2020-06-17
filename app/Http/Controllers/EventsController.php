<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventsController extends Controller
{
    public function addEvent(Request $request)
    {
        $dated_at = $request->input('dated_at');
        $name = $request->input('name');
        $description = $request->input('description');
        $is_premiere = $request->input('is_premiere');
        $is_chosen_for_main_page = $request->input('is_chosen_for_main_page');
        $available_seats_number = $request->input('available_seats_number');
        $duration = $request->input('duration');
        $age = $request->input('age');
        $price = $request->input('price');
        $genre = $request->input('genre');
        $theater_id = $request->input('theater_id');
        $spectacle_id = $request->input('spectacle_id');
        $hall_id = $request->input('hall_id');

        $data = array(
            'dated_at' => $dated_at,
            'name' => $name,
            'description' => $description,
            'is_premiere' => $is_premiere,
            'is_chosen_for_main_page' => $is_chosen_for_main_page,
            'available_seats_number' => $available_seats_number,
            'theater_id' => $theater_id,
            'spectacle_id' => $spectacle_id,
            'hall_id' => $hall_id,
            'duration' => $duration,
            'age' => $age,
            'price' => $price,
            'genre' => $genre
        );

        $event = Event::create($data);
        $spectacle = Spectacle::find($spectacle_id);
        $hall = Hall::find($hall_id);

        if ($spectacle === null & $hall === null) {
            return response()->json([
                'errors' =>
                [
                    'type' => 'HallNotFound',
                    'message' => 'Зал с таким id не найден.'],
                [
                    'type' => 'SpectacleNotFound',
                    'message' => 'Спектакль с таким id не найден.'
                ],
                'message' => 'В процессе события возникли ошибки.'
                ], 404);}
        else if ($spectacle == null) {
            return response()->json([
                'errors' => [
                    'type' => 'SpectacleNotFound',
                    'message' => 'Спектакль с таким id не найден.'
                ],
            ], 404);}
        else if ($hall == null) {
            return response()->json([
                'errors' => [
                    'type' => 'HallNotFound',
                    'message' => 'Зал с таким id не найден.'
                ],
            ], 404);
        }
        else  {
            return response()->json([
                'event' => [
                    'id' => $event->id,
                ],
                'message' => 'Событие успешно добавлено.'
            ], 201);
        }
    }
  /*  public function getEventss($name, $date_range_start, $date_range_end, $genre, $event_age_start, $event_age_end, $event_price_start, $event_price_end, $event_duration_start, $event_duration_end)
    {
        $events = Event::where('name', 'like', '%' .$name. '%')
            ->whereBetween('dated_at', [$date_range_start." 00:00:00", $date_range_end." 23:59:59"])
            ->where('genre', '=', $genre)
            ->whereBetween('age', [$event_age_start, $event_age_end])
            ->whereBetween('price', [$event_price_start, $event_price_end])
            ->whereBetween('duration', [$event_duration_start, $event_duration_end])
            ->with('spectacle')
            ->with('theater')
            ->get();

        if($events){
            return response()->json([
                'events' => $events
            ], 200);
        }
    } */

    public function getEvents(Request $request) // $name, $date_range_start, $date_range_end
    {
        $name = $request->input('name');
        $date_range_start = $request->input('date_from');
        $date_range_end = $request->input('date_to');
        $genre = $request->input('genre');
        $theater = $request->input('theater');
        $age_start = $request->input('age_from');
        $age_end = $request->input('age_to');
        $price_start = $request->input('price_from');
        $price_end = $request->input('price_to');
        $duration_start = $request->input('duration_from');
        $duration_end = $request->input('duration_to');

        $events = Event::where('name', 'like', '%' .$name. '%')
            ->whereBetween('dated_at', [$date_range_start." 00:00:00", $date_range_end." 23:59:59"])
            ->where('genre', 'like', '%' .$genre. '%')
            ->where('theater', '=', $theater)
            ->whereBetween('age', [$age_start, $age_end])
            ->whereBetween('price', [$price_start, $price_end])
            ->whereBetween('duration', [$duration_start, $duration_end])
            ->with('spectacle')
            ->with('theater')
            ->get();

            return response()->json([
                'events' => $events
            ], 200);
    }

    public function getEvent(Request $request)
    {
        $event_id = $request->input('id');
        $event = Event::find($event_id);

        if ($event === null) {
            return response()->json([
                'errors' => [
                    'type' => 'EventNotFound',
                    'message' => 'Событие с таким ID не найдено.'],
                'message' => 'В процессе получения информации о событии возникли ошибки'], 404);}
        else {
            return response()->json([
                'event' => $event
            ], 200);
        }
    }

    public function deleteEvent(Request $request)
    {
        $event_id = $request->input('id');
        $event = Event::find($event_id);

        if ($event === null) {
            return response()->json([
                'type' => 'EventNotFound',
                'message' => 'Событие с таким id не найдено.'
            ], 404);
        } else {
            $event->delete();

            return response()->json([
                'message' => 'Событие успешно удалено.'
            ], 204);
        }
    }

    public function updateEvent(Request $request)
    {
        $event_id = $request->input('id');
        $event = Event::find($event_id);

        if ($event === null) {
            return response()->json([
                'errors' => [
                    'type' => 'EventNotFound',
                    'message' => 'Событие с таким id не найдено.'],
                'message' => 'В процессе обновления информации о событии возникли ошибки.'],404);}
        else {
            $event->fill($request->only([
            'dated_at' => $request->dated_at,
            'name' => $request->name,
            'description' => $request->description,
            'is_premiere' => $request->is_premiere,
            'is_chosen_for_main_page' => $request->is_chosen_for_main_page,
            'available_seats_number' => $request->available_seats_number,
            'theater_id' => $request->theater_id,
            'spectacle_id' => $request->spectacle_id,
            'hall_id' => $request->hall_id,
            'duration' => $request->duration,
            'age' => $request->age,
            'price' => $request->price,
            'genre' => $request->genre]));

            $event->save();

            return response()->json([
                'message' => 'Событие успешно обновлено.'
            ],201);
        }
    }

    public function getMainPagePremieres(Request $request)
    {
        $is_chosen_for_main_page = $request->input('is_chosen_for_main_page');
        $events = Event::where('is_chosen_for_main_page', 'like', $is_chosen_for_main_page)
            ->with('spectacle')
            ->with('theater')
            ->get();

            return response()->json([
                'premieres' => $events
            ], 200);}
}


