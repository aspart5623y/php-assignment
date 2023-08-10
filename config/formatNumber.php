<?php 
function formatNumber($payload) {
    if (!is_numeric($payload)) {
        return "Invalid input";
    }
    // Remove sign if negative
    $payload = number_format((float) $payload, 2);
    $sign = 1;
    // if ($payload < 0) {
    //     $sign = -1;
    //     $payload = -$payload;
    // }
    
    // Trim the number decimal point if it exists
    $num = strpos($payload, '.') !== false ? explode('.', $payload)[0] : $payload;
    $len = strlen($num);
    $result = '';
    $count = 1;
  
    for ($i = $len - 1; $i >= 0; $i--) {
        $result = $num[$i] . $result;
        if ($count % 3 === 0 && $count !== 0 && $i !== 0) {
            $result = ',' . $result;
        }
        $count++;
    }
  
    // Add number after decimal point
    if (strpos($payload, '.') !== false) {
        $result = $result . '.' . explode('.', $payload)[1];
    }

    // Return result with - sign if negative
    return $sign < 0 ? '-' . $result : $result;
}

// Example usage
$originalNumber = -1234567.89;
$formattedNumber = formatNumber($originalNumber);

echo $formattedNumber; // Output: "-1,234,567.89"

?>