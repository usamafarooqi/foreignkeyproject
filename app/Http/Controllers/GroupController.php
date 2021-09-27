<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{
    //
    function store(Request $request){
        $group = new Group;
        $group->name = $request->name;
        $group->description = $request->description;
        $group->save();
        if ($group) {
            return ["message"=>"Group Added Successfully..."];
        }else {
            return ["message"=>"Group Not Added...",$group->errors()];
        }
    }
}
