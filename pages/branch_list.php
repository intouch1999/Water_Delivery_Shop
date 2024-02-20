<?php include("head.php"); ?>
<style>
#card_content{
  min-height:70vh;
}
.btn_add{
  color:white !important;
}
#table_type { 
  overflow: hidden; /* Hide the overflow content */
}
</style>
          <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="card mb-4">
                    <h5 class="card-header">เพิ่ม/ลด สาขา</h5>
                    <div class="card-body">
                    <div class="row gx-3 gy-2 align-items-center">
                        <div class="col-md-2">
                            <label class="form-label" for="inp_branch_no">ลำดับสาขา</label>
                            <input type="number" class="form-control" name="branch_no" id="inp_branch_no" placeholder="ระบุลำดับสาขา">
                            <span id="warning_branch_no"></span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="inp_branch_name">ชื่อสาขา</label>
                            <input type="text" class="form-control" name="branch_name" id="inp_branch_name" placeholder="ระบุชื่อสาขาใหม่">
                            <span id="warning_branch_name"></span>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="submit_cat">&nbsp;</label>
                            <button type="button" id="submit_cat" class="btn btn-primary d-block" onclick="branch_add()">เพิ่ม</button>
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap mt-3">
                        <table class="table table-responsive table-bordered text-center" id="table_branch">
                            <thead>
                                <tr>
                                    <td>สาขาที่</td>
                                    <td>ชื่อสาขา</td>
                                    <td>ดำเนินการ</td>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
<?php include("foot.php"); ?>
<script>
      window.onload = function() {
        chk_branch();
	}

    function chk_branch(){
        fetch('../api/branch?chk_branch', {
        method: 'POST',
        body: JSON.stringify({
        case: 'chk_branch'
        })
        })
        .then(function (response) {
            fetch_status = response.status;
            return response.json();
        }) 
        .then(function (json) { 
            $("#table_branch tbody").empty();
            json.forEach(function(j){ 
                let table_detail;
                let lock_detail;
                if(parseInt(j.count_user)==0){
                    lock_detail = '<button class="btn btn-sm btn-warning" onclick="edit_branch(\''+j.branch_id+'\',\''+j.branch_name+'\')">แก้ไข</button><button class="btn btn-sm btn-danger" onclick="del_branch(\''+j.branch_id+'\',\''+j.branch_name+'\')" style="margin-left:10px">ลบ</button>';
                }else{
                    lock_detail = '<button class="btn btn-sm btn-warning" onclick="edit_branch(\''+j.branch_id+'\',\''+j.branch_name+'\')">แก้ไข</button>';
                }
                
                if(parseInt(j.lock_status)==1) lock_detail = '<i class="menu-icon tf-icons bx bx-lock"></i>';  
                if (typeof j.branch_name !== 'undefined') {
                    table_detail = '<tr><td>'+j.branch_id+'</td><td>'+j.branch_name+'</td><td id="td_'+j.branch_id+'">'+lock_detail+'</td></tr>';
                }  
                $("#table_branch tbody").append(table_detail);
            });
        })
        .catch(error => console.error(error));
    }

    function branch_add(){
        $("#warning_branch_no").html("");
        $("#warning_branch_name").html("");
        let branch_no = $("#inp_branch_no").val();
        let branch_name = $("#inp_branch_name").val();

        if(branch_no.length==0){
            $("#warning_branch_no").html("<font color='red'>ระบุเลขที่สาขา</font>"); 
            return false;
        } 
        if(branch_name.length==0){
            $("#warning_branch_name").html("<font color='red'>ระบุชื่อสาขา</font>"); 
            return false;
        } 

        fetch('../api/branch?add_branch', {
            method: 'POST',
            body: JSON.stringify({
                case: 'add_branch',
                branch_id:branch_no,
                branch_name:branch_name
            })
        })
        .then(function (response) {
            fetch_status = response.status;
            return response.json();
        }) 
        .then(function (json) { 
            if(json[0].status=='0'){
                alert_snackbar('error',json[0].error_message);
            }else{
                alert_snackbar('success',"เพิ่มข้อมูลสาขาเรียบร้อย");
                $("#inp_branch_no").val("");
                $("#inp_branch_name").val("");
                chk_branch();
            }
        })
        .catch(error => console.error(error));
    }
 
    function edit_branch(branch_id,branch_name){
        $("#td_"+branch_id).html('<div class="input-group mb-3"><input type="text" id="inp_change_branch_'+branch_id+'" value="'+branch_name+'" class="form-control form-control-sm" placeholder="กรุณาระบุชื่อสาขา" > <div class="input-group-append"> <button class="btn btn-sm btn-warning" type="button"  onclick="submit_change_branch(\''+branch_id+'\')" >บันทึก</button> </div></div>');
    }
    
    function del_branch(branch_id,branch_name){
        $("#modal_confirm_text").html("ท่านต้องการลบสาขา <b>"+branch_name+"</b> หรือไม่ ?<br><font color='red'>หากลบแล้วจะไม่สามารถดำเนินการกู้คืนได้</font>");
        $("#modal_confirm_submit").attr("onclick","confirm_del_branch('"+branch_id+"')");
        $("#modal_confirm").modal("show");
    }
    
    function confirm_del_branch(branch_id){
        fetch('../api/branch?del_branch', {
            method: 'POST',
            body: JSON.stringify({
                case: 'del_branch',
                branch_id:branch_id
            })
        })
        .then(function (response) {
            fetch_status = response.status;
            return response.json();
        }) 
        .then(function (json) { 
            if(json[0].status=='0'){
                alert_snackbar('error',json[0].error_message);
                $("#modal_confirm").modal("hide");
            }else{
                alert_snackbar('success',"ลบข้อมูลเรียบร้อยแล้ว");
                chk_branch();
                $("#modal_confirm").modal("hide");
            }
        })
        .catch(error => console.error(error));
        
    }

    function submit_change_branch(branch_id){
        let val = $("#inp_change_branch_"+branch_id).val();
        if(val.length==0){
         alert_snackbar("warning","กรุณาระบุชื่อสาขา");
         return false;
        }

        fetch('../api/branch?change_branch', {
            method: 'POST',
            body: JSON.stringify({
                case: 'change_branch',
                branch_id:branch_id,
                branch_name:val
            })
        })
        .then(function (response) {
            fetch_status = response.status;
            return response.json();
        }) 
        .then(function (json) { 
            if(json[0].status=='0'){
                alert_snackbar('error',json[0].error_message);
            }else{
                alert_snackbar('success',"แก้ไขข้อมูลเรียบร้อยแล้ว");
                chk_branch();
            }
        })
        .catch(error => console.error(error));
    }
</script>