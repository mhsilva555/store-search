<div id="wpwrap">
    <div class="my-3 p-4">
        <h2><?php echo e(__('STORE SEARCH PAINEL', STORE_SEARCH_TEXTDOMAIN)); ?></h2>
        <hr>
        <button class="btn btn-primary" id="open-model-new-store" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><?php echo e(__('Cadastrar Nova Loja', STORE_SEARCH_TEXTDOMAIN)); ?> <i class="fas fa-plus"></i></button>
        <?php echo $__env->make('partials.modal-new-store', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('partials.modal-edit-store', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <h4 class="mt-5"><?php echo e(__('Todas as Lojas', STORE_SEARCH_TEXTDOMAIN)); ?></h4>

        <table class="table table-bordered align-middle">
            <thead class="table-primary">
                <th class="text-center"><?php echo e(__('ID', STORE_SEARCH_TEXTDOMAIN)); ?></th>
                <th><?php echo e(__('Loja', STORE_SEARCH_TEXTDOMAIN)); ?></th>
                <th><?php echo e(__('Cidade', STORE_SEARCH_TEXTDOMAIN)); ?></th>
                <th><?php echo e(__('Endereço', STORE_SEARCH_TEXTDOMAIN)); ?></th>
                <th><?php echo e(__('Latitude', STORE_SEARCH_TEXTDOMAIN)); ?></th>
                <th><?php echo e(__('Longitude', STORE_SEARCH_TEXTDOMAIN)); ?></th>
                <th><?php echo e(__('Cadastrada em', STORE_SEARCH_TEXTDOMAIN)); ?></th>
                <th class="text-center"><?php echo e(__('Ações', STORE_SEARCH_TEXTDOMAIN)); ?></th>
            </thead>

            <tbody>
                <?php if(!empty($stores)): ?>
                    <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="store-<?php echo e($value->store_id); ?>">
                        <td class="text-center"><?php echo e($value->store_id); ?></td>
                        <td><?php echo e($value->store_name); ?></td>
                        <td><?php echo e($value->store_city); ?></td>
                        <td><?php echo e($value->store_address); ?></td>
                        <td><?php echo e($value->store_lat); ?></td>
                        <td><?php echo e($value->store_long); ?></td>
                        <td><?php echo e(date('d/m/Y', strtotime($value->created_at))); ?></td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                            <button data-id="<?php echo e($value->store_id); ?>" class="btn btn-sm btn-danger text-sm delete-store"><?php echo e(__('Excluir', STORE_SEARCH_TEXTDOMAIN)); ?> <i class="fas fa-trash"></i></button>
                            <button data-id="<?php echo e($value->store_id); ?>" class="btn btn-sm btn-success text-sm edit-store"><?php echo e(__('Editar', STORE_SEARCH_TEXTDOMAIN)); ?> <i class="fas fa-edit"></i></button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div><?php /**PATH C:\Users\marco\Local Sites\teste-agncia-weber\app\public\wp-content\plugins\store-search\resources\views/dashboard.blade.php ENDPATH**/ ?>