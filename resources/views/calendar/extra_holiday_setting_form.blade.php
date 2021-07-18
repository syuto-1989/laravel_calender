@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
				<div class="card-header text-center">
					<a class="btn btn-outline-secondary float-left" href="{{ url('/extra_holiday_setting?date=' . $calendar->getPreviousMonth()) }}">前の月</a>
					
					<span>{{ $calendar->getTitle() }}の臨時営業日設定</span>
				
					<a class="btn btn-outline-secondary float-right" href="{{ url('/extra_holiday_setting?date=' . $calendar->getNextMonth()) }}">次の月</a>
				</div>
               <div class="card-body">
					@if (session('status'))
                       <div class="alert alert-success" role="alert">
                           {{ session('status') }}
                       </div>
                   @endif
					<form method="post" action="{{ route('update_extra_holiday_setting') }}">
						@csrf
						<div class="card-body">
							{!! $calendar->render() !!}
							<div class="text-center">
								<button type="submit" class="btn btn-primary">保存</button>
							</div>
						</div>
						
					</form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection