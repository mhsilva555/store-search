<?php
$json = file_get_contents(STORE_SEARCH_PLUGIN_PATH . "/storage/json/cidades.json");
$cities = json_decode($json);
?>

<div class="modal fade modal-new-store" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" id="form-new-store">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo e(__('Nova Loja', STORE_SEARCH_TEXTDOMAIN)); ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="text" class="form-control p-1 mb-2" name="store_name" placeholder="<?php echo e(__('Nome da Loja', STORE_SEARCH_TEXTDOMAIN)); ?>">
                    <div class="search-cities">
                        <input type="text" class="form-control p-1 mb-2 store_city" name="store_city" placeholder="<?php echo e(__('Cidade', STORE_SEARCH_TEXTDOMAIN)); ?>">
                        <ul class="list-cities">
                            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($city->Nome); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <input type="text" class="form-control p-1 mb-2" name="store_address" placeholder="<?php echo e(__('Endereço da Loja', STORE_SEARCH_TEXTDOMAIN)); ?>">
                    <input type="text" class="form-control p-1 mb-2" name="store_lat" placeholder="<?php echo e(__('Latitude', STORE_SEARCH_TEXTDOMAIN)); ?>">
                    <input type="text" class="form-control p-1" name="store_long" placeholder="<?php echo e(__('Longitude', STORE_SEARCH_TEXTDOMAIN)); ?>">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Fechar', STORE_SEARCH_TEXTDOMAIN)); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo e(__('Salvar', STORE_SEARCH_TEXTDOMAIN)); ?></button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH C:\Users\marco\Local Sites\teste-agncia-weber\app\public\wp-content\plugins\store-search\resources\views/partials/modal-new-store.blade.php ENDPATH**/ ?>