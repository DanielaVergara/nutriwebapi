<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{


  
    
    public function createPerson(Request $request)
    {   
        $json = $request->json()->all();
        $person =  new Person;
        $person->id   =  $json['id'];
        $person->names = $json['names'];
        $person->lastnames = $json['lastnames'];
        $person->birthdate = $json['birthdate'];
        $person->weight    = $json['weight'];
        $person->height    = $json['height'];
        $person->email     = $json['email'];
        $person->save();
    
        $planController = new PlanController;
        $planController->calculateIdealWeight($person);
        return response()->json($person);
    }



    public function updatePerson(Request $request, $id)
    {
        $json  = $request->json()->all();
        $person   = Person::findOrFail($id);
        $person->names = $json['names'];
        $person->save();
        return response()->json($person);
    }

    public function deletePerson(Request $request,$id){
         $person = Person:: findOrFail($id);
         $person->delete();
    }

    public function searchPerson(Request $request,$id){
        $person = Person:: findOrFail($id);
        return response()->json($person);
    }
}
