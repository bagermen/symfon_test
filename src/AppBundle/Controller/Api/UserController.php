<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\User;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\Annotations as FOS;

class UserController extends FOSRestController
{
    /**
     * @FOS\Get("/users/{id}")
     *
     * @return \AppBundle\Entity\User
     */
    public function getAction(User $user)
    {
        $view = $this->view($user);
        $view->getContext()->addGroup('user');

        return $view;
    }

    /**
     * @FOS\Get("/users")
     *
     * @return \AppBundle\Entity\User[]
     */
    public function listAction()
    {
        return $this->getDoctrine()
            ->getRepository(User::class)
            ->findAllWithoutPass();
    }

    /**
     * @FOS\Put("/users/{id}/roles")
     *
     * @FOS\RequestParam(name="roles", allowBlank=false)
     *
     * @return \AppBundle\Entity\User
     */
    public function setRolesAction(User $theUser, array $roles)
    {
        $theUser->setRoles($roles);

        $manager = $this->getDoctrine()->getManagerForClass(User::class);

        $manager->flush();

        $view = $this->view($theUser);
        $view->getContext()->addGroup('user');

        return $view;
    }
}