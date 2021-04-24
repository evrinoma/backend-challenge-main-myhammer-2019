<?php

namespace AppBundle\Controller;

use AppBundle\Builder\Zipcode as ZipcodeBuilder;
use AppBundle\Services\Zipcode;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class ZipcodeController extends AbstractController
{
    /**
     * @var String
     */
    protected $serviceName = Zipcode::class;

    /**
     * @var String
     */
    protected $builder = ZipcodeBuilder::class;

    protected static function getListSubscribedServices():array
    {
        return [Zipcode::class, ZipcodeBuilder::class];
    }

    /**
     * @Rest\Get("/zipcode")
     * @return View
     */
    public function getAllAction(): View
    {
        return parent::getAllAction();
    }

    /**
     * @Rest\Get("/zipcode/{id}")
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
     * @Rest\Post("/zipcode")
     */
    public function postAction(): View
    {
        return parent::postAction();
    }
}
