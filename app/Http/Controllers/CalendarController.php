<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Calendar\CalendarView;
use App\Calendar\Output\CalendarOutputView;
use App\Calendar\ExtraHoliday;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CalendarController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

   public function show(Request $request){
		//クエリーのdateを受け取る
		$date = $request->input("date");

		//dateがYYYY-MMの形式かどうか判定する
		if($date && preg_match("/^[0-9]{4}-[0-9]{2}$/", $date)){
			$date = strtotime($date . "-01");
		}else{
			$date = null;
		}

		//取得出来ない時は現在(=今月)を指定する
		if(!$date)$date = time();

		$calendar = new CalendarOutputView($date);

    $date_key = date("Ymd");
    $date_today = date("Y年m月d日");
    $schedules = array();
    $schedules = ExtraHoliday::where('date_key', $date_key)->orderBy('schedule_time', 'asc')->get();
		return view('calendar', [
			"calendar" => $calendar,
			"date_today" => $date_today,
			"date_key" => $date_key,
			"schedules" => $schedules
		]);
	}
  public function ajax(Request $request){

        //$formdata = $request->all();
        $date_key = $request['schedule_date_key'];
        $schedules = ExtraHoliday::where('date_key', $date_key)->orderBy('schedule_time', 'asc')->get();
        $user_id =  Auth::id();

        foreach($schedules as $schedule){
           $schedule->schedule_time = substr($schedule->schedule_time, 0,5);
           $schedule->date_key = date('Y年m月d日',  strtotime($schedule->date_key));
           $schedule['user_name'] = $schedule->user->name;
           $schedule['current_user_id'] = $user_id;
        }

		return response()->json([$schedules]);
	}

    public function ajax_delete(Request $request){
        $id = $request['id'];
        $date_key = ExtraHoliday::getDatekeyById($id);
        ExtraHoliday::destroy($id);
        $schedules = ExtraHoliday::where('date_key', $date_key)->orderBy('schedule_time', 'asc')->get();
        $user_id =  Auth::id();

        foreach($schedules as $schedule){
           $schedule->schedule_time = substr($schedule->schedule_time, 0,5);
           $schedule['user_name'] = $schedule->user->name;
           $schedule['current_user_id'] = $user_id;
        }

		return response()->json([$schedules]);
	}

    public function ajax_store(Request $request){
        $formdata = $request->all();

        $hours = $request['schedule_hours'];
        $minutes = $request['schedule_minutes'];
        $schedule_time = $hours.':'.$minutes.':00';
        $schedule_text = $request['schedule_text'];
        $date_key = $request['date_key'];
        $user_id =  Auth::id();

        ExtraHoliday::storeSchedule($date_key, $schedule_text, $schedule_time, $user_id);

        $schedules = ExtraHoliday::where('date_key', $date_key)->orderBy('schedule_time', 'asc')->get();

        foreach($schedules as $schedule){
           $schedule->schedule_time = substr($schedule->schedule_time, 0,5);
           $schedule['user_name'] = $schedule->user->name;
           $schedule['current_user_id'] = $user_id;
        }

		return response()->json([$schedules]);
	}

  public function ajax_update(Request $request){
       // $formdata = $request->all();
        $id = $request['id'];
        $hours = $request['schedule_hours'];
        $minutes = $request['schedule_minutes'];
        $schedule_time = $hours.':'.$minutes.':00';
        $schedule_text = $request['schedule_text'];
        $date_key = $request['date_key'];
        $user_id =  Auth::id();

        ExtraHoliday::updateSchedule($schedule_text, $schedule_time, $id);

        $schedules = ExtraHoliday::where('date_key', $date_key)->orderBy('schedule_time', 'asc')->get();

        foreach($schedules as $schedule){
           $schedule->schedule_time = substr($schedule->schedule_time, 0,5);
           $schedule['user_name'] = $schedule->user->name;
           $schedule['current_user_id'] = $user_id;
        }


		return response()->json([$schedules]);
	}

  public function ajax_cancel(Request $request){

      $date_key = $request['schedule_date_key'];
      $schedules = ExtraHoliday::where('date_key', $date_key)->orderBy('schedule_time', 'asc')->get();
      $user_id =  Auth::id();

      foreach($schedules as $schedule){
         $schedule->schedule_time = substr($schedule->schedule_time, 0,5);
         $schedule->date_key = date('Y年m月d日',  strtotime($schedule->date_key));
         $schedule['user_name'] = $schedule->user->name;
         $schedule['current_user_id'] = $user_id;
      }

  return response()->json([$schedules]);
 }
}
