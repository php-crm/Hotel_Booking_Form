<?php
	/* 
	Author: PHP CRM
	Web: www.phpcrm.com
	Date: 15 April 2024
	Version: 13 
	*/
		// Check if form data is present
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
		     // / To set the API endpoint URL, please log in to your PHP CRM account. 
            $url = "#";
            // Initialize an empty string to store form data
            $data = "";
            // Iterate through the $_POST array to gather all form data
            foreach ($_POST as $key => $value) {
                // Capitalize the first letter of the field name
                $fieldName = ucfirst($key);
                // Concatenate the form field names and values into the data string
                $data .= "<p><b>{$fieldName}:</b> {$value}</p>";
            }
            $email = $_POST['email'];



            // Initialize cURL session
            $curl = curl_init();

            // Set cURL options
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false, // Assuming you're using self-signed SSL certificate in local environment
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => [
                    'email' => $email,
                    'data' => $data, // Use the concatenated form data string
                ],
            ]);

            // Execute the request and get the response
            $response = curl_exec($curl);

            // Check for errors
            if ($response === false) {
                $error = curl_error($curl);
                // Handle cURL error
                echo '<div class="error-message">cURL Error: ' . $error . '</div>';
            } else {
                // Convert the response to an associative array
                $responseData = json_decode($response, true);

                // Check if the response is valid and contains success message
                if ($responseData !== null && isset($responseData['messages']['success'])) {
                    // Display success message
                    echo '<div style="color: #28a745;font-weight: bold;">Your data has been submitted successfully. We will get back to you soon.</div>';
                } else {
                    // Display error message
                    echo '<div style="color: #dc3545;font-weight: bold;">Invalid response received from server.</div>';
                }
            }

            // Close cURL session
            curl_close($curl);
        } else {
            // Handle case where form data is not present
            echo '<div class="error-message">No form data submitted.</div>';
        }
        ?>
		

