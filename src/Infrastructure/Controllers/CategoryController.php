<?php

namespace Src\Infrastructure\Controllers;

use Src\Infrastructure\Persistence\EloquentCategoryRepository;

use Src\Application\CategoryCaseUse\ShowCategory;
use Src\Application\CategoryCaseUse\CreateCategory;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController
{
    protected $repository;

    public function __construct(EloquentCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function show($id):JsonResponse
    {
        $showCategoryCaseUse = new ShowCategory($this->repository);
        $category = $showCategoryCaseUse->__invoke($id);
        return new JsonResponse(['response' => Response::HTTP_OK, 'data' => $category]);
    }

    public function create(Request $request): JsonResponse
    {
        $createCategoryCaseUse = new CreateCategory($this->repository);
        $category = $createCategoryCaseUse->__invoke($request->request->get('title'), $request->request->get('description'));
        return new JsonResponse(['response' => Response::HTTP_OK, 'data' => $category]);
    }

}
