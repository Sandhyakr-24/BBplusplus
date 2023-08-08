<?php 
   // whenever the site is down for maintenance make this flag 'on'. Traffic will then be redirected to maintenance message page
   $cfg_maintenance = 'off'; 
   $cfg_maintenancepage = 'undermaintenance.php';
  
   // Use HTTPS  or not
   $cfg_usehttps = false;  // On LIVE server always set this to 'true'. While testing on local machines this may be set to false
   
   // for __autoload. The installation directory of the ABS. Used in /app/boot/checksandincludes.php
   $cfg_autoload_includepath_rootdirectory = 'abs'; 

   // Log settings
   $cfg_loggingOn = true;  // 'false' to turn off logging
   $cfg_globalLogLevel = 7; // 7-INFO  4-ERROR
   $cfg_logfilename = "abslog.log";
   $cfg_logrolloversize = 100; // 100MB
   $cfg_maxarchivelogfiles = 5; // How many logfiles should be preserved before overwritting (excluding current logfile)

   $cfg_contactus_email="sureshkodoor@gmail.com";
   
   $cfg_AdminEmail="sureshkodoor@gmail.com";
   
    
  
   // Pagination configuration parameters
   $cfg_number_of_records_perpage = 4; 
   $cfg_number_of_pagelinks = 5;
   
   // valid file extensions
   $cfg_valid_imagefile_extensions    = "jpeg,jpg,pjpeg,gif";
   $cfg_valid_documentfile_extensions = "doc,txt,pdf,pem";
   $cfg_picture_maxsize  = 5000;
   $cfg_avatarpics_dir = 'avatarpics';
   
   // EkStep API parameters
   
   $cfg_ekstepapi_url = "https://qa.ekstep.in/api/data/v3/telemetry";
   // $cfg_ekstepapi_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJjOTg2ZmFhYTNlMDg0NjU2YjBlMzA1NjBjNTU1NWE0ZSIsImlhdCI6MTUxMTUxNjI1NCwiZXhwIjoxNTQzMDUyMjU0LCJhdWQiOiJBa3NoYXJhIGZvdW5kYXRpb24iLCJzdWIiOiJqcm9ja2V0QGV4YW1wbGUuY29tIiwiR2l2ZW5OYW1lIjoiUHVzaHBhIiwiU3VybmFtZSI6IlRoYW50cnkiLCJFbWFpbCI6InB1c2hwYUBha3NoYXJhLm9yZy5pbiIsIlJvbGUiOlsiTWFuYWdlciIsIlByb2plY3QgQWRtaW5pc3RyYXRvciJdfQ.QVTgGmwF74STnpxZtRPsjM6DVdxmLOjkLb4m6WqqJZg';
   $cfg_ekstepapi_token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJmZjMwNWQ1NDg1YjQzNDFiZGEyZmViNmI5ZTU0NjBmYSJ9.O1z7wjXtXPweXL18aEuNwJxglRVrADTC-1o3Mp5GQQY';
   
   // Reverse Geocode API to get 'District' for given latitude/longitude values
   $cfg_reversegeocodeapi_provider = 'google'; // can use 'google' or 'mapmyindia'
   // mapmyindia API URL for getting District from lattitude/longitude values
   $cfg_key_mapmyindiaapi = "rn6pcg7nd8fd2qb5zt6xnuk54585h3ck";
   $cfg_reversegeocodeapiurl_mapmyindia = "https://apis.mapmyindia.com/advancedmaps/v1/".$cfg_key_mapmyindiaapi."/rev_geocode?";
   
   $cfg_key_googleapi = "AIzaSyARKQR2KJgN1qYCiZ9cBnGMu3YzhHu2YEE"; // test key for sureshkodoor@gmail.com account
   $cfg_reversegeocodeapiurl_google = "https://maps.google.com/maps/api/geocode/json?latlng=";
?>
