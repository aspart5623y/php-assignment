<?php
    function validateAndSanitize($input, &$errors, $fieldName, $errorMessage, $numericCheck = false, $emailCheck = false) {
        if (isset($input)) {
            $value = trim($input);
            if (empty($value)) {
                $errors[$fieldName] = $errorMessage;
            } elseif ($numericCheck && !is_numeric($value)) {
                $errors[$fieldName] = "Please enter a valid numeric value for $fieldName";
            } elseif ($emailCheck && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$fieldName] = "Invalid email format for $fieldName";
            }
            return $value;
        }
        return '';
    }
?>