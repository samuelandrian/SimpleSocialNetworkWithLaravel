<?php $__env->startSection('title'); ?>
    Welcome!
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <!--
    <?php if(count($errors)>0): ?>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li> <?php echo e($error); ?></li> <!--Pesan eror pada this->validate akan ditampilkan disini-->
          <!--
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>   
        </div>            
    </div>
    <?php endif; ?>
-->
    <?php echo $__env->make('includes.message-block', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="row">
        <div class="col-md-6">
            <h3>Sign-up</h3>
            <!-- registration form -->
            <form action="<?php echo e(route('signup')); ?>" method="POST">
                
                <div class="form-group  <?php echo e($errors->has('email')? 'has-error': ''); ?>"> <!-- kalau ada eror maka bordernya akan merah -->
                    <label for="email">Your Email</label>
                    <input class="form-control"  type="text" name="email" id="email" value="<?php echo e(Request::old('email')); ?>">
                </div>
                
                <div class="form-group <?php echo e($errors->has('first_name')? 'has-error': ''); ?>">
                    <label for="first_name">Your First Name</label>
                    <input class="form-control" type="text" name="first_name" id="first_name" value="<?php echo e(Request::old('first_name')); ?>">
                </div>

                <div class="form-group <?php echo e($errors->has('password')? 'has-error': ''); ?>">
                    <label for="password">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password" value="<?php echo e(Request::old('password')); ?>">
                </div>
                <button type="submit" class="btn btn-primary"> Submit</button>  
                <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">         
            
            </form>
        </div>

        <div class="col-md-6">
            <h3>Sign-in</h3>
            <!-- login form -->
            <form action="<?php echo e(route('signin')); ?>" method="POST">
                
                <div class="form-group <?php echo e($errors->has('email')? 'has-error': ''); ?>">
                    <label for="email">Your Email</label>
                    <input class="form-control" type="text" name="email" id="email" value="<?php echo e(Request::old('email')); ?>">
                </div>
                         
                <div class="form-group <?php echo e($errors->has('password')? 'has-error': ''); ?>">
                    <label for="password">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password" value="<?php echo e(Request::old('password')); ?>">
                </div>
                <button type="submit" class="btn btn-primary"> Submit</button>
                <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">            
            
            </form>
        </div>










    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>