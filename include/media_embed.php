<?php
/************************************************************* 
 * This script is developed by Arturs Sosins aka ar2rsawseen, http://webcodingeasy.com 
 * Feel free to distribute and modify code, but keep reference to its creator 
 * 
 * Media Embed class allows you to retrieve information about media like Video or Images 
 * by simply using link or embed code from media providers like Youtube, Myspace, etc. 
 * It can retrieve embeding codes, title, sizes and thumbnails from 
 * more than 20 popular media providers
 * 
 * For more information, examples and online documentation visit:  
 * http://webcodingeasy.com/PHP-classes/Get-information-about-video-and-images-from-link
**************************************************************/
class media_embed
{
	private $code = "";
	private $site = "";
	private $data = array(
		"small" => "", 
		"medium" => "", 
		"large" => "", 
		"w" => -1, 
		"h" => -1, 
		"embed" => "",
		"iframe" => "",
		"url" => "",
		"site" => "", 
		"title" => ""
		);
	private $default_size = array("w" => 630, "h" => 352);
	private $all_types = array(
		"youtube" => array(
			"link" => "/https?:\/\/[w\.]*youtube\.com\/watch\?v=([^&#]*)|https?:\/\/[w\.]*youtube\.com\/watch\?[^&]+&v=([^&#]*)|https?:\/\/[w\.]*youtu\.be\/([^&#]*)/i",
			"embed" => '/https?:\/\/[w\.]*youtube\.com\/v\/([^?&#"\']*)/is',
			"iframe" => '/https?:\/\/[w\.]*youtube\.com\/embed\/([^?&#"\']*)/is'
		),
		"vimeo" => array(
			"link" => "/https?:\/\/[w\.]*vimeo\.com\/([\d]*)/is",
			"embed" => '/https?:\/\/[w\.]*vimeo\.com\/moogaloop\.swf\?clip_id=([\d]*)/is',
			"iframe" => '/https?:\/\/player\.vimeo\.com\/video\/([\d]*)/is'
		),
		"dailymotion" => array(
			"link" => "/https?:\/\/[w\.]*dailymotion\.com\/video\/([^_]*)/is",
			"embed" => '/https?:\/\/[w\.]*dailymotion\.com\/swf\/video\/([^?&#"\']*)/is',
			"iframe" => '/https?:\/\/[w\.]*dailymotion\.com\/embed\/video\/([^?&#"\']*)/is'
		),
		"funnyordie" => array(
			"link" => '/https?:\/\/[w\.]*funnyordie\.com\/videos\/([^?]*)/is',
		),
	);
	
	function __construct($input){
		foreach($this->all_types as $site => $types)
		{
			foreach($types as $type => $regexp)
			{
				preg_match($regexp, $input, $match);
				if(!empty($match))
				{
					/*echo "<p>".$site." ".$type."</p>";
					echo "<pre>";
					print_r($match);
					echo "</pre>";*/
					for($i = 1; $i < sizeof($match); $i++)
					{
						if($match[$i] != "")
						{
							$this->code = $match[$i];
							$this->site = $site;
							break;
						}
					}
					if($this->code != "")
					{
						break;
					}
				}
			}
			if($this->code != "")
			{
				break;
			}
		}
	}
	
	/**************************
	* PUBLIC FUNCTIONS
	**************************/
	
	public function get_thumb($size = "small"){
		if($this->site != "")
		{
			$size_types = array("small", "medium", "large");
			$size = strtolower($size);
			if(!in_array($size, $size_types))
			{
				$size = "small";
			}
			$this->prepare_data("thumb");
			return $this->data[$size];
		}
		else
		{
			return "";
		}
	}
	
	public function get_iframe($w = -1, $h = -1){
		$this->prepare_data("iframe");
		if($this->site != "" && $this->data["iframe"] != "")
		{
			if($w < 0 || $h < 0)
			{
				$w = (is_int($this->data["w"]) && $this->data["w"] > 0) ? $this->data["w"] : $this->default_size["w"];
				$h = (is_int($this->data["h"]) && $this->data["h"] > 0) ? $this->data["h"] : $this->default_size["h"];
			}
			return '<iframe width="'.$w.'" height="'.$h.'" src="'.$this->data["iframe"].'" frameborder="0" allowfullscreen></iframe>';
		}
		else
		{
			return "";
		}
	}
	
	public function get_embed($w = -1, $h = -1){
		$this->prepare_data("embed");
		if($this->site != "" && $this->data["embed"])
		{
			if($w < 0 || $h < 0)
			{
				$w = (is_int($this->data["w"]) && $this->data["w"] > 0) ? $this->data["w"] : $this->default_size["w"];
				$h = (is_int($this->data["h"]) && $this->data["h"] > 0) ? $this->data["h"] : $this->default_size["h"];
			}
			return '<object width="'.$w.'" height="'.$h.'" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"><param name="movie" value="'.$this->data["embed"].'"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="'.$this->data["embed"].'" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.$w.'" height="'.$h.'"></embed></object>';
		}
		else
		{
			return "";
		}
	}
	
	public function get_url(){
		if($this->site != "")
		{
			$this->prepare_data("url");
			return $this->data["url"];
		}
		else
		{
			return "";
		}
	}
	
	public function get_id(){
		return $this->code;
	}
	
	public function get_site(){
		$this->prepare_data("site");
		return $this->data["site"];
	}
	
	public function get_size(){
		$arr = array();
		$this->prepare_data("size");
		$arr["w"] = ($this->data["w"] < 0) ? $this->default_size["w"] : $this->data["w"];
		$arr["h"] = ($this->data["h"] < 0) ? $this->default_size["h"] : $this->data["h"];
		return $arr;
	}
	
	public function get_title(){
		$this->prepare_data("title");
		return $this->data["title"];
	}
	
	/**************************
	* PRIVATE FUNCTIONS
	**************************/
	private function get_data($url){
		//echo "<p>Curl request ".$url."</p>";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
		$curlData = curl_exec($curl);
		curl_close($curl);
		return $curlData;
	}
	
	private function prepare_data($type){
		if($this->site != "")
		{
			$ready = false;
			switch($type)
			{
				case "size":
					if($this->data["w"] > 0 && $this->data["h"] > 0)
					{
						$ready = true;
					}
				break;
				case "thumb":
					if($this->data["small"] != "" && $this->data["medium"] != "" && $this->data["large"] != "")
					{
						$ready = true;
					}
				break;
				default:
				if($this->data[$type] != "")
				{
					$ready = true;
				}
			}
			//if information is not yet loaded
			if(!$ready)
			{
				$func = ($this->site)."_data";
				$arr = $this->$func();
				//check if information requires http request
				if(!$arr[$type])
				{
					//if not, just provide data
					$func = ($this->site)."_".$type;
					$this->aggregate($this->$func(), $type);
				}
				else
				{
					//else if it needs http request we may as well load all other data
					//so we won't need to request it again
					$req = ($this->site)."_req";
					$res = $this->get_data($this->$req());
					foreach($arr as $key => $val)
					{
						$func = ($this->site)."_".$key;
						if($val)
						{
							$this->aggregate($this->$func($res), $key);
						}
						else
						{
							$this->aggregate($this->$func(), $key);
						}
					}
				}
			}
		}
	}
	
	private function aggregate($data, $type){
		if(is_array($data))
		{
			foreach($data as $key => $val)
			{
				$this->data[$key] = $val;
			}
		}
		else
		{
			$this->data[$type] = $data;
		}
	}
	
	/**************************
	* SOME STANDARDS
	**************************/
	//oembed functions
	private function oembed_size($res){
		$arr = array();
		$res = json_decode($res, true);
		if(is_array($res) && !empty($res) && isset($res["width"]) && isset($res["height"]))
		{
			$arr["w"] = (int)$res["width"];
			$arr["h"] = (int)$res["height"];
		}
		return $arr;
	}
	
	private function oembed_title($res){
		$title = "";
		$res = json_decode($res, true);
		if(is_array($res) && !empty($res) && isset($res["title"]))
		{
			$title = $res["title"];
		}
		return $title;
	}
	
	//og functions
	private function og_size($res){
		$arr = array();
		preg_match( '/property="og:video:width"\s*content="([\d]*)/i', $res, $match);
		if(!empty($match))
		{
			$arr["w"] = (int)$match[1];
		}
		preg_match( '/property="og:video:height"\s*content="([\d]*)/i', $res, $match);
		if(!empty($match))
		{
			$arr["h"] = (int)$match[1];
		}
		return $arr;
	}
	
	private function og_title($res){
		$ret = "";
		preg_match( '/property="og:title"\s*content="([^"]*)"/i', $res, $match);
		if(!empty($match))
		{
			$ret = $match[1];
		}
		return $ret;
	}
	
	private function og_video($res){
		$code = "";
		preg_match( '/<meta\s*property="og:video"\s*content="([^"]*)"/i', $res, $match);
		if(!empty($match))
		{
			$code = $match[1];
		}
		return $code;
	}
	
	//others
	private function link2title(){
		$title = "";
		$parts = explode("/", $this->code);
		if(isset($parts[1]))
		{
			$parts = explode("_", $parts[1]);
			foreach($parts as $key => $val)
			{
				$parts[$key] = ucfirst($val);
			}
			$title = implode(" ", $parts);
		}
		return $title;
	}
	/**************************
	* YOUTUBE FUNCTIONS
	**************************/
	
	//which data needs additional http request
	private function youtube_data(){
		return  array(
			"thumb" => false, 
			"size" => true, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function youtube_req(){
		return $this->youtube_url();
	}
	//return thumbnails
	private function youtube_thumb(){
		$size_types = array("small" => "default", "medium" => "hqdefault", "large" => "hqdefault");
		$arr = array();
		foreach($size_types as $key => $val)
		{
			$arr[$key] = "http://i.ytimg.com/vi/".($this->code)."/".$val.".jpg";
		}
		return $arr;
	}
	//return size
	private function youtube_size($res){
		return $this->og_size($res);
	}
	//return iframe url
	private function youtube_iframe(){
		return "http://www.youtube.com/embed/".($this->code);
	}
	//return embed url
	private function youtube_embed(){
		return "http://www.youtube.com/v/".($this->code);
	}
	//return canonical url
	private function youtube_url(){
		return "http://www.youtube.com/watch?v=".($this->code);
	}
	//return website url
	private function youtube_site(){
		return "http://www.youtube.com";
	}
	//return title
	private function youtube_title($res){
		return $this->og_title($res);
	}
	
	/**************************
	* VIMEO FUNCTIONS
	**************************/
	
	//which data needs additional http request
	private function vimeo_data(){
		return array(
			"thumb" => true, 
			"size" => true, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function vimeo_req(){
		return "http://vimeo.com/api/v2/video/".($this->code).".json";
	}
	//return thumbnails
	private function vimeo_thumb($res){
		$res = json_decode($res, true);
		$arr = array();
		if(is_array($res) && !empty($res))
		{
			$res = current($res);
			$sizes = array("small", "medium", "large");
			foreach($sizes as $val)
			{
				$arr[$val] = $res["thumbnail_".$val];
			}
		}
		return $arr;
	}
	//return size
	private function vimeo_size($res){
		$res = json_decode($res, true);
		$arr = array();
		if(is_array($res) && !empty($res))
		{
			$res = current($res);
			$arr["w"] = (int)$res["width"];
			$arr["h"] = (int)$res["height"];
		}
		return $arr;
	}
	//return iframe link
	private function vimeo_iframe(){
		return "http://player.vimeo.com/video/".($this->code);
	}
	//return embed url
	private function vimeo_embed(){
		return "http://vimeo.com/moogaloop.swf?clip_id=".($this->code);
	}
	//return canonical url
	private function vimeo_url(){
		return "http://www.vimeo.com/".($this->code);
	}
	//return website url
	private function vimeo_site(){
		return "http://www.vimeo.com";
	}
	//return title
	private function vimeo_title($res){
		$res = json_decode($res, true);
		$title = "";
		if(is_array($res) && !empty($res))
		{
			$res = current($res);
			$title = $res["title"];
		}
		return $title;
	}
	/**************************
	* DAILYMOTION FUNCTIONS
	**************************/
	//which data needs additional http request
	private function dailymotion_data(){
		return array(
			"thumb" => true, 
			"size" => true, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function dailymotion_req(){
		return "http://www.dailymotion.com/services/oembed?format=json&url=".$this->dailymotion_url();
	}
	//return thumbnails
	private function dailymotion_thumb($res){
		$arr = array();
		$res = json_decode($res, true);
		if(is_array($res) && !empty($res))
		{
			$arr["large"] = $res["thumbnail_url"];
			$arr["medium"] = str_replace("large", "medium", $res["thumbnail_url"]);
			$arr["small"] = str_replace("large", "small", $res["thumbnail_url"]);
		}
		return $arr;
	}
	//return size
	private function dailymotion_size($res){
		return $this->oembed_size($res);
	}
	//return iframe url
	private function dailymotion_iframe(){
		return "http://www.dailymotion.com/embed/video/".($this->code);
	}
	//return embed url
	private function dailymotion_embed(){
		return "http://www.dailymotion.com/swf/video/".($this->code);
	}
	//return canonical url
	private function dailymotion_url(){
		return "http://www.dailymotion.com/video/".($this->code);
	}
	//return website url
	private function dailymotion_site(){
		return "http://www.dailymotion.com";
	}
	//return title
	private function dailymotion_title($res){
		return $this->oembed_title($res);
	}
	
	/**************************
	* FUNNYORDIE FUNCTIONS
	**************************/
	private function funnyordie_decode(){
		$parts = explode("/", $this->code);
		return $parts[0];
	}
	//which data needs additional http request
	private function funnyordie_data(){
		return array(
			"thumb" => false, 
			"size" => true, 
			"embed" => false,
			"iframe" => false,
			"url" => false,
			"site" => false, 
			"title" => true
		);
	}
	//return http request url where to get data
	private function funnyordie_req(){
		return "http://www.funnyordie.com/oembed?format=json&url=".$this->funnyordie_url();
		
	}
	//return thumbnails
	private function funnyordie_thumb(){
		$arr = array();
		$arr["large"] = "http://t.fod4.com/t/".($this->funnyordie_decode())."/c480x270_30.jpg";
		$arr["medium"] = "http://t.fod4.com/t/".($this->funnyordie_decode())."/c480x270_30.jpg";
		$arr["small"] = "http://t.fod4.com/t/".($this->funnyordie_decode())."/c480x270_30.jpg";
		return $arr;
	}
	//return size
	private function funnyordie_size($res){
		return $this->oembed_size($res);
	}
	//return iframe url
	private function funnyordie_iframe(){
		return "http://public0.ordienetworks.com/flash/fodplayer.swf?key=".$this->funnyordie_decode();
	}
	//return embed url
	private function funnyordie_embed(){
		return $this->funnyordie_iframe();
	}
	//return canonical url
	private function funnyordie_url(){
		return "http://www.funnyordie.com/videos/".($this->code);
	}
	//return website url
	private function funnyordie_site(){
		return "http://www.funnyordie.com";
	}
	//return title
	private function funnyordie_title($res){
		return $this->oembed_title($res);
	}
	
}
?>