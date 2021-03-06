<?php

namespace Controllers;
use Slim\Http\Container;

use PDO;
use PDOException;


class MoviesController
{   
    private $request;
    private $response;
    private $db;

    public function __construct(Container $container)
    {
        $this-> request = $container->get('request');
        $this-> response = $container->get('response');
        $this-> db = $container->get('db');
    }

    public function index() 
    {
        try {
            $db = new PDO ('mysql:host=127.0.0.1;dbname=mixplay-api; charset=UTF8', 'root','', [
            PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);

            $sql = 'select * from movies';

            $stmt = $db->prepare($sql);

            $stmt->execute();

            return $this->response->withJson($stmt->fetchAll(PDO::FETCH_ASSOC));

        } catch (PDOException $e) {
            return $this->response->withJson(['error' => $e->getMessage()]);
        }
    }
    public function show()
    {
        try {
            $db = new PDO ('mysql:host=127.0.0.1;dbname=mixplay-api; charset=UTF8', 'root','', [
            PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);

            //prepared statements
            $sql = 'select * from movies where id = ? limit 1';

            $stmt = $db->prepare($sql);

            $stmt->bindValue(1, 12);
                    
            $stmt->execute();

            return $this->response->withJson($stmt->fetch(PDO::FETCH_ORI_FIRST));

        } catch (PDOException $e) {
            return $this->response->withJson(['error' => $e->getMessage()]);
        }
    }
    
    public function create()
    {
        return $this->response->withJson(['id' => 'post']);
    }

    public function edit() 
    {
        return $this->response->withJson(['id' => 'patch']);
    }

    public function replace() 
    {    
        return $this->response->withJson(['id' => 'put']);    
    }

    public function delete() 
    {
        return $this->response->withJson(['id' => 'delete']);;
    }
}