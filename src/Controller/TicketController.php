<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class TicketController extends AbstractController
{
    /**
     * @Route("/ticket", name="ticket")
     */
    public function index(): Response {
		try {
			$connector = new WindowsPrintConnector("POS-58-Series_LPT1");
			$printer = new Printer($connector);
			$printer -> text(" \n");
			try{
				$logo=EscposImage::load("../public/img/logo.jpg",false);
				$printer->bitImage($logo);
			}catch(Exception $e){
				echo "Impossible d'imprimer l'image";
			}
			$printer->text("Code  Des.      PU QTE   MONT \n");
			$printer->text("------------------------------\n");
			$printer->text("BB001 Biere   1.25  20   200 \n");
			$printer->text("BB001 Biere   1.25  20   200 \n");
			$printer->text("BB001 Biere   1.25  20   200 \n");
			$printer->text("BB001 Biere   1.25  20   200 \n");
			$printer->text("BB001 Biere   1.25  20   200 \n");
			$printer->text("BB001 Biere   1.25  20   200 \n");
			$printer->text("BB001 Biere   1.25  20   200 \n");
			$printer -> feed(3);		
			$printer -> cut();
			$printer -> close();
		} catch (Exception $e) {
			echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
		}		
		die;
        return $this->render('ticket/index.html.twig', [
            'controller_name' => 'TicketController',
        ]);
    }
}
