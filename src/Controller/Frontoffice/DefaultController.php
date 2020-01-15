<?php

namespace App\Controller\Frontoffice;

use App\Repository\BookingRepository;
use DateInterval;
use DatePeriod;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/frontoffice")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="frontoffice_index", methods={"GET"})
     */
    public function index()
    {
        return $this->render('frontoffice/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/bookings/", name="frontoffice_bookings", methods={"POST"})
     */
    public function getBookings(BookingRepository $bookingRepository, Request $request){


        $start = $request->request->get('start');
        $end = $request->request->get('end');
        $result = array();

//        if ($start !== 0 || $end !== 0){

            $bookings = $bookingRepository->findByPeriod($start, $end);

            foreach ($bookings as  $booking){
                $result []= array(
                    'title' => 'booking',
                    'start' => $booking->getCheckInAt()->format('Y-m-d'),
                    'end' => $booking->getCheckOutAt()->modify('+1 day')->format('Y-m-d'),
                    'rendering' => 'background'
                );
            }
//        }

        return new JsonResponse($result);
    }

    /**
     * @Route("/pax/count/by/days/of/period", name="frontoffice_pax_count_by_days_of_period", methods={"POST"})
     */
    public function getPaxCountByDaysOfPeriod(BookingRepository $bookingRepository, Request $request){
        $result = array();
        $start = $request->request->get('start');
        $end = $request->request->get('end');


        $begin = new DateTime($start);
        $end = new DateTime($end);
        //$end = $end->modify( '+1 day' );

        $interval = new DateInterval('P1D');
        /**
         * @var DatePeriod
         */
        $daterange = new DatePeriod($begin, $interval ,$end);

        foreach($daterange as $date){
            $count = $bookingRepository->countPaxPerDay($date, true);
            if ($count > 0){
                $result[]= array(
                    'title' => $count,
                'start' => $date->format('Y-m-d'),
                'end' => $date->format('Y-m-d')
            );
            }

        }

        return new JsonResponse($result);
    }

}
