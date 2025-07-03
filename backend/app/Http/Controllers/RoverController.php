<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoverService;


class RoverController extends Controller 
{

    public function start(Request $request) 
    {
        
        $validated = $this->validator($request);

        $rover = new RoverService(
            $validated['initial_position'], 
            $validated['direction'], 
            $validated['obstacles'] ?? []
        );

        $res  = $rover->execute($validated['commands']);    

        return response()->json([$res]);

    }

    private function validator(Request $request): array 
    {

        return $request->validate([
            'initial_position' => 'required|array|size:2',
            'initial_position.0' => 'required|integer',
            'initial_position.1' => 'required|integer',
            'direction' => 'required|string|in:N,E,S,W',
            'obstacles' => 'nullable|array',
            'commands' => 'required|string'

        ]);
    }
}