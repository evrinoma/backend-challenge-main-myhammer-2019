<?php

namespace AppBundle\Controller;

use AppBundle\Builder\Job as JobBuilder;
use AppBundle\Services\Job;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class JobController extends AbstractController
{
    /**
     * @var String
     */
    protected $serviceName = Job::class;

    /**
     * @var String
     */
    protected $builder = JobBuilder::class;

    /**
     * @Rest\Get("/job")
     *
     * @param Request $request
     * @return View
     */
    public function getAllFilteringAction(Request $request): View
    {
        return new View(
            $this->container->get($this->serviceName)->findAll($request->query->all()),
            Response::HTTP_OK
        );
    }

    /**
     * @Rest\Get("/job/{id}")
     *
     * @param $id
     * @throws NotFoundHttpException
     * @return View
     */
    public function getAction($id): View
    {
        return parent::getAction($id);
    }

    /**
     * @Rest\Post("/job")
     */
    public function postAction(Request $request): View
    {
        return parent::postAction($request);
    }

    /**
     * @Rest\Put("/job/{id}")
     *
     * @param String $id
     * @param Request $request
     * @return View
     */
    public function putAction(String $id, Request $request): View
    {
        return parent::putAction($id, $request);
    }
}
