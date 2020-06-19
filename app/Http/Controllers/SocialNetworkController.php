<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SocialNetwork;

class SocialNetworkController extends Controller
{
    public function addSocialNetwork(Request $request)
    {
        $name = $request->input('name');
        $logo = $request->input('logo');

        $data = array(
            'name' => $name,
            'logo' => $logo,
        );

        $socialnetwork = SocialNetwork::create($data);


            return response()->json([
                'hall' => [
                    'id' => $socialnetwork->id],
                'message' => 'Социальная сеть успешно добавлена.'
            ], 201);
        }

    public function updateHall(Request $request)
    {
        $socialnetwork_id = $request->input('id');
        $socialnetwork = Hall::find($socialnetwork_id);

        if ($socialnetwork === null)
        {
            return response()->json([
                'errors' => [
                    'type' => 'SocialNetworkNotFound',
                    'message' => 'Социальная сеть с таким id не найден.'],
                'message' => 'В процессе обновления социальной сети возникли ошибки.'],404);}
        else{
            $socialnetwork->fill($request->only([
                'name' => $request->name,
                'logo' => $request->logo]));
            $socialnetwork->save();

            return response()->json([
                'message' => 'Социальная сеть успешно обновлена.'
            ],201);}
    }

    public function getHall(Request $request)
    {
        $socialnetwork_id = $request->input('id');
        $socialnetwork = SocialNetwork::find($socialnetwork_id);

        if ($socialnetwork === null) {
            return response()->json([
                'errors' => [
                    'type' => 'SocialNetworkNotFound',
                    'message' => 'Социальная сеть с таким id не найден.'],
                'message' => 'В процессе обновления социальной сети возникли ошибки.'],404);}
        else {
            return response()->json([
                'socialnetwork' => $socialnetwork
            ], 200);
        }
    }
}
