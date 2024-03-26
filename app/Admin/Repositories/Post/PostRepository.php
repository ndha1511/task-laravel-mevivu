<?php
namespace App\Admin\Repositories\Post;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Models\Post;

class UserRepository extends EloquentRepository implements PostRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return Post::class;
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}

?>