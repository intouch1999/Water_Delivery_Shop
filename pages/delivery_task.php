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
                            <table class="table table-bordered" >
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
                                <tbody id="table_branch">
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
            const selectedDate = $("#inp_date").val();
            table_branch(selectedDate);
            changeDateHeader(selectedDate);
            loadDataAndProgressBar(selectedDate);
            
        }
    };

    $('#inp_date').change(function() {
    var selectedDate = $(this).val();
    loadDataAndProgressBar(selectedDate); // เมื่อเปลี่ยนวันที่
    table_branch(selectedDate); // โหลดข้อมูลตาราง branch ใหม่
    changeDateHeader(selectedDate); // เปลี่ยนหัวข้อวันที่
});

});



// ฟังก์ชันโหลดข้อมูลและอัปเดตหลอดโปรเกรส
function loadDataAndProgressBar(selectedDate) {
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
        if (data[0].status == '1') {

    updateProgressBar(data.slice(1)); // เรียกใช้งาน updateProgressBar กับข้อมูลใหม่
        } else {


        }

    })
    .catch(function(error) {
        // หากเกิดข้อผิดพลาดในการโหลดข้อมูล
        console.error('Error fetching data:', error);
    });
}

// ฟังก์ชันอัปเดตหลอดโปรเกรส
function updateProgressBar(data) {
    const sentCount = data.filter(item => item.task_status === 2).length;
    const sendingCount = data.filter(item => item.task_status === 1).length;
    const notSentCount = data.filter(item => item.task_status === 0).length;
    const totalCount = data.length;

    const sentPercentage = (sentCount / totalCount) * 100;
    const sendingPercentage = (sendingCount / totalCount) * 100;
    const notSentPercentage = (notSentCount / totalCount) * 100;


    const progressBar = document.querySelector('.progress');

    const sentBar = progressBar.querySelector('.bg-success');
    const sendingBar = progressBar.querySelector('.bg-warning');
    const notSentBar = progressBar.querySelector('.bg-secondary');

    sentBar.style.width = `${sentPercentage}%`;
    sendingBar.style.width = `${sendingPercentage}%`;
    notSentBar.style.width = `${notSentPercentage}%`;
}

function changeDateHeader(selectedDate) {

    const formattedDate = formatDate(selectedDate);

    const header = `รายการการจัดส่งน้ำประจำวัน ${formattedDate}`;

    $('.card-header').text(header);
}


function formatDate(selectedDate) {
    const dateObj = new Date(selectedDate);
    const day = dateObj.getDate();
    const month = dateObj.getMonth() + 1;
    const year = dateObj.getFullYear();
    const formattedDate = `${day}/${month < 10 ? '0' : ''}${month}/${year}`;
    return formattedDate;
}

function getStatusClass(status) {
    switch (status) {
        case 0:
            return 'bg-secondary';
        case 1:
            return 'bg-warning';
        case 2:
            return 'bg-success';
        default:
            return 'bg-light'; // หรือคลาสอื่นๆ ที่ต้องการกำหนดเอง
    }
}

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
        if (data[0].status == '1') {
            const table = document.getElementById('table_branch');
            table.innerHTML = '';
            let taskCounter = 0; // เก็บค่านับจำนวน task
            let prevCusId = null; // เก็บค่า cus_id ก่อนหน้า

            data.slice(1).forEach(deli_t => {
                // ตรวจสอบว่า cus_id เปลี่ยนหรือไม่
                if (deli_t.cus_id !== prevCusId) {
                    taskCounter = 1; // ถ้าเปลี่ยน cus_id ให้เริ่มนับใหม่
                } else {
                    taskCounter++; // ถ้าไม่เปลี่ยน cus_id เพิ่มค่านับตามปกติ
                }

                prevCusId = deli_t.cus_id;
                console.log(prevCusId);

                const newRow = document.createElement("tr");

                // สร้างคอลัมน์สำหรับแสดงรายการสินค้า (จำกัดเพียงสามคอลัมน์)
                let productColumns = '';
                for (let i = 0; i < 3; i++) {
                    const product = (i < deli_t.products.length) ? deli_t.products[i] : { product_id: '0', order_quantity: '0' };
                    const productId = product.product_id;
                    const quantity = product.order_quantity;
                    const id = productId.replace('-', ''); // ลบอักขระพิเศษออก

                    // กำหนดคอลัมน์ตามลำดับ
                    let columnClass = '';
                    if (i === 0) {
                        columnClass = 'water-l';
                    } else if (i === 1) {
                        columnClass = 'water-m';
                    } else {
                        columnClass = 'water-s';
                    }

                    productColumns += `<td class="text-center ${columnClass}" id="${id}">${productId} (${quantity})</td>`;
                }

                newRow.innerHTML = `
                    <td class="text-center"><span class="badge rounded-pill ${getStatusClass(deli_t.task_status)}">${deli_t.task_id}</span></td> 
                    <td class="text-center">${deli_t.cus_name}</td>
                    ${productColumns}
                    <td class="text-center">${deli_t.cus_address}</td>
                    <td class="text-center"><a href="javascript:void(0)"><i class="menu-icon tf-icons bx bx-map"></i></a></td>
                    <td class="text-center"><a href="tel:${deli_t.cus_tel}">${deli_t.cus_tel}</a></td>
                    <td><span class="badge rounded-pill bg-warning" onclick="alert('${deli_t.sale_user}');">${deli_t.sale_user}</span></td>
                `;

                table.appendChild(newRow);
            })
        } else {
            const table = document.getElementById('table_branch');
            table.innerHTML = `
                <td colspan="9" class="text-center fs-1">ไม่มีรายการส่งในวันที่เลือก</td>
            `;
            table.appendChild(table);
        }
    })
    .catch(function(error) {
        console.error('Error fetching data:', error);
    });
}


</script>
