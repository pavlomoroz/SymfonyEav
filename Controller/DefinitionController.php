<?php

namespace Enviroment\EavBundle\Controller;

use Enviroment\EavBundle\Entity\Definition;
use Enviroment\EavBundle\Form\DefinitionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefinitionController extends Controller
{

    public function indexAction()
    {
        $definitions = $this->getDoctrine()->getRepository('EnviromentEavBundle:Definition')->findAll();

        return $this->render('EnviromentEavBundle:Definition:index.html.twig', ['entities' => $definitions]);
    }

    public function newAction(Request $request)
    {
        $definition = new Definition();
        $definition->setSchema($this->get('enviroment.eav.entity')->getAttributeSchema());

        $form = $this->createForm(new DefinitionType(), $definition);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($definition);
            $em->flush();

            return $this->redirect($this->generateUrl('enviroment_eav_homepage'));
        }

        return $this->render('EnviromentEavBundle:Definition:new.html.twig', ['form' => $form->createView()]);
    }

    public function editAction(Definition $definition, Request $request)
    {
        $form = $this->createForm(new DefinitionType(), $definition);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('enviroment_eav_homepage'));
        }

        return $this->render(
            'EnviromentEavBundle:Definition:edit.html.twig',
            [
                'form' => $form->createView(),
                'definition' => $definition
            ]
        );
    }

    public function deleteAction(Definition $definition)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($definition);
        $em->flush();

        return $this->redirect($this->generateUrl('enviroment_eav_homepage'));
    }
}