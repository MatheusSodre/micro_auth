<?php 
namespace App\Services\User;
use App\Http\Resources\User\UserAuthResource;
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
        
        return (new UserAuthResource($user))->additional(['token' => $user->createToken($data['device_name'])->plainTextToken]);
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
        return ($this->userRepository->userHasPermission($user,$permission)) 
                        ? response()->json(['message' => 'successs']) 
                        : response()->json(['message' => 'unauthorized']);
    }

    public function update($request,$id):bool|null
    {
        return $this->userRepository->update($request,'uuid',$id);
    }
    
    public function destroy($id):bool|null
    {
        return $this->userRepository->delete('uuid',$id);
    }
}

?>