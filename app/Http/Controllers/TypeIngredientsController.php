<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeIngredient;

class TypeIngredientsController extends Controller
{
    public function getTypeIngredients(){
      return  TypeIngredient::all();
    }
}
