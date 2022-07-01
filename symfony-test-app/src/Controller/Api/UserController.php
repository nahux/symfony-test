<?php
namespace App\Controller\Api;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @route("/api/user")
 */
class UserController extends AbstractController
{
    /**
     * List all available users
     *
     * @Route("/", name="user_list", methods={"GET"})
     */
    public function list(): JsonResponse
    {
        $users = [
            [
                "id" => 1,
                "name" => "Lily",
            ],
            [
                "id" => 2,
                "name" => "Theo",
            ],
        ];
        return new JsonResponse($users, 200, []);
    }

    /**
     * Show requested User data
     *
     * @Route(
     *  "/{id}",
     *  name="user_show",
     *  methods={"GET"},
     *  condition="params['id'] < 1000"
     * )
     * Added condition just to test
     */
    public function show(int $id): JsonResponse
    {
        $users = [
            1 => [
                "id" => 1,
                "name" => "Lily",
            ],
            2 => [
                "id" => 2,
                "name" => "Theo",
            ],
        ];
        $user = $users[$id] ?? [];
        return new JsonResponse($user, 200, []);
    }
}
