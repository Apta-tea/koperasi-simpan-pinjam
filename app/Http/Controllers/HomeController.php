<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Exception;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('check');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Dashboard');
    }

    public function operator()
    {
        $data['user'] = User::all();
        return view('Operator.Show',$data);
    }

    public function destroy($id)
    {
        //
        $user = User::find($id);
        $user->delete($id);
        return redirect('operator');
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],]);

            try
            {
                $data = array(
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password)
                );
                User::create($data);
                $pesan = "Success";
            }
            catch(Exception $exception)
            {
                $pesan = 'Database error!, ada duplikat data' . $exception->getCode();
            }
            Session::flash('pesan',$pesan);
            return redirect ('operator');           
        
    }

}
