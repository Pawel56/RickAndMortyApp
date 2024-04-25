<?php

namespace App\Controller;

use App\Helper\CharactersHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class CharactersController extends AbstractController
{
    private CharactersHelper $charactersHelper;

    public function __construct(CharactersHelper $charactersHelper)
    {
        $this->charactersHelper = $charactersHelper;
    }
    
    #[Route('/', name: 'app_characters')]
    public function index()
    {
        $characters = array();
        $result = $this->charactersHelper->getCharacters(1, 'info');
        $info = $result;
        $counter = 1;

        do{
            $result = $this->charactersHelper->getCharacters($counter, 'results');
            for($i = 0; $i < sizeof($result); $i+=1)array_push($characters, $result[$i]);
            $counter+=1;
        }while($counter <= $info['pages']);
        return $this->render('index.html.twig', array(
            'characters' => $characters
        ));
    }
}
