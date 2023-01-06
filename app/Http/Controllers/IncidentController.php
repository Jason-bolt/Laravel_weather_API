<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIncidentRequest;
use App\Http\Requests\UpdateIncidentRequest;
use App\Http\Resources\IncidentsResource;
use App\Models\Incident;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Http;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return IncidentsResource::collection(Incident::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIncidentRequest  $request
     * @return IncidentsResource|\Illuminate\Http\JsonResponse
     */
    public function store(StoreIncidentRequest $request)
    {
        $API_KEY = env('WEATHER_API_KEY');
        $name = $request->name;
        $country = $request->country;
        $city = $request->city;
        $data = Http::get('https://api.openweathermap.org/data/2.5/weather?q=' . $city . '&appid=' . $API_KEY);

//        return response($data);
        if ($data['cod'] != 200)
        {
            return response()->json([
                'data' => [
                    'error' => [
                        'code' => $data['cod'],
                        'message' => $data['message']
                    ]
                ]
            ]);
        }

        $weather_data = $data->json();
        $temperature = $weather_data['main']['temp'];
        $humidity = $weather_data['main']['humidity'];
        $wind_speed = $weather_data['wind']['speed'];

        $incident = Incident::create([
            'name' => $name,
            'country' => $country,
            'city' => $city,
            'temperature' => $temperature,
            'humidity' => $humidity,
            'wind_speed' => $wind_speed
        ]);

        return new IncidentsResource($incident);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function show(Incident $incident)
    {
        return new IncidentsResource($incident);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function edit(Incident $incident)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIncidentRequest  $request
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncidentRequest $request, Incident $incident)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incident $incident)
    {
        $incident->delete();
        return response(null);
    }
}
