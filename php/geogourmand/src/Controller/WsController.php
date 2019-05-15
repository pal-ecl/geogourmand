<?php
/**
 * Created by PhpStorm.
 * User: Wizpaul
 * Date: 24/04/2019
 * Time: 16:14
 */

namespace App\Controller;


use App\Components\HttpClient\Adapter\GuzzleAdapter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Components\HttpClient\Client;
use App\Components\HttpClient\TableFactory;
use App\Components\Table2\Format\Html;
use Symfony\Component\HttpFoundation\Response;
use App\Components\Excel\ExcelWriter;
use App\Components\Table2\Format\Excel;
use App\Controller\AppController;


class WsController extends AbstractController
{

    /**
     * @Route("/ws/map", name="ws.map")
     */
    public function map()
    {
        return $this->redirectToRoute("homepage");
    }
}