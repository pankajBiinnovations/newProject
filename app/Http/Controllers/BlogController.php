<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redis;
use Event;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\WelcomeEmailEvent;
class BlogController extends Controller
{
    use SoftDeletes;
    public function index($id)
    {
        $key = 'mykey';
        $value = 'oi';
        Redis::set($key, $value, 'EX', 5);
        $userData=Redis::get($key);
        dd($userData);
    //  $user= User::where('id',$id)->first();
    //  Redis::set('user'.$user->id,$user->tojson());
    //  $userData=Redis::get('user'.'1');
    //  print_r($userData);
    
    }
    public function event()
    {
        $user = User::find(1); // Assuming you have a user instance
       
event (new WelcomeEmailEvent($user));

    }
    public function bl($id)
    {
        $user = User::find(7);
        $user->delete();
        
    }
    
}
