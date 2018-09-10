<div class="{{$component->columns}} columns post-display">
	<h2>Latest from the Chamber:</h2>


	<div class="row box-sml">
	@php $blogs = $component->loop('blog'); @endphp
	@foreach($blogs as $post)
		@if($loop->iteration < 4)
			<div class="four columns">
				<img src="{{$post->featimg()}}" alt="{{$post->title}}">
				<h3>{{$post->title}}</h3>
				<p>{{ time_elapsed_string($post->created_at) }}</p>
				<a href="/{{$post->slug}}">Read More</a>
			</div>
		@endif
	@endforeach
	</div>

</div>