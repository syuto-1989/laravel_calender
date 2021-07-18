@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
				<div class="card-header text-center">
					<a class="btn btn-outline-secondary float-left" href="{{ url('/extra_holiday_setting/edit/' . $calendar->getPreviousDay()) }}">前の日</a>
					
					<span>{{ $date_key }}の予定設定</span>
				
					<a class="btn btn-outline-secondary float-right" href="{{ url('/extra_holiday_setting/edit/' . $calendar->getNextDay()) }}">次の日</a>
				</div>
               <div class="card-body">
					@if (session('status'))
                       <div class="alert alert-success" role="alert">
                           {{ session('status') }}
                       </div>
                   @endif
					<form method="post" action="{{ route('schedule_setting') }}">
						@csrf
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
							<div class="scheduleBtn text-center">
								<button type="submit" class="btn btn-primary">保存</button>
							</div>
                            <input class="form-control" type="hidden" name="date_key" value="{{ $date_key }}" />
						</div>
						
					</form>
                   <div id="schedule">
                       @foreach($schedules as $schedule)
                       @php
                        $schedule->schedule_time = substr($schedule->schedule_time, 0, -3);
                       @endphp
                       <form method="post" action="{{ route('schedule_update') }}">
						@csrf
                       <div class="scheduleBox box_{{$schedule->id}}">
                           <div class="time time_{{$schedule->id}}">{{$schedule->schedule_time}}</div>
                           <div class="schedule schedule_{{$schedule->id}}">{{$schedule->schedule_comment}}</div>
                           <div class="editBlock">
                               <div class="update btn">
                                <button type="submit" class="updateBtn" value="{{$schedule->id}}">編集</button>
                               </div>
                               <div class="delete btn">
                                <a class="delete" href="/extra_holiday_setting/delete/{{$schedule->id}}">削除</a>
                               </div>
                           </div>
                       </div>
                        <input class="updateDateKey" type="hidden" name="update_date_key" value="{{ $date_key }}" />
                       </form>
                       @endforeach
                   </div>
                    <a href="/" class="btn btn-primary">トップへ</a>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection