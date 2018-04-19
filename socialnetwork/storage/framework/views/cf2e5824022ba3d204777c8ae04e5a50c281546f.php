 <?php if(count($errors)>0): ?>

    <div class="row">
        <div class="col-md-4 col-md-offset-4 error">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li> <?php echo e($error); ?></li> <!--Pesan eror pada this->validate akan ditampilkan disini-->
          
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>   
        </div>            
    </div>
 <?php endif; ?>
 <?php if(Session::has('message')): ?>
    <div>
        <div class="col-md-4 col-md-offset-4 success">
            <?php echo e(Session::get('message')); ?>

        </div>     
    </div>
 <?php endif; ?>