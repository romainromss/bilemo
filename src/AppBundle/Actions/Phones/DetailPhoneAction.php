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
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

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
     * Details of phone.
     *
     * @Route("/phones/{id}", name="details_phones", methods={"GET"})
     *
     * @SWG\Response(
     *     response="200",
     *     description="Return the details of  one phone.",
     *     @SWG\Schema(ref=@Model(type=AppBundle\Entity\Phone::class, groups={"details_phone"}))
     * )
     *
     * @SWG\Response(
     *     response="404",
     *     description="No phone found, check your parameters."
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="string",
     *     description="Id Phone"
     * )
     *
     *
     * @SWG\Tag(name="Phone")
     * @Security(name="Bearer")
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
        return $this->sendResponse($data, 200, [], true);
    }
}
