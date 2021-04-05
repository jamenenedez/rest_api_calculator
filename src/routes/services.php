<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->group('/api', function () use ($app) {
    $app->group('/v1', function () use ($app) {
        // Get All Services
        $app->get('/services[/{params:.*}]', function (Request $request, Response $response) {
            $sql = "SELECT * FROM Service";

            $filters = $request->getQueryParams();

            try {
                // Get DB Object
                $db = new db();
                // Connect
                $db = $db->connect();

                if(!empty($filters)){

                    extract($filters);

                    if(!is_null($limit)){
                        unset($filters['limit']);                        
                    }

                    if(!is_null($offset)){
                        unset($filters['offset']);                        
                    }                   

                    foreach (array_keys($filters) as $key) {
                        if(!strstr($sql, 'WHERE')){           
                            if(in_array($key,['type', 'status'])){
                                $sql .= " WHERE $key = :$key";
                            }else{
                                $sql .= " WHERE $key like :$key";
                            }
                        }else{
                            $sql .= " AND $key like :$key";
                        }
                    }                    
                    
                    if(!is_null($limit)){
                        $sql .= " LIMIT :limit";
                        $filters['limit'] = $limit;
                    }
                    
                    if(!is_null($offset)){
                        $sql .= " OFFSET :offset";
                        $filters['offset'] = $offset;
                    }

                    $stmt = $db->prepare($sql);
                    foreach ($filters as $key => $value) {
                        if(is_numeric($value)){
                            $stmt->bindValue(":$key", $value, PDO::PARAM_INT);
                        }elseif (in_array($key,['type', 'status'])) {
                            $stmt->bindValue(":$key", $value, PDO::PARAM_STR_CHAR);                            
                        }else{
                            $stmt->bindValue(":$key", "%".$value."%", PDO::PARAM_STR_CHAR);                            
                        }
                    }
                    $stmt->execute();               
                }else{
                    $stmt = $db->query($sql);
                }
                
                $services = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                echo json_encode($services);
            } catch (PDOException $e) {
                echo '{"error": {"text": ' . $e->getMessage() . '}';
            }
        });

        // Get Single Service
        $app->get('/service/{id}', function (Request $request, Response $response) {
            $id = $request->getAttribute('id');

            $sql = "SELECT * FROM Service WHERE id = $id";

            try {
                // Get DB Object
                $db = new db();
                // Connect
                $db = $db->connect();

                $stmt = $db->query($sql);
                $customer = $stmt->fetch(PDO::FETCH_OBJ);
                $db = null;
                echo json_encode($customer);
            } catch (PDOException $e) {
                echo '{"error": {"text": ' . $e->getMessage() . '}';
            }
        }); 

        // Add Service
        $app->post('/service', function (Request $request, Response $response) {
            $uuid = UUID::v4();
            $type = $request->getParam('type');
            $cost = $request->getParam('cost');
            $status = $request->getParam('status');

            $sql = "INSERT INTO Service (uuid,type,cost,status) VALUES
            (:uuid,:type,:cost,:status)";

            try {
                // Get DB Object
                $db = new db();
                // Connect
                $db = $db->connect();

                $stmt = $db->prepare($sql);

                $stmt->bindParam(':uuid', $uuid);
                $stmt->bindParam(':type', $type);
                $stmt->bindParam(':cost',  $cost);
                $stmt->bindParam(':status', $status);

                $stmt->execute();

                echo json_encode(["notice" => ["text" => "Service Added"]]);
            } catch (PDOException $e) {
                echo json_encode(["error" => ["text" => $e->getMessage()]]);
            }
        }); 

        // Update Service
        $app->put('/service/{id}', function (Request $request, Response $response) {
            $id = $request->getAttribute('id');
            $type = !empty($request->getParam('type')) ? $request->getParam('type') : null;
            $cost = !empty($request->getParam('cost')) ? $request->getParam('cost') : null;
            $status = !empty($request->getParam('status')) ? $request->getParam('status') : null;

            $sets = [];
            if ($type) {
                $sets[] = 'type = :type';
            }
            if ($cost) {
                $sets[] = 'cost = :cost';
            }
            if ($status) {
                $sets[] = 'status = :status';
            }

            $sql = "UPDATE Service SET " . implode(", ", $sets) . " WHERE id = $id";

            try {
                // Get DB Object
                $db = new db();
                // Connect
                $db = $db->connect();

                $stmt = $db->prepare($sql);

                if ($type) {
                    $stmt->bindParam(':type', $type);
                }
                if ($cost) {
                    $stmt->bindParam(':cost',  $cost);
                }
                if ($status) {
                    $stmt->bindParam(':status', $status);
                }

                $stmt->execute();

                echo json_encode(["notice" => ["text" => "Service Updated"]]);
            } catch (PDOException $e) {
                echo json_encode(["error" => ["text" => $e->getMessage()]]);
            }
        }); 

        // Delete Service
        $app->delete('/service/{id}', function (Request $request, Response $response) {
            $id = $request->getAttribute('id');

            $sql = "DELETE FROM Service WHERE id = $id";

            try {
                // Get DB Object
                $db = new db();
                // Connect
                $db = $db->connect();

                $stmt = $db->prepare($sql);
                $stmt->execute();
                $db = null;
                echo json_encode(["notice" => ["text" => "Service Deleted"]]);
            } catch (PDOException $e) {
                echo json_encode(["error" => ["text" => $e->getMessage()]]);
            }
        }); 
    });
});
