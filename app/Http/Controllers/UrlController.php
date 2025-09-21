<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    public function shorten(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'original_url' => 'required|url'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'invalid',
                    'data' => $validator->errors()->all()
                ]);
            }

            $shortCode = Str::random(7);

            $url = Url::create([
                'original_url' => $request->input('original_url'),
                'shortened_url' => $shortCode,
                'user_id' => $request->header('id')
            ]);

            return response()->json([
                'shortened_url' => url($shortCode)
            ]);
        } 
        catch (Exception $e) {
            return response()->json([
                'status' => "failed",
                'message' => "Something went wrong"
            ]);
        }
    }

    public function index(Request $request)
    {
        $urls = Url::where('user_id', '=', $request->header('id'))
            ->get(['original_url', 'shortened_url', 'visits']);

        return response()->json($urls);
    }

    public function redirect($code)
    {
        $url = Url::where('shortened_url', '=', $code)->first();

        $url->increment('visits');

        return redirect()->away($url->original_url);
    }
}
