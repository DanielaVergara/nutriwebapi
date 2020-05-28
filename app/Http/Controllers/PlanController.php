<?php

namespace App\Http\Controllers;

use App\Person;
use App\PersonPlan;
use App\Http\Controllers\TypeIngredientsController;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{

    public function calculateIdealWeight(Person $person)
    {
        $heightSquare = $person->height * $person->height;
        $imc =   $person->weight  /  $heightSquare;
        $float_redondeado = round($imc);
        $personPlan = new PersonPlan();
        $planController = new PlanController();

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
        $personPlan->id_plan   = 1;
        $personPlan->save();
    }


    public function getPlan($idPerson){
        $plan=DB::table('plans')
        ->join('person_plans', 'plans.id','=','person_plans.id_plan')
        ->join('plan_ingredients','plans.id','=','plan_ingredients.id_plan')
        ->join('ingredients','plan_ingredients.id_ingredient','=','ingredients.id')
        ->join('type_ingredients','ingredients.id_type','=','type_ingredients.id')
        ->select('ingredients.names', 'plan_ingredients.hour','person_plans.goalCalories','person_plans.goalDescription')
        ->where('person_plans.id_person','=',$idPerson)->get();
        return response()->json($plan);
    }

    public function ingredients(){
        $typeIngredientController = new TypeIngredientsController();
        $ingredientsController = new IngredientsController();
        $ingredientsController->validationIngredientsType($typeIngredientController->getTypeIngredients());
    }
}
