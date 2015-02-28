<?php

class AuthController extends BaseController {

	/**
	 * 處理 OpenID 登入
	 * GET login/openid
	 */
	public function openIDLogin()
	{
		try{

			// $openid = new LightOpenID('my-host.example.org');
			$openid = new LightOpenID('localhost');

			if(!$openid->mode){
				// 第一步驟
				// 設定
				$openid->identity = 'http://openid.ntpc.edu.tw/';
				// 要求取得之資料欄位
				$openid->required = array(
										'namePerson/friendly',
										'contact/email',
										'namePerson',
										'birthDate',
										'person/gender',
										'contact/postalCode/home',
										'contact/country/home',
										'pref/language',
										'pref/timezone'
									);

				// 會先到　輸入帳密登入頁面
				// 再到 同意 / 不同意 授權頁面
				return Redirect::to($openid->authUrl());

			} elseif ($openid->mode == 'cancel') {
				// 使用者取消(不同意授權)
				return Redirect::to('/'); // 導回首頁

			} else {
				// 使用者同意授權
				// 此時 $openid->mode = "id_res"
				if ($openid->validate()) {
					// 通過驗證，也同意授權
					// 取得資料
				    $attr = $openid->getAttributes();
				    // return dd($attr);
				    // 將取得之資料帶到下一個步驟進行處理
				    // 要有相對應的路由設定
				    return Redirect::action('AuthController@showUserData', ['user' => $attr]);
				}

			}

		} catch (ErrorException $e) {

    		echo $e->getMessage();

		}
		
	}

	/**
	 * 處理自OpenID取得之User資料
	 * 
	 */
	public function showUserData(){
		// 取得傳過來的data
		$user_data = Input::get('user');
		
		// dd($user_data);
		$this->mydd($user_data);

		// 存到session
		Session::put('user_session', $user_data);
		echo "<hr />";
		echo "Session 裡的東西：";
		$this->mydd(Session::get('user_session', '這是預設值，沒設定過就用這個囉！！'));

		// 清掉全部session
		Session::flush();
		echo "<hr />";
		echo "Session 裡現在什麼都沒有：";
		$this->mydd(Session::get('user_session', '這是預設值，沒設定過就用這個囉！！'));

	}

	/**
	 * dump 資料，讓輸出較易讀
	 * 
	 */
	public function mydd($data){
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
	}

}
