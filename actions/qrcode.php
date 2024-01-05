<?php

function generateQRCode($data, $size = 150)
{
    $apiUrl = 'https://chart.googleapis.com/chart?chs=' . $size . 'x' . $size . '&cht=qr&chl=' . urlencode($data);
    echo '<img src="' . $apiUrl . '" alt="QR Code" />';
}
?>
