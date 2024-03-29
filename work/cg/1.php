<?php
$itemNum=0;
class RSSParser	{
	var $channel_title="";
	var $channel_website="";
	var $channel_description="";
	var $channel_pubDate="";
	var $channel_lastUpdated="";
	var $channel_copyright="";
	var $title="";
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
			xml_set_object( $this->xml_parser, &$this );
			xml_set_element_handler( $this->xml_parser, "startElement", "endElement" );
			xml_set_character_data_handler( $this->xml_parser, "characterData" );
			$fp = @fopen("$file","r") or die( "$file could not be opened" );
			while ($data = fread($fp, 4096)){xml_parse( $this->xml_parser, $data, feof($fp)) or die( "XML error");}
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
		}
	}
	
	function endElement($parser, $tag){
		switch($tag){
			case "ITEM":
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

$myRss = new RSSParser("http://sanjose.backpage.com/online/exports/Rss.xml?section=4381&category=4443");
?>
<?php
function regexp($input, $regexp) {
	//$input = file_get_contents("http://www.phpfunctions.be");
	//$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
	if(preg_match_all("/$regexp/siU", $input, $matches, PREG_SET_ORDER)) {
		return $matches;
	}
	return false;
}
?>
<?php
$myRss_RSSmax=0;
if($myRss_RSSmax==0 || $myRss_RSSmax>count($myRss->titles))$myRss_RSSmax=count($myRss->titles);
for($itemNum=0;$itemNum<$myRss_RSSmax;$itemNum++){?>
	<p>
	<?php echo $myRss->titles[$itemNum]; ?></p>
	<p>&nbsp; <?php echo $myRss->descriptions[$itemNum]; ?></p>
	<p>&nbsp;<a href="<?php echo $myRss->links[$itemNum]; ?>">New Link</a></p>
	<?php
	$input = $myRss->links[$itemNum];
	$regexp = "^.*\/([0-9]*)$";
	$matches = regexp($input, $regexp);
	print_r($matches);
	$id = $matches[0][1];
	if (!$id) {
		continue;
	}
	$date = date('Y-m-d');
	if (!is_dir('files/'.$date)) {
		mkdir('files/'.$date, 0777);
		chmod('files/'.$date, 0777);
	}
	if (!file_exists('files/'.$date.'/'.$id.'.txt')) {
		$string = '';
		$string .= "Title = ".$myRss->titles[$itemNum]."\n";
		$string .= "Link = ".$myRss->links[$itemNum]."\n";
		$c = file_get_contents($myRss->links[$itemNum]);
		$regexp = "<img src=\"(.*)\".*>";
		$matches = regexp($c, $regexp);
		foreach($matches as $match) {
			if (preg_match('/www\.backpage\.com\/images/', $match[1])) {
				continue;
			}
			$string .= "Images = ".$match[1]."\n";
		}
		$string .= "Description = ".$myRss->descriptions[$itemNum]."\n";
		file_put_contents('files/'.$date.'/'.$id.'.txt', $string);
		echo $string.'<br><br>';
	}
	?>
	<hr>
	<?php } ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
