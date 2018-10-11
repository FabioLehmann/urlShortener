<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

use Psr\Log\LoggerInterface;


class LinksController extends Controller 
{
    /**
     * @Route("/links", name="links",methods={"GET","HEAD"}))
     */
	public function getlinks(LoggerInterface $logger,EntityManagerInterface $entityManager)
	{	
		$request = Request::createFromGlobals();
		$RAW_QUERY = 'SELECT id, source,target,DATE_FORMAT(uploaded_date, "%d.%m.%Y")  as uploaded_date
from urls;';
     
		$statement = $entityManager->getConnection()->prepare($RAW_QUERY);
		$statement->execute();

		$result = $statement->fetchAll();
		$response = new Response();
		$response->setContent(json_encode(array(
			'data' => $result
		)));
		$response->headers->set('Content-Type', 'application/json');
		
		$response->headers->set('Access-Control-Allow-Origin', 'http://localhost:4200');
		
	    $response->headers->set('Access-Control-Allow-Methods', 'GET');
	    $response->headers->set('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept, Authorization');
		
		
		return $response;
	}
	
    /**
     * @Route("/links",name="newlink",methods={"POST","OPTIONS"}))
     */
 	public function createUrl(LoggerInterface $logger,EntityManagerInterface $entityManager)
 	{	
		
		$source = "https://www.google.ch/search?q=bootstrap+4+icon+inside+input&rlz=1C5CHFA_enCH698CH699&oq=boostrap+4+icon+in&aqs=chrome.1.69i57j0l5.9559j0j4&sourceid=chrome&ie=UTF-8";
		$webapp_name = "http://localhost:4200/";
		$target = $webapp_name.md5($source) ;
		$date =  date('Y-m-d');	
		
		
		$RAW_QUERY = "SELECT *  from urls where source ='$source';";
		$statement = $entityManager->getConnection()->prepare($RAW_QUERY);
		$statement->execute();
		$result = $statement->fetchAll();
		
		if(!isset($result)){
		
			$RAW_QUERY = "INSERT INTO urls (source, target, uploaded_date)
	VALUES ('$source', '$target', '$date');";
     
			$statement = $entityManager->getConnection()->prepare($RAW_QUERY);
			$statement->execute();
		}
		
		
		$response = new Response();
		$response->setContent(json_encode(array(
			'data' => 'a'
		)));
		
		
		$response = new Response();
		$response->headers->set('Content-Type', 'application/json');
		$response->headers->set('Access-Control-Allow-Origin', '*');
	    $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT, DELETE');
		$response->headers->set('X-PINGOTHER', 'pingpong');
	    $response->headers->set('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept, Authorization');
		

 		return $response;
 	}
    /**
       * @Route("/links/{id}/", name="redirectlink",methods={"GET","HEAD","OPTIONS"})))
       */
	public function redirectlink(LoggerInterface $logger,EntityManagerInterface $entityManager,$id)
	{	
		$logger->info('$target');
		
		$webapp_name = "http://localhost:4200/";
		$target = $webapp_name.$id;
		$RAW_QUERY = "SELECT source from urls WHERE target = '$target';";
     
		$statement = $entityManager->getConnection()->prepare($RAW_QUERY);
		$statement->execute();

		$result = $statement->fetchAll();
		
		
		if(!isset($result[0]['source'])){
			$url = $webapp_name;
		}
		else{
			$url = $result[0]['source'];	
		}
		$response = new Response();
		$response->headers->set('Content-Type', 'application/json');
		$response->headers->set('Access-Control-Allow-Origin', '*');
	    $response->headers->set('Access-Control-Allow-Methods', 'POST');
	    $response->headers->set('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept, Authorization');
		
		$response->setContent(json_encode(array(
			'ulr' => $url
		)));
		return $this->redirect($url);
		
		// return $response;
	}
}
