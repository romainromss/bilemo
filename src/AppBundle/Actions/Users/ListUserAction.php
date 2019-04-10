<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-21
 * Time: 19:44
 */

namespace AppBundle\Actions\Users;

use AppBundle\Actions\AbstractAction;
use AppBundle\Domains\Users\ListUsers\LoaderListUsers;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ListUserAction extends AbstractAction
{
    /** @var LoaderListUsers */
    protected $loader;

    /**
     * ListPhonesAction constructor.
     *
     * @param LoaderListUsers $loader
     */
    public function __construct(LoaderListUsers $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @Route("/clients/{client_id}/users", name="list_users", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ListUsers(Request $request)
    {
        $datas =  $this->loader->load($request);
        return $this->sendResponse($datas);
    }
}
