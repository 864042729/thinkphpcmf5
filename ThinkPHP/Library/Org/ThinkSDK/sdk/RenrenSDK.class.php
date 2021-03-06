<?php

// +----------------------------------------------------------------------
// | TOPThink [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2010 http://topthink.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 素材火 <416148489@qq.com> <http://www.sucaihuo.com>
// +----------------------------------------------------------------------
// | RenrenSDK.class.php 2013-02-25
// +----------------------------------------------------------------------

class RenrenSDK extends ThinkOauth {

    /**
     * 获取requestCode的api接口
     * @var string
     */
    protected $GetRequestCodeURL = 'http://graph.renren.com/oauth/authorize';

    /**
     * 获取access_token的api接口
     * @var string
     */
    protected $GetAccessTokenURL = 'http://graph.renren.com/oauth/token';
    
      protected $Authorize = 'scope=publish_feed';
    /**
     * API根路径
     * @var string
     */
//	protected $ApiBase = 'http://api.renren.com/restserver.do';
    protected $ApiBase = 'api.renren.com';

    /**
     * 组装接口调用参数 并调用接口
     * @param  string $api    微博API
     * @param  string $param  调用API的额外参数
     * @param  string $method HTTP请求方法 默认为GET
     * @return json
     */
    public function call($api, $param = '', $method = 'POST', $multi = false) {
        /* 人人网调用公共参数 */
        $params = array(
            'method' => $api,
            'access_token' => $this->Token['access_token'],
            'v' => '2.0',
            'format' => 'json',
        );
        if($api == 'feed/put'){
           $url = "https://api.renren.com/v2/feed/put";
//           print_r($params);
//           print_r($param);
//           print_r($this->param($params, $param));
//           exit;
        }else{
           $url = $this->url(''); 
        }
        $data = $this->http($url, $this->param($params, $param), $method);
        print_r($data);exit;
        return json_decode($data, true);
    }

    /**
     * 合并默认参数和额外参数
     * @param array $params  默认参数
     * @param array/string $param 额外参数
     * @return array:
     */
    protected function param($params, $param) {
        $params = parent::param($params, $param);

        /* 签名 */
        ksort($params);
        $param = array();
        foreach ($params as $key => $value) {
            $param[] = "{$key}={$value}";
        }
        $sign = implode('', $param) . $this->AppSecret;
        $params['sig'] = md5($sign);

        return $params;
    }

    /**
     * 解析access_token方法请求后的返回值
     * @param string $result 获取access_token的方法的返回值
     */
    protected function parseToken($result, $extend) {
        $data = json_decode($result, true);
        if ($data['access_token'] && $data['expires_in'] && $data['refresh_token'] && $data['user']['id']) {
            $data['openid'] = $data['user']['id'];
            unset($data['user']);
            return $data;
        } else
            throw new Exception("获取人人网ACCESS_TOKEN出错：{$data['error_description']}");
    }

    /**
     * 获取当前授权应用的openid
     * @return string
     */
    public function openid() {
        $data = $this->Token;
        if (!empty($data['openid']))
            return $data['openid'];
        else
            throw new Exception('没有获取到人人网用户ID！');
    }

}
