<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theater;

class TheaterController extends Controller
{

    public function addTheater(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $address = $request->input('address');
        $logo = $request->input('logo');
        $photo = $request->input('photo');
        $preview = $request->input('preview');
        $cash_desk_phone_number = $request->input('cash_desk_phone_number');
        $phone_number_for_reference = $request->input('phone_number_for_reference');
        $contacts = $request->input('contacts');

        $data = array(
            'name' => $name,
            'description' => $description,
            'address' => $address,
            'logo' => $logo,
            'photo' => $photo,
            'preview' => $preview,
            'cash_desk_phone_number' => $cash_desk_phone_number,
            'phone_number_for_reference' => $phone_number_for_reference,
            'contacts' => $contacts
        );

        $theater = Theater::create($data);

        if ($theater) {
            return response()->json([
                'theater' => [
                    'id' => $theater->id
                ],
                'message' => 'Театр успешно добавлен.'
            ], 201);}
        else {
            return response()->json([
                'message' => 'В процессе добавления нового театра возникли ошибки.'
            ], 404);
        }
    }
    public function getTheaters()
    {
        $theaters = Theater::orderBy('created_at', 'asc')->get();

        return response()->json([
            'theaters' => $theaters
        ], 200);
    }

    public function getTheater(Request $request)
    {
        $theater_id = $request->input('id');
        $theater = Theater::find($theater_id);

        if ($theater === null) {
            return response()->json([
                'errors' => [
                    'type' => 'TheaterNotFound',
                    'message' => 'Театр с таким id не найден.'],
                'message' => 'В процессе получения информации о театре возникли ошибки.'
            ], 404);}
        else {
            return response()->json([
                'theater' => $theater
            ], 200);
        }
    }

    public function deleteTheater(Request $request)
    {
        $theater_id = $request->input('id');
        $theater = Theater::find($theater_id);

        if ($theater === null) {
           return response()->json([
                'errors' => [
                    'type' => 'TheaterNotFound',
                    'message' => 'Театр с таким id не найден.'],
                'message' => 'В процессе удаления театра возникли ошибки.'
            ], 404);}
        else {
            $theater->delete();

            return response()->json([
                'message' => 'Театр успешно удален.'
            ], 201);
        }
    }

    public function updateTheater(Request $request)
    {
        $theater_id = $request->input('id');
        $theater = Theater::find($theater_id);

        if ($theater === null) {
            return response()->json([
                'errors' => [
                    'type' => 'TheaterNotFound',
                    'message' => 'Театр с таким id не найден.'],
                'message' => 'В процессе обновления информации о театре возникли ошибки.'],404);}
        else {
            $theater->fill($request->only([
                'name' => $request->name,
                'description' => $request->description,
                'address' => $request->address,
                'logo' => $request->logo,
                'photo' => $request->photo,
                'preview' => $request->preview,
                'cash_desk_phone_number' => $request->cash_desk_phone_number,
                'phone_number_for_reference' => $request->phone_number_for_reference,
                'contacts' => $request->contacts
            ]));

            $theater->save();

            return response()->json([
                'message' => 'Театр успешно обновлен.'
            ],201);
        }
    }
}
