<?php

namespace App\Http\Controllers\Admin\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
    * Display all transaction history of students
    */
    public function index()
    {   
        $data = [];
        $data['transactions'] = Membership::get();
        if($data['transactions']){
            return view('admin.transactions.index',$data);
        }
    }
}
