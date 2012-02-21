<?php 
class BrowserHelper extends Helper{

	/**
	 * Chris Schuld's Browser Class var 
	 * (http://chrisschuld.com/) 
	 */
	private $_browser = null;
	
	/**
	 * Harald Hope's Full Featured PHP Browser/OS detection var
	 * (http://techpatterns.com/downloads/php_browser_detection.php
	 */
	private $_browserDetection = null;


	/**
	 * $OSs os mappings from header descriptions, see BrowserDetection Class
	 */
	protected $OSs = array(
		'Windows' => 'nt',
		// add more os mappings here
	);
	
	/**
	 * $OSs os varsion mappings from header descriptions, see BrowserDetection Class
	 */
	protected $OSVersions = array(
		'XP' => '5.1',
		'Vista' => '6',
		// add more os version mappings here
	);

	public function beforeRender(){
		parent::beforeRender();
		App::import('Libs', 'Browser.Browser');
		App::import('Libs', 'Browser.BrowserDetection');
		$this->_browser = new Browser();
		$this->_browserDetection = new BrowserDetection();
	}		
	
	/**
	 * wrapper methods:
	 */
		
	public function getBrowser(){
		return $this->_browser->getBrowser();
	}
	
	public function getVersion(){
		return $this->_browser->getVersion();
	}
	
	public function getPlatform(){
		return $this->_browser->getPlatform();
	}
	
	public function browserDetection($which_test, $test_excludes='', $external_ua_string=''){
		return $this->_browserDetection->browser_detection($which_test, $test_excludes, $external_ua_string);
	}
	
	/**
	 * $maxVersionToCheck set a maximum version number (eg 7.0) 
	  * $browserToCheck default is IE
	 * $platformToCheck  default is Windows
	 * $slimVersionNumber default to true, so $maxVersionToCheck can be 7 instead of 7.2.3.2
	 * $OSVersion default is XP set to null to not check version
	 * 
	 */
	public function checkBrowserVersionPlatform(
		$maxVersionToCheck = null, $browserToCheck = null, 
		$platformToCheck = null, $OSVersion ='XP',  $slimVersionNumber = true)
	{
		$browserToCheck = !empty($browserToCheck)? $browserToCheck : Browser::BROWSER_IE;
		$maxVersionToCheck = !empty($maxVersionToCheck)? $maxVersionToCheck : 7;
		$platformToCheck = !empty($platformToCheck)? $platformToCheck : Browser::PLATFORM_WINDOWS; 
		
		$version = $this->getVersion();
		if($slimVersionNumber){
			$version = array_shift(split('\.',$version));
		}
	
		//check OS version if necessary:
		$osVersionPass = true;
		if($OSVersion){
			$osVersionPass = false;
			if( $this->OSVersions[$OSVersion]== $this->browserDetection( 'os_number' )){
				$osVersionPass = true;
			}
		}
		
		
		//debug($this->browserDetection( 'os_number' ));
		//debug($this->getBrowser());
		//debug($version);
		//debug($this->getPlatform());
		//debug($osVersionPass);
		
		
		if(
			$this->getBrowser() == $browserToCheck &&
			$version <= $maxVersionToCheck &&
			$this->getPlatform() == $platformToCheck &&
			$osVersionPass
		  )
		{
			return true;
		}
		return false;
	}

}