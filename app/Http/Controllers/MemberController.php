<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use JWTAuth;
use App\Models\Group;
class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
      $member = Group::where('id',$id)->with('getMember')->first();
      return $member;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member= new Member();
        $member->name = $request->name;
        $member->email= $request->email;
        $member->contact = $request->contact;
        $member->group_id = $request->group_id;
        $member->save();
        if ($member) {
            return ["result"=>"member add successfullly"];
        }
        else {
            return $member->errors();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $member = Member::all();
        return $member;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function usinggroupid($id)
    {
        $member = Member::where('group_id',$id)->get();
        return response($member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $member = JWTAuth::parsetoken()->toUser();

        $member = Member::where('id',$id)->first();
        $member->name = $request->name;
        $member->email = $request->email;
        $member->group_id = $request->group_id;
        $member->save();
       
        // $data = $member->update($request->all());
        if ($member) {
        return ["result"=>"update successfully"];
        }
        else {
        return ["result"=>"update fail"];
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();
        if ($member) {
            return ["result"=>"delete successfully..."];
        }
        else {
            return ["result"=>"delete fail..."];
            
        }
    }
    function upload(Request $request){
        $result = $request->file("file")->store('apiDocs');
        return ["result"=>$result];
    } function innerjoin(){
        $result = DB::table('groups')
        ->join("members","groups.id","=","members.group_id")
        ->select("members.*","groups.description")->get();
        return $result;
    }
}
