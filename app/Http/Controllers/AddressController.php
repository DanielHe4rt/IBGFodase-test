<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Repository\AddressRepository;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    private AddressRepository $repository;

    public function __construct(AddressRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAddresses()
    {
        return response()->json(
            $this->repository->paginate()
        );
    }

    public function postAddress(CreateAddressRequest $request)
    {
        $payload = $request->validated();

        return response()->json(
            $this->repository->create($payload),
            Response::HTTP_CREATED
        );
    }

    public function getAddress(int $address)
    {
        return response()->json(
            $this->repository->find($address)
        );
    }

    public function putAddress(UpdateAddressRequest $request, int $address)
    {
        $payload = $request->validated();

        return response()->json(
            $this->repository->update($address, $payload)
        );
    }

    public function deleteAddress(int $address)
    {
        return response()->json(
            $this->repository->delete($address),
            Response::HTTP_NO_CONTENT
        );
    }
}
