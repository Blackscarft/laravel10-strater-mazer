<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    
    public function index(){
        $userLogin = Auth::user();
        return view('pages.user.index', ['user' => $userLogin, ]);
    }
    
    public function createUser(UsersDataTable $datatable){
        // $roles = Role::get()->skip(1);
        $roles = Role::get();
        return $datatable->render('pages.user.new',['roles' => $roles]);
    }

    public function saveCreateUser(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
            'signature' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024'
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()->toArray(),
            ], 422);
        } 

        $photoName = "photo_". $request->name . "_" . uniqid() . "." . $request->photo->extension();
        $request->file('photo')->move(public_path('images/photo'), $photoName);

        $signatureName = "photo_". $request->name . "_" . uniqid() . "." . $request->signature->extension();
        $request->file('signature')->move(public_path('images/signature'), $photoName);

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $photoName,
            'signature' => $signatureName
        ]);
        $role = Role::where('id', $request->role)->first();
        $roleName = $role->name;
        $newUser->assignRole($roleName);

        return response()->json(['message' => 'Pembuatan akun berhasil'], 200);
    }
    
    public function resetPassword($id) {        
        $user = User::find($id);
        $user->password = Hash::make("digiQrifyForBetter");
        $user->save();

        return response()->json(['message' => 'Akun berhasil di reset password'], 200);
    }

    public function nonaktif($id) {        
        $user = User::find($id);
        $user->delete();

        return response()->json(['message' => 'Akun berhasil di nonaktifkan'], 200);
    }

    public function updatePhoto(Request $request){        
        $validator = Validator::make($request->all(), [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,bmp,webp|max:1024',
        ]); 

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()->toArray(),
            ], 422);
        } 

        $user = auth()->user();
        $photo = public_path('images/photo/') . $user->photo;

        if(file_exists($photo)){
            if($user->photo != "default.jpg"){
                unlink($photo);
            }
        }

        $photoName = "photo_". $user->name . "_" . uniqid() . "." . $request->photo->extension();
        $request->file('photo')->move(public_path('images/photo'), $photoName);

        $user->photo  = $photoName;
        /** @var \App\Models\User $user **/
        $user->save();

        return response()->json([
            'message' => 'Berhasil memperbaruhi photo profile',
            'photo' => 'images/photo/'.$photoName
        ], 200);
    }

    public function updateProfile(Request $request){
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'max:255',
                'email',
                'unique:users',
                Rule::unique('users')->ignore($user->id)->when($request->email !== $user->email, function ($query) use ($user) {
                    return $query->where('email', $user->email);
                }),
            ],
            
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()->toArray(),
            ], 422);
        } 

        if ($request->email !== $user->email) {
            $user->email = $request->email;
        }
        $user->name = $request->name;
        /** @var \App\Models\User $user **/
        $user->save();

        return response()->json([
            'message' => 'Berhasil memperbaruhi profile',
            'name' => $request->name
        ], 200);
    }

    public function updatePassword(Request $request) {
        $user = auth()->user();

        // Check password matches
        if(!(Hash::check($request->current_password, $user->password))){
            $errors = [
                'current_password' => ['Password yang anda masukan tidak sesuai dengan password saat ini !']
            ];

            return response()->json(['errors' => $errors] , 422);
        }

        // Check new password with current password is same
        if(strcmp($request->current_password, $request->password) == 0){
            $errors = [
                'password' => ['Password yang baru tidak boleh sama dengan password yang lama !']
            ];

            return response()->json(['errors' => $errors] , 422);
        }

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()->toArray(),
            ], 422);
        }

        $user->password = Hash::make($request->password);

         /** @var \App\Models\User $user **/
        $user->save();

        return response()->json(['message' => 'Berhasil memperbaruhi password'], 200);
    }

    public function updateSignature(Request $request){   
        $validator = Validator::make($request->all(), [
            'signature' => 'required|image|mimes:jpeg,png,jpg,gif,bmp,webp|max:1024',
        ]); 

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()->toArray(),
            ], 422);
        } 

        $user = auth()->user();
        $signature = public_path('images/signature/') . $user->signature;

        if(file_exists($signature)){
            if($user->signature != "default.png"){
                unlink($signature);
            }
        }

        $signatureName = "signature_". $user->name . "_" . uniqid() . "." . $request->signature->extension();
        $request->file('signature')->move(public_path('images/signature'), $signatureName);

        $user->signature  = $signatureName;
        /** @var \App\Models\User $user **/
        $user->save();

        return response()->json([
            'message' => 'Berhasil memperbaruhi signature profile',
            'signature' => 'images/signature/'.$signatureName
        ], 200);
    }
}