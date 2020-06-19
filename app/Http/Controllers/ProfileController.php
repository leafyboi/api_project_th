<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Bookmark;

class ProfileController extends Controller
{
    public function updateUserProfile(Request $request)
    {
        $user_id = $request->input('id');
        $user = User::find($user_id);

        if ($user === null) {
            return response()->json([
                'errors' => [
                    'type' => 'UserNotFound',
                    'message' => 'Пользователь с таким ID пользователя не найден.'],
                'message' => 'Указанные данные введены неверно.'], 404);
        } else {
            $user->name = $request->input('name');
            $user->surname = $request->input('surname');
            $user->save();

            return response()->json([
                'message' => 'Информация в Вашем профиле успешно обновлена.'
            ], 201);
        }
    }

    public function getUserProfile(Request $request)
    {
        $user_id = $request->input('id');
        $user = User::find($user_id);

        if ($user === null){
            return response()->json([
                'errors' => [
                    'type' => 'UserNotFound',
                    'message' => 'Пользователь с таким ID пользователя не найден.'],
                'message' => 'Указанные данные введены неверно.'], 404);
        }
        else {
            return response()->json([
                'user' => $user
            ],200);
        }
    }

    public function addUserBookmark(Request $request)
    {
        $user_id = $request->input('user_id');
        $spectacle_id = $request->input('spectacle_id');

        $data = array(
            'spectacle_id' => $spectacle_id,
            'user_id' => $user_id
        );

        $bookmark = Bookmark::create($data);
        $spectacle = Spectacle::find($spectacle_id);
        $user = User::find($user_id);

        if ($bookmark) {
            return response()->json([
                'message' => 'Спектакль добавлен в закладки.'
            ], 201); // raspisat' oshibki
        }
    }

    public function deleteUserBookmark(Request $request)
    {
        $user_id = $request->input('user_id');
        $spectacle_id = $request->input('spectacle_id');
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

    public function getUserBookmarks(Request $request)
    {
        $user_id = $request->input('id');
        $user = User::find($user_id);
        $bookmarks = Bookmark::where($user_id)
            ->with('spectacle')
            ->get();

        if ($user === null) {
            return response()->json([
                'type' => 'UserNotFound',
                'message' => 'Пользователь с таким id не найден.'
            ], 404);
        } else {
            return response()->json([
                'bookmarks' => $bookmarks], 200);
        }
    }
}
