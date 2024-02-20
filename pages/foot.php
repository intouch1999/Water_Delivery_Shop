<!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  ,Develop by <b>Mescha.</b> And Design by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- public modal --> 

          <!-- Modal -->
          <div class="modal fade" id="modal_confirm" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog">
              <form class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="backDropModalTitle">ยืนยันดำเนินการ</h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col mb-3">
                      <span id="modal_confirm_text"></span>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    ยกเลิก
                  </button>
                  <button type="button" id="modal_confirm_submit" class="btn btn-primary">ยืนยัน</button>
                </div>
              </form>
            </div>
          </div> 
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/js/js-snackbar.min.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <script src="../assets/js/jquery.redirect.js"></script>

    <script src="../libs/evo-calendar/js/evo-calendar.min.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/pages-account-settings-account.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
<script>
  //alert snackbar
  function alert_snackbar(bar_status,message){
    SnackBar({
      message: message,
    status: bar_status, 
    fixed: true,
    timeout: 5000,
    })
    }
  //active menu page
  var page_name ='<?= basename(strtok($_SERVER['REQUEST_URI'], '?')); ?>';
  $(document).ready(function() {
      $("#menu_"+page_name).addClass("active");
      var dataMenuValue = $("#menu_"+page_name).data("menu");
      $("#"+dataMenuValue).addClass("active").addClass("open");
  }); 


  function logout(){
    $("#modal_confirm_text").html("ต้องการออกจากระบบหรือไม่ ?")
      $("#modal_confirm_submit").attr("onclick","confirm_logout();");
      $("#modal_confirm").modal("show");
  }

  function confirm_logout(){
     window.location.href="login";
  }

  function change_password(){
    $("#modal_confirm_text").html('เปลี่ยนแปลงรหัสผ่านเข้าใช้งาน ? <br><label for="old_password" class="mt-3">ระบุรหัสผ่านเดิม</label><input class="form-control " autocomplete="off" id="old_password" type="password">'
    +'<label for="new_password1" class="mt-3"><b>ระบุรหัสผ่านใหม่</b></label><input class="form-control " autocomplete="off" id="new_password1" type="password">'
    +'<input class="form-control  mt-1" autocomplete="off" id="new_password2" type="password"><br><span id="reset_warning">&nbsp;</span>');
    $("#modal_confirm_submit").attr("onclick","confirm_reset();");
    $("#modal_confirm").modal("show");
  }

  function confirm_reset(){
    let old_password = $("#old_password").val();
    let new_password = $("#new_password1").val();
    let new_password2 = $("#new_password2").val();

    $("#reset_warning").html("&nbsp;");

    if(old_password.length==0){
      $("#reset_warning").html("<font color='red'>กรุณาระบุรหัสผ่านเดิม</font>");
      return false;
    } 
    if(new_password.length<=3 || new_password2.length<=3){
      $("#reset_warning").html("<font color='red'>กรุณาระบุรหัสผ่านใหม่อย่างน้อย 4 ตัว</font>");
      return false;
    }
    if(new_password !==new_password2){
      $("#reset_warning").html("<font color='red'>รหัสผ่านใหม่ที่ระบุไม่ตรงกัน</font>");
      return false;
    }

    fetch('../api/user?change_password', {
            method: 'POST',
            body: JSON.stringify({
            case: 'change_password',
            old_password:old_password,
            new_password:new_password
        })
        })
        .then(function (response) {
            fetch_status = response.status;
            return response.json();
        }) 
        .then(function (json) {
            if(json[0].status=='0'){
                $("#reset_warning").html("<font color='red'>"+json[0].error_message+"</font>");
            }else{
              $("#modal_confirm").modal("hide");
              alert_snackbar('success',"เปลี่ยนแปลงรหัสผ่านสำเร็จ")
            }
        })
        .catch(error => console.error(error));
  }
</script>