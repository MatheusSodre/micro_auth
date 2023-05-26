<?php 
namespace App\Services\Permissions;
use App\Http\Resources\Permissions\MenuResource;
use App\Repositories\Permissions\ResourceRepository;


class ResourceService
{
    public function __construct(protected ResourceRepository $resourceRepository) 
    {
    }

    public function all()
    {
        return $this->resourceRepository->get(['permissions'],false);
    }
}

?>