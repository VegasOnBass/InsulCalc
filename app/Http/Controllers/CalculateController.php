<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculateController extends Controller
{
    public function calculate(Request $request)
    {

        // Set up incoming data
        $lengthFt = $request->input('lengthFt');
        $lengthIn = $request->input('lengthIn');
        $widthFt = $request->input('widthFt');
        $widthIn = $request->input('widthIn');
        $heightFt = $request->input('heightFt');
        $heightIn = $request->input('heightIn');
        $rValue = $request->input('rValue');

        // Make all dimesions same unit
        $length = $lengthFt + ($lengthIn / 12);
        $width = $widthFt + ($widthIn / 12);
        $height = $heightFt + ($heightIn / 12);
        

        // Perform the insulation calculation logic here
        $area = 2 * ($height * $width + $height * $length + $width * $length);
        $insulationNeeded = $area / $rValue;

        // Return the result as JSON
        return response()->json([
            'insulationNeeded' => $insulationNeeded,
        ]);
    }
}
