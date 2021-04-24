<?php

namespace AppBundle\Controller;

use AppBundle\Builder\Job as JobBuilder;
use AppBundle\Services\Job;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class JobController extends AbstractController
{
//region SECTION: Fields
    /**
     * @var String
     */
    protected $serviceName = Job::class;

    /**
     * @var String
     */
    protected $builder = JobBuilder::class;
//endregion Fields

//region SECTION: Public
    /**
     * @Rest\Post("/job")
     */
    public function postAction(): View
    {
        return parent::postAction();
    }

    /**
     * @Rest\Put("/job/{id}")
     *
     * @param String $id
     *
     * @return View
     */
    public function putAction(string $id): View
    {
        return parent::putAction($id);
    }
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @Rest\Get("/job")
     *
     * @return View
     */
    public function getAllAction(): View
    {
        return new View(
            $this->container->get($this->serviceName)->findAll($this->request->query->all()),
            Response::HTTP_OK
        );
    }

    protected static function getListSubscribedServices():array
    {
        return [Job::class, JobBuilder::class];
    }

    /**
     * @Rest\Get("/job/{id}")
     *
     * @param $id
     *
     * @return View
     * @throws NotFoundHttpException
     */
    public function getAction($id): View
    {
        return parent::getAction($id);
    }
//endregion Getters/Setters
}
