@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header text-center alert-info">
		{{$problem->title}}
	</div>

	<div class="card-body">
		<div class="card">
			<div class="card-header @if($problem->open) alert-success @else alert-danger @endif">
				{{$problem->title}} <span class="pull-right">
					@if(Auth::user()->isAdmin OR $problem->user_id == Auth::user()->id)
					<form id="submit-form" action="{{route('problem.status',['id' => $problem->id])}}" method="POST" class="hidden">
						@csrf
						@method('PATCH')
						<input @if($problem->open) class="btn btn-danger" value="Close" @else class="btn btn-primary" value="Open" @endif type="submit"></input>
					</form>
					@endif
				</span>
			</div>
			<div class="card-body">
				<p class="text-center">
					{{$problem->body}}......
				</p>
			</div>
			<div class="card-footer">
				By : {{$problem->user->name}} | {{\Carbon\Carbon::parse($problem->created_at)->diffForHumans()}} | Status : @if($problem->open) Open @else Closed @endif
			</div>
		</div>
	</div>
</div>

@if($problem->solutions)
@foreach($problem->solutions as $reply)
<div class="card">
	<div class="card-header text-center alert-info">
		{{$reply->user->name}} said : {{$reply->created_at->diffForHumans()}}..
		<span class="pull-right">
			<div class="row">
				@if($problem->open AND $problem->user_id == Auth::user()->id)
				<form id="submit-form" action="{{route('solution.status',['id' => $reply->id, 'problem'=> $problem->id])}}" method="POST" class="hidden">
					@csrf
					@method('PATCH')
					@if($reply->isBest)
					<div>
						<input class="btn btn-warning" value="Revert to normal" type="submit"></input>
					</div>
					@else
					<input class="btn btn-primary" value="Make it Best" type="submit"></input>
					@endif
				</form>
				@endif
				@if($reply->isBest)
				<div>
					<input class="btn btn-success disabled" value="Best Answer" type="label"></input>
				</div>
				@endif
			</div>
		</span>
	</div>
	<div class="card-body">
		<p class="text-center">
			{{$reply->body}}
		</p>
	</div>
</div>
@endforeach
@endif
@if(Auth::check())
<br>
@if($problem->open)
<div class="card">
	<div class="card-header">Reply</div>
	<div class="card-body">
		<form action="{{route('post.reply',['problem' => $problem->id])}}" method="POST">
			@csrf
			<div class="form-group">
				<textarea name="body" class="form-control" placeholder="Anything to Say?" rows="5"></textarea>
			</div>
			<div class="form-group">
				<input type="submit" value="Reply" class="btn btn-primary btn-block">
			</div>
		</form>
	</div>
</div>
@else
<button type="button" class="btn btn-warning btn-lg btn-block">Closed By Admin</button>
@endif
@else
<p class="text-center">Please <a href="{{route('login')}}">SingIn</a> to participate</p>
@endif

@endsection
