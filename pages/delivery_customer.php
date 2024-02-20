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
@media screen and (min-width: 900px) {
.table td {
    white-space: normal;  
    overflow-wrap: break-word;  
  }
}
</style>
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-fluid flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-md-12">
        <div class="card" id="card_content">
        <h5 class="card-header">ข้อมูลลูกค้าจัดส่ง
        <div class="custom-float-right"><a class="btn btn-sm btn-info btn_add" href="delivery_customer_add">เพิ่มข้อมูลลูกค้า</a></div>
        </h5>
        <div class="table-responsive text-nowrap">
          <table class="table" id="table_product">
            <thead>
              <tr >
                <th class="text-center" style="border-right:1px solid silver">ลำดับ</th>
                <th class="text-center" style="border-right:1px solid silver">รหัสลูกค้า</th>
                <th class="text-center" style="border-right:1px solid silver">ชื่อลูกค้า</th>
                <th class="text-center" style="border-right:1px solid silver">ที่อยู่</th>
                <th class="text-center" style="border-right:1px solid silver">ประเภท</th>
                <th class="text-center" style="border-right:1px solid silver">แผนที่</th>
                <th class="text-center" style="border-right:1px solid silver">แก้ไข</th>
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
      fetch('../api/customer?chk_deli_customer', {
          method: 'POST',
          body: JSON.stringify({
          case: 'chk_deli_customer' 
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
                if(typeof j.cus_id !== "undefined"){
                  i++;
                  let table_detail = "<tr>"+ 
                                    "<td>"+i+"</td>"+
                                    "<td>"+j.cus_id+"</td>"+
                                    "<td>"+j.cus_name+"</td>"+
                                    "<td>"+j.cus_address+"</td>"+ 
                                    "<td>"+j.comp_type+"</td>"+
                                    "<td><a class='btn btn-sm btn-info btn_add' href='https://maps.google.com/?q="+j.lat+","+j.lon+"' target='_blank'>คลิก</a></td>"+
                                    "<td><a class='btn btn-sm btn-warning btn_add' href='javascript:void(0)' onclick=\"edit_customer('"+j.cus_id+"')\"><i class='menu-icon tf-icons bx bx-edit-alt' ></i></a></td></td>"+
                                    "</tr>";
                  $("#table_product tbody").append(table_detail);
                }
            });
        })
        .catch(error => console.error(error));
    }); 
 

    function edit_customer(cus_id){
      $.redirect("delivery_customer_add",
      {
        cus_id: cus_id
      },
      "POST");
    }
    
  </script>