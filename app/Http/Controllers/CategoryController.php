<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        return new JsonResponse([
            'status' => Response::HTTP_OK,
            'data' => Category::all()
        ]);
    }

    public function view($id): JsonResponse
    {
        $category = Category::find($id);
        if ($category)
        {
            return new JsonResponse([
                'status' => Response::HTTP_OK,
                'data' => $category
            ]);
        }
        else
        {
            return new JsonResponse([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'data' => 'Element not found'
            ]);
        }
    }

    public function store(\Symfony\Component\HttpFoundation\Request $request): JsonResponse
    {
        try {

            $category = Category::create($request->all());

            return new JsonResponse([
                'status' => Response::HTTP_OK,
                'data' => $category
            ]);

        } catch (\Exception $e) {
            return new JsonResponse([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {

            $category = Category::find($id);
            if ($category) {
                $category->update($request->all());

                return new JsonResponse([
                    'status' => Response::HTTP_OK,
                    'data' => $category
                ]);
            }
            else {
                return new JsonResponse([
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'data' => 'There isn\'t any category with this id'
                ]);
            }

        } catch (\Exception $e) {
            return new JsonResponse([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function trash($id): JsonResponse
    {
        try {

            $category = Category::find($id);
            if ($category) {
                $category->delete();
            } else {
                return new JsonResponse([
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'data' => 'There isn\'t any category with this id'
                ]);
            }

            return new JsonResponse([
                'status' => Response::HTTP_OK,
                'data' => $category
            ]);

        } catch (\Exception $e) {
            return new JsonResponse([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'data' => $e->getMessage()
            ]);
        }
    }

    public function delete($id): JsonResponse
    {
        try {

            $category = Category::find($id);
            if ($category) {
                $category->forceDelete();
            } else {
                return new JsonResponse([
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'data' => 'There isn\'t any category with this id'
                ]);
            }

            return new JsonResponse([
                'status' => Response::HTTP_OK,
                'data' => $category
            ]);

        } catch (\Exception $e) {
            return new JsonResponse([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'data' => $e->getMessage()
            ]);
        }
    }
}
