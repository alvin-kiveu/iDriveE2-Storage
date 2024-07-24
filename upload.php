<?php
// iDrive E2 credentials and endpoint
$accessKey = 'YOUR_ACCESS_KEY';
$secretKey = 'YOUR_SECRET_KEY';
$endpoint = 'https://YOUR_ENDPOINT_URL';
$bucket = 'YOUR_BUCKET_NAME';
// File to upload
$filePath = $_FILES['video']['tmp_name'];
$fileName = $_FILES['video']['name'];
$fileType = $_FILES['video']['type'];
// Date and time for the request
$timestamp = gmdate('D, d M Y H:i:s T');
// Create the signature
$canonicalString = "PUT\n\n$fileType\n$timestamp\n/$bucket/$fileName";
$signature = base64_encode(hash_hmac('sha1', $canonicalString, $secretKey, true));
// Prepare headers
$headers = [
    "Content-Type: $fileType",
    "Date: $timestamp",
    "Authorization: AWS $accessKey:$signature"
];
// cURL for uploading
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$endpoint/$bucket/$fileName");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents($filePath));
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
if ($httpCode == 200) {
    echo 'Upload successful: ' . $fileName;
} else {
    echo 'Upload failed with status code ' . $httpCode;
}
?>
