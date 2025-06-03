<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Handle the incoming request.
     */
        public function __invoke(Request $request)
        {
            $lat = $request->latitude;
            $lon = $request->longitude;
            $apiKey = config('filament-google-autocomplete-field.api-key');

            $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$lat},{$lon}&language=id&key={$apiKey}";

            $response = Http::get($url);
            $data = $response->json();

            if (!empty($data['results'])) {
                $components = collect($data['results'][0]['address_components']);

                // Ambil komponen kota
                $cityComponent = $components->first(function ($comp) {
                    return in_array('administrative_area_level_2', $comp['types']);
                });

                $city = $cityComponent['long_name'] ?? 'Tidak diketahui';

                session([
                    'user_kota' => $city,
                    'user_latitude' => $lat,
                    'user_longitude' => $lon,
                ]);

                return response()->json(['status' => 'ok', 'kota' => $city]);
            }

            return response()->json(['status' => 'error', 'message' => 'Lokasi tidak ditemukan'], 404);
        }

    public function gantiKota(Request $request)
    {
        $request->validate([
            'kota' => 'required|string|max:255',
        ]);

        session(['user_kota' => $request->kota]);

        return back()->with('success', 'Lokasi berhasil diganti ke ' . $request->kota);
    }
}
