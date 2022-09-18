<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\UX\Chartjs\Model\Chart;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChartjsController extends AbstractController
{
    

    #[Route('/chartjs', name: 'app_chartjs')]
    public function index(ChartBuilderInterface $chartBuilder, BookRepository $repo): Response
    {
        $places = $repo->placeNotNull();
        $dates = $repo->dateNotNull();
       
        $goupByPlace = [];
        # groupe data by publication_place
        foreach ($places as $book) {
            $goupByPlace[$book->getPublicationPlace()][] = $book;
        }

        foreach ($dates as $book) {
            $goupByDate[$book->getPublicationDate()][] = $book;
        }

       $xPlace =  [];
       $yPlace =array_keys($goupByPlace);
       foreach ($goupByPlace as $item){
        $xPlace[] = count($item);
       }

       $xDate =  [];
       $yDate =array_keys($goupByDate);
       foreach ($goupByDate as $item){
        $xDate[] = count($item);
       }
      

        $chartBar = $chartBuilder->createChart(Chart::TYPE_BAR);
        $chartBar->setData([
            'labels' => $yPlace,
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $xPlace,
                ],
            ],
        ]);

        $chartBar->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 10,
                ],
            ],
        ]);
        

        
        return $this->render('chartjs/index.html.twig', [
            'chartBar' => $chartBar,
        ]);
    }

    
}


