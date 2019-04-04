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
     * @Route("/clients/{id_client}/users", name="list_users", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ListUsers()
    {
        $datas =  $this->loader->load();
        return $this->sendResponse($datas);
    }
}
