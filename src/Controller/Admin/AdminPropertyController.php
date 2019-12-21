<?php 
namespace App\Controller\Admin;

use App\Entity\Option;
use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminPropertyController extends AbstractController{
    
    private $repo;
    private $manager;

    public function __construct(PropertyRepository $repository, EntityManagerInterface $manager){
        $this->repo = $repository;
        $this->manager=$manager;
    }

    /**
     * @Route ("/admin/all/properties", name="admin.property.index")
     */
    public function index(){
        $properties = $this->repo->findAll();

        return $this->render('admin/property/index.html.twig', [
            'properties'=> $properties
        ]);
    }

    /**
     * @Route("/admin/property/new", name="admin.property.new")
     */
    public function new(Request $request){
        $property = new Property();
        $form = $this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->manager->persist($property);
           $this->manager->flush();
           $this->addFlash('success', 'Bien créé');
           return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/new.html.twig', [
            'property' => $property, 
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/admin/edit/{id}", name="admin.property.edit")
     */
    public function edit(Property $property, Request $request){

        // $option = new Option;
        // $property->addOption($option);

        $form = $this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           $this->manager->flush();
           $this->addFlash('success', 'Bien modifié');
           return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/edit.html.twig', [
            'property' => $property, 
            'form' => $form->createView()
        ]);
    } 

    /**
     * @Route("/admin/delete/{id}", name ="admin.property.delete")
     */
    public function delete(Property $property){
        $this->manager->remove($property);
        $this->manager->flush();
        $this->addFlash('success', 'Bien supprimé');
        return $this->redirectToRoute('admin.property.index');
    }
}