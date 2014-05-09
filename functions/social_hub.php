<?php

// =========================================================
// REQUIRE
// =========================================================
require_once 'instagram.class.php';

class SocialHub{
	//                          __              __      
	//   _________  ____  _____/ /_____ _____  / /______
	//  / ___/ __ \/ __ \/ ___/ __/ __ `/ __ \/ __/ ___/
	// / /__/ /_/ / / / (__  ) /_/ /_/ / / / / /_(__  ) 
	// \___/\____/_/ /_/____/\__/\__,_/_/ /_/\__/____/  
	const REPLY_URL          = 'https://twitter.com/intent/tweet?in_reply_to=%s';
	const RETWEET_URL        = 'https://twitter.com/intent/retweet?tweet_id=%s';
	const FAVORITE_URL       = 'https://twitter.com/intent/favorite?tweet_id=%s';
	const TWITTER_SHARE_URL  = 'https://twitter.com/intent/tweet?via=%s&text=%s&url=%s';
	const TWITTER_USER_URL   = 'https://twitter.com/%s';
	const TWEET_URL          = 'https://twitter.com/%s/status/%s';
	const INSTAGRAM_USER_URL = 'http://instagram.com/%s';
	const CACHE_ON           = true;

	//                                       __  _          
	//     ____  _________  ____  ___  _____/ /_(_)__  _____
	//    / __ \/ ___/ __ \/ __ \/ _ \/ ___/ __/ / _ \/ ___/
	//   / /_/ / /  / /_/ / /_/ /  __/ /  / /_/ /  __(__  ) 
	//  / .___/_/   \____/ .___/\___/_/   \__/_/\___/____/  
	// /_/              /_/                                 
	public $instagram;
	public $twitter;
	public $options;
	private $items;

	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct()
	{
		$this->options = get_option('social_hub_options');
		$this->twitter = new TwitterOAuth(
			$this->options['twitter_consumer_key'], 
			$this->options['twitter_consumer_secret'], 
			$this->options['twitter_access_token'], 
			$this->options['twitter_access_token_secret']);
		$this->instagram = new Instagram(array(
			'apiKey'      => $this->options['instagram_app_key'],
			'apiSecret'   => $this->options['instagram_app_secret'],
			'apiCallback' => ''));

		wp_enqueue_script('masonry', get_bloginfo('template_url').'/js/masonry.js', array('jquery'));
		wp_enqueue_script('social_hub', get_bloginfo('template_url').'/js/social_hub.js', array('jquery'));
		wp_localize_script('social_hub', 'social_hub', array(
			'container'  => '.social-posts',
			'ajax_url'   => get_bloginfo('wpurl').'/wp-admin/admin-ajax.php',
			'more_count' => 1,
			'count'      => $this->options['count']));
	}

	/**
	 * Get All social items
	 * @return array
	 */
	public function getItems()
	{
		$cache = $this->getCache(__CLASS__);
		if($cache)
		{			
			return $cache;
		}

		$tweets = $this->getTweets();
		$instas = $this->getInstas();
		$items  = $this->merge(array($tweets, $instas));
		$items  = $this->sortByTime($items);	

		$this->setCache(__CLASS__, $items, 3600);
		return $items;
	}

	/**
	 * Set Cache
	 * @param string  $key    
	 * @param string  $val    
	 * @param integer $time   
	 * @param string  $prefix 
	 */
	public function setCache($key, $val, $time = 3600, $prefix = 'cheched-')
	{		
		set_transient($prefix.$key, $val, $time);
	}

	/**
	 * Get Cache
	 * @param  string $key    
	 * @param  string $prefix 
	 * @return mixed
	 */
	public function getCache($key, $prefix = 'cheched-')
	{		
		if(self::CACHE_ON)
		{
			$cached   = get_transient($prefix.$key);
			if (false !== $cached) return $cached;	
		}
		return false;
	}

	/**
	 * Get instagram items
	 * @return array
	 */
	public function getInstas()
	{
		$hash = str_replace('#', '', $this->options['instagram_hash']);
		$data = $this->instagram->getTagMedia($hash, 30);		
		$out  = array();

		if($data->data)
		{
			foreach ($data->data as &$item) 
			{				
				$res['id']					 = $item->id;
				$res['text']				 = $item->caption->text;
				$res['img']				     = $item->images->low_resolution->url;
				$res['time']			     = intval($item->created_time);
				$res['link']			     = $item->link;
				$res['type']				 = 'instagram';
				$res['user']['name']         = $item->user->username;
				$res['user']['display_name'] = $item->user->full_name;
				$res['user']['img']          = $item->user->profile_picture;
				array_push($out, $res);
			}
		}

		return $out;
	}

	/**
	 * Get twitter items
	 * @return array
	 */
	public function getTweets()
	{
		$tweets = $this->twitter->get("https://api.twitter.com/1.1/search/tweets.json?q=".urlencode($this->options['twitter_hash'])."&count=30");
		$tweets = json_decode($tweets);
		$out    = array();

		if($tweets->statuses)
		{
			foreach ($tweets->statuses as &$item) 
			{
				$res['id']					 = $item->id_str;
				$res['text']				 = $item->text;
				$res['img']				     = $item->images->low_resolution->url;
				$res['time']			     = strtotime($item->created_at);
				$res['link']			     = sprintf(self::TWEET_URL, $item->user->screen_name, $item->id_str);
				$res['type']                 = 'twitter';
				$res['user']['name']         = $item->user->screen_name;
				$res['user']['display_name'] = $item->user->name;
				$res['user']['img']          = $item->user->profile_image_url;
				array_push($out, $res);
			}
		}		
		return $out;
	}

	/**
	 * Wrap all items to HTML code
	 * @param  array $items --- items to wrap
	 */
	public function wrapItems($items)
	{
		$out = '';
		if($items)
		{
			foreach ($items as $item) 
			{
				switch ($item['type']) 
				{
					case 'twitter':
						$out .= $this->wrapTweet($item);
						break;
					case 'instagram':
						$out .= $this->wrapInstagram($item);
						break;
				}
			}
		}
		return $out;
	}

	/**
	 * Wrap tweet item
	 * @param  array $item --- one twitter item
	 */
	private function wrapTweet($item)
	{
		$minutes_ago = intval((microtime(true) - $item['time']) / 60);
		$user_url    = sprintf(self::TWITTER_USER_URL, $item['user']['name']);
		$url         = $item['link'];
		$reply       = sprintf(self::REPLY_URL, $item['id']);
		$retweet     = sprintf(self::RETWEET_URL, $item['id']);
		$favorite    = sprintf(self::FAVORITE_URL, $item['id']);
		$share       = sprintf(self::TWITTER_SHARE_URL, $item['user']['name'], urlencode($item['text']), $url);
		ob_start();
		?>
		<div class="social-post filter-twitter">
			<span class="post-type-ico twitter"></span>								
			<div class="text">
				<p><a href="<?php echo $url; ?>"><?php echo $item['text']; ?></a></p>
				<div class="sub-row">
					<?php echo $minutes_ago; ?> minutes ago
					<div class="tweet-control">
						<a href="<?php echo $reply; ?>" class="reply">reply</a>
						<a href="<?php echo $retweet; ?>" class="retweet">retweet</a>
						<a href="<?php echo $favorite; ?>" class="favorite">favorite</a>
					</div>
				</div>
			</div>
			<div class="footer">
				<a href="<?php echo $share; ?>" class="share">share</a>
				<a href="<?php echo $user_url; ?>" class="user">
					<img src="<?php echo $item['user']['img']; ?>" alt="<?php echo $item['user']['display_name']; ?>" width="50">
					<span><b><?php echo $item['user']['display_name']; ?></b> <br>@<?php echo $item['user']['name']; ?></span>
				</a>
			</div>
		</div>
		<?php
		$var = ob_get_contents();
		ob_end_clean();
    	return $var;
	}

	/**
	 * Wrap instagram item
	 * @param  array $item --- one instagram item
	 */
	public function wrapInstagram($item)
	{	
		$url         = $item['link'];
		$user_url    = sprintf(self::INSTAGRAM_USER_URL, $item['user']['name']);
		$minutes_ago = intval((microtime(true) - $item['time']) / 60);
		$share       = sprintf(self::TWITTER_SHARE_URL, '', urlencode($item['text']), $url);
		ob_start();
		?>
		<div class="social-post filer-instagram">
			<span class="post-type-ico instagram"></span>
			<div class="image">
				<img src="<?php echo $item['img']; ?>" alt="">
			</div>
			<div class="text">
				<p><a href="<?php echo $url; ?>"><?php echo $item['text']; ?></a></p>
				<div class="sub-row">
					<?php echo $minutes_ago; ?> minutes ago					
				</div>
			</div>
			<div class="footer">
				<a href="<?php echo $share; ?>" class="share">share</a>
				<a href="<?php echo $user_url; ?>" class="user">
					<img src="<?php echo $item['user']['img']; ?>" alt="<?php echo $item['user']['display_name']; ?>" width="50">
					<span><b><?php echo $item['user']['display_name']; ?></b> <br>@<?php echo $item['user']['name']; ?></span>
				</a>
			</div>
		</div>
		<?php
		$var = ob_get_contents();
		ob_end_clean();
    	return $var;
	}

	/**
	 * Custom array merge
	 * @param  array $args --- arrays
	 * @return array       --- one big array
	 */
	public function merge($args)
	{
		$res = array();

		if($args)
		{
			foreach ($args as &$arr) 
			{
				if(is_array($arr))
				{
					foreach ($arr as &$el) 
					{
						$res[] = $el;
					}
				}
			}
		}
		return $res;
	}

	/**
	 * Custom sort Social items
	 * @param  array $arr --- social items
	 * @return array      --- sorted result
	 */
	public function sortByTime($arr)
	{
		$res   = array();
		$times = array_map(array(&$this, 'getTime'), $arr);
		arsort($times);
		foreach ($times as $key => $value) 
		{
		 	$res[] = $arr[$key];
		} 
		return $res;
	}

	/**
	 * Get time from array element
	 * @param  array $el --- array element
	 * @return integer   --- time unix format
	 */
	public function getTime($el)
	{
		return $el['time'];
	}
	
}
// =========================================================
// LAUNCH
// =========================================================
$GLOBALS['social_hub'] = new SocialHub();