<?php

namespace Pongtan\Http;

use Pongtan\View\Factory;

class Controller
{
    public $view;

    public $smarty;

    public function construct__()
    {

    }

    public function smarty()
    {
        $this->smarty = Factory::newSmarty();
        return $this->smarty;
    }

    public function view()
    {
        return $this->smarty();
    }

    /**
     * @param $response
     * @param $res
     * @return mixed
     */
    public function echoJson($response, $res)
    {
        return $response->getBody()->write(json_encode($res));
    }
}