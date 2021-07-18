<?php
namespace App\Http\Controllers\Calendar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendar\Form\CalendarFormView;
use App\Calendar\ExtraHoliday;
class ExtraHolidaySettingController extends Controller
{
	public function form(Request $request){

		//クエリーのdateを受け取る
		$date = $request->input("date");

		//dateがYYYY-MMの形式かどうか判定する
		if($date && strlen($date) == 7){
			$date = strtotime($date . "-01");
		}else{
			$date = null;
		}
		
		//取得出来ない時は現在(=今月)を指定する
		if(!$date)$date = time();
		
		//フォームを表示
		$calendar = new CalendarFormView($date);

		return view('calendar/extra_holiday_setting_form', [
			"calendar" => $calendar
		]);
	}

    
    public function edit($date_key){
    $schedules = ExtraHoliday::where('date_key', $date_key)->orderBy('schedule_time', 'asc')->get();
    //フォームを表示
    $calendar = new CalendarFormView($date_key);
                  

		return view('calendar/extra_holiday_setting_edit', [
            "date_key" => $date_key,
            "schedules" => $schedules,
            "calendar" => $calendar
		]);
	}
    
    
    public function delete(Request $request ,$id){
    $date_key = ExtraHoliday::getDatekeyById($id);
    ExtraHoliday::destroy($id);
    
    return redirect(route('edit_extra_holiday_setting', [
                   'date_key' => $date_key,
                ]));
	}
    
    public function ajax(Request $request){
       
        $formdata = $request->all();
        $hours = $request['schedule_hours']; 
        $minutes = $request['schedule_minutes']; 
        $schedule_time = $hours.':'.$minutes.':00';
        $schedule = $request['schedule_text']; 
        $date_key = $request['schedule_date_key']; 
            
		return response()->json([$formdata]);
	}
    
    public function schedule_store(Request $request){

        $hours = $request['schedule_hours']; 
        $minutes = $request['schedule_minutes']; 
        $schedule_time = $hours.':'.$minutes.':00';
        $schedule = $request['schedule_text']; 
        $date_key = $request['date_key']; 

        ExtraHoliday::storeSchedule($date_key, $schedule, $schedule_time);

		return redirect(route('edit_extra_holiday_setting', [
                   'date_key' => $date_key,
                ]));
	}
    public function schedule_update(Request $request){
        $id = $request['id'];
        $hours = $request['schedule_hours']; 
        $minutes = $request['schedule_minutes']; 
        $schedule_time = $hours.':'.$minutes.':00';
        $schedule = $request['schedule_text']; 
        $date_key = $request['update_date_key']; 

        ExtraHoliday::updateSchedule($schedule, $schedule_time, $id);

		return redirect(route('edit_extra_holiday_setting', [
                   'date_key' => $date_key,
                ]));
	}
}