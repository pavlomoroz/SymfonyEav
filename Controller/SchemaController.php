<?php

namespace Enviroment\EavBundle\Controller;

use Enviroment\EavBundle\Entity\Definition;
use Enviroment\EavBundle\Entity\Schema;
use Enviroment\EavBundle\Form\DefinitionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class SchemaController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $schemas = $em->getRepository('EnviromentEavBundle:Schema')->findAll();

        $this->getEntitiesName($schemas);

        return $this->render(
            "EnviromentEavBundle:Schema:index.html.twig",
            array(
                'schemas' => $schemas
            )
        );
    }

    public function newAction(Schema $schema)
    {
        $definition = new Definition();

        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new DefinitionType(), $definition);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $definition = $form->getData();

                $definition->setSchema($schema);

                $em->persist($definition);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('Save successful!'));

                return $this->redirect($this->generateUrl('enviroment_eav_homepage'));
            } else {
                $this->get('session')->getFlashBag()->add('error', $this->get('translator')->trans('Save unsuccessful!'));
            }
        }

        return $this->render("EnviromentEavBundle:Schema:edit.html.twig", array('form' => $form->createView()));
    }

    public function editAction(Request $request, Definition $definition)
    {
        $form = $this->createForm(new DefinitionType(), $definition);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $definition = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($definition);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('Save successful!'));

            return $this->redirect($this->generateUrl('enviroment_eav_homepage'));
        }

        return $this->render(
            "EnviromentEavBundle:Schema:edit.html.twig",
            array(
                'form'   => $form->createView(),
            )
        );
    }

    public function deleteAction(Definition $definition)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($definition);
        $em->flush();

        $this->get('session')
            ->getFlashBag()
            ->add('success', $this->get('translator')->trans('Attribute was successfully deleted!'));

        return $this->redirect($this->generateUrl('enviroment_eav_homepage'));
    }

    public function difinitionsAction(Schema $schema)
    {
        $encoder = new JsonEncoder();
        $normalizer = new GetSetMethodNormalizer();
        $normalizer->setIgnoredAttributes(['schema', 'attributes', 'options', 'orderIndex']);

        $serializer = new Serializer([$normalizer], [$encoder]);

        return new JsonResponse($serializer->serialize($schema->getDefinitions()->toArray(), 'json'));
    }

    protected function getEntitiesName($entities)
    {
        foreach ($entities as $entity) {
            $entity->setClassName(substr($entity->getClassName(), strrpos($entity->getClassName(), '\\') + 1));
        }
    }
}