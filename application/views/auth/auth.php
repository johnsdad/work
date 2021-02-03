<?php 
  // $response = get_web_page('http://ip-api.com/json');// "http://ip-api.com/json"
  // //var_dump($response);
  // $resArr = array();
  // $resArr = json_decode($response, true);
  // echo "<pre>";
  // print_r($resArr);
  // echo "</pre>";

  function get_web_page($url) {
    $options = array(
        CURLOPT_RETURNTRANSFER => true,   // return web page
        CURLOPT_HEADER         => false,  // don't return headers
        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
        CURLOPT_ENCODING       => "",     // handle compressed
        CURLOPT_USERAGENT      => "test", // name of client
        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
        CURLOPT_TIMEOUT        => 120,    // time-out on response
    ); 
    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $content  = curl_exec($ch);
    curl_close($ch);
    return $content;
  }
?>






<?php 

function curl_get_contents($url)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}
//https://www.instagram.com/digitalhashim/
//https://www.instagram.com/rashidpahatspp/?__a=1
 $content=curl_get_contents("https://www.instagram.com/sdadtechnology/");

   print_r($content);
   exit;

   $content = explode("window._sharedData = ", $content)[1];
     
   $content = explode(";</script>", $content)[0];
   $data    = json_decode($content, true);
  
   $array1=array();
   $array1=$data["entry_data"]; 
   //$array1["entry_data"]["ProfilePage"];
   
   $array2=array();
   $array2=$array1["ProfilePage"];  
   //$array2["ProfilePage"][0];
   
   $array3=array();
   $array3=$array2[0];  
   //$array3[0]["graphql"];
   
   $array4=array();
   $array4=$array3["graphql"];  
  // $array4["graphql"]["user"];
   
   $array5=array();
   $array5=$array4["user"]; 
  // $array5["user"]["edge_owner_to_timeline_media"];
   
   $array6=array();
   $array6=$array5["edge_owner_to_timeline_media"]; 
   //$array6["edge_owner_to_timeline_media"]["edges"];
   
   $array7=array();
   $array7=$array6["edges"];
   
  
  
  echo '<pre>';
  print_r($array7);
  echo '<br>';
  
  // echo '<pre>';
  // print_r($data);
  //exit();
  
  // if(count($array7)>0)
  // {
  //   foreach($array7 as $data1)
  //   {
  //     echo "<img src='".$data1["node"]["display_url"]."' width='200'>";
  //   }
  // }
  // else
  // {
  //  echo 'failed';
  // }

?>









