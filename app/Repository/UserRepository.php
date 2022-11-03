<?php

namespace App\Repository;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;


//class UserRepository implements UserRepositoryInterface
//{
//    public function getAll()
//    {
//        return User::all();
//    }
//
//    public function getById($id)
//    {
//        return User::findOrFail($id);
//    }
//
//    public function delete($id)
//    {
//        User::destroy($id);
//    }
//
//    public function create(array $data)
//    {
//        return User::create($data);
//    }
//
//    public function update($id, array $newDetails)
//    {
//        return User::whereId($id)->update($newDetails);
//    }
//
//}
 class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
