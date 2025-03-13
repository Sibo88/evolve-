<?php
// Simulate condition check (replace with real logic)
$conditionPassed = rand(0, 1); // Randomly pass (1) or fail (0)

if ($conditionPassed) {
    $response = array('status' => 'success');
} else {
    $response = array('status' => 'fail');
}

header('Content-Type: application/json');
echo json_encode($response);
?>
