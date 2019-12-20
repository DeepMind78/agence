<?php 

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PropertyController extends AbstractController {

    private $repo;

    public function __construct(PropertyRepository $repo){
            $this->repo = $repo;
    }
    // Possible de mettre aussi l'entityManager ou ObjectManager ici pour y accéder globalemen dans toute la classe.

    /**
     * @Route("/biens", name="property.index")
     */
    public function index(EntityManagerInterface $manager, PaginatorInterface $paginator, Request $request)
    {
        $propertiesQuery = $this->repo->findAllVisible();
        // dump($property);
        $properties = $paginator->paginate(
            $propertiesQuery,
            $request->query->getInt('page',1),
            12
        );

        return $this->render('property/index.html.twig',[
            "current_menu" => 'porperties',
            'properties' => $properties
        ]);
    }

    /**
     * @Route("/biens/{id}/{slug}", name="property.show", requirements={"slug":"[a-z0-9\-]*"})
     */
    public function show(string $slug, Property $property)
    {   
        if($property->getSlug()!==$slug){
            return $this->redirectToRoute('property.show',[
                'id' => $property->getId(),
                'slug'=>$property->getSlug()
            ], 301);
        }
        // $property = $this->repository->find($id);
        return $this->render('property/show.html.twig',[
            "property" => $property,
            "current_menu" => 'properties'
        ]);
    }
}