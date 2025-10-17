<?php
function formatINR($amount) {
    return '₹ ' . number_format($amount, 0, '.', ',');
}

function formatINRWithDecimals($amount) {
    return '₹ ' . number_format($amount, 2, '.', ',');
}
?>
