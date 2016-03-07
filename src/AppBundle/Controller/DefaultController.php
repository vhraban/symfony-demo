<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Application;
use AppBundle\Form\Type\ApplicationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * Index action that is called on an app home page
     *
     * @param Request $request Request instance
     *
     * @return Response HTTPFoundation Response
     */
    public function indexAction(Request $request)
    {
        $application = new Application();
        $form = $this->createForm(ApplicationType::class, $application);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($application);
            $em->flush();
            return $this->render('AppBundle:Default:thanks.html.twig',
                [
                    "application" => $application
                ]
            );

        }


        return $this->render('AppBundle:Default:index.html.twig',
                [
                    "form" => $form->createView()
                ]
            );
    }
}
