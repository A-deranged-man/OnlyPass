<?php
    // Connect to database
    include("../controller/DBController.php");
    $db = new DBController();
    $conn =  $db->getConnstring();
    session_start();

    class api
    {
        function make_safe_SS($uname)
        {
            global $conn;
            mysqli_real_escape_string($conn, $uname);
            return stripslashes($uname);
        }

        function get_key($user_id)
        {
            global $conn;
            //Retrieve users encryption key
            $stmt = mysqli_stmt_init($conn);
            $sql = "SELECT encrypt_key FROM `users` WHERE user_id=?";
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $key_array = $result->fetch_assoc();
            return $key_array['encrypt_key'];
        }

        function check_character_condition($string)
        {
            return (bool)preg_match('/(?=.*([A-Z]))(?=.*([a-z]))(?=.*([0-9]))(?=.*([~`\!@#\$%\^&\*\(\)_\{\}\[\]]))/', $string);
        }


        function generate_password()
        {
            $allowedCharacters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~`!@#$%^&*()_{}[]';
            $password = '';
            $length = 15;
            $max = mb_strlen($allowedCharacters, '8bit') - 1;
            for ($i = 0; $i < $length; ++$i) {
                $password .= $allowedCharacters[random_int(0, $max)];
            }

            if ($this->check_character_condition($password)) {
                return $password;
            } else {
                return $this->generate_password();
            }
        }

        /**
         * ENCRYPT information
         *
         * @param string $message - message to encrypt
         * @param string $key - encryption key
         * @throws Exception
         */
        function sodium_encrypt($message, $key)
        {
            $nonce = \random_bytes(SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);
            $encrypted_text = sodium_crypto_aead_xchacha20poly1305_ietf_encrypt($message, '', $nonce, $key);
            $pass_nonce = array($encrypted_text, $nonce);
            return $pass_nonce;
        }

        /**
         * DECRYPT information
         *
         * @param string $encrypted_text - message encrypted using sodium_encrypt()
         * @param string $nonce - nonce bytes
         * @param string $key - encryption key
         * @return string
         * @throws Exception
         */

        function sodium_decrypt($encrypted_text, $nonce, $key)
        {
            return sodium_crypto_aead_xchacha20poly1305_ietf_decrypt($encrypted_text, '', $nonce, $key);
        }

        function register_user($email,$fname,$lname,$password)
        {
            global $conn;
            $email = $this->make_safe_SS($email);
            $fname = $this->make_safe_SS($fname);
            $lname = $this->make_safe_SS($lname);
            $password = password_hash($password, PASSWORD_DEFAULT);
            $key = sodium_crypto_aead_xchacha20poly1305_ietf_keygen();
            $date = date("Y-m-d H:i:s");
            $stmt = mysqli_stmt_init($conn);
            $sql = "INSERT INTO `users` (fname, lname, email, password, create_datetime, encrypt_key) VALUES (?, ?, ?, ?, ?, ?)";
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, 'ssssss', $fname, $lname, $email, $password, $date, $key);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($result)
            {
                $message = "User registered.";
                $status = 1;
            }
            else
            {
                $message = "User creation failed.";
                $status = 0;
            }
            $response = array('status' => $status, 'status_message' => $message);
            header('Content-Type: application/json');
            return json_encode($response);
        }

        function login_user($email, $password)
        {
            global $conn;
            $stmt = mysqli_stmt_init($conn);
            $sql = "SELECT user_id, fname, lname, email, password FROM `users` WHERE email=?";
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password']))
            {
                $user_id = $row['user_id'];
                $email = $row['email'];
                $fname = $row['fname'];
                $lname = $row['lname'];
                $_SESSION["user_id"] = $row['user_id'];
                $_SESSION["email"] = $row['email'];
                $_SESSION["fname"] = $row['fname'];
                $_SESSION["logged-in"] = true;
                $status = 1;
                $response = array('status' => $status ,'user_id'=>$user_id,'email' => $email, 'fname' => $fname, 'lname' => $lname);
                //client to store input password
            }
            else
            {
                $status = 0;
                $message = "Login Fail";
                $response = array('status' => $status, 'status_message' => $message);
            }
            header('Content-Type: application/json');
            return json_encode($response);
        }

        function insert_data($site_name, $user_id)
        {
              global $conn;
                $key = $this->get_key($user_id);

                //Encrypt site name and get value + nonce
                $site_name_encrypted_array = $this->sodium_encrypt($site_name, $key);
                $site_name_encrypted = $site_name_encrypted_array[0];
                $site_nonce = $site_name_encrypted_array[1];

                //Generate Password and encrypt, get value and nonce
                $password_plain = $this->generate_password();
                $password_encrypted_array = $this->sodium_encrypt($password_plain, $key);
                $password_encrypted = $password_encrypted_array[0];
                $password_nonce = $password_encrypted_array[1];

                //Add data from function to database
                $stmt2 = mysqli_stmt_init($conn);
                $sql2 = "INSERT INTO `user_data` (user_id, site_name, site_nonce, password, password_nonce) VALUES (?, ?, ?, ?, ?)";
                mysqli_stmt_prepare($stmt2, $sql2);
                mysqli_stmt_bind_param($stmt2, 'issss', $user_id, $site_name_encrypted, $site_nonce, $password_encrypted, $password_nonce);
                mysqli_stmt_execute($stmt2);
                $result2 = mysqli_stmt_get_result($stmt2);
                if ($result2)
                {
                    $message = "Password created.";
                    $status = 1;
                }
                else
                {
                    $message = "Password creation failed.";
                    $status = 0;
                }
                $response = array('status' => $status, 'status_message' => $message);
                header('Content-Type: application/json');
                return json_encode($response);
            
        }

        function get_data($user_id)
        {

                //Take connection string, get users encryption key and prepare/execute sql
                global $conn;
                $key = $this->get_key($user_id);
                $stmt2 = mysqli_stmt_init($conn);
                $sql2 = "SELECT * FROM user_data WHERE user_id = ?";
                mysqli_stmt_prepare($stmt2, $sql2);
                mysqli_stmt_bind_param($stmt2, 'i', $user_id);
                mysqli_stmt_execute($stmt2);
                $result2 = mysqli_stmt_get_result($stmt2);

                //Create a new array, loop through the results from the query and loop them, loading each row into the array every loop
                $user_data_db = array();
                while ($r = mysqli_fetch_assoc($result2)) {
                    $user_data_db[] = $r;
                }
                //Create a new array, loop through the first array and use the nonce & key to decrypt information and add to the new array on each loop
                $user_data = array();
                for ($i = 0; $i < count($user_data_db); $i++) {
                    $user_data[$i]['entry_id'] = $user_data_db[$i]['entry_id'];
                    $user_data[$i]['user_id'] = $user_data_db[$i]['user_id'];
                    $user_data[$i]['site_name'] = $this->sodium_decrypt($user_data_db[$i]['site_name'], $user_data_db[$i]['site_nonce'], $key);
                    $user_data[$i]['password_plain'] = $this->sodium_decrypt($user_data_db[$i]['password'], $user_data_db[$i]['password_nonce'], $key);
                }
                //If there is data encode to json, if not sent a fail message
                if($result2)
                {
                    $response = json_encode($user_data);
                }
                else
                {
                    $message = "Data retrieval failed.";
                    $status = 0;
                    $response = json_encode(array('status' => $status, 'status_message' => $message));
                }
                //Return response to client
                return $response;
        }

        function remove_data($entry_id,$user_id)
        {
                global $conn;
                $stmt = mysqli_stmt_init($conn);
                $sql = "DELETE FROM `user_data` WHERE `user_data`.`entry_id` = ? AND `user_data`.`user_id` = ?";
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, 'ii', $entry_id, $user_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if ($result)
                {
                    $message = "Entry removed";
                    $status = 1;
                }
                else
                {
                    $message = "Entry deletion error";
                    $status = 0;
                }
                $response = array('status' => $status, 'status_message' => $message);
                header('Content-Type: application/json');
                return json_encode($response);
            }

    }