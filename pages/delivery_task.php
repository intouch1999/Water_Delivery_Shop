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
.table-container { 
    overflow-x: auto;
    white-space:nowrap !important;
    height:100vh;
  }

  /* Force the table to have a single row layout */
  .table-responsive.table {
    display: block;
    white-space:nowrap !important;
  }

  /* Make each table cell behave like a table row */
  .table-responsive.table tbody,
  .table-responsive.table tr,
  .table-responsive.table td {
    display: block;
    white-space:nowrap !important;
  }
  
  td{
    padding:0.2rem 0.75rem !important;
  }
  .w-lm-300{
    min-width:100px !important;
  }

  .w-lm-200{
    min-width:200px !important;
  }

  .w-lm-300{
    min-width:300px !important;
  }

  .w-lm-400{
    min-width:300px !important;
  }

  .rush-task .btn-rush-task{
    position: fixed;
    bottom: 4rem;
    left: 1.625rem;
    z-index: 999999;
    height:45px;
    box-shadow: 0 1px 7px 1px #1dbfff;
  }
  .mr-1{
    margin-right:5px;
  }

  .water-l{
    font-size:25px;
    font-weight: bold;
    color:navy;
    background-color:rgba(29,141,222,0.1) !important;
  }

  .water-h-l{
    font-size:16px !important;
    font-weight: bold;
    color:navy;
    background-color:rgba(29,141,222,0.1) !important;
  }

  .water-m{
    font-size:25px;
    font-weight: bold;
    color:red;
    background-color:rgba(255,66,66,0.1) !important;
  }

  .water-h-m{
    font-size:16px !important;
    font-weight: bold;
    color:red;
    background-color:rgba(255,66,66,0.1) !important;
  }

  .water-s{
    font-size:16px !important;
    font-size:25px;
    font-weight: bold;
    color:purple;
    background-color:rgba(129,66,255,0.1) !important;
  }

  .water-h-s{
    font-weight: bold;
    color:purple;
    background-color:rgba(129,66,255,0.1) !important;
  }
</style>
    <!-- Content wrapper -->
    <div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-2">
            <div class="col-md-4 col-sm-4 text-center">
                <span class="text-success">ส่งแล้ว</span> / <span class="text-warning">กำลังส่ง</span> / <span class="text-secondary">ยังไม่ส่ง</span>
                <div class="progress mb-3">
                    <div class="progress-bar bg-success shadow-none" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-warning shadow-none" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-secondary shadow-none" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="col-md-8 col-sm-8">
                <input type="date" class="form-control" id="inp_date" value="<?= $cur_date; ?>"> 
            </div>
        </div>
        <div class="row">
            <div class="card mb-4">
                <h5 class="card-header">รายการการจัดส่งน้ำประจำวัน <?= $cur_date_th; ?></h5>
                <div class="card-body" style="padding:0px!important;">
                    <div class="table_unfit">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table_branch">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th class="w-lm-200">ชื่อลูกค้า</th>
                                        <th class="">ใหญ่ 55</th>
                                        <th class="">กลาง 24</th>
                                        <th class="">เล็ก 73</th>
                                        <th class="w-lm-300">สถานที่</th>
                                        <th>Map</th>
                                        <th>โทร.</th>
                                        <th class="w-lm-200">ดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center"><span class="badge rounded-pill bg-warning">1</span></td> 
                                        <td class="text-center">คุณสนชัย ช่างชัยใหญ่</td>
                                        <td class="text-center water-l">3</td>
                                        <td class="text-center water-m">2</td>
                                        <td class="text-center water-s">-</td>
                                        <td >ลาดพร้าว 88 ตึกข้ามเจริญ ห้อง 48 D อาคารสีฟ้า</td>
                                        <td class="text-center"><a href="javascript:void(0)"><i class="menu-icon tf-icons bx bx-map"></i></a></td>
                                        <td class="text-center"><a href="tel:0896179535">0896179535</a></td>
                                        <td ><span class="badge rounded-pill bg-warning" onclick="alert('คุณสนชัย ช่างชัยใหญ่');">คุณสนชัย ช่างชัยใหญ่</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><span class="badge rounded-pill bg-secondary">1</span></td> 
                                        <td class="text-center">K. Khaetthaleeya phothepha </td>
                                        <td class="text-center water-l">5</td>
                                        <td class="text-center water-m">10</td>
                                        <td class="text-center water-s">3</td>
                                        <td>คอนโดแชปเตอร์วันอีโค รัชดา-ห้วยขวาง ตึกC ชั้น17 ห้อง605 ถ. ประชาอุทิศ แขวงห้วยขวาง เขตห้วยขวาง กรุงเทพมหานคร 10310 </td>
                                        <td class="text-center"><a href="javascript:void(0)"><i class="menu-icon tf-icons bx bx-map"></i></a></td>
                                        <td class="text-center"><a href="tel:0896179535">0896179535</a></td>
                                        <td ><span class="badge rounded-pill bg-secondary">K. Khaetthaleeya phothepha</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><span class="badge rounded-pill bg-secondary">2</span></td> 
                                        <td class="text-center">ประชาราษฎร์บำเพ็ญ 24 ซอยในหมู่บ้านแยก 2</td>
                                        <td class="text-center water-l">15</td>
                                        <td class="text-center water-m">-</td>
                                        <td class="text-center water-s">-</td>
                                        <td>ประชาราษฎร์บำเพ็ญ 24 ซอยในหมู่บ้านแยก 2</td>
                                        <td class="text-center"><a href="javascript:void(0)"><i class="menu-icon tf-icons bx bx-map"></i></a></td>
                                        <td class="text-center"><a href="tel:0896179535">0896179535</a></td>
                                        <td ><span class="badge rounded-pill bg-secondary">ประชาราษฎร์บำเพ็ญ 24 ซอยในหมู่บ้านแยก 2</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><span class="badge rounded-pill bg-success">1</span></td> 
                                        <td class="text-center">คุณสนชัย ช่างชัยใหญ่</td>
                                        <td class="text-center water-l">-</td>
                                        <td class="text-center water-m">-</td>
                                        <td class="text-center water-s">8</td> 
                                        <td>ลาดพร้าว 88 ตึกข้ามเจริญ ห้อง 48 D อาคารสีฟ้า</td>
                                        <td class="text-center"><a href="javascript:void(0)"><i class="menu-icon tf-icons bx bx-map"></i></a></td>
                                        <td class="text-center"><a href="tel:0896179535">0896179535</a></td>
                                        <td ><span class="badge rounded-pill bg-success">คุณสนชัย ช่างชัยใหญ่</span></td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="rush-task">
    <button class="btn btn-info btn-rush-task"><i class="menu-icon tf-icons bx bx-message-square-add"></i></button>
</div> 
<?php include("foot.php"); ?>
<script>
$(document).ready(function() {
    window.onload = function() {
        if (location.href.endsWith('delivery_task')) {
            table_branch($("#inp_date").val());
        }
    };

    $('#inp_date').change(function() {
        var selectedDate = $(this).val();
        table_branch(selectedDate);
    });
});

function table_branch(selectedDate) {
    fetch('../api/product?case=table_branch', {
            method: 'POST',
            body: JSON.stringify({
                case: 'table_branch',
                date: selectedDate
            }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            const table = document.getElementById('table_branch');

            table.innerHTML = '';
            data.slice(1).forEach(deli_t => {

                const newRow = document.createElement("tr");
                console.log(deli_t);
                newRow.innerHTML = `
                                        <td class="text-center"><span class="badge rounded-pill bg-warning">1</span></td> 
                                        <td class="text-center">${deli_t.cus_name}</td>
                                        <td class="text-center water-l">3</td>
                                        <td class="text-center water-m">2</td>
                                        <td class="text-center water-s">-</td>
                                        <td >ลาดพร้าว 88 ตึกข้ามเจริญ ห้อง 48 D อาคารสีฟ้า</td>
                                        <td class="text-center"><a href="javascript:void(0)"><i class="menu-icon tf-icons bx bx-map"></i></a></td>
                                        <td class="text-center"><a href="tel:0896179535">0896179535</a></td>
                                        <td ><span class="badge rounded-pill bg-warning" onclick="alert('คุณสนชัย ช่างชัยใหญ่');">คุณสนชัย ช่างชัยใหญ่</span></td>
    
                                    `

                table.appendChild(newRow);
            })
           
        })
        .catch(function(error) {
            console.error('Error fetching data:', error);
        });
}

</script>
