<?php 
namespace App\Repositories\User;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\User\UserRepositoryInterface;


class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function permissionUser($field,$uuid)
    {
       return $this->model->with('permissions')->where($field,$uuid)->first();
    }

    public function userHasPermission($user,$permission)
    {
        return $user->permissions()->where('name',$permission)->first() ? true : false;
    }
    public function addPermissionUser($request)
    {
        
        $user = $this->model->where('uuid',$request['user'])->first(); 
        return $user->permissions()->sync($request['permissions']);
    }
    
}

?>