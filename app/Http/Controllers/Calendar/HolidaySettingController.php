<?php
namespace App\Http\Controllers\Calendar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendar\HolidaySetting;
class HolidaySettingController extends Controller
{

	function form(){

		//取得
		$setting = HolidaySetting::firstOrNew();
		return view("calendar/holiday_setting_form", [
			"setting" => $setting,
			"FLAG_OPEN" => HolidaySetting::OPEN,
			"FLAG_CLOSE" => HolidaySetting::CLOSE
		]);
	}
    function edit(){
			
		//取得
		$setting = HolidaySetting::firstOrNew();
		return view("calendar/holiday_setting_edit", [
			"setting" => $setting,
			"FLAG_OPEN" => HolidaySetting::OPEN,
			"FLAG_CLOSE" => HolidaySetting::CLOSE
		]);
	}
	function update(Request $request){
		//取得
		$setting = HolidaySetting::firstOrNew();
        //var_dump($request->flag_mon);
        //exit();
		//更新
		//$setting->create($request->all());
        $setting->update($request->all());
		return redirect()
			->action("App\Http\Controllers\Calendar\HolidaySettingController@form")
			->withStatus("保存しました");
	}
}
