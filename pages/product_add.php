<?php include("head.php"); ?>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-fluid flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header" id="text-header">เพิ่มสินค้าใหม่</h5>
                    <!-- Account -->
                    <form id="formProductSettings" method="POST">
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                          src="../assets/img/product/temp_product.png"
                          alt="product-temp"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedProduct"
                        />
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block" id="btn_new_up">เพิ่มรูปภาพ</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" name="file" id="upload" class="product-file-input" hidden accept="image/png,image/jpeg,image/jpg;capture=camera"
                            />
                          </label> 

                          <p class="text-muted mb-0">รูปภาพต้องเป็นนามสกุล JPG, JEPG, หรือ PNG เท่านั้น</p>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="inp_product_name" class="form-label"><i class="menu-icon tf-icons bx bx-package"></i> ชื่อสินค้า</label>
                            <input class="form-control" type="text" id="inp_product_name" name="product_name" autocomplete="off" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="inp_product_barcode" class="form-label"><i class="menu-icon tf-icons bx bx-barcode"></i> รหัสบาร์โค้ด (หากมี)</label>
                            <input class="form-control" type="text" name="product_barcode" id="inp_product_barcode"  autocomplete="off"/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="inp_cat" class="form-label"><i class="menu-icon tf-icons bx bx-category"></i> หมวดหมู่</label>
                            <select id="inp_cat" name="cat_id" class="select2 form-select" onchange="select_cat(this.value);">
                              <option value="">ระบุหมวดหมู่</option>
                            </select>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="inp_sub" class="form-label"><i class="menu-icon tf-icons bx bx-category-alt"></i> ประเภท</label>
                            <select id="inp_sub" name="cat_sub_id" class="select2 form-select">
                              <option value="">ระบุประเภท</option>
                            </select>
                          </div>

                          <div class=" col-md-12" style="background-color:#edebeb;">
                          <i class="menu-icon tf-icons bx bx-dice-1"></i> ข้อมูลต่อหน่วย
                          </div>

                          <div class="mb-3 col-md-4" style="background-color:#edebeb;padding-bottom:10px">
                            <label for="inp_unit" class="form-label">จำนวนชิ้น(ต่อหน่วย)</label>
                            <input type="number" step="1" min="1" class="form-control text-center"  id="inp_unit" name="unit" value="1" autocomplete="off"/>
                          </div>
                          
                          <div class="mb-3 col-md-4" style="background-color:#edebeb;padding-bottom:10px">
                            <label for="inp_unit_cost" class="form-label">ราคาทุน(บาท/ต่อหน่วย)</label>
                            <input type="number" step="0.01"  min="0" class="form-control text-center"  id="inp_unit_cost" name="unit_cost" autocomplete="off"/>
                          </div>
                          
                          <div class="mb-3 col-md-4" style="background-color:#edebeb;padding-bottom:10px">
                            <label for="inp_unit_price" class="form-label">ราคาขาย(บาท/ต่อหน่วย)</label>
                            <input type="number" step="0.01"   min="0" class="form-control text-center"  id="inp_unit_price" name="unit_price" autocomplete="off"/>
                          </div>

                          <div class="col-md-12" style="background-color:#f2fbfc;">
                          <i class="menu-icon tf-icons bx bx-dice-6"></i> ข้อมูลต่อแพ็ค
                          </div>

                          <div class="mb-3 col-md-4" style="background-color:#f2fbfc;padding-bottom:10px">
                            <label for="inp_pack" class="form-label">จำนวนชิ้น(ต่อแพ็ค)</label>
                            <input type="number" step="1" min="1" class="form-control text-center" id="inp_pack" name="pack" autocomplete="off"/>
                          </div>

                          <div class="mb-3 col-md-4" style="background-color:#f2fbfc">
                            <label for="inp_pack_cost" class="form-label">ราคาทุน(บาท/ต่อแพ็ค)</label>
                            <input type="number" step="0.01"  min="0" class="form-control text-center" id="inp_pack_cost" name="pack_cost" autocomplete="off"/>
                          </div>
                          
                          <div class="mb-3 col-md-4" style="background-color:#f2fbfc">
                            <label for="inp_pack_price" class="form-label">ราคาขาย(บาท/ต่อแพ็ค)</label>
                            <input type="number" step="0.01"   min="0" class="form-control text-center" id="inp_pack_price" name="pack_price" autocomplete="off"/>
                          </div>

                        </div>
                        <div class="mt-2">
                          <button type="button" class="btn btn-primary me-2" id="btn_action" onclick="add_new_product();">บันทึกข้อมูล</button>
                        </div>
                      
                    </div>
                    </form>

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
              function add_new_product(){
                if ($("#inp_product_name").val() == "") {
                  alert_snackbar("warning", "กรุณาระบุชื่อสินค้า");  
                  setTimeout(function(){
                    $("#inp_product_name").focus();
                  },300);
                  return false;
                } 
                if ($("#inp_cat").val().length =="") {
                  alert_snackbar("warning", "กรุณาระบุหมวดหมู่");  
                  setTimeout(function(){
                    $("#inp_cat").focus();
                  },300);
                  return false;
                }
                if ($("#inp_sub").val().length =="") {
                  alert_snackbar("warning", "กรุณาระบุประเภท");  
                  setTimeout(function(){
                    $("#inp_sub").focus();
                  },300);
                  return false;
                }
              if ($("#inp_unit").val() < 1) {
                alert_snackbar("warning", "กรุณาระบุจำนวนชิ้น(ต่อหน่วย)");  
                setTimeout(function(){
                  $("#inp_unit").focus();
                },300);
                return false;
              }
              if ($("#inp_unit_price").val()  < 1 ) {
                alert_snackbar("warning", "กรุณาระบุราคา(บาท/ต่อหน่วย)");  
                setTimeout(function(){
                  $("#inp_unit_price").focus();
                },300);
                return false;
              }
              
              if ($("#inp_pack").val() < 1) {
                alert_snackbar("warning", "กรุณาระบุจำนวนชิ้น(ต่อแพ็ค)");  
                setTimeout(function(){
                  $("#inp_pack").focus();
                },300);
                return false;
              }
              if ($("#inp_pack_price").val()  < 1 ) {
                alert_snackbar("warning", "กรุณาระบุราคา(บาท/ต่อแพ็ค)");  
                setTimeout(function(){
                  $("#inp_pack_price").focus();
                },300);
                return false;
              }

              if ($("#upload")[0].files.length === 0) {
                alert_snackbar("warning", "กรุณาเลือก/อัพโหลดไฟล์รูปสินค้า");
                return false;
              }

                $("#modal_confirm_text").html("ยืนยันการเพิ่มสินค้าใหม่ในระบบ")
                $("#modal_confirm_submit").attr("onclick","confirm_new_product();");
                $("#modal_confirm").modal("show");
              }

              function confirm_new_product(){ 
                  // Get form data
                  const formElement = document.getElementById('formProductSettings');
                  const formData = new FormData(formElement);
                  
                  formData.append("case", "add_product");
                  // Fetch API POST request
                  fetch('../api/product?add_product', {
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
                          window.location.href = "product_list";
                        },1500);
                     }else{
                      alert_snackbar("danger","พบข้อผิดพลาด : "+json[0].error_message);
                     }
                  })
                  .catch(error => console.error(error));
              }



              $(document).ready(function() {
                let nIndex = $("#inp_nIndex").val(); 

                  function call_edit(){
                      if (nIndex > 0 ) {
                        $("#btn_action").attr("onclick","edit_product();").html("แก้ไขข้อมูล");
                        $("#text-header").html("แก้ไขข้อมูลสินค้า");
                        $("#btn_new_up").html("เปลี่ยนแปลงรูปภาพ");
                        
                        fetch('../api/product?product_data_edit', {
                          method: 'POST',
                          body: JSON.stringify({
                          case: 'product_data_edit',
                          nIndex:nIndex
                        })
                        })
                        .then(function (response) {
                            fetch_status = response.status;
                            return response.json();
                        }) 
                        .then(function (json) {
                          select_cat(json[0].cat_id);
                          $("#inp_product_name").val(json[0].product_name);
                          $("#inp_product_barcode").val(json[0].product_barcode);
                          $("#inp_cat").val(json[0].cat_id);
                          $("#inp_unit").val(json[0].unit);
                          $("#inp_unit_cost").val(json[0].unit_cost);
                          $("#inp_unit_price").val(json[0].unit_price);
                          $("#inp_pack").val(json[0].pack);
                          $("#inp_pack_cost").val(json[0].pack_cost);
                          $("#inp_pack_price").val(json[0].pack_price);
                          $("#uploadedProduct").attr("src","../assets/img/product/"+json[0].product_img);


                          setTimeout(function(){
                              $("#inp_sub").val(json[0].cat_sub_id);
                          },1000);
                        })
                        .catch(error => console.error(error));
                        
                      }
                   }


                fetch('../api/category?chk_category', {
                      method: 'POST',
                      body: JSON.stringify({
                      case: 'chk_category'
                      })
                      })
                      .then(function (response) {
                          fetch_status = response.status;
                          return response.json();
                      }) 
                      .then(function (json) {  
                          json.forEach(function(j){ 
                              if (typeof j.cat_name !== 'undefined') {  
                                  let optionElement = $('<option>').attr('value', j.cat_id).text(j.cat_name);
                                  $('#inp_cat').append(optionElement);
                              }  
                          }); 
                          call_edit();
                      })
                      .catch(error => console.error(error));
                }); 

                function select_cat(val){
                  fetch('../api/category?select_sub_category', {
                      method: 'POST',
                      body: JSON.stringify({
                      case: 'select_sub_category',
                      cat_id:val
                      })
                      })
                      .then(function (response) {
                          fetch_status = response.status;
                          return response.json();
                      }) 
                      .then(function (json) {  
                        $("#inp_sub").html("<option value=''>ระบุประเภท</option>");
                          json.forEach(function(j){ 
                              if (typeof j.cat_sub_name !== 'undefined') {  
                                  let optionElement = $('<option>').attr('value', j.cat_sub_id).text(j.cat_sub_name);
                                  $('#inp_sub').append(optionElement);
                              }  
                          }); 
                      })
                      .catch(error => console.error(error));
                }

                function edit_product(){
                  if ($("#inp_product_name").val() == "") {
                    alert_snackbar("warning", "กรุณาระบุชื่อสินค้า");  
                    setTimeout(function(){
                      $("#inp_product_name").focus();
                    },300);
                    return false;
                  } 
                  if ($("#inp_cat").val().length =="") {
                    alert_snackbar("warning", "กรุณาระบุหมวดหมู่");  
                    setTimeout(function(){
                      $("#inp_cat").focus();
                    },300);
                    return false;
                  }
                  if ($("#inp_sub").val().length =="") {
                    alert_snackbar("warning", "กรุณาระบุประเภท");  
                    setTimeout(function(){
                      $("#inp_sub").focus();
                    },300);
                    return false;
                  }
                if ($("#inp_unit").val() < 1) {
                  alert_snackbar("warning", "กรุณาระบุจำนวนชิ้น(ต่อหน่วย)");  
                  setTimeout(function(){
                    $("#inp_unit").focus();
                  },300);
                  return false;
                }
                if ($("#inp_unit_price").val()  < 1 ) {
                  alert_snackbar("warning", "กรุณาระบุราคา(บาท/ต่อหน่วย)");  
                  setTimeout(function(){
                    $("#inp_unit_price").focus();
                  },300);
                  return false;
                }
                
                if ($("#inp_pack").val() < 1) {
                  alert_snackbar("warning", "กรุณาระบุจำนวนชิ้น(ต่อแพ็ค)");  
                  setTimeout(function(){
                    $("#inp_pack").focus();
                  },300);
                  return false;
                }
                if ($("#inp_pack_price").val()  < 1 ) {
                  alert_snackbar("warning", "กรุณาระบุราคา(บาท/ต่อแพ็ค)");  
                  setTimeout(function(){
                    $("#inp_pack_price").focus();
                  },300);
                  return false;
                }
 

                $("#modal_confirm_text").html("ยืนยันการแก้ไขข้อมูลสินค้าในระบบ")
                $("#modal_confirm_submit").attr("onclick","confirm_edit_product();");
                $("#modal_confirm").modal("show");
              }

              function confirm_edit_product(){
                  // Get form data
                  const formElement = document.getElementById('formProductSettings');
                  const formData = new FormData(formElement);
                  
                  formData.append("case", "edit_product");
                  formData.append("nIndex", $("#inp_nIndex").val());
                  // Fetch API POST request
                  fetch('../api/product?edit_product', {
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
                          window.location.href = "product_list";
                        },1500);
                     }else{
                      alert_snackbar("danger","พบข้อผิดพลาด : "+json[0].error_message);
                     }
                  })
                  .catch(error => console.error(error));
                }
            </script>