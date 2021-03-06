<?php

namespace AppBundle\Controller;

use AppBundle\Builder\Service as ServiceBuilder;
use AppBundle\Services\Service;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class ServiceController extends AbstractController
{
    /**
     * @var String
     */
    protected $serviceName = Service::class;

    /**
     * @var String
     */
    protected $builder = ServiceBuilder::class;

    protected static function getListSubscribedServices():array
    {
        return [Service::class, ServiceBuilder::class];
    }

    /**
     * @Rest\Get("/service")
     * @return View
     */
    public function getAllAction(): View
    {
        return parent::getAllAction();
    }

    /**
     * @Rest\Get("/service/{id}")
     *
     * @param int $id
     * @throws NotFoundHttpException
     * @return View
     */
    public function getAction($id): View
    {
        return parent::getAction($id);
    }

    /**
     * @Rest\Post("/service")
     *
     * @return View
     */
    public function postAction(): View
    {
        return parent::postAction();
    }
}
