<?php

namespace App\Http\Controllers;

use App\Models\sample;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
            $members = sample::latest()->paginate(5);
      
            return view('members.index', compact('members'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'filename' => 'required',
            'username' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'gender' => 'required',
            'role' => 'required',
            'email' => 'required',
        ]);
    // public/images/file.png
    

    $database = new sample;
    if ($request->file('filename') == null) {
        $file = "";
    }else{
       $file = $request->file('filename')->store('public/images');  
    }
    $database->filename = $file;
    $database->username = $request->username;
    $database->fname = $request->fname;
    $database->lname = $request->lname;
    $database->address = $request->address;
    $database->phone = $request->phone;
    $database->password = $request->password;
    $database->gender = $request->gender;
    $database->role = $request->role;
    $database->email = $request->email;
    $database->save();
    
  
    // sample::create($request->all());
   
    return redirect()->route('members.index')
                        ->with('success', 'Member is created successfully.');
    }
    
    public function show(sample $member)
    {
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(sample $member)
    {
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sample $member)
    {
        $request->validate([
            'username' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'role' => 'required',
            'email' => 'required',
           
        ]);
  
         
    
         
      
           
            $member->update($request->all());
  
  
        return redirect()->route('members.index')
                        ->with('success', 'Member updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(sample $member)
    {
        $member->delete();
  
        return redirect()->route('members.index')
                        ->with('success', 'Member deleted successfully');
    }
}
