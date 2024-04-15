<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(
        UserRepository $userRepo,
        JWTTokenManagerInterface $JWTManager,
        #[Autowire(service: 'lexik_jwt_authentication.handler.authentication_success')]
        AuthenticationSuccessHandler $handler,
    ): JsonResponse
    {
        $user = $userRepo->find(1);
        $jwt = $JWTManager->createFromPayload($user, ['a' => 'b']);

        return $handler->handleAuthenticationSuccess($user, $jwt);
    }

    #[Route('/parse', name: 'app_parse')]
    public function parse(JWTTokenManagerInterface $JWTManager): JsonResponse
    {
        dd($JWTManager->parse('eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE3MTIzOTIzNzQsImV4cCI6MTcxMjM5NTk3NCwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6ImFkbWluQGV4YW1wbGUuY29tIn0.SE-wb5q5hFyc7n6QVgd8tFdBlU18Nit-4S6kfWx5PPuSErPLdh7MnFPW3-kHeXj7mUNt_mhzXYX21QID1PB9TMAwN1GsBFQ7V9mLtgo8WIXqsdAwfd17gWVGl2RmDwA_ClWqKe-BuEOsDfUEMlZMjNKypXsBIXdrC4S8FdAzUNddOi4oYaAA3qdfbJ6OqeHsZW785ya-By2Ny5fcIyLFohY8iPXLZCXQ8oTdElJgRGZmuMRRz70VEUYAleO5Go9p2ktadRw0uXN9H5fojX8aBbxCw3-zXOTCFfR5e94wjW1tbVd2osqcaOdnN0kLpPAYEXo20xftipSY4UG4c7SecQ'));

        return $this->json([]);
    }
}
