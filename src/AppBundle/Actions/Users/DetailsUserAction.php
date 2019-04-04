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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/clients/{client_id}/users/{user_id}", name="details_user", methods={"GET"})
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
