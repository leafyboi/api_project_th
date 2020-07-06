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
        $theater_id = $request->input('theater_id');
        $url = $request->input('url');

        $data = array(
            'name' => $name,
            'logo' => $logo,
            'url' => $url,
            'theater_id' => $theater_id
        );

        $socialNetwork = SocialNetwork::create($data);


            return response()->json([
                'hall' => [
                    'id' => $socialNetwork->id],
                'message' => 'Социальная сеть успешно добавлена.'
            ], 201);
        }

    public function updateSocialNetwork(Request $request)
    {
        $socialNetwork_id = $request->input('id');
        $socialNetwork = SocialNetwork::find($socialNetwork_id);

        if ($socialNetwork === null)
        {
            return response()->json([
                'errors' => [
                    'type' => 'SocialNetworkNotFound',
                    'message' => 'Социальная сеть с таким id не найден.'],
                'message' => 'В процессе обновления социальной сети возникли ошибки.'],404);}
        else{
            $socialNetwork->fill($request->only([
                'name' => $request->name,
                'logo' => $request->logo,
                'url' => $request->url,
                'theater_id' => $request->theater_id]));
            $socialNetwork->save();

            return response()->json([
                'message' => 'Социальная сеть успешно обновлена.'
            ],201);}
    }

    public function getSocialNetwork(Request $request)
    {
        $socialNetwork_id = $request->input('id');
        $socialNetwork = SocialNetwork::find($socialNetwork_id);

        if ($socialNetwork === null) {
            return response()->json([
                'errors' => [
                    'type' => 'SocialNetworkNotFound',
                    'message' => 'Социальная сеть с таким id не найден.'],
                'message' => 'В процессе обновления социальной сети возникли ошибки.'],404);}
        else {
            return response()->json([
                'socialnetwork' => $socialNetwork
            ], 200);
        }
    }

    public function getAllSocialNetworks()
    {
        $socialNetworks = SocialNetwork::orderBy('created_at', 'asc')->get();

        return response()->json([
            'socialnetwork' => $socialNetworks
        ], 200);
    }

    public function deleteSocialNetwork(Request $request)
    {
        $id = $request->input('id');
        $socialNetwork = SocialNetwork::find($id);

        if ($socialNetwork === null) {
            return response()->json([
                'errors' => [
                    'type' => 'SocialNetworkNotFound',
                    'message' => 'Социальная сеть с таким id не найден.'],
                'message' => 'В процессе обновления социальной сети возникли ошибки.'], 404);}
        else {
            $socialNetwork->delete();

            return response()->json([
                'message' => 'Социальная сеть успешно удалена.'
            ], 201);
        }
    }
}
