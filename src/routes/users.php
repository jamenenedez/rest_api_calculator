<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->group('/api', function() use ($app){
    $app->group('/v1', function() use ($app){
        // Get All Users
        $app->get('/users[/{params:.*}]', function(Request $request, Response $response){
            $sql = "SELECT * FROM User";

            $filters = $request->getQueryParams();

            try{
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
                            $sql .= " WHERE $key like :$key";
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
                        }else{
                            $stmt->bindValue(":$key", "%".$value."%", PDO::PARAM_STR_CHAR);                            
                        }
                    }
                    $stmt->execute();               
                }else{
                    $stmt = $db->query($sql);
                }    

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
            $uuid = UUID::v4();
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
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':role', $role);
                $stmt->bindParam(':status', $status);
        
                $stmt->execute();
        
                echo json_encode(["notice" => ["text" => "User Added"]]);
        
            } catch(PDOException $e){
                echo json_encode(["error" => ["text" => $e->getMessage()]]);
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
        
            } catch(PDOException $e){
                echo json_encode(["error" => ["text" => $e->getMessage()]]);
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
            } catch(PDOException $e){
                echo json_encode(["error" => ["text" => $e->getMessage()]]);
            }
        });
    });
});