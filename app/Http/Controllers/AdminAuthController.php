<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Product;
class AdminAuthController extends Controller
{
  public function index()
  {
    return view('admin.home');
  }
  public function login()
  {
    return view('admin.login');
  }
  public function handlelogin(Request $request)
  {
   
  //  if(Auth::guard('webadmin')->attempt($request->only(['email','password'])))
   if (Auth::guard('webadmin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/admin');
        }
   return redirect()->back()->with('error','Invalid Credential');
  }
  public function logout()
  {
    Auth::guard('webadmin')->logout();
    return redirect()->route('admin.login');
  }
  public function AdminManageReview()
  {
   $data=DB::table('reviews')->get();
   return view('admin.AdminManageReview',compact('data'));
  }
  public function userApprove(Request $request , $id)
  {
    DB::table('reviews')->where('id',$id)->update([
      'status'=>'active'
    ]);
    return back();

  }
  public function userReject(Request $request , $id)
  {
    DB::table('reviews')->where('id',$id)->update(['status'=>'inactive']);
    return back();

  }
  public function addProduct()
  {
   
    return view('admin.addProduct');
  }
  public function productpost(Request $request)
  {
    
// Validate the uploaded file
$data=$request->name;

// Get the uploaded file
$image = $request->file('image');

// Generate a unique filename
$filename = time() . '.' . $image->getClientOriginalExtension();
$image->move('public/images', $filename);

// Store the image in the desired folder
// $image->storeAs('public/images', $filename);

// Save the image information in the database
$imageData = new Product();
$imageData->image = $filename;
$imageData->name = $request->input('name');
$imageData->save();

// Redirect or return a response
return redirect()->back()->with('success', 'Image uploaded successfully.');
}
}
