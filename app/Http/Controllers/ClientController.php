<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\UserDTO;
use App\Http\Requests\ClientDeleteRequest;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Resources\ClientResource;
use App\Models\User;
use App\Services\ClientService;

class ClientController extends Controller
{
    function __construct(
        public ClientService $clientService = new ClientService()
    ){}

    public function index()
    {
        return ClientResource::collection(
            User::client()->get()
        );
    }

    public function show(User $client)
    {
        return ClientResource::make(
            $client->load('activeLoans.book')
        );
    }

    public function store(ClientStoreRequest $request)
    {
        $client = ClientResource::make(
            $this->clientService->store(
                UserDTO::fromRequest($request)
            )
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Client created successfully',
            'client' => $client
        ]);
    }

    public function destroy(ClientDeleteRequest $request, User $client)
    {
        $client->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Client deleted successfully'
        ]);
    }
}
