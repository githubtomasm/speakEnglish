<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{



    /**
     * CREATE A NEW METHOD FOR SUCCESS 
     * VALIDATE IF THERE IS ANY DATA TO SEND BACK TO AFTER RESPONSE 200
     *
     */


    protected $statusCode = 200;


    public function getStatusCode ()
    {
        return $this->statusCode;
    }


    public function setStatusCode ( $statusCode )
    {
        $this->statusCode = $statusCode;
        
        return $this;

    }




    public function responseSuccess ( $message = 'Procesado', $data = [] )
    {
        return $this->setStatusCode(200)->respondSuccessfully( $data, $message );
    }




    /**
     * Generate an error response, with 404 status
     *
     * @return mixed   
     */
    public function responseNotFound ( $message = 'No encontrado')
    {
        return $this->setStatusCode(404)->respondWithError( $message );
    }   




    /**
     * Generate an response for error 500
     *
     * @return mixed
     */
    public function respondInternalError ( $message = 'Error en la Aplicacion')
    {
        return $this->setStatusCode(500)->respondWithError( $message );   
    }




    /**
     * Return json to be output by API
     * 
     * @return json
     */
    public function respond ($data, $headers = [])
    {   
        return response()->json( $data, $this->getStatusCode(), $headers );
    }





    public function respondSuccessfully ( $data, $message )
    {

        return $this->respond([
            'data'  => $data,
            
            'succes' => [
                'message'       => $message,
                'status_code'   => $this->getStatusCode()
            ],

        ]);
    }





    /**
     * Generic error response
     */
    public function respondWithError ( $message )   
    {
        return $this->respond([
            'error' => [
                'message'       => $message,
                'status_code'   => $this->getStatusCode(),
            ]
        ]);          
    }



}
