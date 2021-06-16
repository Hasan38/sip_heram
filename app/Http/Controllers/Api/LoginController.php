<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    public function login(Request $request)
{
  
    /*$validator = \Validator::make($request->all(), [
      'phone' => 'required',
      'password' => 'required',
  ]);

  if($validator->fails()){
      return response()->json(['status_code' => 0,
      'message' => 'Mohon masukan data',
      'access_token' => '',
      'pemohon'=> []],201);
  }

  if(auth()->guard('pemohons')->attempt(['phone' => request('phone'), 'password' => request('password')])){
      config(['auth.guards.api.provider' => 'pemohons']);

      $pemohon = \App\Models\Pemohon::select('pemohons.*')->find(auth()->guard('pemohons')->user()->id);
      $success =  $pemohon;
      $tokenResult = $pemohon->createToken('authToken')->plainTextToken;

      return response()->json([
        'status_code' => 1,
        'message' => 'success',
        'access_token' => $tokenResult,
        'pemohon'=> $pemohon], 200);
  }else{ 
      return response()->json([
        'status_code' => 401,
        'message' => 'Phone number and Password are Wrong',
        'access_token' => 'null',
        'pemohon'=> $pemohon], 401);
  }*/
try{
  $request->validate([
    'phone' => 'required',
    'password' => 'required'
  ]);
  $credentials = request(['phone', 'password']);
  if (!\Auth::guard('pemohons')->attempt($credentials)) {
    return response()->json([
      'status_code' => 401,
      'message' => 'Unauthorized'
    ],401);
  }
  $user = \App\Models\Pemohon::where('phone', $request->phone)->first();
  if ( ! \Hash::check($request->password, $user->password, [])) {
     throw new \Exception('Error in Login');
  }
  $tokenResult = $user->createToken('authToken')->plainTextToken;
  return response()->json([
    'status_code' => 200,
    'access_token' => $tokenResult,
    'pemohon' => $user,
    
  ],200);
} catch (\Exception $error) {
  return response()->json([
    'status_code' => 500,
    'message' => 'Error in Login',

  ],500);
}




}

public function register(Request $request){
  
    
    
  try{

    $this->validate([
      'name' => 'required',
      'phone' => 'required',
      'jk' => 'required',
      'tgl_lahir' => 'required',
      'kelurahan_id' => 'required',
      'address' => 'required'
      
  ]);
  
      $new = new \App\Models\Pemohon;
      $new->name=$this->name;
      $new->phone=$this->phone;
      $new->nik=$this->nik;
      $new->email=$this->email;
      $new->jk=$this->jk;
      $new->tgl_lahir=$this->tgl_lahir;
      $new->kelurahan_id=$this->kelurahan_id;
      $new->address=$this->address;
      $new->password=\Hash::make($this->phone);
      $new->avatar='NULL';
      $new->created_by=1;
      
      $new->save();

      
        return response()->json([
          'status_code' => 200,
          'message' => 'Register Success',
          
        ]);      
       
}catch(Exception $e) {
return response()->json([
  'status_code' => 500,
  'message' => 'Register Gagal',
  
      ]);
    }
  }

public function logout(Request $request){
  $user=\Auth::user()->tokens()->where('id', $request->get("id"))->delete();
  // Get user who requested the logout
  $user = request()->user(); //or Auth::user()
  // Revoke current user token
  $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
  if($user){
    return response()->json([
      'status_code' => 200,
      'message' => 'Logout',
      'user' => [],
    ],200);
  }else{
    return response()->json([
      'status_code' => 401,
      'message' => 'Failed Logout',
      'user' => [],
    ],401);
  }
  }
}
