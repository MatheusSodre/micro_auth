<?php 
namespace App\Repositories\Interfaces\User; 
interface UserRepositoryInterface 
{
    public function permissionUser(string $field,string $uuid);
    public function HasPermission(string $user,string $permission);
    public function addPermissionUser(array $permission);
}

?>