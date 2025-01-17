<?php

namespace App\Admin\Services\Post;

use App\Admin\Repositories\Post\PostRepositoryInterface;
use Illuminate\Http\Request;
use App\Admin\Traits\Setup;


class PostService implements PostServiceInterface
{
    use Setup;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(PostRepositoryInterface $repository){
        $this->repository = $repository;
    }
    
    public function store(Request $request){

        $this->data = $request->validated();
        $this->data['slug'] = $this->createSlug($this->data['title']); 

        return $this->repository->create($this->data);
    }

    public function update(Request $request){
        
        $this->data = $request->validated();

        if(isset($this->data['password']) && $this->data['password']){
            $this->data['password'] = bcrypt($this->data['password']);
        }else{
            unset($this->data['password']);
        }

        return $this->repository->update($this->data['id'], $this->data);

    }

    public function delete($id){
        return $this->repository->delete($id);

    }

}