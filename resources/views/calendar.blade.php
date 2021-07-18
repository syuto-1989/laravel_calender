@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-7">
           <div class="card">
               <div class="card-header text-center">
					<a class="btn btn-outline-secondary float-left" href="{{ url('/?date=' . $calendar->getPreviousMonth()) }}">前の月</a>

					<span>{{ $calendar->getTitle() }}</span>

					<a class="btn btn-outline-secondary float-right" href="{{ url('/?date=' . $calendar->getNextMonth()) }}">次の月</a>
				</div>
				<div class="card-body">
					{!! $calendar->render() !!}
               </div>
           </div>
       </div>
        <div class="col-md-5">
           <div id="schedule">
               <h1 id="dateToday">本日（{{$date_today}}）の予定</h1>
               <div class="card-body">
                <div class="timeWrap">
                    <div class="timeBox">
                        <select id="schedule_hours" name="schedule_hours" class="form-control">
                            <option value="選択してください" >選択してください</option>
                            @php
                                for($i=1; $i<=24; $i++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                            @endphp
                        </select>
                        <span>時</span>
                    </div>
                    <div class="timeBox">
                        <select id="schedule_minutes" name="schedule_minutes" class="form-control">
                            <option value="選択してください" >選択してください</option>
                            @php
                                for($i=00; $i<60; $i++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                            @endphp
                        </select>
                        <span>分</span>
                    </div>
                    <div class="scheduleText">
                        <span>予定</span>
                        <input id="schedule_text" class="form-control" type="text" name="schedule_text" value="" />
                    </div>
                </div>
                <div class="ajaxStoreBtn text-center">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
              </div>
            　<div id="store_date_key">
               <input class="form-control" type="hidden" name="store_date_key" value="{{ $date_key }}" />
            　</div>
              <div class="for_edit">
                  <a href="/extra_holiday_setting/edit/{{$date_key}}">編集</a>
              </div>
              <div id="scheduleArea">
               <input class="form-control" type="hidden" name="store_date_key" value="{{ $date_key }}" />
               @if(!empty($schedules))
                   @foreach($schedules as $schedule)
                   @php
                    $schedule->schedule_time = substr($schedule->schedule_time, 0, -3);
                   @endphp
                   <div class="scheduleBox box_{{$schedule->id}}">
                       <div class="user_name user_{{$schedule->user->id}}">{{$schedule->user->name}}</div>
                       <div class="time time_{{$schedule->id}}">{{$schedule->schedule_time}}</div>
                       <div class="schedule schedule_{{$schedule->id}}">{{$schedule->schedule_comment}}</div>
                       @if( Auth::id() == $schedule->user->id)
                         <div class="delete btn">
                             <button id="ajaxDelete" class="delete ajaxDelete">削除</button>
                             <input type="hidden" name="ajaxDeleteId" value="{{$schedule->id}}">
                             <input type="hidden" name="ajaxDateKey" value="{{$date_key}}">
                         </div>
                         <div class="update btn"><button type="submit" value="{{$schedule->id}}" class="updateBtnTop">編集</button><input type="hidden" name="update_date_key" value="{{$date_key}}"></div>
                       @endif
                   </div>
                   @endforeach
               @else
                <p>予定がありません</p>
               @endif
              </div>
           </div>
       </div>
   </div>
</div>
@endsection
