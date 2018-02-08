<?php

namespace Alyahmmed\MediasciMail;

/**
* 
*/
class MailManager
{
	static $api_url;
	static $app_key;
	
	private static function init($data=array())
	{
		if (class_exists('Config')) {
			self::$api_url = \Config::get('mailapp.api_url');
			self::$app_key = \Config::get('mailapp.app_key');
		} else {
			self::$api_url = isset($data['api_url']) ? $data['api_url'] : '';
			self::$app_key = isset($data['app_key']) ? $data['app_key'] : '';
		}
	}

	public static function send($data)
	{
		self::init($data);
		$valid = self::validateData($data);
		if ($valid['status']) {
			return self::callUrl('send', $data, 'post');
		} else {
			return $valid['message'];
		}
	}

	private static function callUrl($url='', $data=array(), $method='get')
	{
		if (! self::$api_url) {
			return false;
		}
		$url = self::$api_url.$url;
		$data['app_key'] = self::$app_key;
		if (strtolower($method) == 'get') {
			$url .= '?' . http_build_query($data);
		}
		$agent = 'MediasciMail client v0.1';
		$results = array('body' => '', 'headers' => array(), 'info' => '');
		$curl = curl_init();
		if (strtolower($method) == 'post') {
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		}
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_ENCODING, '');
		curl_setopt($curl, CURLOPT_USERAGENT, $agent);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		curl_setopt($curl, CURLOPT_HEADER, 1);
		$response = curl_exec($curl);
		$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
		$results['headers'] = explode("\r\n", substr($response, 0, $header_size));
		$results['body'] = substr($response, $header_size);

		curl_close($curl);
		return $results['body'];
	}

	private static function validateData($data=array())
	{
		$results = array('status' => true, 'message' => '');
		$required = array('subject', 'body', 'from', 'to');
		foreach ($required as $key) {
			if (! in_array($key, array_keys($data))) {
				$results = array('status' => false, 'message' => 'missing '. $key);
				break;
			}
		}
		return $results;
	}
}
