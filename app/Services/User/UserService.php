<?php 
namespace App\Services\User;
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
        return $this->userRepository->create($data);
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