<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Bookmark;

class ProfileController extends Controller
{
    public function updateUserProfile(Request $request, $user_id)
    {
        $user = User::find($user_id);

        if ($user) {
            $user->name = $request->input('name');
            $user->surname = $request->input('surname');
            $user->save();

            return response()->json([
                'message' => 'Информация в Вашем профиле успешно обновлена.'
            ], 201);
        } else {
            return response()->json([
                'errors' => [
                    'type' => 'UserNotFound',
                    'message' => 'Пользователь с таким ID пользователя не найден.'],
                'message' => 'Указанные данные введены неверно.'], 404);
        }
    }

    public function getUserProfile($user_id)
    {
        $user = User::find($user_id);

        if ($user){
         return response()->json([
             'user' => $user
         ],200);
        }
        else {
            return response()->json([
                'errors' => [
                    'type' => 'UserNotFound',
                    'message' => 'Пользователь с таким ID пользователя не найден.'],
                'message' => 'Указанные данные введены неверно.'], 404);
        }
    }

    public function addUserBookmark(Request $request, $user_id)
    {
        $spectacle_id = $request->input('spectacle_id');

        $data = array(
            'spectacle_id' => $spectacle_id,
            'user_id' => $user_id
        );

        $bookmark = Bookmark::create($data);

        if ($bookmark) {
            return response()->json([
                'message' => 'Спектакль добавлен в закладки.'
            ]); // raspisat' oshibki
        }
    }

    public function deleteUserBookmark($user_id, $spectacle_id)
    {
        $bookmark = Bookmark::where($user_id)->find($spectacle_id);

        if ($bookmark) {
            $bookmark->delete();

            return response()->json([
                'message' => 'Закладка удалена.'
            ], 204);
        } else {
            return response()->json([
                'type' => 'BookmarkNotFound',
                'message' => 'Закладка пользователя с таким ID не найдена.'],404);
        }
    }

    public function getUserBookmark($user_id)
    {
        $bookmarks = Bookmark::where($user_id)
        ->with('spectacle')
        ->get();

    if($bookmarks)
    {
        return response()->json([
        'bookmarks' => $bookmarks
        ], 200);}
    }
}
