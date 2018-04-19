<?php $__env->startSection('logout'); ?>
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	 	<ul class="nav navbar-nav navbar-right">
	        <li><a href="<?php echo e(route('account')); ?>">Account</a></li>
	        <li><a href="<?php echo e(route('logout')); ?>">Logout</a></li>
			        
     	</ul>	      
	 </div><!-- /.navbar-collapse -->
<?php $__env->stopSection(); ?>
	


<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('includes.message-block', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	





	<section class="row new-post">
		<div class="col-md-6 col-md-offset-3">
			<header> <h3>What do you have to say?</h3> </header>
			<form action=" <?php echo e(route('post.create')); ?>" method="post" >
				<div class"form-group">
					<textarea class="new-post" id="new-post" name="body" placeholder="Your Post" rows="5" cols="100"></textarea>
				</div>

				<button type="submit" class="btn btn-primary">Create Post</button>
				<input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">


			</form>
		</div>
	</section>
	
	<section class="row posts">
		<div class="col-md-6 col-md-offset-3">
			<header> <h3>Time Line</h3> </header>

			<!-- $posts disini sama dengan 'posts' pada PostController fungsi getDashboard-->
			<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				<article class="post" data-postid="<?php echo e($post->id); ?>">
					<p>
						<?php echo e($post->body); ?>

					</p>
					<div class="info">
						Posted by <?php echo e($post->user->first_name); ?> on <?php echo e($post->created_at); ?> 2018
						<!-- mengakses data pada tabel user menggunakan fungsi user() pada Post model-->
					</div>
					
					<div class="interaction">
						<a href="#" class="like">Like</a>	
						<a href="#" class="like">Dislike</a>

						<?php if(Auth::user() == $post->user): ?>
							<a href="#" class="edit">Edit</a>
							<a href="<?php echo e(route('post.delete', ['post_id' => $post->id])); ?>">Delete</a>

						<?php endif; ?>



						

						<!-- route menerima menerima parameter post_id yang nilainya $post->id akan dipassing ke ke ethod getDeletePost. jadi getDeletePost akan menghapus id yang nilainya difereerensikan dengan $post->id (lihat foreach diatas)-->
					</div>

				</article>

			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
	var token = '<?php echo e(Session::token()); ?>';
	var urlEdit = '<?php echo e(route('edit')); ?>';
	var urlLike = '<?php echo e(route('like')); ?>';
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>