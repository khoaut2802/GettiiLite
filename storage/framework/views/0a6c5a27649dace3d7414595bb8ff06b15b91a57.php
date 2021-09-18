

<?php $PurviewHelpers = app('App\Helpers\PurviewHelpers'); ?>

<?php $__env->startSection('title', 'Gettii Lite'); ?>

<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content_header'); ?>
<h1>
    <?php echo e(trans('report.S_ReportManage')); ?>

    <small></small>
</h1>
<!-- 網站導覽 -->
<ol class="breadcrumb">
    <li class="active"><?php echo e(trans('report.S_ReportList')); ?></li>
</ol>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<!--0526 調整樣式-->
<!-- 無框線 box2 一般表格 ＋ 合計欄位 ＋ 按鈕  -->

    <div class="box no-border">
        <div class="box-header with-border-non">
          <h3 class="box-title"><?php echo e(trans('report.S_Report')); ?></h3>
        </div>
        <div class="box-body">
          <div class="col-md-12">
            <!-- TABLE8 一般樣式 ＋ 雙層表頭 ＋ 按鈕 -->
            <table id="" class="table table-striped table-row">
              <thead>
                <tr>
                    <th><?php echo e(trans('report.S_Item')); ?></th>
                    <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo e(trans('report.S_SystemReport')); ?></td>
                  <td><a class="btn btn-info-outline" href="/systemreport"><?php echo e(trans('report.S_Search')); ?></a></td>
                </tr>
              </tbody>
            </table>
        </div>
        </div>
        <div class="box-footer"></div>
      </div>



<!--/.0526 調整樣式-->
<!-- 0526 合併調整到上方表格內 -->
<!--<ul>
  <li><a href="/systemreport"><?php echo e(trans('report.S_SystemReport')); ?></a></li>-->
  <!--<li><a href="/clientreport"><?php echo e(trans('report.S_ClientList')); ?></a></li>-->
<!--</ul>-->
<!-- /.0526 合併調整到上方表格內 -->
<script>

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/gettiilite/resources/views/frontend/report/index.blade.php ENDPATH**/ ?>