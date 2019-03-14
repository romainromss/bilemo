<?php
declare(strict_types=1);

/*
 * This file is part of the Bilemo project.
 *
 * (c) Romain Bayette <romainromss@posteo.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Actions\Phones;

use AppBundle\Actions\AbstractAction;
use AppBundle\Domains\Phones\DetailsPhone\LoaderDetailPhone;
use AppBundle\Domains\Phones\DetailsPhone\RequestResolverDetailsPhone;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DetailPhoneAction.
 *
 * @author Romain Bayette <romainromss@posteo.net>
 */
class DetailPhoneAction extends AbstractAction
{
    /**
     * @var LoaderDetailPhone
     */
    private $loader;
    /**
     * @var RequestResolverDetailsPhone
     */
    private $requestResolver;

    public  function __construct(
        LoaderDetailPhone $loader,
        RequestResolverDetailsPhone $requestResolver
    ) {
        $this->loader = $loader;
        $this->requestResolver = $requestResolver;
    }

    /**
     * @Route("/phones/{id}", name="details_phones", methods={"GET"})
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \ReflectionException
     */
    public function DetailPhone(Request $request)
    {
        $input = $this->requestResolver->resolver($request);
        $data = $this->loader->load($input);
        return $this->sendResponse($data);
    }

}
