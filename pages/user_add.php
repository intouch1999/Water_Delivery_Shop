<?php include("head.php"); ?>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header" id="text-header">ลงทะเบียนพนักงานใหม่</h5>
                    <!-- Account -->
                    <form id="formAccountSettings" enctype="multipart/form-data">
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                          src="../assets/img/user/nouser.jpg"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block" id="btn_new_up">อัพโหลดรูปภาพ</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" name="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg;capture=camera" required />
                          </label>

                          <p class="text-muted mb-0">สามารถอัพโหลดนามสกุล JPG JPEG หรือ PNG เท่านั้น</p>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      
                        <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="inp_branch" class="form-label">เลือกสาขาที่ปฏิบัติงาน</label>
                            <select id="inp_branch" name="branch_id" class="select2 form-select" onchange="if(this.value=='vip') alert_snackbar('danger','การเลือกทุกสาขา จะสามารถเข้าใช้งานได้ทุกสาขาโปรดระมัดระวัง')" required>
                              <option value="">ระบุสาขาที่ปฏิบัติงาน</option>
                              <option value="vip" style="color:red">ทุกสาขา</option>
                            </select>
                          </div> 
                          <div class="mb-3 col-md-6">
                            <label for="inp_fname" class="form-label">ชื่อ-สกุล</label>
                            <input class="form-control" type="text" id="inp_fname" name="fname" placeholder="กรุณาระบุชื่อ-สกุล" autocomplete="off" autofocus required/>
                          </div> 
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="dob">วันเกิด</label>
                            <div class="input-group input-group-merge">
                              <input type="date" id="inp_dob" name="dob" class="form-control" />
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">ที่อยู่ติดต่อ</label>
                            <input type="text" class="form-control" id="inp_address" name="address" placeholder="ระบุที่อยู่ที่สามารถติดต่อได้" autocomplete="off" required/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="inp_position" class="form-label">ตำแหน่ง</label>
                            <select id="inp_position"  name="position" class="select2 form-select" required>
                              <option value="">ระบุเพื่อจำกัดสิทธิ์ใช้งาน</option>
                              <option value="ผู้จัดการร้าน">ผู้จัดการร้าน</option>
                              <option value="ผู้ช่วยผู้จัดการ">ผู้ช่วยผู้จัดการ</option>
                              <option value="พนักงานขาย">พนักงานขาย</option>
                              <option value="พนักงานขนส่ง">พนักงานขนส่ง</option>
                            </select>
                          </div> 
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="inp_phone_no">หมายเลขโทรศัพท์</label>
                            <div class="input-group input-group-merge">
                              <input type="text" id="inp_phone_no" name="phone_no" class="form-control" placeholder="ระบุหมายเลขโทรศัพท์ (เฉพาะตัวเลข)" autocomplete="off" required/>
                            </div>
                          </div>
                        </div>
                        <div class="mt-2">
                          <button type="button" class="btn btn-primary me-2" id="btn_user_action" onclick="add_new_user();">บันทึกข้อมูล</button>
                        </div>
                      </form>
                    </div>

                    <!-- So important for edit -->
                    <input type="hidden" id="inp_nIndex" name="inp_nIndex" value="<?= @$_POST['nIndex']; ?>">
                    
                    <!-- /Account -->
                  </div> 
                </div>
              </div>
            </div>
            <!-- / Content -->
            <?php include("foot.php"); ?>
            <script>
              function add_new_user(){
                if ($("#inp_branch").val() == "") {
                  alert_snackbar("warning", "กรุณาสาขา");  
                  setTimeout(function(){
                    $("#inp_branch").focus();
                  },300);
                  return false;
                }
                if ($("#inp_fname").val().length < 3) {
                  alert_snackbar("warning", "กรุณาระบุชื่อ-สกุล");  
                  setTimeout(function(){
                    $("#inp_fname").focus();
                  },300);
                  return false;
                }
                if ($("#inp_dob").val().length =="") {
                  alert_snackbar("warning", "กรุณาระบุวันเกิด");  
                  setTimeout(function(){
                    $("#inp_dob").focus();
                  },300);
                  return false;
                }
                if ($("#inp_address").val() < 3) {
                  alert_snackbar("warning", "กรุณาระบุที่อยู่ติดต่อ");  
                  setTimeout(function(){
                    $("#inp_address").focus();
                  },300);
                  return false;
                }
              if ($("#inp_position").val().length =="") {
                alert_snackbar("warning", "กรุณาระบุตำแหน่ง");  
                setTimeout(function(){
                  $("#inp_position").focus();
                },300);
                return false;
              }
              if ($("#inp_phone_no").val().length =="") {
                alert_snackbar("warning", "กรุณาระบุหมายเลขโทรศัพท์");  
                setTimeout(function(){
                  $("#inp_phone_no").focus();
                },300);
                return false;
              }

              if ($("#upload")[0].files.length === 0) {
                alert_snackbar("warning", "กรุณาเลือก/อัพโหลดไฟล์รูปพนักงาน");
                return false;
              }

                $("#modal_confirm_text").html("ยืนยันการเพิ่มพนักงานในระบบ")
                $("#modal_confirm_submit").attr("onclick","confirm_new_user();");
                $("#modal_confirm").modal("show");
              }

              function confirm_new_user(){
                  // Get form data
                  const formElement = document.getElementById('formAccountSettings');
                  const formData = new FormData(formElement);
                  
                  formData.append("case", "add_user");
                  // Fetch API POST request
                  fetch('../api/user?add_user', {
                    method: 'POST',
                    body: formData,
                  })
                  .then(function (response) {
                      fetch_status = response.status;
                      return response.json();
                  }) 
                  .then(function (json) {
                    $("#modal_confirm").modal("hide");
                     if(json[0].status==1){
                        alert_snackbar("success","เพิ่มข้อมูลเสร็จสิ้น กำลังกลับไปยังหน้าหลัก");
                        setTimeout(function(){
                          window.location.href = "user_list";
                        },2500);
                     }else{
                      alert_snackbar("danger","พบข้อผิดพลาด : "+json[0].error_message);
                     }
                  })
                  .catch(error => console.error(error));
                }
                
                
                
                function edit_user(){
                if ($("#inp_branch").val() == "") {
                  alert_snackbar("warning", "กรุณาสาขา");  
                  setTimeout(function(){
                    $("#inp_branch").focus();
                  },300);
                  return false;
                }
                if ($("#inp_fname").val().length < 3) {
                  alert_snackbar("warning", "กรุณาระบุชื่อ-สกุล");  
                  setTimeout(function(){
                    $("#inp_fname").focus();
                  },300);
                  return false;
                }
                if ($("#inp_dob").val().length =="") {
                  alert_snackbar("warning", "กรุณาระบุวันเกิด");  
                  setTimeout(function(){
                    $("#inp_dob").focus();
                  },300);
                  return false;
                }
                if ($("#inp_address").val() < 3) {
                  alert_snackbar("warning", "กรุณาระบุที่อยู่ติดต่อ");  
                  setTimeout(function(){
                    $("#inp_address").focus();
                  },300);
                  return false;
                }
              if ($("#inp_position").val().length =="") {
                alert_snackbar("warning", "กรุณาระบุตำแหน่ง");  
                setTimeout(function(){
                  $("#inp_position").focus();
                },300);
                return false;
              }
              if ($("#inp_phone_no").val().length =="") {
                alert_snackbar("warning", "กรุณาระบุหมายเลขโทรศัพท์");  
                setTimeout(function(){
                  $("#inp_phone_no").focus();
                },300);
                return false;
              }
 

                $("#modal_confirm_text").html("ยืนยันการแก้ไขข้อมูลพนักงานในระบบ")
                $("#modal_confirm_submit").attr("onclick","confirm_edit_user();");
                $("#modal_confirm").modal("show");
              }

              function confirm_edit_user(){
                  // Get form data
                  const formElement = document.getElementById('formAccountSettings');
                  const formData = new FormData(formElement);
                  
                  formData.append("case", "edit_user");
                  formData.append("nIndex", $("#inp_nIndex").val());
                  // Fetch API POST request
                  fetch('../api/user?edit_user', {
                    method: 'POST',
                    body: formData,
                  })
                  .then(function (response) {
                      fetch_status = response.status;
                      return response.json();
                  }) 
                  .then(function (json) {
                    $("#modal_confirm").modal("hide");
                     if(json[0].status==1){
                        alert_snackbar("success","แก้ไขข้อมูลเสร็จสิ้น กำลังกลับไปยังหน้าหลัก");
                        setTimeout(function(){
                          window.location.href = "user_list";
                        },2500);
                     }else{
                      alert_snackbar("danger","พบข้อผิดพลาด : "+json[0].error_message);
                     }
                  })
                  .catch(error => console.error(error));
                }



                /* call barch */
                $(document).ready(function () {
                  let nIndex = $("#inp_nIndex").val(); 

                  function call_edit(){
                      if (nIndex > 0 ) {
                        $("#btn_user_action").attr("onclick","edit_user();").html("แก้ไขข้อมูล");
                        $("#text-header").html("แก้ไขข้อมูลพนักงาน");
                        $("#btn_new_up").html("เปลี่ยนแปลงรูปภาพ");
                        fetch('../api/user?emp_data_edit', {
                          method: 'POST',
                          body: JSON.stringify({
                          case: 'emp_data_edit',
                          nIndex:nIndex
                        })
                        })
                        .then(function (response) {
                            fetch_status = response.status;
                            return response.json();
                        }) 
                        .then(function (json) {
                            $("#inp_branch").val(json[1].branch_id);
                            $("#inp_fname").val(json[1].emp_fname);
                            $("#inp_dob").val(json[1].emp_dob);
                            $("#inp_address").val(json[1].emp_address);
                            $("#inp_phone_no").val(json[1].emp_tel);
                            $("#inp_position").val(json[1].emp_position);
                            $("#uploadedAvatar").attr("src","../assets/img/user/"+json[1].emp_img);
                        })
                        .catch(error => console.error(error));
                      }
                   }

                // Make an API request using jQuery's $.ajax() method
                fetch('../api/user?chk_all_branch', {
                    method: 'POST',
                    body: JSON.stringify({
                    case: 'chk_all_branch' 
                  })
                  })
                  .then(function (response) {
                      fetch_status = response.status;
                      return response.json();
                  }) 
                  .then(function (json) {
                    if(json[0].status==1){
                      json.forEach(function(j){
                        if(typeof j.branch_name !== "undefined"){
                          $("#inp_branch").append("<option value='"+j.branch_id+"'>"+j.branch_name+"</option>");
                        }
                        call_edit();
                      });
                    }
                  })
                  .catch(error => console.error(error));
              });
            </script>