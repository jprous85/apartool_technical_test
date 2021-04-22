<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApartmentController extends Controller
{
    public function index(): JsonResponse
    {
        return new JsonResponse([
            'status' => Response::HTTP_OK,
            'data' => Apartment::all()
        ]);
    }

    public function view($id): JsonResponse
    {
        $apartment = Apartment::find($id);
        if ($apartment)
        {
            return new JsonResponse([
                'status' => Response::HTTP_OK,
                'data' => $apartment
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

    public function store(Request $request): JsonResponse
    {
        try {

            $apartment = Apartment::create($request->all());

            return new JsonResponse([
                'status' => Response::HTTP_OK,
                'data' => $apartment
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

            $apartment = Apartment::findOrFail($id);
            $apartment->update($request->all());

            return new JsonResponse([
                'status' => Response::HTTP_OK,
                'data' => $apartment
            ]);

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

            $apartment = Apartment::find($id);
            if ($apartment) {
                $apartment->delete();
            } else {
                return new JsonResponse([
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'data' => 'There isn\'t apartment for this id'
                ]);
            }
            return new JsonResponse([
                'status' => Response::HTTP_OK,
                'data' => $apartment
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

            $apartment = Apartment::findOrFail($id);
            if ($apartment) {
                $apartment->forceDelete();
            } else {
                return new JsonResponse([
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'data' => 'There isn\'t apartment for this id'
                ]);
            }

            return new JsonResponse([
                'status' => Response::HTTP_OK,
                'data' => $apartment
            ]);

        } catch (\Exception $e) {
            return new JsonResponse([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'data' => $e->getMessage()
            ]);
        }
    }
}
