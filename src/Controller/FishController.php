<?php

namespace App\Controller;

use App\Entity\Fish;
use App\Repository\FishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FishController extends AbstractController
{
    /**
     * 2. Consultez le template home.html.twig
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render(
            'home.html.twig',
            [
                'message' => "3. Consultez base.html.twig, observez le lien qui redirige sur searchFish",
            ]);
    }

    /**
     * 5. Cette méthode va générer un template search, qui va accueillir notre code React.
     * Consultez le template search.html.twig
     * @Route("/fish", name="searchFish")
     */
    public function displayComponent(): Response
    {
        return $this->render('search.html.twig');
    }

    /**
     * Cette méthode ne renvoie que des données au format Json, nous n'utilisons plus l'API, nous SOMMES l'API !
     * @Route("/searchfish")
     * @param FishRepository $fishRepository
     * @param Request $request
     * @return JsonResponse
     */
    public function getRequest(FishRepository $fishRepository, Request $request): JsonResponse
    {
        $searchedLetters = $request->get('chain');

        // Récupération des données depuis la base
        // Problème : Les champs de Fish sont privés. Donc on ne peut pas envoyer les infos comme ça.

        // Cette méthode findBy est personnalisée. Allez la voir pour plus d'informations.
        $fishesListFromBase = $fishRepository->findBySearchedWords($searchedLetters);

        // Création d'un tableau qui va accueillir les données formattées
        $formattedFishes = [];

        foreach($fishesListFromBase as $fish) {
            // On récupère ses valeurs,
            $fishValues = [
                "name" => $fish->getName(),
                "maxAge" => $fish->getMaxAge(),
                "water" => $fish->getWater(),
            ];

            // Et on les ajoute dans le tableau $formatedFishes
            $formattedFishes[] = $fishValues;
        }

        return new JsonResponse($formattedFishes);
    }
}
