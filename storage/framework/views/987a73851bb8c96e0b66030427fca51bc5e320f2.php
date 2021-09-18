<?php $SaleManagePresenter = app('App\Presenters\SaleManagePresenter'); ?>
<?php echo e($SaleManagePresenter->constructPerfomationInf($events['performance_inf'])); ?>



<?php $__env->startSection('title', 'Gettii Lite'); ?>

<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content_header'); ?>
<h1>
    <?php echo e(trans('sellManage.S_SubTitle_2')); ?>

    
</h1>
<ol class="breadcrumb">
    <li><a href="/sell" onclick="loading.openLoading()"><?php echo e(trans('sellManage.S_SubTitle_1')); ?></a></li>
    <li class="active"><?php echo e(trans('sellManage.S_SubTitle_2')); ?></li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div id="app" class="content-navonly">
    <!-- 新增子選單 -->
    <ul id="" class="nav nav-tabs-sell">
        <li class="active">
            <a id="" onclick="loading.openLoading()" href="/sell"><span><?php echo e(trans('sellManage.S_sellInfoTab_01')); ?></span></a>
        </li>
        <li>
            <a id="" onclick="loading.openLoading()" href="/orders"><span><?php echo e(trans('sellManage.S_sellInfoTab_02')); ?></span></a>
        </li>
    </ul>
<div>
<!-- 0511 固定功能按鈕 ｜ 匯出，更新，新規登錄，申請 放置區 -->
<div class="funtion-btn-block">
    <button type="button" class="btn waves-effect waves-light btn-rounded btn-inverse" onclick="createCsvFile()"> <?php echo e(trans('sellManage.S_CsvButton')); ?> <!--<i class="fas fa-file-export"></i>--> </button>
</div>
<!-- /.0511 固定功能按鈕 ｜ 匯出，更新，新規登錄，申請 放置區 -->
<div>
    <!-- box -->
    <div class="box box-solid">
        <!---box-header--->
        <div class="box-header with-border box-s1">
            <h3 class="box-title w-90 pr-x">
                <?php if(!$SaleManagePresenter->getPublished()): ?>
                <span class="badge status-badge bg-navy mr-15x">未公開</span>
                <?php endif; ?>
                <?php echo e($events['performance_inf']["performance_name"]); ?>

            </h3>
            
            <p class="margin-fix w-90"><?php echo e($events['performance_inf']["performance_name_sub"]); ?></p>
            <?php if($SaleManagePresenter->getPublished()): ?>
                <div class="box-btn pull-right">
                    <a href="/schedule/list/<?php echo e($events['performance_inf']['performance_id']); ?>/0" class="btn waves-effect waves-light btn-danger">中止管理</a>
                </div>
            <?php endif; ?>
        </div>
        <!---/.box-header--->
        <div class="box-body">
            <!--- table ----->
            <table id="example1" class="table table-striped">
            <thead>
                <th width="15">
                    <?php if($SaleManagePresenter->getPublished()): ?>
                    中 止
                    <?php endif; ?>
                </th>
                <th><?php echo e(trans('sellManage.S_EventOpenDate')); ?> / <?php echo e(trans('sellManage.S_EventOpenTime')); ?></th>
               <!-- <th><?php echo e(trans('sellManage.S_EventOpenTime')); ?></th>-->
                <th class="text-center"><?php echo e(trans('sellManage.S_EventTimeSlot')); ?></th>
                <th class="text-right"><?php echo e(trans('sellManage.S_EventDetailSeatName')); ?></th> <!-- STS task 25 2020/06/24 -->
                <th class="text-right"><?php echo e(trans('sellManage.S_EventSeatTotal')); ?></th>
                <th class="text-right"><?php echo e(trans('sellManage.S_EventOnPorcessTotal')); ?></th>
                <th class="text-right"><?php echo e(trans('sellManage.S_EventSellTotal')); ?></th>
                <th class="text-right"><?php echo e(trans('sellManage.S_EventNoSellTotal')); ?></th>
                
                <th class="text-right"><?php echo e(trans('sellManage.S_EventRestOfSeat')); ?></th>
                <th class="text-right"><?php echo e(trans('sellManage.S_EventMaxTotal')); ?></th>
                <th></th>
            </tr>
            </thead>
               
                <!-- STS task 25 2020/06/24 start -->
                <tbody>
                <?php $__currentLoopData = $events["schedule_inf"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                 <?php echo e($SaleManagePresenter->constructScheduleInf($event)); ?><?php echo e($SaleManagePresenter->constructSeatData($event["seat_Data_First"])); ?>

                 <tr>
                        <td rowspan="<?php echo e(count($event['seat_Data'])+1); ?>">
                            <?php if($SaleManagePresenter->getCancelBtn()): ?>
                               <a href="/schedule/list/<?php echo e($events['performance_inf']['performance_id']); ?>/<?php echo e($event['schedule_id']); ?>" class="btn btn-danger btn-stop"><i class="fas fa-calendar-times"></i></a>
                            <?php endif; ?>
                        </td>
                        <td rowspan="<?php echo e(count($event['seat_Data'])+1); ?>"><?php echo e($event['performance_date']); ?> <?php echo e($SaleManagePresenter->timeTransform($event['start_time'])); ?>

                            <?php if( $SaleManagePresenter->getCancelStatus()): ?>
                                <span class="badge bg-red">
                                    <?php echo e(trans('sellManage.S_Status_Stopped')); ?>

                                </span>
                            <?php endif; ?>
                        </td>
                        <td rowspan="<?php echo e(count($event['seat_Data'])+1); ?>" class="ellipsis max-15"> 
                            <?php echo e($SaleManagePresenter->getStageName()); ?>

                        </td>
                        <td class="text-right" style="border-top: 1px solid black;border-collapse: collapse;border-left: 1px solid #b7b7b7;border-collapse: collapse;"  ><?php echo e($event["seat_Data_First"]['seat_name']); ?></td>
                        <td class="text-right" ><?php echo e($SaleManagePresenter->getSaleTotal()); ?></td>
                        <td class="text-right" ><?php echo e($SaleManagePresenter->orderCol()); ?></td>
                        <td class="text-right" ><?php echo e($SaleManagePresenter->isSellCol()); ?></td>
                        <td class="text-right" ><?php echo e($SaleManagePresenter->resCol()); ?></td>                    
                        <td class="text-right" ><?php echo e($SaleManagePresenter->noSellCol()); ?></td>
                        <!-- STS 2021/08/02 Task 25-->
                        <td class="text-right __comma" style=" border-right: 1px solid #b7b7b7;border-collapse: collapse;" ><?php echo e($SaleManagePresenter->subtotalCol()); ?></td>
                        <td rowspan="<?php echo e(count($event['seat_Data'])+1); ?>">
                            <?php if($SaleManagePresenter->getPublished()): ?>
                                <a href="/sell/seat/<?php echo e($event['schedule_id']); ?>" class="btn btn-info-outline btn-mm" onclick="loading.openLoading()">
                                    <?php echo e($SaleManagePresenter->getSeatSettingTitle()); ?>

                                </a>
                                <?php if($SaleManagePresenter->getDispStatus()): ?>
                                    <a href="/sell/detail/<?php echo e($event['schedule_id']); ?>" class="btn btn-info-outline btn-mm" onclick="loading.openLoading()">
                                        <?php echo e(trans('sellManage.S_EventDetail')); ?>

                                    </a>
                                <?php endif; ?>
                            <?php else: ?> 
                                <?php if($event['time_setting'] == 'normal'): ?>
                                    <a href="/sell/unpublished/seat/<?php echo e($event['draft_id']); ?>/<?php echo e($event['date_value']); ?>/<?php echo e($event['rule_id']); ?>" class="btn btn-info-outline btn-mm" onclick="loading.openLoading()">
                                        <?php echo e($SaleManagePresenter->getSeatSettingTitle()); ?>

                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php $__currentLoopData = $event["seat_Data"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event_defaut): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <?php echo e($SaleManagePresenter->constructSeatData($event_defaut)); ?>

                    <tr>
                        <td class="text-right" style="  border-top: 1px solid #b7b7b7;border-collapse: collapse;  border-left: 1px solid #b7b7b7;border-collapse: collapse;" ><?php echo e($event_defaut['seat_name']); ?></td>
                        <td class="text-right" style="  border-top: 1px solid #b7b7b7;border-collapse: collapse;" ><?php echo e($SaleManagePresenter->getSaleTotal()); ?></td>
                        <td class="text-right" style="  border-top: 1px solid #b7b7b7;border-collapse: collapse;" ><?php echo e($SaleManagePresenter->orderCol()); ?></td>
                        <td class="text-right" style="  border-top: 1px solid #b7b7b7;border-collapse: collapse;" ><?php echo e($SaleManagePresenter->isSellCol()); ?></td>
                        <td class="text-right" style="  border-top: 1px solid #b7b7b7;border-collapse: collapse;" ><?php echo e($SaleManagePresenter->resCol()); ?></td>                    
                        <!--STS 2021/08/03 Task 25-->                 
                        <td class="text-right" style="  border-top: 1px solid #b7b7b7;border-collapse: collapse;"><?php echo e($SaleManagePresenter->noSellCol()); ?></td>
                        <td class="text-right __comma" style="  border-top: 1px solid #b7b7b7;border-collapse: collapse;  border-right: 1px solid #b7b7b7;border-collapse: collapse;"><?php echo e($SaleManagePresenter->subtotalCol()); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tr style="  border-bottom: 2px solid #b7b7b7;border-collapse: collapse;"></tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody> 
                <!-- STS task 25 2020/06/24 end -->

                <tfoot class="tfoot-light">
                <tr>
                    <!-- <th class="text-center" colspan="3"><?php echo e(trans('sellManage.S_TableTotal')); ?></th> -->
                    <th class="text-center" colspan="4"><?php echo e(trans('sellManage.S_TableTotal')); ?></th> <!-- STS task 25 -->

                    <th class="text-right __comma"><?php echo e($SaleManagePresenter->AllseatTotal()); ?></th>
                    <th class="text-right __comma"><?php echo e($SaleManagePresenter->allInpayTotal()); ?></th>
                    <th class="text-right __comma"><?php echo e($SaleManagePresenter->allSellTotal()); ?></th>
                    <th class="text-right __comma"><?php echo e($SaleManagePresenter->resTotal()); ?></th>
                    <th class="text-right __comma"><?php echo e($SaleManagePresenter->allUnsellTotal()); ?></th>
                    <th class="text-right __comma"><?php echo e($SaleManagePresenter->allIncomeTotal()); ?></th>
                    <th></th>
                </tr>
                </tfoot>
            </table>
            <!--  /. table--->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
<script>
function createCsvFile(){
    let date = new Date();
    var fileName = String(date.getFullYear()) + String(date.getMonth() + 1) + String(date.getDate()) + "_ステージ一覧.csv";//匯出的檔名
    var data = "<?php echo e($events["csv"]); ?>";
    var blob = new Blob(["\ufeff",data], {
        type : "text/csv,charset=UTF-8"
    });
    var href = URL.createObjectURL(blob);
    var link = document.createElement("a");
    document.body.appendChild(link);
    link.href = href;
    link.download = fileName;
    link.click();
}

if (!!window.performance && window.performance.navigation.type === 2) {
    //!! 用來檢查 window.performance 是否存在
    //window.performance.navigation.type ===2 表示使用 back or forward
    console.log('Reloading');
    window.location.reload();
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Downloads\GettiiLite (9)New\resources\views/frontend/sell/manage.blade.php ENDPATH**/ ?>