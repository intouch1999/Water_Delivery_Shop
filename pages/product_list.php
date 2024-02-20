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
        <h5 class="card-header">รายการสินค้า
        <div class="custom-float-right"><a class="btn btn-sm btn-info btn_add" href="product_add">เพิ่มสินค้าใหม่</a></div>
        </h5>
        <div class="table-responsive text-nowrap">
          <table class="table" id="table_product">
            <thead>
              <tr>
                <th colspan="5" style="border:1px solid silver"></th>
                <th colspan="2" class="text-center" style="border:1px solid silver">unit</th>
                <th colspan="2" class="text-center" style="border:1px solid silver">pack</th>
                <th colspan="4" style="border:1px solid silver"></th>
              </tr>
              <tr >
                <th class="text-center" style="border-right:1px solid silver">ลำดับ</th>
                <th class="text-center" style="border-right:1px solid silver">รหัสสินค้า</th>
                <th colspan="2" class="text-center" style="border-right:1px solid silver">ชื่อสินค้า</th>
                <th class="text-center" style="border-right:1px solid silver">หมวดหมู่/ประเภท</th>
                <th class="text-center" style="border-right:1px solid silver">จำนวนชิ้น</th>
                <th class="text-center" style="border-right:1px solid silver">ราคา</th>
                <th class="text-center" style="border-right:1px solid silver">จำนวนชิ้น</th>
                <th class="text-center" style="border-right:1px solid silver">ราคา</th>
                <th class="text-center" style="border-right:1px solid silver">ผู้เพิ่ม</th>
                <th class="text-center" style="border-right:1px solid silver">วันที่แก้ไข</th>
                <th class="text-center" style="border-right:1px solid silver">เปิดใช้งาน</th>
                <th class="text-center" style="border-right:1px solid silver">ดำเนินการ</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            </tbody>
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
      fetch('../api/product?chk_product', {
          method: 'POST',
          body: JSON.stringify({
          case: 'chk_product' 
        })
        })
        .then(function (response) {
            fetch_status = response.status;
            return response.json();
        }) 
        .then(function (json) {
            let i=0;
            $("#table_product tbody").empty();
            json.forEach(function(j){
                if(typeof j.nIndex !== "undefined"){
                  i++;
                  let chk_checked = "";
                  if(parseInt(j.product_active)==1) chk_checked = "checked";
                  let formchk_btn = '<div class="form-check form-switch mb-2"><input class="form-check-input" type="checkbox" onclick="push_enable(\''+j.nIndex+'\',this)" '+chk_checked+'></div>';
                  let product_picture = '<img src="../assets/img/product/'+j.product_img+'" alt="user-avatar" class="d-block rounded" height="70px" width="70px">';
                  let table_detail = "<tr>"+ 
                                    "<td>"+i+"</td>"+
                                    "<td>"+j.product_id+"</td>"+
                                    "<td>"+j.product_name+"</td>"+
                                    "<td>"+product_picture+"</td>"+
                                    "<td>"+j.cat_name+"/"+j.cat_sub_name+"</td>"+
                                    "<td>"+j.unit+"</td>"+
                                    "<td>"+j.unit_price+"</td>"+
                                    "<td>"+j.pack+"</td>"+
                                    "<td>"+j.pack_price+"</td>"+
                                    "<td>"+j.create_user+"</td>"+
                                    "<td>"+j.edit_date+"</td>"+
                                    "<td>"+formchk_btn+"</td>"+
                                    "<td><button class='btn btn-sm btn-warning text-center' onclick=\"edit_product(\'"+j.nIndex+"\')\"><i class='menu-icon tf-icons bx bx-edit-alt'></i></button></td></td>"+
                                    "</tr>";
                  $("#table_product tbody").append(table_detail);
                }
            });
        })
        .catch(error => console.error(error));
    }); 

    function push_enable(nIndex,val){
      let product_active;
      if(val.checked) product_active = 1;
      else product_active = 0;
      fetch('../api/product?active_product', {
          method: 'POST',
          body: JSON.stringify({
          case: 'active_product',
          nIndex:nIndex,
          product_active:product_active 
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

    function edit_product(nIndex){
      $.redirect("product_add",
      {
        nIndex: nIndex
      },
      "POST");
    }
  </script>