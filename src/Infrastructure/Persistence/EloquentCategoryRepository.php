<?php


namespace Src\Infrastructure\Persistence;


use Src\Domain\Interfaces\CategoryInterfaces\CategoryRepository;
use Src\Domain\Models\Category;
use Src\Infrastructure\ORMConnect\CategoryORMConnect;

final class EloquentCategoryRepository implements CategoryRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new CategoryORMConnect();
    }

    public function create(Category $category)
    {
        return $this->model::create([
            'title'       => $category->getTitle(),
            'description' => $category->getDescription()
        ]);

    }

    public function show($id)
    {
        return $this->model::findOrFail($id);
    }
}
