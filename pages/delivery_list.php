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
            <h5 class="card-header">เพิ่มหมวดหมู่สินค้าจัดส่ง (Delivery)</h5>
            <div class="card-body">
            <div class="row gx-3 gy-2 align-items-center">
                <div class="col-md-4">
                    <label class="form-label" for="inp_cat_name">หมวดหมู่</label>
                    <input type="text" class="form-control" name="inp_cat_name" id="inp_cat_name" placeholder="ระบุหมวดหมู่เช่น น้ำดื่มขวดใหญ่(แพ็ค) เป็นต้น" readonly>
                    <span id="warning_cat_name"></span>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="submit_cat">&nbsp;</label>
                    <button type="button" id="submit_cat" class="btn btn-secondary d-block" disabled>บันทึก</button>
                </div>
            </div>
            <div class="table-responsive text-nowrap mt-3">
                    <table class="table" id="table_deli_cat">
                        <thead>
                        <tr class="text-nowrap">
                            <th width="30%">หมวดหมู่</th> 
                            <th width="30%">แก้ไข</th> 
                            <th>ลบ</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card mb-4">
            <div class="card-header">
                <h5>เพิ่มสินค้าจัดส่ง</h5>
                <p>เพิ่มสินค้าจัดส่งตามหมวดหมู่ต่าง ๆ</p>
                <div class="row gx-3 gy-2 align-items-center">
                    <div class="col-md-3">
                    <label class="form-label" for="select_cat">หมวดหมู่</label>
                    <select id="select_cat" class="form-select form-control-sm color-dropdown">
                    </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="inp_search_product">สินค้า</label>
                        <input type="text" class="form-control" list="data_product_list" name="inp_search_product" id="inp_search_product" placeholder="ระบุชื่อ หรือ รหัสสินค้า"> 
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="inp_search_product">ประเภทขาย</label>
                        <select id="delivery_type" class="form-select form-control-sm color-dropdown">
                            <option value="pack">Pack (แพ็ค)</option>
                            <option value="unit">Unit (ชิ้น)</option>
                        </select>
                    </div>
                    <datalist id="data_product_list"></datalist>
                    <div class="col-md-2">
                        <label class="form-label" for="submit_cat">&nbsp;</label>
                        <button type="button" id="submit_product_sub" class="btn btn-primary d-block" onclick="cat_product_submit()">บันทึก</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table" id="table_sub_cat">
                        <thead>
                        <tr class="text-nowrap">
                            <th>หมวดหมู่</th>
                            <th>รหัสสินค้า</th>
                            <th>สินค้า</th> 
                            <th>ประเภทส่ง</th> 
                            <th>ลบ</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
          <div class="modal fade" id="modal_edit" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog">
              <form class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="backDropModalTitle">เปลี่ยนแปลงข้อมูล</h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col mb-3" id="modal_edit_content"> 
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    ยกเลิก
                  </button>
                  <button type="button" id="modal_edit_submit" class="btn btn-primary">ยืนยัน</button>
                </div>
              </form>
            </div>
          </div> 
<?php include("foot.php"); ?>
<script>
    
    window.onload = function() {
        preload_page();
	}

    async function preload_page(){
        await chk_category();
        await chk_cat_product();
    }

    function chk_category(){
        return new Promise((resolve) => { 
            fetch('../api/category?chk_deli_category', {
            method: 'POST',
            body: JSON.stringify({
            case: 'chk_deli_category'
            })
            })
            .then(function (response) {
                fetch_status = response.status;
                return response.json();
            }) 
            .then(function (json) {
                $('#table_deli_cat tbody').empty();
                $('#select_cat').empty();
                json.forEach(function(j){ 
                    if (typeof j.delivery_cat_id !== 'undefined') {  
                        let optionElement = $('<option>').attr('value', j.delivery_cat_id).text(j.delivery_cat_name);
                        $('#select_cat').append(optionElement);
                        let table_cat_detail;
                        if(parseInt(j.product_count)==0){
                            table_cat_detail = '<tr><td>'+j.delivery_cat_name+'</td><td><button class="btn btn-sm btn-secondary text-center"><i class="menu-icon tf-icons bx bx-edit-alt" ></i></button></td><td><font color="silver">ระบบยังไม่สามารถลบได้ในขณะนี้</font></td></tr>';
                       }else{
                            table_cat_detail = '<tr><td>'+j.delivery_cat_name+'</td><td><button class="btn btn-sm btn-secondary text-center"><i class="menu-icon tf-icons bx bx-edit-alt" ></i></button></td><td><font color="silver">ไม่สามารถลบได้เนื่องจากมีสินค้าที่ใช้หมวดหมู่นี้</font></td></tr>';
                        }
                        $('#table_deli_cat tbody').append(table_cat_detail);
                    }  
                });
                resolve("done");
            })
            .catch(error => console.error(error));
        });
    }

    function chk_cat_product(){
        return new Promise((resolve) => { 
            fetch('../api/category?chk_deli_product', {
            method: 'POST',
            body: JSON.stringify({
            case: 'chk_deli_product'
            })
            })
            .then(function (response) {
                fetch_status = response.status;
                return response.json();
            }) 
            .then(function (json) {
                $('#table_sub_cat tbody').empty();
                json.forEach(function(j){ 
                    if (typeof j.delivery_cat_name !== 'undefined') {  
                        //let optionElement = $('<option>').attr('value', j.cat_id).text(j.cat_name);
                        //$('#select_cat').append(optionElement);
                        let table_cat_sub_detail; 

                        table_cat_detail = '<tr><td>'+j.delivery_cat_name+'</td><td>'+j.product_id+'</td><td>'+j.product_name+'</td><td>'+j.delivery_type+'</td><td><button class="btn btn-sm btn-danger text-center" onclick="del_cat_product(\''+j.nIndex+'\',\''+j.product_name+'\')"><i class="menu-icon tf-icons bx bx-trash" ></i></button></td></tr>';
                        $('#table_sub_cat tbody').append(table_cat_detail);
                    }  
                });
                resolve("done");
            })
            .catch(error => console.error(error));
        });
    }

        function cat_product_submit() {
        let product_name = $("#inp_search_product").val();
        if (product_name.length <= 5) {  
            alert_snackbar("warning", "กรุณาระบุข้อมูลให้ถูกต้อง");
            return false;
        }else{
            fetch('../api/category?submit_cat_deli_product', {
            method: 'POST',
            body: JSON.stringify({
            case: 'submit_cat_deli_product',
            product_name: product_name,
            delivery_cat_id:$("#select_cat").val(),
            delivery_type:$("#delivery_type").val()
            })
            })
            .then(function (response) {
                fetch_status = response.status;
                return response.json();
            }) 
            .then(function (json) {
                $("#inp_search_product").val("");
                if(json[0].status=='1'){
                    alert_snackbar("success","เพิ่มข้อมูลเสร็จสิ้น");
                    chk_cat_product();
                }else{
                    alert_snackbar("warning",json[0].error_message);
                }
            })
            .catch(error => console.error(error));    
        }
    }

    function del_cat_product(nIndex,val){
        $("#modal_confirm_text").html("ต้องการ<b>ลบสินค้า</b><b>\""+val+"\"</b>  ออกจากสินค้าจัดส่งหรือไม่")
        $("#modal_confirm_submit").attr("onclick","submit_del_cat_product('"+nIndex+"');");
        $("#modal_confirm").modal("show");
    }

    function submit_del_cat_product(nIndex){
        fetch('../api/category?del_deli_cat_product', {
            method: 'POST',
            body: JSON.stringify({
            case: 'del_deli_cat_product',
            nIndex:nIndex
        })
        })
        .then(function (response) {
            fetch_status = response.status;
            return response.json();
        }) 
        .then(function (json) {
            if(json[0].status=='0'){
                alert_snackbar('error',json[0].error_message)
            }else{
                alert_snackbar('success',"ลบสินค้าออกจากสินค้าจัดส่งเรียบร้อยแล้ว");
                preload_page();
            }
            $("#modal_confirm").modal("hide");
        })
        .catch(error => console.error(error));
    }

    //search product
    $(document).ready(function() {
            const inpSearchProduct = $("#inp_search_product");
            const dataProductList = $("#data_product_list");
            let debounceTimeout;

            inpSearchProduct.on("keyup", function() {
                // Clear existing datalist options
                dataProductList.empty();

                // Clear the previous timeout
                clearTimeout(debounceTimeout);

                // Set a new timeout to wait for user to finish typing
                debounceTimeout = setTimeout(function() {
                    const userInput = inpSearchProduct.val();
                    $.ajax({
                        url: `../api/category?case=search_product&search=${userInput}`,
                        method: "GET",
                        dataType: "json",
                        success: function(data) {
                            data.forEach(function(item) {
                                if (typeof item.product_id !== 'undefined') {
                                    const option = $("<option>")
                                        .val(item.product_id + " | " + item.product_name)
                                        .text(item.product_name);
                                    dataProductList.append(option);
                                }
                            });
                        },
                        error: function(error) {
                            console.error("Error fetching data:", error);
                        }
                    });
                }, 500);  
            });
        });



</script>
