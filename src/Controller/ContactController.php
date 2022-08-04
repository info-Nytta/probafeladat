<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    private $em;

    public function __construct (EntityManagerInterface $em) {

        $this -> em = $em;    
    }

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {
        $message= new Message();
        $form = $this->createForm(ContactFormType::class, $message);
        $form = $form->handleRequest($request);
        $res = '';

        if ($form->isSubmitted() && $form->isValid())
            {               
                $newMessage = $form->getData();                 
                if ($newMessage->getName()==null || $newMessage->getEmail()==null || $newMessage->getMsg()==null)
                {
                    $res = 'Hiba! Kérjük töltsd ki az összes mezőt!';
                }
                else
                {
                    $this-> em ->persist($newMessage);
                    $this -> em -> flush();
                    $res = 'Köszönjük szépen a kérdésedet. Válaszunkkal hamarosan keresünk a megadott e-mail címen.'; 
                }
            }
        
        return $this->render('contact/index.html.twig',[
            'title'=> 'Kapcsolat',
            'form'=> $form->createView(),
            'msg'=> $res
        ]);
    }
}
