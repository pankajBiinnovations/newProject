<?php

namespace App\Http\Controllers;
use App\Models\Review;
use Illuminate\Http\Request;
use Auth;
use DB;
use Hash;
class UserAuthController extends Controller
{
  public function index()
  {
    return view('user.home');
  }
  public function login()
  {
    return view('user.login');
  }
  public function handlelogin(Request $request)
  {
   if(Auth::attempt($request->only(['email','password'])))
   {
    return redirect()->route('user.home');
   }
   return redirect()->back()->with('error','Invalid Credential');
  }
  public function logout()
  {
    Auth::logout();
    return redirect()->route('user.login');
  }
  public function addReview()
  {
   
    return view('user.addReview');
  }
  public function addReviewPost(Request $request)
  {
    $validatedData = $request->validate([
     
      'comment' => 'required|string|max:255'
      // Add any other validation rules as needed
  ]);

  // Create a new review instance
  $review = new Review();
 
  $review->comment = $request->input('comment');
  // Set any other review attributes as needed
  $review->user_id=Auth::id();
  $review->status='inactive';
  $review->save();
 
  // Return a JSON response indicating success
  return response()->json(['message' => 'Review added successfully']);

  }
  public function myreview()
  {
   $datas=DB::table('reviews')->where('user_id',auth()->user()->id)->get();
   return view('user.myreview',compact('datas'));
  }

  public function destroy($id)
{
    $item = Review::find($id);
   
    if ($item) {
        $item->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }
    
    return response()->json(['error' => 'Item not found'], 404);
}
public function regpost(Request $request)
{
  $data=$request->except(['_token']);
  DB::table('users')->insert([
    'name'=>$data['name'],
    'email'=>$data['email'],
    'password'=>Hash::make($data['password'])
  ]);
}


}
