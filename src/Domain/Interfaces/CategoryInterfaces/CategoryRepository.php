<?php


namespace Src\Domain\Interfaces\CategoryInterfaces;


use Src\Domain\Models\Category;

interface CategoryRepository
{
    public function show($id);
    public function create(Category $category);
}
