<?php
namespace App\Controller\History;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HistoryController extends AbstractController
{
    /**
     * @Route("/history-order", name="app_historyorder")
    */
    public function historyOrderpage()
    {
        return $this->render('history/historyorder.html.twig');
    }

    /**
     * @Route("/history-view", name="app_historyview")
    */
    public function historyViewgpage()
    {
        return $this->render('history/historyview.html.twig');
    }
}
