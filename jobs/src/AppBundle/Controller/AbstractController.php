<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class AbstractController extends AbstractFOSRestController
{
//region SECTION: Fields
    /**
     * @var String
     */
    protected $serviceName;

    /**
     * @var String
     */
    protected $builder;

    /**
     * @var Request
     */
    protected $request;
//endregion Fields

//region SECTION: Constructor
    /**
     * AbstractController constructor.
     *
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
    }
//endregion Constructor

//region SECTION: Public
    /**
     * @return View
     */
    public function postAction(): View
    {
        $parameters      = $this->request->request->all();
        $entity          = $this->builder::build($parameters);
        $persistedEntity = $this->container->get($this->serviceName)->create($entity);

        return new View(
            $persistedEntity,
            Response::HTTP_CREATED
        );
    }

    /**
     * @param String $id
     *
     * @return View
     */
    public function putAction(string $id): View
    {
        $params          = $this->request->request->all();
        $params['id']    = $id;
        $entity          = $this->builder::build($params);
        $persistedEntity = $this->container->get($this->serviceName)->update($entity);

        return new View(
            $persistedEntity,
            Response::HTTP_OK
        );
    }
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @return View
     */
    public function getAllAction(): View
    {
        return new View(
            $this->container->get($this->serviceName)->findAll(),
            Response::HTTP_OK
        );
    }

    /**
     * @param $id
     *
     * @return View
     */
    public function getAction($id): View
    {
        $entity = $this->container->get($this->serviceName)->find($id);
        if (!$entity) {
            throw new NotFoundHttpException(
                sprintf(
                    'The resource \'%s\' was not found.',
                    $id
                )
            );
        }

        return new View(
            $entity,
            Response::HTTP_OK
        );
    }
//endregion Getters/Setters
}
