<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class dans le controller qui permet de générer du contenu HTML dans le template/la vue, ici home.html.twig, grâce à la fonction render() présente dans AbstractController mis à dispositon par Symfony
 */
class HomeController extends AbstractController
{
    // Définir la route pour le navigateur
    #[Route('/', 'home.index', methods : ['GET'])]
    public function index(): Response 
    {
        return $this->render('home.html.twig');
    }
}
?>