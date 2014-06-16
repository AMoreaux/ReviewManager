<?php

namespace Emiage\ReviewManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Response;

use Emiage\ReviewManagerBundle\Entity\Module;
use Emiage\ReviewManagerBundle\Form\ModuleType;

/**
 * Module controller.
 *
 */
class ModuleController extends Controller
{

    /**
     * Lists all Module entities.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EmiageReviewManagerBundle:Module')->findAll();

        return $this->render('EmiageReviewManagerBundle:Module:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Module entity.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function createAction(Request $request)
    {
        $entity = new Module();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('module_show', array('id' => $entity->getId())));
        }

        return $this->render('EmiageReviewManagerBundle:Module:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Module entity.
    *
    * @param Module $entity The entity
    *@Secure(roles="ROLE_ADMIN")
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Module $entity)
    {
        $form = $this->createForm(new ModuleType(), $entity, array(
            'action' => $this->generateUrl('module_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Module entity.
     *@Secure(roles="ROLE_ADMIN")
     */
    public function newAction()
    {
        $entity = new Module();
        $form   = $this->createCreateForm($entity);

        return $this->render('EmiageReviewManagerBundle:Module:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Module entity.
     *@Secure(roles="ROLE_ADMIN")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:Module')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Module entity.');
        }

        return $this->render('EmiageReviewManagerBundle:Module:show.html.twig', array(
            'entity'      => $entity,));
    }

    /**
     * Displays a form to edit an existing Module entity.
     *@Secure(roles="ROLE_ADMIN")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:Module')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Module entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('EmiageReviewManagerBundle:Module:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Module entity.
    *
    * @param Module $entity The entity
    *@Secure(roles="ROLE_ADMIN")
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Module $entity)
    {
        $form = $this->createForm(new ModuleType(), $entity, array(
            'action' => $this->generateUrl('module_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Module entity.
     *@Secure(roles="ROLE_ADMIN")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EmiageReviewManagerBundle:Module')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Module entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            $em->flush();

            return $this->redirect($this->generateUrl('module'));
        }

        return $this->render('EmiageReviewManagerBundle:Module:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Module entity.
     *@Secure(roles="ROLE_ADMIN")
     */
    public function deleteAction(Request $request, $id)
    {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EmiageReviewManagerBundle:Module')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Module entity.');
            }

            $em->remove($entity);
            $em->flush();

        return $this->redirect($this->generateUrl('module'));
    }

    /**
     *@Secure(roles="ROLE_PROF")
     */
    public function downloadAction($slug)
    {
        $file = $slug;
        $path = "../../ReviewManager/web/uploads/documents/Modules/";

        $response = new Response();
        $response->setContent(file_get_contents($path.$file));
        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-disposition', 'filename='. $file);

        return $response;
    }

}
