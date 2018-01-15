<?php

require "vendor/autoload.php";

$client = new GuzzleHttp\Client;

try {
    $response = $client->post('http://forneed-official.dev/oauth/token', [
        'form_params' => [
            'client_id' => 2,
            'client_secret' => 'r0AVFDlU0oYxKjQhRTezVFNJ0xA8UP7SlchDwGat',
            'grant_type' => 'password',
            'username' => 'akram@abdulrahman.com',
            'password' => 'badbad91',
            'scope' => '*',
        ]
    ]);

    // You'd typically save this payload in the session
    $auth = json_decode( (string) $response->getBody() );
    
    $response = $client->post('http://forneed-official.dev/api/login', [
        'headers' => [
            'Authorization' => 'Bearer '.$auth->access_token,
        ],
        'form_params' => [
            'email' => 'haha123@123.com1',
            'password'=>'badbad91'
        ]
    ]);
    $user_auth  = json_decode( (string) $response->getBody() );
    // $response = $client->get('http://forneed-official.dev/api/projects', [
    //     'headers' => [
    //         'Authorization' => 'Bearer '.$user_auth->access_token,
    //     ]     
    // ]);

    // $response = $client->get('http://forneed-official.dev/api/surveys', [
    //     'headers' => [
    //         'Authorization' => 'Bearer '.$user_auth->access_token,
    //     ]     
    // ]);

    // $response = $client->post('http://forneed-official.dev/api/surveys/1/400', [
    //     'headers' => [
    //         'Authorization' => 'Bearer '.$user_auth->access_token,
    //     ],
    //     'form_params' => [
    //         'step' => '1',
    //         'final_step'=>'1',
    //         'survey_id'=>'3',
    //         'answers'=>[1]
    //     ]
    // ]);

    //  $response = $client->get('http://forneed-official.dev/api/surveys/3/citizens', [
    //     'headers' => [
    //         'Authorization' => 'Bearer '.$user_auth->access_token,
    //     ]     
    // ]);


    //  $response = $client->get('http://forneed-official.dev/api/citizens/extras', [
    //     'headers' => [
    //         'Authorization' => 'Bearer '.$user_auth->access_token,
    //     ]     
    // ]);

   $response = $client->post('http://forneed-official.dev/api/citizens', [
        'headers' => [
            'Authorization' => 'Bearer '.$user_auth->access_token,
        ],
        'form_params' => [
            'user'=>[ 
                "name" => "tamer",
                "email" => "tamer@tamer.com",
                "password" => "badbad91",
                "password_confirmation" => "badbad91"
            ],
            'extra'=>[
                "AcademicLevel" => "3",
                "Age" => "9",
                "Gender" => "24",
                "MaritalState" => "30",
                "RefugeState" => "31",
                "WorkingState" => "48",
                "Area" => "51"
            ],
            "contactable"=>true
        ]
    ]);

    //$todos = json_decode( (string) $response->getBody() );
    header('Content-Type:application/json');
    echo $response->getBody() ;

} catch (GuzzleHttp\Exception\BadResponseException $e) {
    echo "Unable to retrieve access token.\n".($e->getResponse()->getBody(true));
}
