<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Application;
use AppBundle\Form\Type\ApplicationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $application = new Application();
        $form = $this->createForm(ApplicationType::class, $application);

        return $this->render('AppBundle:Default:index.html.twig',
                [
                    "form" => $form->createView()
                ]
            );
    }
}
