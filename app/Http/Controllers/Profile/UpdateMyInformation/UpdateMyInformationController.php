<?php

namespace App\Http\Controllers\Profile\UpdateMyInformation;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMyInfo;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UpdateMyInformationController extends Controller
{
    // Изменить информацию
    public function showUpdateMyInformationForm()
    {
        return view('personalArea.aboutRefactoring');
    }

    public function updateMyInformationForm_process(UpdateMyInfo $request)
    {

        $user = User::find(Auth::user()->id);

        $user->login = $request->login ? $request->login : "";
        $user->firstname = $request->firstname ? $request->firstname : "";
        $user->lastname = $request->lastname ? $request->lastname : "";
        $user->phone = $request->phone ? $request->phone : "";
        $user->about = $request->about ? $request->about : "";

        $user->save();

        return redirect(route('personalArea'));
    }
}
