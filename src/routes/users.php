<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->group('/api', function() use ($app){
    $app->group('/v1', function() use ($app){
        // Get All Users with pagination
        $app->get('/users/{offset}/{limit}', function(Request $request, Response $response){
            $limit = $request->getAttribute('limit');            
            $offset = $request->getAttribute('offset');       
            $sql = "SELECT * FROM User LIMIT :limit OFFSET :offset";
           
            try{
                // Get DB Object
                $db = new db();
                // Connect
                $db = $db->connect();
                $stmt = $db->prepare($sql);
                
                $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset',  $offset, PDO::PARAM_INT);

                $stmt->execute();       
                $users = $stmt->fetchAll(PDO::FETCH_OBJ);

                $db = null;
                echo json_encode($users);
            } catch(PDOException $e){
                echo '{"error": {"text": '.$e->getMessage().'}';
            }
        });

        // Get All Users
        $app->get('/users', function(Request $request, Response $response){
            $sql = "SELECT * FROM User WHERE status <> 'inactive'";

            try{
                // Get DB Object
                $db = new db();
                // Connect
                $db = $db->connect();
        
                $stmt = $db->query($sql);
                $users = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                echo json_encode($users);
            } catch(PDOException $e){
                echo '{"error": {"text": '.$e->getMessage().'}';
            }
        });
        
        // Get Single User
        $app->get('/user/{id}', function(Request $request, Response $response){
            $id = $request->getAttribute('id');
        
            $sql = "SELECT * FROM User WHERE id = $id";
        
            try{
                // Get DB Object
                $db = new db();
                // Connect
                $db = $db->connect();
        
                $stmt = $db->query($sql);
                $customer = $stmt->fetch(PDO::FETCH_OBJ);
                $db = null;
                echo json_encode($customer);
            } catch(PDOException $e){
                echo '{"error": {"text": '.$e->getMessage().'}';
            }
        });
        
        // Add User
        $app->post('/user', function(Request $request, Response $response){
            $uuid = uniqid();
            $username = $request->getParam('username');
            $password = $request->getParam('password');
            $role = $request->getParam('role');
            $status = $request->getParam('status');
        
            $sql = "INSERT INTO User (uuid,username,password,role,status) VALUES
            (:uuid,:username,:password,:role,:status)";
        
            try{
                // Get DB Object
                $db = new db();
                // Connect
                $db = $db->connect();
        
                $stmt = $db->prepare($sql);
        
                $stmt->bindParam(':uuid', $uuid);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password',  $password);
                $stmt->bindParam(':role',      $role);
                $stmt->bindParam(':status',      $status);
        
                $stmt->execute();
        
                echo json_encode(["notice" => ["text" => "User Added"]]);
                /* echo '{"notice": {"text": "User Added"}'; */
        
            } catch(PDOException $e){
                echo json_encode(["error" => ["text" => $e->getMessage()]]);
                /* echo '{"error": {"text": '.$e->getMessage().'}'; */
            }
        });
        
        // Update User
        $app->put('/user/{id}', function(Request $request, Response $response){
            $id = $request->getAttribute('id');
            $username = $request->getParam('username');
            $password = $request->getParam('password');
            $role = $request->getParam('role');
            $status = $request->getParam('status');

            $sets = [];
            if($username){
                $sets[] = 'username = :username';
            }
            if($password){
                $sets[] = 'password = :password';
            }
            if($role){
                $sets[] = 'role = :role';
            }
            if($status){
                $sets[] = 'status = :status';
            }
        
            $sql = "UPDATE User SET ".implode(", ", $sets)." WHERE id = $id";
        
            try{
                // Get DB Object
                $db = new db();
                // Connect
                $db = $db->connect();
        
                $stmt = $db->prepare($sql);

                if($username){
                    $stmt->bindParam(':username', $username);
                }
                if($password){
                    $stmt->bindParam(':password',  $password);
                }
                if($role){
                    $stmt->bindParam(':role',      $role);
                }
                if($status){
                    $stmt->bindParam(':status',      $status);
                }        
        
                $stmt->execute();
                
                echo json_encode(["notice" => ["text" => "User Updated"]]);
                /* echo '{"notice": {"text": "User Updated"}'; */
        
            } catch(PDOException $e){
                echo json_encode(["error" => ["text" => $e->getMessage()]]);
                /* echo '{"error": {"text": '.$e->getMessage().'}'; */
            }
        });
        
        // Delete User
        $app->delete('/user/{id}', function(Request $request, Response $response){
            $id = $request->getAttribute('id');
        
            $sql = "DELETE FROM User WHERE id = $id";
        
            try{
                // Get DB Object
                $db = new db();
                // Connect
                $db = $db->connect();
        
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $db = null;
                echo json_encode(["notice" => ["text" => "User Deleted"]]);
                /* echo '{"notice": {"text": "User Deleted"}'; */
            } catch(PDOException $e){
                echo json_encode(["error" => ["text" => $e->getMessage()]]);
                /* echo '{"error": {"text": '.$e->getMessage().'}'; */
            }
        });
    });
});