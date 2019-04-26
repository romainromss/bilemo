<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-21
 * Time: 19:44
 */

namespace AppBundle\Actions\Users;


use AppBundle\Actions\AbstractAction;
use AppBundle\Domains\Users\DetailsUser\LoaderDetailsUser;
use AppBundle\Domains\Users\DetailsUser\RequestResolverDetailsUser;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class DetailsUserAction extends AbstractAction
{
    /**
     * @var LoaderDetailsUser
     */
    private $loader;
    /**
     * @var RequestResolverDetailsUser
     */
    private $requestResolver;

    public  function __construct(
        LoaderDetailsUser $loader,
        RequestResolverDetailsUser $requestResolver
    ) {
        $this->loader = $loader;
        $this->requestResolver = $requestResolver;
    }

    /**
     * Details of one User for a Client.
     *
     * @Route("/clients/{client_id}/users/{user_id}", name="details_user", methods={"GET"})
     *
     * @SWG\Response(
     *     response="200",
     *     description="details  one user.",
     *      @SWG\Schema(ref=@Model(type=AppBundle\Entity\Users::class, groups={"details_user"}))
     * )
     *
     * @SWG\Response(
     *     response="404",
     *     description="No user found check your parameters."
     * )
     *
     * @SWG\Parameter(
     *     name="client",
     *     in="path",
     *     type="string",
     *     description="Id client."
     * )
     *
     * @SWG\Parameter(
     *     name="user",
     *     in="path",
     *     type="string",
     *     description="Id user."
     * )
     *
     * @SWG\Tag(name="User")
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
