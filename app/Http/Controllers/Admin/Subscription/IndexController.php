<?php

namespace App\Http\Controllers\Admin\Subscription;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;

class Indexcontroller extends Controller
{
    /**
    * Display all listing of students
    */
    public function index()
    {   
        $data = [];
        $data['subscriptions'] = Membership::get();
        if($data['subscriptions']){
            return view('admin.subscriptions.index',$data);
        }
    }

}
