<?php

namespace App\Http\Controllers;

use App\PlanIngredient;
use App\Ingredient;


class IngredientsController extends Controller
{

    public function ingredients($personPlan)
    {
        $typeIngredientController = new TypeIngredientsController();
        $ingredientsController = new IngredientsController();
        $ingredientsController->validationIngredientsType($typeIngredientController->getTypeIngredients(), $personPlan);
    }

    public function validationIngredientsType($typeIngredient, $personPlan)
    {
        $ingredientsController = new IngredientsController();
        for ($i = 0; $i < $typeIngredient->count(); $i++) {
            $ingredientsController->validationFood($typeIngredient[$i], "Desayuno", $personPlan);
            $ingredientsController->validationFood($typeIngredient[$i], "Almuerzo", $personPlan);
            $ingredientsController->validationFood($typeIngredient[$i], "Comida", $personPlan);
        }
    }

    private function validationFood($typeIngredient, $hour, $personPlan)
    {
        $ingredientsController = new IngredientsController();
        switch ($typeIngredient->name) {
            case "fruta/verdura":
                $planIngredients = new PlanIngredient();
                $ingredient =  $ingredientsController->getIngredientsByType($typeIngredient->id);
                $planIngredients->id_ingredient = $ingredient->id;
                $planIngredients->id_plan       =  $personPlan->id_plan;
                $planIngredients->hour       = $hour;
                $planIngredients->save();
                break;
            case "carbohidratos":
                $planIngredients = new PlanIngredient();
                $ingredient =  $ingredientsController->getIngredientsByType($typeIngredient->id);
                $planIngredients->id_ingredient = $ingredient->id;
                $planIngredients->id_plan       = $personPlan->id_plan;
                $planIngredients->hour       = $hour;
                $planIngredients->save();
                break;
            case "lacteo":
                if ($hour == "Desayuno") {
                    $planIngredients = new PlanIngredient();
                    $ingredient =  $ingredientsController->getIngredientsByType($typeIngredient->id);
                    $planIngredients->id_ingredient = $ingredient->id;
                    $planIngredients->id_plan       =  $personPlan->id_plan;
                    $planIngredients->hour       = $hour;
                    $planIngredients->save();
                }
                break;
            case "proteina":
                $planIngredients = new PlanIngredient();
                $ingredient =  $ingredientsController->getIngredientsByType($typeIngredient->id);
                $planIngredients->id_ingredient = $ingredient->id;
                $planIngredients->id_plan       = $personPlan->id_plan;
                $planIngredients->hour       = $hour;
                $planIngredients->save();
                break;
            default:
                # code...
                break;
        }
    }

    public function getIngredientsByType($id)
    {
        $ingredients = Ingredient::where('id_type', '=', $id)->get();
        $index =  rand(0, $ingredients->count() - 1);
        return $ingredients[$index];
    }
}
