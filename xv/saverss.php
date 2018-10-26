<?php require_once('../Connections/connXV.php'); ?>
<?php
include('../functions.php');
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
	$insertSQL = sprintf("INSERT INTO videos3 (id, url, title, embedlink, duration, thumbnail, tags, category) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($return[$k]['id'], "int"),
						   GetSQLValueString($return[$k]['url'], "text"),
						   GetSQLValueString($return[$k]['title'], "text"),
						   GetSQLValueString($return[$k]['embedlink'], "text"),
						   GetSQLValueString($return[$k]['duration'], "text"),
						   GetSQLValueString($return[$k]['thumbnail'], "text"),
						   GetSQLValueString($return[$k]['tags'], "text"),
						   GetSQLValueString($return[$k]['category'], "text"));
	echo $insertSQL;
echo '<br>';
		  $Result1 = @mysql_query($insertSQL, $connXV);
		  $tmp = explode(',', $return[$k]['tags']); pr($tmp);
				
					mysql_query("delete from videos_tag WHERE id = ".$return[$k]['id']);
				foreach ($tmp as $k => $v) {
					if (empty($v)) {
						continue;
					}
					echo "Tag: ".$v.'<br>';
					$q = sprintf("select * from tags WHERE tag = %s", GetSQLValueString($v, 'text'));
					$rs = mysql_query($q);
					if (mysql_num_rows($rs) === 0) {
						mysql_query(sprintf("insert into tags set tag = %s", GetSQLValueString($v, 'text')));
						$id = mysql_insert_id();
					} else {
						$rec = mysql_fetch_array($rs);
						$id = $rec['tag_id'];
					}
					mysql_query("insert into videos_tag set tag_id = $id, id = ".$return[$k]['id']);
				}
}
pr($return);

?>
