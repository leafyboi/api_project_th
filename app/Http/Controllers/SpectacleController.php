<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spectacle;
use App\Theater;

class SpectacleController extends Controller
{
    public function addSpectacle(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $rate = 0;
        $duration = $request->input('duration');
        $year = $request->input('year');
        $poster = $request->input('poster');
        $trailer = $request->input('trailer');
        $slider_poster = $request->input('slider_poster');
        $theater_id = $request->input('theater_id');

        $data = array(
            'name' => $name,
            'description' => $description,
            'rate' => $rate,
            'duration' => $duration,
            'year' => $year,
            'poster' => $poster,
            'trailer' => $trailer,
            'slider_poster' => $slider_poster,
            'theater_id' => $theater_id
        );

        $spectacle = Spectacle::create($data);
        $theater = Theater::find($theater_id);

        if ($theater === null) {
            return response()->json([
                'errors' => [
                    'type' => 'TheaterNotFound',
                    'message' => 'Театр с таким ID не найден.'],
                'message' => 'В процессе добавления спектакля возникли ошибки.'
            ], 404);}
        else {
            return response()->json([
                'spectacle' => [
                    'id' => $spectacle->id,
                ],
                'message' => 'Спектакль успешно добавлен.'
            ], 201);
        }
    }
    public function getSpectacles(Request $request)
    {
        $theater_id = $request->input('theater_id');
        $spectacles = Spectacle::where('theater_id', $theater_id)->orderBy('created_at', 'asc')->get(['id', 'name', 'rate', 'poster', 'description'])->toArray();
        $theater = Theater::find($theater_id);

        if ($theater === null){
            return response()->json([
                'errors' => [
                    'type' => 'TheaterNotFound',
                    'message' => 'Театр с таким id не найден.'],
                'message' => 'В процессе получения информации о спектаклях возникли ошибки.'
            ], 404);}
        else {
            return response()->json([
                'spectacles' => $spectacles
                ], 200);}
    }

    public function getSpectacle(Request $request)
    {
        $spectacle_id = $request->input('spectacle_id');
        $spectacle = Spectacle::get(['id', 'name', 'rate', 'poster', 'description'])->find($spectacle_id);

        if ($spectacle === null) {
            return response()->json([
                'errors' => [
                    'type' => 'SpectacleNotFound',
                    'message' => 'Спектакль с таким id не найден.'],
                'message' => 'В процессе получения информации о спектакле возникли ошибки.'
            ], 404);}
        else {
            return response()->json([
                'spectacle' => $spectacle
            ], 200);
        }
    }

    public function deleteSpectacle(Request $request)
    {
        $spectacle_id = $request->input('id');
        $spectacle = Spectacle::find($spectacle_id);

        if ($spectacle === null) {
            return response()->json([
                'errors' => [
                    'type' => 'SpectacleNotFound',
                    'message' => 'Спектакль с таким id не найден.'],
                'message' => 'В процессе получения информации о спектакле возникли ошибки.'
            ], 404);}
        else {
            $spectacle->delete();

            return response()->json([
                'message' => 'Спектакль успешно удален.'
            ], 201);
        }
    }

    public function updateSpectacle(Request $request)
    {
        $spectacle_id = $request->input('id');
        $spectacle = Spectacle::find($spectacle_id);

        if ($spectacle === null) {
            return response()->json([
                'errors' => [
                    'type' => 'SpectacleNotFound',
                    'message' => 'Спектакль с таким id не найден.'],
                'message' => 'В процессе обновления информации о спектакле возникли ошибки.'],404);}
        else {
            $spectacle->fill($request->only([
            'name' => $request->name,
            'description' => $request->description,
            'rate' => $request->rate,
            'duration' => $request->duration,
            'year' => $request->year,
            'poster' => $request->poster,
            'trailer' => $request->trailer,
            'slider_poster' => $request->slider_poster,
            'theater_id' => $request->theater_id]));
            $spectacle->save();

            return response()->json([
                'message' => 'Спектакль успешно обновлен.'
            ],201);
        }
    }
}
