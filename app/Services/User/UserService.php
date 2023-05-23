<?php 
namespace App\Services\User;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\User\UserRepository;

class UserService 
{
    public function __construct(protected UserRepository $userRepository)
    {
        
    }
    public function store(array $data)
    {
        
        $data['password'] = bcrypt($data['password']);
        $user = $this->userRepository->create($data);
        if (!empty($data['device_name'])) {
            return (new UserResource($user))
                    ->additional(['token' => $user->createToken($data['device_name'])->plainTextToken]);
        }
        return new UserResource($user);
    }

    
    public function getAll()
    {
        return $this->userRepository->paginate();
    }

    public function getByUuid($id)
    { 
        return $this->userRepository->firstOrFail('uuid',$id);
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