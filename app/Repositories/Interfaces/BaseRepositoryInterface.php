<?php
namespace App\Repositories\Interfaces;

 interface BaseRepositoryInterface
 {
    public function all();
    public function paginate($relations = [], $limit = null, $columns = ['*']);
    public function create(array $data);
    public function first($field ,$id);
    public function firstOrFail($field ,$id);
    public function update(array $data,$field, $id);
    public function delete($field,$id);
    public function updateOrCreate(array $attributes, array $values);
    public function get(array $condition = [], bool $takeOne = true);
 }
?>
