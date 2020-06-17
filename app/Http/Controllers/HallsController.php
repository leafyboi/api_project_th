<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hall;
use App\Theater;

class HallsController extends Controller
{
    public function addHall(Request $request)
    {
        $name = $request->input('name');
        $scheme = $request->input('scheme');
        $capacity = $request->input('capacity');
        $theater_id = $request->input('theater_id');

        $data = array(
            'name' => $name,
            'scheme' => $scheme,
            'capacity' => $capacity,
            'theater_id' => $theater_id
        );

        $hall = Hall::create($data);
        $theater = Theater::find($theater_id);

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
    public function getHalls(Request $request)
    {
        $theater_id = $request->input('theater_id');
        $halls = Hall::find($theater_id)->get();
        $theater = Theater::find($theater_id);

        if ($theater === null){
            return response()->json([
                'errors' => [
                    'type' => 'TheaterNotFound',
                    'message' => 'Театр с таким id не найден.'],
                'message' => 'В процессе получения информации о залах театра возникли ошибки.'
            ], 404);}
        else {
            return response()->json([
                    'halls' => $halls
                ], 200);
            }
    }

    public function getHall(Request $request)
    {
        $hall_id = $request->input('id');
        $hall = Hall::find($hall_id);

        if ($hall) {
            return response()->json([
                'hall' => $hall
            ], 200);}
        else {
            return response()->json([
                'errors' => [
                    'type' => 'HallNotFound',
                    'message' => 'Зал с таким id не найден.'],
                'message' => 'В процессе получения информации о зале возникли ошибки.'
            ], 404);
        }
    }

    public function deleteHall(Request $request)
    {
        $hall_id = $request->input('id');
        $hall = Hall::find($hall_id);

        if ($hall === null) {
           return response()->json([
                'errors' => [
                    'type' => 'HallNotFound',
                    'message' => 'Зал с таким id не найден.'],
                'message' => 'В процессе удаления зала возникли ошибки.'
            ], 404);}
        else {
            $hall->delete();

            return response()->json([
                'message' => 'Зал успешно удален.'
            ], 201);
        }
    }

    public function updateHall(Request $request)
    {
        $hall_id = $request->input('id');
        $hall = Hall::find($hall_id)->first();

        if ($hall === null) {
            return response()->json([
                'errors' => [
                    'type' => 'HallNotFound',
                    'message' => 'Зал с таким id не найден.'],
                'message' => 'В процессе обновления информации о зале возникли ошибки.'],404);}
        else {
            $hall->fill($request->only([
            'name' => $request->name,
            'scheme' => $request->scheme,
            'capacity' => $request->capacity,
            'theater_id' => $request->theater_id]));
            $hall->save();

            return response()->json([
                'message' => 'Зал успешно обновлен.'
            ],201);
        }
    }
}
