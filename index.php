<?php

require 'GetAnalytic.php';

$GA = new GetAnalytic(); 
$request_method=$_SERVER["REQUEST_METHOD"];
$request_url= $_SERVER['REQUEST_URI']; 

switch ($request_method) {
	case 'GET':
            $uri_request = explode('?', $_SERVER['REQUEST_URI'], 2);
            if($uri_request[0] == "/project_analytics/index.php/get_visitor"){
                
                if( empty($_GET['filter']) ){
                    $filter = "" ;
                }else{
                    $filter = $_GET['filter'] ;
                }

                if( empty($_GET['dateStart']) ){
                    $dateStart = date('Y-m-d') ;
                }else{
                    $dateStart = $_GET['dateStart'] ; 
                }
                
                if( empty( $_GET['dateEnd']) ){
                    $dateEnd = date('Y-m-d') ;
                }else{
                    $dateEnd = $_GET['dateEnd'] ;
                }
        
                $GA->get_visitor($filter, $dateStart, $dateEnd);

            }else if($uri_request[0] == "/project_analytics/index.php/get_title"){

                if( empty($_GET['dateStart']) ){
                    $dateStart = date('Y-m-d') ;
                }else{
                    $dateStart = $_GET['dateStart'] ; 
                }
                
                if( empty( $_GET['dateEnd']) ){
                    $dateEnd = date('Y-m-d') ;
                }else{
                    $dateEnd = $_GET['dateEnd'] ;
                }
            
                $GA->get_visitor_title($dateStart, $dateEnd) ; 

            }else if($uri_request[0] == "/project_analytics/index.php/get_path"){

                if( empty($_GET['dateStart']) ){
                    $dateStart = date('Y-m-d') ;
                }else{
                    $dateStart = $_GET['dateStart'] ; 
                }
                
                if( empty( $_GET['dateEnd']) ){
                    $dateEnd = date('Y-m-d') ;
                }else{
                    $dateEnd = $_GET['dateEnd'] ;
                }
            
                $GA->get_visitor_path($dateStart, $dateEnd) ;
            }
			
			break;
	case 'POST':
	        echo "No Post Mehod" ; 
			break; 
	default:
		// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
		break;
}