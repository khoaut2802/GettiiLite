

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
  <li><a href="/report"><?php echo e(trans('report.S_ReportList')); ?></a></li>
  <li class="active"><?php echo e(trans('report.S_SystemReport')); ?></li>
</ol>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!--<form method="GET"  action="/systemreport/output"> -->
  <div id="report">
    <form id="outputRepot" method="POST" action="/systemreport/systemreport" target="_blank">
        <?php echo e(csrf_field()); ?>

        <input type="hidden" name="jsonRepo" v-model="jsonRepo">
    </form>
    <form id="searchEvent" method="POST" action="/systemreport" >
        <?php echo e(csrf_field()); ?>

        <input type="hidden" name="jsonEvent" v-model="jsonEvent">
    </form>
    <!-- box - 檢索 -->
    <div class="box no-border">
      <!---box-header--->
      <div class="box-header with-border-non">
        <h3 class="box-title"><?php echo e(trans('sellManage.S_SearchTitle2')); ?></h3>
      </div>
      <!---/.box-header  --->
      <div class="box-body">
        <div class="form-horizontal form-bordered">
          <div class="form-body col-md-12">
            <!--form-group 1-->
            <div class="form-group">
              <label class="control-label col-md-2"><?php echo e(trans('report.S_Term')); ?></label>
              <div class="col-md-10">
                <div class="input-group">
                  <input type="text" class="form-control pull-left" id="dateRange">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
              </div>              
            </div>
            <!--/.form-group 1-->
            <?php if(session('GLID') == '1'): ?>
              <!-- 0521 新增調整 改為 select --->
              <!--form-group 2-->      
              <?php if(session('GLID') == '1'): ?>
                <div class="form-group">
                  <label class="control-label col-md-2"><?php echo e(trans('report.S_Distributor')); ?></label> 
                  <div class="col-md-10">
                    <select id="client" name="client" class="form-control" style="width: 100%;" onChange="changeSelect()">
                      <option value="0"><?php echo e(trans('report.S_SelectDistributor')); ?></option>
                      <?php $__currentLoopData = $clients['data']['user-data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adminInf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php echo e($glid == $adminInf['GLID'] ? 'selected="selected"' : ""); ?> value="<?php echo e($adminInf['GLID']); ?>"><?php echo e($adminInf['contract_name']); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div> 
                </div> 
              <?php endif; ?>
              <!--/.form-group 2-->  
              <!-- /.0521 新增調整 改為 select --->       
            <?php endif; ?>
          </div>
        </div>
      </div>
      <!--0603 調整順序-->
      <!---box-footer  --->
         <div class="box-footer text-right">
           <?php if(session('GLID') == '1'): ?>
             <button id="selectClientReport" v-on:click="eventSearch()" class="btn waves-effect waves-light btn-angle btn-info" disabled><?php echo e(trans('report.S_Search')); ?></button>
           <?php elseif(session('GLID') != '1'): ?>
             <button v-on:click="eventSearch()" class="btn waves-effect waves-light btn-angle btn-info"><?php echo e(trans('report.S_Search')); ?></button>           
           <?php endif; ?>
         </div>
      <!---/.box-footer  --->
      <!--/.0603 調整順序-->
    </div>
     <div class="box no-border">
      <div class="box-header">
        <h3 class="table-title"></h3>
        <p class="margin-fix"><span class="text-gray"><?php echo e(trans('report.S_Term')); ?> ｜ </span><?php echo e(str_replace('-','/',$date['startDate'])); ?> - <?php echo e(str_replace('-','/',$date['endDate'])); ?></p>
        
        <p class="margin-fix"><span class="text-gray"><?php echo e(trans('report.S_Distributor')); ?> ｜ </span>
          <?php echo e(isset($user['data']['user_data']['contract_name']) ? $user['data']['user_data']['contract_name'] : ''); ?>

        </p>
      </div>
    </div>   
    <div class="box no-border">
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-horizontal form-bordered">
            <div class="form-body">
              <table class="table table-striped table-normal">
                <thead>
                  <tr>
                    <th width="90"></th>
                    <th><?php echo e(trans('report.S_Event')); ?> </th>
                    <th><?php echo e(trans('report.S_Date')); ?> </th>
                    <th><?php echo e(trans('report.S_Status')); ?> </th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $eventData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td>
                        <div class="form-checkbox form-checkbox-fix">
                          <label class="control control--checkbox">
                            <input type="checkbox"  class="chk"> 
                              <div class="control__indicator__normal"></div>
                          </label>
                        </div>
                      </td>
                      <input type="hidden" class="performance" value="<?php echo e($event['performance_id']); ?>">
                      <td>
                        <div class="box-subtitle">
                          <span class="label label-info-outline"> 
                            <?php echo e($event['performance_code']); ?>

                          </span> 
                        </div>
                        <?php echo e($event['performance_name']); ?>

                      </td>
                      <td>
                        <?php echo e($event['performance_st_dt']); ?> - <?php echo e($event['performance_end_dt']); ?>

                      </td>
                      <td>
                        <?php echo e($event['status']); ?>

                      </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
            <!-- /.form-body-->
          </div>
        </div>
      </div>
      <div class="box-footer text-right">
        <button v-on:click="outputReport()" class="btn waves-effect waves-light btn-angle btn-info"> <?php echo e(trans('report.S_Output')); ?></button>
      </div> 
    </div> 
  </div>
<!--</form>-->
<script>   
var report = new Vue({
  el: '#report',
  data:{
      jsonRepo: '',
      jsonEvent: '',
  }, 
  methods: {
    eventSearch:function(){
      //buton click event(for client user)
      let range = document.getElementById("dateRange").value.split('/').join('').replace(' ', '');
      range = range.replace(' ', '');
      let glid = '<?php echo e(session("GLID")); ?>'
      if(glid == 1)
      {
        //LS user
        glid = document.getElementById("client").value;
      }
      
      let json    = []
      json.push({
         glid: glid,
         date: range,
         performance: performance,
      })     
      this.jsonEvent = JSON.stringify(json)
      
      this.$nextTick(() => {
         document.getElementById("searchEvent").submit()
      })
    },
    outputReport:function(){
      let json    = []
      let performance    = []        
  
      var CHK = document.getElementsByClassName('chk');
      var PerformanceId = document.getElementsByClassName('performance');
      for (var i = 0; CHK.length > i; i++) {
        if(CHK[i].checked){
          performance.push(PerformanceId[i].value)
        }
      }
      if(performance.length == 0) {
        alert(' <?php echo e(trans('report.S_Msg1')); ?>');
        return;
      }
      json.push({
         glid: '<?php echo e($glid); ?>',
         date: '<?php echo e(str_replace("-","/",$date["startDate"])); ?> - <?php echo e(str_replace("-","/",$date["endDate"])); ?>',
         performance: performance,
       })     
       this.jsonRepo = JSON.stringify(json)
       
       this.$nextTick(() => {
         document.getElementById("outputRepot").submit()
       })
    }
  },
});    
    
$(function(){
  setButtonDisabled();
});
function setButtonDisabled() {
  const GLID = document.getElementById("client").value;
  if(GLID==0)
  {
    document.getElementById("selectClientReport").disabled = true;
  }else{
    document.getElementById("selectClientReport").disabled = false;  
  }
} 
$('#dateRange').daterangepicker({
    "locale": {
        "format": "YYYY/MM/DD"
    },
    startDate: '<?php echo e($date["startDate"]); ?>',
    endDate: '  <?php echo e($date["endDate"]); ?>'
});

function changeSelect(){
  setButtonDisabled();
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/gettiilite/resources/views/frontend/report/sysreport.blade.php ENDPATH**/ ?>