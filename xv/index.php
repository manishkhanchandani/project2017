<?php 

define('ROOT_DIR', dirname(__FILE__));
define('BASE_DIR', dirname(dirname(__FILE__)));

include('../functions.php');

spl_autoload_register(function ($class) {
    // Parse class prefix
    $prefix = 'Parse\\';
    // base directory for the namespace prefix
    $base_dir = defined('PARSE_SDK_DIR') ? PARSE_SDK_DIR : BASE_DIR.'/libraries/Parse/';
	
    // does the class use the namespace prefix?
    $len = strlen($prefix);

    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }
    // get the relative class name
    $relative_class = substr($class, $len);
    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir.str_replace('\\', '/', $relative_class).'.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});



use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;

$app_id = 'myAppID';
$master_key = 'myMasterKey';
$server_url = 'https://mkparse.info'; //'https://parse-server-mk1.herokuapp.com';
$mount_path = 'parse';
ParseClient::initialize( $app_id, null, $master_key );
ParseClient::setServerURL($server_url, $mount_path);
/*$health = ParseClient::getServerHealth();
pr($health);*/

class RSSParser {
	var $channel_title="";
	var $channel_website="";
	var $channel_description="";
	var $channel_pubDate="";
	var $channel_lastUpdated="";
	var $channel_copyright="";
	var $title="";
	var $embed="";
	var $tag="";
	var $tsmall="";
	var $tmedium="";
	var $tbig="";
	var $tvbig="";
	var $rate="";
	var $duration="";
	var $duration_sec="";
	var $guid="";
	var $link="";
	var $description="";
	var $pubDate="";
	var $author="";
	var $url="";
	var $width="";
	var $height="";
	var $inside_tag=false;	
	function RSSParser($file)	{
			$this->xml_parser = xml_parser_create();
			xml_set_object( $this->xml_parser, $this);
			xml_set_element_handler( $this->xml_parser, "startElement", "endElement" );
			xml_set_character_data_handler( $this->xml_parser, "characterData" );
			$fp = @fopen("$file","r");
			if (empty($fp)) {
				return false;
			}
			while ($data = fread($fp, 4096)){xml_parse( $this->xml_parser, $data, feof($fp));}
			fclose($fp);
			xml_parser_free( $this->xml_parser );
		}
	
	function startElement($parser,$tag,$attributes=''){
		$this->current_tag=$tag;
		if($this->current_tag=="ITEM" || $this->current_tag=="IMAGE"){
			$this->inside_tag=true;
			$this->description="";
			$this->link="";
			$this->title="";
			$this->pubDate="";
			$this->embed="";
			$this->tag="";
			$this->tsmall="";
			$this->tmedium="";
			$this->tbig="";
			$this->tvbig="";
			$this->rate="";
			$this->duration="";
			$this->duration_sec="";
			$this->guid="";
		}
	}
	
	function endElement($parser, $tag){
		switch($tag){
			case "ITEM":
				$this->embeds[]=trim($this->embed);
				$this->tags[]=trim($this->tag);
				$this->tsmalls[]=trim($this->tsmall);
				$this->tmediums[]=trim($this->tmedium);
				$this->tbigs[]=trim($this->tbig);
				$this->tvbigs[]=trim($this->tvbig);
				$this->rates[]=str_replace('? ', '', str_replace('%', '', trim($this->rate)));
				$this->durations[]=trim($this->duration);
				$this->duration_secs[]=trim($this->duration_sec);
				$this->guids[]=trim($this->guid);
				$this->titles[]=trim($this->title);
				$this->links[]=trim($this->link);
				$this->descriptions[]=trim($this->description);
				$this->pubDates[]=trim($this->pubDate);
				$this->authors[]=trim($this->author);
				$this->author=""; $this->inside_tag=false;
				break;
			case "IMAGE":
				$this->channel_image="<img src=\"".trim($this->url)."\" width=\"".trim($this->width)."\" height=\"".trim($this->height)."\" alt=\"".trim($this->title)."\" border=\"0\" title=\"".trim($this->title)."\" />";
				$this->title=""; $this->inside_tag=false;
			default:
				break;
		}
	}
	
	function characterData($parser,$data){
		if($this->inside_tag){
			switch($this->current_tag){
				case 'MEDIA:KEYWORDS': 
					$this->tag.=$data; break;
				case 'FLV_EMBED': 
					$this->embed.=$data; break;
				case 'THUMB_SMALL': 
					$this->tsmall.=$data; break;
				case 'THUMB_MEDIUM': 
					$this->tmedium.=$data; break;
				case 'THUMB_BIG': 
					$this->tbig.=$data; break;
				case 'THUMB_VERYBIG': 
					$this->tvbig.=$data; break;
				case 'RATE': 
					$this->rate.=$data; break;
				case 'DURATION': 
					$this->duration.=$data; break;
				case 'DURATION_SECS': 
					$this->duration_sec.=$data; break;
				case 'GUID': 
					$this->guid.=$data; break;
				case "TITLE":
					$this->title.=$data; break;
				case "DESCRIPTION":
					$this->description.=$data; break;
				case "LINK":
					$this->link.=$data; break;
				case "URL":
					$this->url.=$data; break;
				case "WIDTH":
					$this->width.=$data; break;
				case "HEIGHT":
					$this->height.=$data; break;
				case "PUBDATE":
					$this->pubDate.=$data; break;
				case "AUTHOR":
					$this->author.=$data;	break;
				default: break;									
			}//end switch
		}else{
			switch($this->current_tag){
				case "DESCRIPTION":
					$this->channel_description.=$data; break;
				case "TITLE":
					$this->channel_title.=$data; break;
				case "LINK":
					$this->channel_website.=$data; break;
				case "COPYRIGHT":
					$this->channel_copyright.=$data; break;
				case "PUBDATE":
					$this->channel_pubDate.=$data; break;
				case "LASTBUILDDATE":
					$this->channel_lastUpdated.=$data; break;
				default:
					break;
			}
		}
	}
}

$myRss = new RSSParser("https://www.xvideos.com/rss/rss.xml"); 
$itemNum=0;
$myRss_RSSmax=0;
if($myRss_RSSmax==0 || $myRss_RSSmax>count($myRss->titles)) $myRss_RSSmax=count($myRss->titles);

$return = array();

foreach ($myRss->titles as $k => $v) {
	$return[$k]['title'] = $v;
	$return[$k]['url'] = $myRss->links[$k];
	$return[$k]['duration'] = $myRss->duration_secs[$k].' sec';
	$return[$k]['thumbnail'] = $myRss->tvbigs[$k];
	$return[$k]['embedlink'] = $myRss->embeds[$k];
	$return[$k]['tags'] = $myRss->tags[$k];
	$return[$k]['id'] = $myRss->guids[$k];
	$return[$k]['category'] = 'adult';
	
	$query = new ParseQuery("XT_videos");
	$query->equalTo("id", (int) $return[$k]['id']);
	$results = $query->find();
	
	if (!empty($results)) {
		continue;
	}
	
	$object = ParseObject::create("XT_videos");
	$objectId = $object->getObjectId();
	$object->set("id", (int) $return[$k]['id']);
	$object->set("title", $return[$k]['title']);
	$object->set("thumbnail", $return[$k]['thumbnail']);
	$object->setArray("tags", explode(',', $return[$k]['tags']));
	$object->set("duration", (int) $myRss->duration_secs[$k]);
	$object->save(true);

}
pr($return);

?>
