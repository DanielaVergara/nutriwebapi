<?php

namespace App\Http\Controllers;

use App\Person;
use App\PersonPlan;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    public function calculateIdealWeight(Person $person)
    {
        $heightSquare = $person->height * $person->height;
        $imc =   $person->weight  /  $heightSquare;
        $float_redondeado = round($imc);
        $personPlan = new PersonPlan();

        if ($float_redondeado >= 25) {
            $personPlan->goalDescription = "La meta planteada para este mes, es bajar de peso";
            $personPlan->goalCalories = $person->weight * 25;
        }
        if ($float_redondeado > 18.5 && $float_redondeado < 25) {
            $personPlan->goalDescription = "La meta planteada para este mes, es mantener el peso";
            $personPlan->goalCalories = $person->weight * 30;
        }
        if ($float_redondeado < 18.5) {
            $personPlan->goalDescription = "La meta planteada para este mes, es subir de peso";
            $personPlan->goalCalories = $person->weight * 35;
        }
        $personPlan->email =  $person->email;
        $personPlan->id_person = $person->id;
        $personPlan->save();
        
    }
}
