<?php


namespace Src\Application\CategoryCaseUse;


use Src\Domain\Interfaces\CategoryInterfaces\CategoryRepository;

class ShowCategory
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        return $this->repository->show($id);
    }
}
