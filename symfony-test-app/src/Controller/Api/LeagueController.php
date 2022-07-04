<?php

namespace App\Controller\Api;

use App\Entity\League;
use App\Repository\LeagueRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/league')]
class LeagueController extends AbstractController
{
    private $repository;

    public function __construct(LeagueRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('/', name: 'league_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $leagueList = $this->repository->findAll();

        return new JsonResponse($leagueList);
    }

    #[Route('/{id}', name: 'league_show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $league =  $this->repository->find($id);
        if (!$league) {
            return new JsonResponse(null, 404);
        }

        return new JsonResponse($league);
    }

    #[Route('/edit/{id}', name: 'league_edit', methods: ['POST'])]
    public function update(int $id, Request $request): JsonResponse
    {
        die(print_r($request->request, true));
        $league =  $this->repository->find($id);
        if (!$league) {
            return new JsonResponse(null, 404);
        }

        return new JsonResponse('test', 200);
    }

    #[Route('/delete/{id}', name: 'league_delete', methods: ['POST'])]
    public function delete(int $id): JsonResponse
    {
        $league =  $this->repository->find($id);
        if (!$league) {
            return new JsonResponse(null, 404);
        }

        $this->repository->remove($league);

        return new JsonResponse('League was removed successfully', 200);
    }
}
