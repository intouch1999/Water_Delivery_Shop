<?php include("head.php"); ?>
<style>
#card_content{
  min-height:70vh;
}
.custom-float-right {
  float: right;
}
.btn_add{
  color:white !important;
}
</style>

  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->
    <div class="container-fluid flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-md-12">
          <div class="card" id="card_content">
          <h5 class="card-header">รายชื่อผู้ใช้งาน
          <div class="custom-float-right"><a class="btn btn-sm btn-info btn_add" href="user_add">เพิ่มพนักงานใหม่</a></div>
          </h5>
          <div class="table-responsive text-nowrap">
            <table class="table" id="table_emp">
              <thead>
                <tr>
                  <th>ลำดับ</th>
                  <th>รหัสพนักงาน</th>
                  <th colspan="2">ชื่อ-สกุล</th>
                  <th>สาขา</th>
                  <th>ตำแหน่ง</th>
                  <th>อัพเดท</th>
                  <th>เปิดใช้งาน</th>
                  <th>แก้ไข</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0"></tbody>
            </table>
          </div>
        </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
    <?php include("foot.php"); ?>
    <script>
    $(document).ready(function() {
      fetch('../api/user?check_user', {
          method: 'POST',
          body: JSON.stringify({
          case: 'check_user' 
        })
        })
        .then(function (response) {
            fetch_status = response.status;
            return response.json();
        }) 
        .then(function (json) {
          if(json[0].status==1){
            let i=0;
            $("#table_emp tbody").empty();
            json.forEach(function(j){
                if(typeof j.nIndex !== "undefined"){
                  i++;
                  let chk_checked = "";
                  if(parseInt(j.user_active)==1) chk_checked = "checked";
                  let formchk_btn = '<div class="form-check form-switch mb-2"><input class="form-check-input" type="checkbox" onclick="push_enable(\''+j.nIndex+'\',this)" '+chk_checked+'></div>';
                  let emp_pictur = '<img src="../assets/img/user/'+j.emp_img+'" alt="user-avatar" class="d-block rounded" height="70px" width="70px">';
                  let table_detail = "<tr>"+ 
                                     "<td>"+i+"</td>"+
                                     "<td>"+j.emp_id+"</td>"+
                                     "<td>"+emp_pictur+"</td>"+
                                     "<td>"+j.emp_fname+"</td>"+
                                     "<td>"+j.branch_name+"</td>"+
                                     "<td>"+j.emp_position+"</td>"+
                                     "<td>"+j.edit_date+"</td>"+
                                     "<td>"+formchk_btn+"</td>"+
                                     "<td><button class='btn btn-sm btn-warning text-center' onclick=\"edit_emp(\'"+j.nIndex+"\')\"><i class='menu-icon tf-icons bx bx-edit-alt'></i></button><button class='btn btn-sm btn-secondary text-center' style='margin-left:5px' onclick=\"reset_password(\'"+j.nIndex+"\')\"><i class='menu-icon tf-icons bx bx-lock-open'></i></button></td></td>"+
                                     "</tr>";
                  $("#table_emp tbody").append(table_detail);
                }
            });
            }else{
            alert_snackbar("danger","พบข้อผิดพลาด : "+json[0].error_message);
            }
        })
        .catch(error => console.error(error));
    }); 


    function push_enable(nIndex,val){
      let user_active;
      if(val.checked) user_active = 1;
      else user_active = 0;
      fetch('../api/user?active_user', {
          method: 'POST',
          body: JSON.stringify({
          case: 'active_user',
          nIndex:nIndex,
          user_active:user_active 
        })
        })
        .then(function (response) {
            fetch_status = response.status;
            return response.json();
        }) 
        .then(function (json) {
          if(json[0].status==1){
             alert_snackbar("success","บันทึกข้อมูลแล้ว");
            }else{
              alert_snackbar('error',json[0].error_message);
            } 
        })
        .catch(error => console.error(error));
    }

    function edit_emp(nIndex){
      $.redirect("user_add",
      {
        nIndex: nIndex
      },
      "POST");
    }

    function reset_password(nIndex){
      $("#modal_confirm_text").html("ยืนยันการ Reset รหัสผ่าน <b>โดยรหัสผ่านเริ่มต้นจะเป็นรหัสพนักงาน</b>")
      $("#modal_confirm_submit").attr("onclick","confirm_reset_password('"+nIndex+"');");
      $("#modal_confirm").modal("show");
    }

    function confirm_reset_password(nIndex){
      fetch('../api/user?reset_password', {
          method: 'POST',
          body: JSON.stringify({
          case: 'reset_password',
          nIndex:nIndex
        })
        })
        .then(function (response) {
            fetch_status = response.status;
            return response.json();
        }) 
        .then(function (json) {
          if(json[0].status==1){
             alert_snackbar("success","Reset รหัสผ่านเรียบร้อยแล้ว");
            }else{
              alert_snackbar('error',json[0].error_message);
            } 
            $("#modal_confirm").modal("hide");
        })
        .catch(error => console.error(error));
    }
    </script>
      