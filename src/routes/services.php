<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->group('/api', function () use ($app) {
    $app->group('/v1', function () use ($app) {
        // Get All Services with pagination
        $app->get('/services/{offset}/{limit}', function (Request $request, Response $response) {
            $limit = $request->getAttribute('limit');
            $offset = $request->getAttribute('offset');
            $sql = "SELECT * FROM Service LIMIT :limit OFFSET :offset";

            try {
                // Get DB Object
                $db = new db();
                // Connect
                $db = $db->connect();
                $stmt = $db->prepare($sql);

                $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset',  $offset, PDO::PARAM_INT);

                $stmt->execute();
                $Services = $stmt->fetchAll(PDO::FETCH_OBJ);

                $db = null;
                echo json_encode($Services);
            } catch (PDOException $e) {
                echo '{"error": {"text": ' . $e->getMessage() . '}';
            }
        }); 

        // Get All Services
        $app->get('/services', function (Request $request, Response $response) {
            $sql = "SELECT * FROM Service WHERE status <> 'inactive'";

            try {
                // Get DB Object
                $db = new db();
                // Connect
                $db = $db->connect();

                $stmt = $db->query($sql);
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
            $uuid = uniqid();
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
