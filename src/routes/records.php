<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->group('/api', function () use ($app) {
    $app->group('/v1', function () use ($app) {

        // Get All Records
        $app->get('/records[/{params:.*}]', function (Request $request, Response $response) {
            $sql = "SELECT * FROM Record";

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
                
                $records = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                echo json_encode($records);
            } catch (PDOException $e) {
                echo '{"error": {"text": ' . $e->getMessage() . '}';
            }
        });

        // Get Single Record
        $app->get('/record/{id}', function (Request $request, Response $response) {
            $id = $request->getAttribute('id');

            $sql = "SELECT * FROM Record WHERE id = $id";

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

        // Add Record
        $app->post('/record', function (Request $request, Response $response) {
            
            $service_id = $request->getParam('service_id');
            $str = $request->getParam('str');
            $user_id = $request->getParam('user_id');

            $db = new db();
            $db = $db->connect();
            
            try {               

                if(!$service_id){
                    throw new Exception("Service ID is required", 1);
                }
                if(!$user_id){
                    throw new Exception("User ID is required", 1);
                }                
                
                // Looks for the service
                $sql = "SELECT * FROM Service WHERE id = :service_id";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':service_id', $service_id, PDO::PARAM_INT);
                $stmt->execute();
                $service = $stmt->fetch(PDO::FETCH_OBJ);
                
                // Looks for the user
                $sql = "SELECT * FROM User WHERE id = :user_id";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_OBJ);

                if($service && $user){
                    $service_response = "failed";
                    $cost = 0;
                    switch ($service->type) {
                        case 'addition':{
                            if(!$str){
                                throw new Exception("Operations or operands are required", 1);
                            }
                            $cost += $service->cost;
                            if($user->balance >= $cost){
                                $service_response = 0;
                                if(!is_array($str)){
                                    $str = explode(" ", $str);
                                }
                                if(count($str) < 2){
                                    throw new Exception("At least 2 numbers are required for addition operation", 1);    
                                }
                                foreach ($str as $value) {
                                    $service_response += $value;
                                }
                            }else{
                                throw new Exception("Insuficient user's balance", 1);                                
                            }
                            break;
                        }
                        case 'subtraction':{
                            if(!$str){
                                throw new Exception("Operations or operands are required", 1);
                            }
                            $cost += $service->cost;
                            if($user->balance >= $cost){                                
                                if(!is_array($str)){
                                    $str = explode(" ", $str);
                                }
                                if(count($str) < 2){
                                    throw new Exception("At least 2 numbers are required for subtraction operation", 1);    
                                }
                                $service_response = $str[0];
                                $operands_count = count($str);
                                for ($i = 1; $i < $operands_count; $i++) {
                                    $service_response -= $str[$i];
                                }
                            }else{
                                throw new Exception("Insuficient user's balance", 1);                                
                            }
                            break;
                        } 
                        case 'multiplication':{
                            if(!$str){
                                throw new Exception("Operations or operands are required", 1);
                            }
                            $cost += $service->cost;
                            if($user->balance >= $cost){
                                $service_response = 1;
                                if(!is_array($str)){
                                    $str = explode(" ", $str);
                                }
                                if(count($str) < 2){
                                    throw new Exception("At least 2 numbers are required for multiplication operation", 1);    
                                }
                                foreach ($str as $value) {
                                    $service_response *= $value;
                                }
                            }else{
                                throw new Exception("Insuficient user's balance", 1);                                
                            }
                            break;
                        }
                        case 'division':{
                            if(!$str){
                                throw new Exception("Operations or operands are required", 1);
                            }
                            $cost += $service->cost;
                            if($user->balance >= $cost){
                                $service_response = 1;
                                if(!is_array($str)){
                                    $str = explode(" ", $str);
                                }
                                if(count($str) < 2){
                                    throw new Exception("At least 2 numbers are required for division operation", 1);    
                                }
                                $service_response = $str[0];
                                $operands_count = count($str);
                                for ($i = 1; $i < $operands_count; $i++) {
                                    $service_response /= $str[$i];
                                }
                            }else{
                                throw new Exception("Insuficient user's balance", 1);                                
                            }
                            break;
                        }     
                        case 'square_root':{
                            if(!$str){
                                throw new Exception("Operations or operands are required", 1);
                            }
                            $cost += $service->cost;
                            if($user->balance >= $cost){
                                if(!is_array($str)){
                                    $str = explode(" ", $str);
                                }
                                if(count($str) > 1){
                                    throw new Exception("Square root only allows one operand", 1);    
                                }else{
                                    $str = $str[0];
                                }
                                $service_response = sqrt($str);
                            }else{
                                throw new Exception("Insuficient user's balance", 1);                                
                            }
                            break;
                        }
                        case 'free_form':{
                            if(!$str){
                                throw new Exception("Operations or operands are required", 1);
                            }
                            $cost += $service->cost;
                            if($user->balance >= $cost){
                                if(is_array($str)){
                                    throw new Exception("Operation must be an string", 1);
                                }
                                $service_response = math_eval($str);
                            }else{
                                throw new Exception("Insuficient user's balance", 1);                                
                            }
                            break;
                        }                        
                        case 'random_string':{
                            $cost += $service->cost;
                            if($user->balance >= $cost){                                
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, "https://www.random.org/strings/?num=10&len=8&digits=on&upperalpha=on&loweralpha=on&unique=on&format=plain&rnd=new");
                                curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result 
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result   

                                // Fetch and return content, save it.
                                $raw_data = curl_exec($ch);
                                curl_close($ch);

                                $service_response = preg_replace("/\n/",'',$raw_data);
                            }else{
                                throw new Exception("Insuficient user's balance", 1);                                
                            }
                            break;
                        }

                        default:{
                            # code...
                            break;
                        }
                    }

                    if($service_response == "failed"){
                        throw new Exception("Action failed", 1);
                    }

                    $db->beginTransaction();

                    // Inserts the  service record
                    $sql = "INSERT INTO Record (uuid,service_id,user_id,cost,user_balance,service_response) VALUES
                    (:uuid,:service_id,:user_id,:cost,:user_balance,:service_response)";

                    $stmt = $db->prepare($sql);
                    $uuid = UUID::v4();
                    $user_balance = $user->balance - $cost;
                    $stmt->bindParam(':uuid', $uuid);
                    $stmt->bindParam(':service_id', $service_id);
                    $stmt->bindParam(':user_id',  $user_id);
                    $stmt->bindParam(':cost', $cost);
                    $stmt->bindParam(':user_balance', $user_balance);
                    $stmt->bindParam(':service_response', $service_response);
                    $stmt->execute();

                    // Update the user's balance
                    $sql = "UPDATE User SET balance = :balance WHERE id = :user_id";

                    $stmt = $db->prepare($sql);  
                    $stmt->bindParam(':user_id', $user_id);
                    $stmt->bindParam(':balance', $user_balance);
                    $stmt->execute();

                    $db->commit();

                    echo json_encode(["result" => ["value" => $service_response]]);
                }                
            } catch (PDOException $e) {
                $db->rollBack();
                echo json_encode(["error" => ["text" => $e->getMessage()]]);
            }catch(Exception $e){
                echo json_encode(["error" => ["text" => $e->getMessage()]]);
            }
        });

        // Update Record
        $app->put('/record/{id}', function (Request $request, Response $response) {
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

            $sql = "UPDATE Record SET " . implode(", ", $sets) . " WHERE id = $id";

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

                echo json_encode(["notice" => ["text" => "Record Updated"]]);
            } catch (PDOException $e) {
                echo json_encode(["error" => ["text" => $e->getMessage()]]);
            }
        });

        // Delete Record
        $app->delete('/record/{id}', function (Request $request, Response $response) {
            $id = $request->getAttribute('id');

            $sql = "DELETE FROM Record WHERE id = $id";

            try {
                // Get DB Object
                $db = new db();
                // Connect
                $db = $db->connect();

                $stmt = $db->prepare($sql);
                $stmt->execute();
                $db = null;
                echo json_encode(["notice" => ["text" => "Record Deleted"]]);
            } catch (PDOException $e) {
                echo json_encode(["error" => ["text" => $e->getMessage()]]);
            }
        });
    });
});
