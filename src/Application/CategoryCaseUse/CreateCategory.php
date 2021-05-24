<?php

namespace Src\Application\CategoryCaseUse;

use Src\Domain\Interfaces\CategoryInterfaces\CategoryRepository;
use Src\Domain\Models\Category;

final class CreateCategory
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($title, $description)
    {
        $category = new Category($title, $description);
        return $this->repository->create($category);
    }
}
