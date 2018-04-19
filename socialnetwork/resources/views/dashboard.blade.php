@extends('layouts.master')

@section('logout')
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	 	<ul class="nav navbar-nav navbar-right">
	        <li><a href="{{route('account')}}">Account</a></li>
	        <li><a href="{{route('logout')}}">Logout</a></li>
			        
     	</ul>	      
	 </div><!-- /.navbar-collapse -->
@endsection
	


@section('content')
	@include('includes.message-block')
	





	<section class="row new-post">
		<div class="col-md-6 col-md-offset-3">
			<header> <h3>What do you have to say?</h3> </header>
			<form action=" {{ route('post.create') }}" method="post" >
				<div class"form-group">
					<textarea class="new-post" id="new-post" name="body" placeholder="Your Post" rows="5" cols="100"></textarea>
				</div>

				<button type="submit" class="btn btn-primary">Create Post</button>
				<input type="hidden" name="_token" value="{{ Session::token() }}">


			</form>
		</div>
	</section>
	
	<section class="row posts">
		<div class="col-md-6 col-md-offset-3">
			<header> <h3>Time Line</h3> </header>

			<!-- $posts disini sama dengan 'posts' pada PostController fungsi getDashboard-->
			@foreach($posts as $post)

				<article class="post" data-postid="{{$post->id}}">
					<p>
						{{$post->body}}
					</p>
					<div class="info">
						Posted by {{$post->user->first_name}} on {{$post->created_at}} 2018
						<!-- mengakses data pada tabel user menggunakan fungsi user() pada Post model-->
					</div>
					
					<div class="interaction">
						<a href="#" class="like">Like</a>	
						<a href="#" class="like">Dislike</a>

						@if(Auth::user() == $post->user)
							<a href="#" class="edit">Edit</a>
							<a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>

						@endif



						

						<!-- route menerima menerima parameter post_id yang nilainya $post->id akan dipassing ke ke ethod getDeletePost. jadi getDeletePost akan menghapus id yang nilainya difereerensikan dengan $post->id (lihat foreach diatas)-->
					</div>

				</article>

			@endforeach
		</div>

		



		





	</section>

<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Post</h4>
      </div>
      <div class="modal-body">
        <form>
        	<div class="form-group">
        		<label for="post-body">Edit The Post</label>
        		<textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	var token = '{{ Session::token() }}';
	var urlEdit = '{{ route('edit') }}';
	var urlLike = '{{ route('like') }}';
</script>

@endsection