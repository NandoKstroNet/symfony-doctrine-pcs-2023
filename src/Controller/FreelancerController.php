<?php

namespace App\Controller;

use App\Entity\Freelancer;
use App\Repository\FreelancerRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/freelancers', name: 'freelancers')]
class FreelancerController extends AbstractController
{
    #[Route('/', name: '_index', methods: ['GET'])]
    public function index(FreelancerRepository $repository): JsonResponse
    {
        $freelancers = $repository->findAll();

        return $this->json([
            'data' => $freelancers,
        ]);
    }

    #[Route('/{nickname}', name: '_show', methods: ['GET'])]
    public function show(string $nickname, FreelancerRepository $repository): JsonResponse
    {
        $freelancer = $repository->findOneByNickname($nickname);

        if (!$freelancer) {
            return $this->notFoundJson();
        }

        return $this->json([
            'data' => $freelancer
        ]);
    }

    #[Route('/', name: '_create', methods: ['POST'])]
    public function create(EntityManagerInterface $manager): JsonResponse
    {
        $freelancer = new Freelancer();
        $freelancer->setName('Freelancer');
        $freelancer->setNickname('NandoKstroNet');
        $freelancer->setAbout('lorem ipsum');
        $freelancer->setExpertises(['php', 'symfony', 'doctrine']);
        $freelancer->setCreatedAt(new \DateTimeImmutable());
        $freelancer->setUpdatedAt(new \DateTimeImmutable());

        $manager->persist($freelancer);
        $manager->flush();

        return $this->json([], 204);
    }

    #[Route('/{nickname}', name: '_update', methods: ['PUT'])]
    public function update(string $nickname, FreelancerRepository $repository, EntityManagerInterface $manager): JsonResponse
    {
        $freelancer = $repository->findOneByNickname($nickname);

        if (!$freelancer) {
            return $this->notFoundJson();
        }

        $freelancer->setName('Chaged');
        $freelancer->setUpdatedAt(new \DateTimeImmutable());

        $manager->flush();

        return $this->json([
            'message' => sprintf("%s updated", $freelancer->getNickname()),
        ]);
    }

    #[Route('/{nickname}', name: '_delete', methods: ['DELETE'])]
    public function remove(string $nickname, FreelancerRepository $repository, EntityManagerInterface $manager): JsonResponse
    {
        $freelancer = $repository->findOneByNickname($nickname);

        if (!$freelancer) {
            return $this->notFoundJson();
        }

        $manager->remove($freelancer);
        $manager->flush();

        return $this->json([
            'message' => sprintf("%s removed", $freelancer->getNickname()),
        ]);
    }

    private function notFoundJson(string $message = null): JsonResponse
    {
        return $this->json([
            'data' => ['message' => $message ?? 'Not found...'],
        ], 404);
    }
}
