<?php 
namespace App\Repositories\Permissions;
use App\Models\Permission\Resource;
use App\Repositories\BaseRepository;

class ResourceRepository extends BaseRepository
{
    public function __construct(Resource $resource)
    {
        $this->model = $resource;
    }
}
?>