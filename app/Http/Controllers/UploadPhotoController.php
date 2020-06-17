<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


class UploadPhotoController extends Controller
{
    public function theaterLogoSave(Request $request) {
        request()->validate([
            'theater_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $filename = Str::random(15);
        $path = $request->file('theater_logo')->move(public_path("/theater_logo"), $filename);
        $photoURL = url('/theater_logo/'.$filename);
        return response()->json([
            'message' => 'Картинка успешно загружена на сервер по адресу:',
            'url' => $photoURL], 200);
    }

    public function theaterPhotoSave(Request $request) {
        request()->validate([
            'theater_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $filename = Str::random(15);
        $path = $request->file('theater_photo')->move(public_path("/theater_photo"), $filename);
        $photoURL = url('/theater_photo/'.$filename);
        return response()->json([
            'message' => 'Картинка успешно загружена на сервер по адресу:',
            'url' => $photoURL], 200);
    }

    public function theaterPreviewSave(Request $request) {
        request()->validate([
            'theater_preview' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $filename = Str::random(15);
        $path = $request->file('theater_preview')->move(public_path("/theater_preview"), $filename);
        $photoURL = url('/theater_preview/'.$filename);
        return response()->json([
            'message' => 'Картинка успешно загружена на сервер по адресу:',
            'url' => $photoURL], 200);
    }

    public function spectaclePosterSave(Request $request) {
        request()->validate([
            'spectacle_poster' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $filename = Str::random(15);
        $path = $request->file('spectacle_poster')->move(public_path("/spectacle_poster"), $filename);
        $photoURL = url('/spectacle_poster/'.$filename);
        return response()->json([
            'message' => 'Картинка успешно загружена на сервер по адресу:',
            'url' => $photoURL], 200);
    }

    public function spectacleTrailerSave(Request $request) {
        request()->validate([
            'spectacle_trailer' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $filename = Str::random(15);
        $path = $request->file('spectacle_trailer')->move(public_path("/spectacle_trailer"), $filename);
        $photoURL = url('/spectacle_trailer/'.$filename);
        return response()->json([
            'message' => 'Картинка успешно загружена на сервер по адресу:',
            'url' => $photoURL], 200);
    }

    public function spectacleSliderPosterSave(Request $request) {
        request()->validate([
            'spectacle_sliderposter' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $filename = Str::random(15);
        $path = $request->file('spectacle_sliderposter')->move(public_path("/spectacle_sliderposter"), $filename);
        $photoURL = url('/spectacle_sliderposter/'.$filename);
        return response()->json([
            'message' => 'Картинка успешно загружена на сервер по адресу:',
            'url' => $photoURL], 200);
    }

    public function hallSchemeSave(Request $request) {
        request()->validate([
            'hall_scheme' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $filename = Str::random(15);
        $path = $request->file('hall_scheme')->move(public_path("/hall_scheme"), $filename);
        $photoURL = url('/hall_scheme/'.$filename);
        return response()->json([
            'message' => 'Картинка успешно загружена на сервер по адресу:',
            'url' => $photoURL], 200);
    }
}
