<?php

function getUserCitys($type) {
    $c_province = cookie("province_id");
    $c_city = cookie("city_id");
    $c_country = cookie("country_id");
    if (!$c_province) {
        $ipModel = new \Home\Model\IpModel();
        $cityController = new \Home\Controller\CityController();
        $ip_info = $ipModel->get_city_name();

        if (is_array($ip_info)) {
            $province = $cityController->replace_city_name($ip_info['province']);
            $province_info = M("citys")->field("id")->where("name='" . $province . "'")->find();
            $c_province = $province_info['id'];
            if ($c_province > 0) {
                $city_info = M("citys")->field("id")->where("pid = '" . $c_province . "'")->find();
                $c_city = $city_info['id'];
                if ($c_city > 0) {
                    $country_info = M("citys")->field("id")->where("pid = '" . $c_city . "'")->find();
                    $c_country = $country_info['id'];
                }

            }
        }
    }
    if ($c_province == '' or $c_city == '') {
        $c_province = 320000;//江苏
        $c_city = 320100;//南京
        $c_country = 320102;//玄武
        cookie("province_id", $c_province);
        cookie("city_id", $c_city);
        cookie("country_id", $c_country);
    }
    $rs = array("province_id" => $c_province, "city_id" => $c_city, "country_id" => $c_country);
    if ($type == '1') {
        $province_info = M("citys")->field("name")->where("id='" . $c_province . "'")->find();
        $city_info = M("citys")->field("name")->where("id='" . $c_city . "'")->find();
        if ($c_country > 0) {
            $country_info = M("citys")->field("name")->where("id='" . $c_country . "'")->find();
        }
        $rs['province_name'] = $province_info['name'];
        $rs['city_name'] = $city_info['name'];
        $rs['country_name'] = $country_info['name'];
    }
    return $rs;
}

?>