<?php

namespace App\Http\Controllers;

use App\Person;
use App\User;
use Illuminate\Http\Request;

class PersonController extends Controller
{   
    public function createPerson(Request $request)
    {   
        $json = $request->json()->all();
        $person =  new Person;
        $person->names = $json['names'];
        $person->lastnames = $json['lastnames'];
        $person->birthdate = $json['birthdate'];
        $person->weight    = $json['weight'];
        $person->height    = $json['height'];
        $person->email     = $json['email'];
        $user = new User;
        $user->email = $json['email'];
        $user->password = $json['password'];
        $user->save();
        $person->id_user = $user->id;
        $person->save();
        $planController = new PlanController;
        $planController->calculateIdealWeight($person);
        return response()->json([
            'code'=>'0',
            'msg'=>'Sucessful'
        ]);
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

    public function searchPersonByUserId($id){
        $persons = Person::where('id_user','=',$id)->first();
        return response()->json($persons);
    }
}
