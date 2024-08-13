<?php 

$hostname = 'localhost';
$user = 'root';
$pw = '';
$database = 'smpitnf';
$GOOGLE_CLIENT_ID = '637285875974-18sel50cag4sl6vihreimgdda15im70i.apps.googleusercontent.com';
$GOOGLE_CLIENT_SECRET = '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';
$GOOGLE_OAUTH_SCOPE = 'https://www.googleapis.com/auth/drive';
$REDIRECT_URI = 'http://localhost/smpit-nf/google_drive_sync.php';

$db = mysqli_connect($hostname, $user, $pw, $database);

// Start Session

if(!session_id()) session_start();

// Google OAuth URL

$googleOauthURL = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode($GOOGLE_OAUTH_SCOPE) . '&redirect_uri=' . $REDIRECT_URI . '&response_type=code&client_id=' . $GOOGLE_CLIENT_ID . '&access_type=online';

?>