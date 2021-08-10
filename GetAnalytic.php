<?php
 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'vendor/autoload.php';

use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;

putenv('GOOGLE_APPLICATION_CREDENTIALS=SMILE-GA4-14d385f4f755.json');


class GetAnalytic{

    var $property_id ;
    var $client;  

    public function __construct() {
        $this->property_id = '265718521' ;
        $this->client = new BetaAnalyticsDataClient();
    }

    public  function get_visitor($param, $dateStart, $dateEnd)
	{
        if($param == ""){
            $param = "country" ; 
        }

        $result = $this->client->runReport([
            'property' => 'properties/' .  $this->property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $dateStart,
                    'end_date' => $dateEnd,
                ]),
            ],
            'dimensions' => [new Dimension(
                [
                    'name' => $param,
                ]
            ),
            ],
            'metrics' => [new Metric(
                [
                    'name' => 'totalUsers',
                ]
            )
            ]
        ]);

        if($result == ""){
            $response=array(
                'status' => "01",
                'message' =>'Get Activity User Failed',
                'data' => array() 
            );
        }else{
            $data = array() ;
            $i = 0 ; 
            foreach ($result->getRows() as $row) {
                $data[$i] = array(
                    $row->getDimensionValues()[0]->getValue(),
                    $row->getMetricValues()[0]->getValue()
                ) ; 
                $i++ ; 
            }
            $response=array(
                'status' => "00",
                'message' =>'Get Activity User Success',
                "count_data"=>count($data), 
                'data' => $data
            );
        }
        
		header('Content-Type: application/json');
		echo json_encode($response);
	}

    public  function get_visitor_title( $dateStart, $dateEnd )
	{
        $result  = $this->client->runReport([
            'property' => 'properties/' .  $this->property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $dateStart,
                    'end_date' => $dateEnd,
                ]),
            ],
            'dimensions' => [new Dimension(
                [
                    'name' => "pageTitle",
                ]
            ),
            ],
            'metrics' => [new Metric(
                [
                    'name' => 'totalUsers',
                ]
            )
            ]
        ]) ;

        if($result == ""){
            $response=array(
                'status' => 01,
                'message' =>'Get Total User By Title Failed',
                "count_data"=>0, 
                'data' => array() 
            );
        }else{
            $data = array() ;
            $i = 0 ; 
            foreach ($result->getRows() as $row) {
                $data[$i] = array(
                    $row->getDimensionValues()[0]->getValue(),
                    $row->getMetricValues()[0]->getValue()
                ) ; 
                $i++ ; 
            }
            $response=array(
                'status' => 00,
                'message' =>'Get Total User by title Success',
                "count_data"=>count($data), 
                'data' => $data
            );
        }
        
		header('Content-Type: application/json');
		echo json_encode($response);

	}

    public function get_visitor_path( $dateStart, $dateEnd)
	{
        $result  = $this->client->runReport([
            'property' => 'properties/' .  $this->property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $dateStart,
                    'end_date' => $dateEnd,
                ]),
            ],
            'dimensions' => [new Dimension(
                [
                    'name' => "pagePath",
                ]
            ),
            ],
            'metrics' => [new Metric(
                [
                    'name' => 'totalUsers',
                ]
            )
            ]
        ]) ;

        if($result == ""){
            $response=array(
                'status' => 01,
                'message' =>'Get Total User By Page Path Failed',
                "count_data"=>0, 
                'data' => array() 
            );
        }else{
            $data = array() ;
            $i = 0 ; 
            foreach ($result->getRows() as $row) {
                $data[$i] = array(
                    $row->getDimensionValues()[0]->getValue(),
                    $row->getMetricValues()[0]->getValue()
                ) ; 
                $i++ ; 
            }
            $response=array(
                'status' => 00,
                'message' =>'Get Total User By Page Path Success',
                "count_data"=>count($data), 
                'data' => $data
            );
        }

        header('Content-Type: application/json');
		echo json_encode($response);
	}

}
