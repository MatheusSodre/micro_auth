<?php 
namespace App\Services\User;
use App\Http\Resources\User\UserAuthResource;
use App\Http\Resources\User\UserResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService 
{
    public function __construct(protected UserRepository $userRepository)
    {
        
    }

    public function store(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->userRepository->create($data);
    }

    public function getAll()
    {
        return $this->userRepository->paginate(['permissions']);
    }

    public function getByEmail(array $data)
    { 
        $user = $this->userRepository->first('email',$data['email']);
        
        if (!$user || !Hash::check($data['password'],$user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        
        return (new UserResource($user))->additional(['token' => $user->createToken($data['device_name'])->plainTextToken]);
    }

    public function update($request,$id):bool|null
    {
        if (isset($request['password']))
            $request['password'] = bcrypt($request['password']);
        
        return $this->userRepository->update($request,'uuid',$id);
    }
    
    public function destroy($id):bool|null
    {
        return $this->userRepository->delete('uuid',$id);
    }

    public function permissionUser(string $uuid)
    { 
        return $this->userRepository->permissionUser('uuid',$uuid);
    }

    public function addPermissionUser($request)
    {   
        $this->userRepository->addPermissionUser($request);
        return response()->json(['message' => 'successs']);
    }

    public function userHasPermission($user,$permission)
    {   
        $userAdmin         = $this->isUserAdmin($user->email);
        $userHasPermission = $this->userRepository->hasPermission($user,$permission);
        return ($userAdmin || $userHasPermission) 
                        ? response()->json(['message' => 'successs']) 
                        : response()->json(['message' => 'unauthorized'],403);
    }

    public function isUserAdmin(string $email)
    {
        return in_array($email,config('admin.admins'));
    }
}

?>