<?php

/**
 * Domain List API 
 */

// API URI https://domainlists.io/api/LIST_TYPE/ZONE_CODE/YOUR_LOGIN/YOUR_PASSWORD/

/**
 *  LIST_TYPE (list types):
 *  full - full list of domains
 *  new - list of new (added today) domains (for generic zones only)
 *  deleted - list of deleted (removed today) domains (for generic zones only)
 *  fulldns - full list of domains + DNS
 *  newdns - list of new (added today) domains + DNS (for generic zones only)
 *  deleteddns - list of deleted (removed today) domains + DNS (for generic zones only)
 */

 /**
  * ZONE_CODE:
  * .com  | 532
  * .net  | 537
  * .org  | 538
  * .io   | 962
  * .co   | 863
  * .us   | 539
  */

define('USER_NAME', 'eric@trafficlight.me');
define('PASSWORD', '3JFMkIkYzTmA');

class DLCrawl
  {
    public function __construct( $login=null, $password=null, $zone=null, $type=null )
      {
        $this->base_url = 'https://domainlists.io/api/';
        $this->login    = $login;
        $this->password = $password;
        $this->zone     = $zone;
        $this->type     = $type;
      }
    
    public function buildUrl()
      {
        $errors = 0;
        foreach( $this as $key => $value )
          {
            if(!isset($value))
              {
                print "The {$key} property is blank.\n";
                $errors ++;
              }
          }
          $errors > 0 ? die("There were {$errors} errors.") : null;
          return "{$this->base_url}/{$this->type}/{$this->zone}/{$this->login}/{$this->password}/";
      }
    
    public function getRequest()
      {
        $url = $this->buildUrl();
        $curl = curl_init();
        curl_setopt_array( $curl, array(
          CURLOPT_URL             => $url,
          CURLOPT_RETURNTRANSFER  => true
        ));
        $response = curl_exec( $curl );
        curl_close( $curl );
        return $response;
      }
  }

$crawler = new DLCrawl;
$crawler->getRequest();
