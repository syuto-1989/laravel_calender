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
							<select id="schedule_hours" name="schedule_hours" class="form-control">
                                <option value="選択してください" >選択してください</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                            </select>
                            <select id="schedule_minutes" name="schedule_minutes" class="form-control">
                                <option value="選択してください" >選択してください</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                            </select>
                            <input id="schedule_text" class="form-control" type="text" name="schedule_text" value="" />
							<div class="text-center">
								<button type="submit" class="btn btn-primary">保存</button>
							</div>
                            <input class="form-control" type="hidden" name="date_key" value="{{ $date_key }}" />
						</div>
						
					</form>
                   <!---
                   <div id="form">
						@csrf
						<div class="card-body">
							<select id="schedule_hours" name="extra_holiday[{{ $date_key }}][hours]" class="form-control">
                                <option value="選択してください" >選択してください</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                            </select>
                            <select id="schedule_minutes" name="extra_holiday[{{ $date_key }}][minutes]" class="form-control">
                                <option value="選択してください" >選択してください</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                            </select>
                            <input id="schedule_text" class="form-control" type="text" name="extra_holiday[{{ $date_key }}][schedule]" value="{{ $schedule }}" />
							<div class="text-center">
								<button id="bt2" class="btn btn-primary">登録</button>
							</div>
                            <input class="form-control" type="hidden" name="schedule_date_key" value="{{ $date_key }}" />
						</div>
					</div>
                    --->
                   <div id="schedule">
                       @foreach($schedules as $schedule)
                       dd(schedule);
                       <div class="time">{{$schedule->schedule_time}}</div>
                       <div class="schedule">{{$schedule->schedule_comment}}</div>
                       @endforeach
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection