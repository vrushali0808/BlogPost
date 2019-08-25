<?php
// read a text file into a string
$blogFile = file_get_contents('blogPosts.txt');

 
$strippedQuotesData = str_replace("\"","",$blogFile);

// String convert to an array to revome '---'
$data = explode('---', $strippedQuotesData);

$trimmedData = trim($data[1]);
$LINES =  explode("\n", $trimmedData);

$PAIRS = array();

for($line = 0; $line < sizeof($LINES); $line++){
    	$PAIRS[] = explode(":", $LINES[$line]);;
}

for($pair = 0; $pair < sizeof($PAIRS); $pair++){
    $myObj[ $pair ] = array($PAIRS[$pair][0] => $PAIRS[$pair][1]);
       if ( strcmp ($PAIRS[$pair][0] , "tags") == 0 ){
        $splittedContentForTag = explode(",",$PAIRS[$pair][1]);
        $output[key($myObj[ $pair ])] = $splittedContentForTag;

    } else
    {
        $output[key($myObj[ $pair ])] = current($myObj[ $pair ]);
    }
}

$trimmedContent = trim($data[2]);
$splittedContent  = explode("READMORE",$trimmedContent);


$shortContent = $splittedContent[0];
$shortContentData = str_replace("\n","",$shortContent);

$content = $splittedContent[1];
$contentData = str_replace("\n","",$content);

$output["short-content"] = $shortContentData;
$output["content"] = $contentData;

 $myJSON = json_encode($output);
 print_r($myJSON);
// echo json_encode(json_decode($data));

// write a string to a JSON file.
file_put_contents('blogPosts.json', json_encode($output));

?>