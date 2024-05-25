<?php include("head.php"); ?>

<style>
    #card_content {
        min-height: 70vh;
    }

    .btn_add {
        color: white !important;
    }

    #table_type {
        overflow: hidden;
        /* Hide the overflow content */
    }

    .table-container {
        overflow-x: auto;
        white-space: nowrap !important;
        height: 100vh;
    }

    /* Force the table to have a single row layout */
    .table-responsive.table {
        display: block;
        white-space: nowrap !important;
    }

    /* Make each table cell behave like a table row */
    .table-responsive.table tbody,
    .table-responsive.table tr,
    .table-responsive.table td {
        display: block;
        white-space: nowrap !important;
    }

    td {
        padding: 0.2rem 0.75rem !important;
    }

    .w-lm-300 {
        min-width: 100px !important;
    }

    .w-lm-200 {
        min-width: 200px !important;
    }

    .w-lm-300 {
        min-width: 300px !important;
    }

    .w-lm-400 {
        min-width: 300px !important;
    }

    .rush-task .btn-rush-task {
        position: fixed;
        bottom: 4rem;
        left: 1.625rem;
        z-index: 999999;
        height: 45px;
        box-shadow: 0 1px 7px 1px #1dbfff;
    }

    .mr-1 {
        margin-right: 5px;
    }

    .water-l {
        font-size: 25px;
        font-weight: bold;
        color: navy;
        background-color: rgba(29, 141, 222, 0.1) !important;
    }

    .water-h-l {
        font-size: 16px !important;
        font-weight: bold;
        color: navy;
        background-color: rgba(29, 141, 222, 0.1) !important;
    }

    .water-m {
        font-size: 25px;
        font-weight: bold;
        color: red;
        background-color: rgba(255, 66, 66, 0.1) !important;
    }

    .water-h-m {
        font-size: 16px !important;
        font-weight: bold;
        color: red;
        background-color: rgba(255, 66, 66, 0.1) !important;
    }

    .water-s {
        font-size: 16px !important;
        font-size: 25px;
        font-weight: bold;
        color: purple;
        background-color: rgba(129, 66, 255, 0.1) !important;
    }

    .water-h-s {
        font-weight: bold;
        color: purple;
        background-color: rgba(129, 66, 255, 0.1) !important;
    }
    .table-responsive{
    min-height: 200px;
    }

    .need{
    color:red;
  }
</style>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-2">
            <div class="col-md-4 col-sm-4 text-center">
                <span class="text-success">ส่งแล้ว</span> / <span class="text-warning">กำลังส่ง</span> / <span class="text-danger">ยกเลิก</span>
                <div class="progress mb-3">
                    <div class="progress-bar bg-success shadow-none" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-warning shadow-none" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-danger shadow-none" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="col-md-8 col-sm-8">
                <input type="date" class="form-control" id="inp_date" value="">
            </div>
        </div>
        <div class="row">
            <div class="card mb-4">
                
                <h5 class="card-header">รายการการจัดส่งน้ำประจำวัน</h5>
                <div class="card-body" style="padding:0px!important;">
                    <div class="table_unfit">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="main_table">
                                <thead id ="table_head">
                                    <tr class="text-center">
                                        <th width="5%">กระทำ</th>
                                        <th>หมายเลข</th>
                                        <th class="w-lm-200">ชื่อลูกค้า</th>
                                        <th class="">ใหญ่ </th>
                                        <th class="">กลาง 24</th>
                                        <th class="">เล็ก 73</th>
                                        <th class="w-lm-200">จำนวนเงิน</th>
                                        <th class="w-lm-300">สถานที่</th>
                                        <th>Map</th>
                                        <th>โทร.</th>
                                        <th class="w-lm-200">ดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody id="table_branch">
                                    <!-- <tr>
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
                                    </tr>  -->
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
//     $(document).ready(function() {
//     const col_date_GB = () => {
//         const date = new Date();
//         const formatter_enGB = new Intl.DateTimeFormat('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
//         const formattedDate_GB = formatter_enGB.format(date); 
//         return formattedDate_GB; 
//     };

//     const col_date_CA = () => {
//         const date = new Date();
//         const formatter_frCA = new Intl.DateTimeFormat('fr-CA', { day: '2-digit', month: '2-digit', year: 'numeric' });
//         const formattedDate_CA = formatter_frCA.format(date);
//         return formattedDate_CA;
//     }

//     window.onload = function() {
//         const selectedDate_CA = col_date_CA(); 
//         const selectedDate_GB = col_date_GB(); 


//         $('#inp_date').val(selectedDate_CA);

//         table_branch(selectedDate_CA); 
//         changeDateHeader(selectedDate_GB);
//         // loadDataAndProgressBar(selectedDate); 
//     };

//     // On date input change
//     $('#inp_date').change(function() {
//         var selectedDate = $(this).val();

//         const formattedDate = new Intl.DateTimeFormat('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' }).format(new Date(selectedDate));
//         // loadDataAndProgressBar(formattedDate);te
//         table_branch(selectedDate); 
//         changeDateHeader(formattedDate); 
//     });
// });

$(document).ready(function() {

    const getDateFromURL = () => {
        const urlParams = new URLSearchParams(window.location.search);
        const dateParam = urlParams.get('date');
        return dateParam ? dateParam : null;
    };

    window.onload = function() {
    const urlDate = getDateFromURL();
    let selectedDate_CA;
    let selectedDate_GB;

    if (urlDate) {

        selectedDate_CA = urlDate;
        selectedDate_GB = urlDate;
    } else {
        const date = new Date();
        const formatter_enGB = new Intl.DateTimeFormat('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
        const formattedDate_GB = formatter_enGB.format(date); 
        const formatter_frCA = new Intl.DateTimeFormat('fr-CA', { day: '2-digit', month: '2-digit', year: 'numeric' });
        const formattedDate_CA = formatter_frCA.format(date);
        selectedDate_CA = formattedDate_CA;
        selectedDate_GB = formattedDate_GB;
    }

    const formatter_frCA = new Intl.DateTimeFormat('fr-CA', { day: '2-digit', month: '2-digit', year: 'numeric' });
    const formattedDateForDisplay = formatter_frCA.format(new Date(selectedDate_CA));

    const selectedDate = $('#inp_date').val(selectedDate_CA);

    table_branch(selectedDate_CA); 
    changeDateHeader(formattedDateForDisplay);
    // loadDataAndProgressBar(selectedDate); 
};

    $('#inp_date').change(function() {
        var selectedDate = $(this).val();

        const formattedDate = new Intl.DateTimeFormat('fr-CA', { day: '2-digit', month: '2-digit', year: 'numeric' }).format(new Date(selectedDate));
        // loadDataAndProgressBar(formattedDate);
        table_branch(selectedDate); 
        changeDateHeader(formattedDate); 
    });
});

    // // // ฟังก์ชันโหลดข้อมูลและอัปเดตหลอดโปรเกรส
    // function loadDataAndProgressBar(selectedDate) {
    //     fetch('../api/product?case=table_branch', {
    //             method: 'POST',
    //             body: JSON.stringify({
    //                 case: 'table_branch',
    //                 date: selectedDate
    //             }),
    //             headers: {
    //                 'Content-Type': 'application/json'
    //             }
    //         })
    //         .then(function(response) {
    //             return response.json();
    //         })
    //         .then(function(data) {
    //             if (data[0].status == '1') {

    //                 updateProgressBar(data.slice(1)); // เรียกใช้งาน updateProgressBar กับข้อมูลใหม่
    //             } else {

    //                 updateProgressBar(data);
    //             }

    //         })
    //         .catch(function(error) {
    //             // หากเกิดข้อผิดพลาดในการโหลดข้อมูล
    //             console.error('Error fetching data:', error);
    //         });
    // }

    function updateProgressBar(data) {
        if (data.length === 0) {
            const progressBar = document.querySelector('.progress');
            const bar = progressBar.querySelector('.progress-bar');

            // กำหนดให้สีทั้งหมดเป็นสีเดียว 100%
            bar.style.width = '100%';
            bar.classList.add('bg-danger');
        } else {
            // หาก data มีข้อมูล
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
            const notSentBar = progressBar.querySelector('.bg-danger');

            sentBar.style.width = `${sentPercentage}%`;
            sendingBar.style.width = `${sendingPercentage}%`;
            notSentBar.style.width = `${notSentPercentage}%`;
        }
    }

    function changeDateHeader(selectedDate) {
    const formattedDate = selectedDate;
    const formate = new Intl.DateTimeFormat('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' }).format(new Date(selectedDate));
    const header = `รายการการจัดส่งน้ำประจำวัน ${formate}`;
    $('.card-header').html(header);
        
    const url = `./delivery_task?date=${formattedDate}`;
    history.pushState({}, '', url);
}


    refresh = () => {
        const selectedDate = $("#inp_date").val();
        table_branch(selectedDate);
        // loadDataAndProgressBar(selectedDate);
    }

    // function formatDate(selectedDate) {
    //     const dateObj = new Date(selectedDate);
    //     const day = dateObj.getDate();
    //     const month = dateObj.getMonth() + 1;
    //     const year = dateObj.getFullYear();
    //     const formattedDate = `${day}/${month < 10 ? '0' : ''}${month}/${year}`;   
    //     console.log(formattedDate);
    //     return formattedDate;
     
    // }

    function getStatusClass(status) {
        switch (status) {
            case 0:
                return 'bg-danger';
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
                    updateProgressBar(data.slice(1));
                    const table = document.getElementById('main_table');
                    const table_body = document.getElementById('table_branch');
                    table.querySelector('thead').innerHTML = '';
                    table_body.innerHTML = '';

                    let taskCounter = 0;

                    const productSet = new Map();
                    data.slice(1).forEach(deli_t => {
                        deli_t.products.forEach(product => {
                            productSet.set(product.product_name, product.product_id);
                        });
                    });

                    const productHeaders = Array.from(productSet.entries());
                    const productOrder = ['P00003', 'P00002', 'P00001'];

                    // Sort productHeaders based on the custom order
                    const sortedProductHeaders = productHeaders.sort(([, idA], [, idB]) => {
                        return productOrder.indexOf(idA) - productOrder.indexOf(idB);
                    });

                    const thead = table.querySelector('thead');
                    const headerRow = document.createElement('tr');
                    headerRow.classList.add('text-center');
                    headerRow.innerHTML = `
                        <th width="5%">กระทำ</th>
                        <th>หมายเลข</th>
                        <th class="w-lm-200">ชื่อลูกค้า</th>
                        ${sortedProductHeaders.map(([product, productId]) => {
                            if (productId === 'P00003') {
                                return `<th class="text-center w-lm-100">เล็ก</th>`;
                            } else if (productId === 'P00002') {
                                return `<th class="text-center w-lm-100">กลาง</th>`;
                            } else if (productId === 'P00001') {
                                return `<th class="text-center w-lm-100">ใหญ่</th>`;
                            } else {
                                return `<th class="text-center w-lm-200">${product}</th>`;
                            }
                        }).join('')}
                        <th class="w-lm-200">จำนวนเงิน</th>
                        <th class="w-lm-300">สถานที่</th>
                        <th>Map</th>
                        <th>ติดต่อ</th>
                        <th class="w-lm-200">ดำเนินการ</th>
                    `;
                    thead.appendChild(headerRow);

                    data.slice(1).forEach(deli_t => {
                        const newRow = document.createElement("tr");

                        const productColumns = productHeaders.map(([productName, productId]) => {
                            const product = deli_t.products.find(p => p.product_name === productName);
                            if (product) {
                                if (product.product_id === 'P00001') {
                                    return `<td class="text-center water-l ${product.product_id} ">${product.order_quantity}</td>`;
                                } else if (product.product_id === 'P00002') {
                                    return `<td class="text-center water-m ${product.product_id}">${product.order_quantity}</td>`;
                                } else if (product.product_id === 'P00003') {
                                    return `<td class="text-center water-s ${product.product_id}">${product.order_quantity}</td>`;
                                } else {
                                    return `<td class="text-center">${product.order_quantity}</td>`;
                                }
                            } else {

                                if (productId === 'P00003') {
                                    return `<td class="text-center water-s ${productId}">0</td>`;
                                } else if (productId === 'P00002') {
                                    return `<td class="text-center water-m ${productId}">0</td>`;
                                } else if (productId === 'P00001') {
                                    return `<td class="text-center water-l ${productId}">0</td>`;
                                } else {
                                    return `<td class="text-center">0</td>`;
                                }
                            }
                        }).join('');

                        newRow.innerHTML = `
                            <td class="text-center"><button class="btn btn-primary btn-sm" onclick="submitCheck('${deli_t.task_id}')">ยืนยัน</button> </td>
                            <td class="text-center"><span class="badge rounded-pill status ${getStatusClass(deli_t.task_status)}">${deli_t.task_id}</span></td>
                            <td class="text-center">${deli_t.cus_name}</td>
                            ${productColumns}
                            <td class="text-center">จำนวนเงินที่ต้องจ่าย : ${Math.ceil(deli_t.price_total.toFixed(2))}<br>จำนวนเงินที่ได้รับ : ${Math.ceil(deli_t.pay_total.toFixed(2))}</td>
                            <td class="text-center">${deli_t.cus_address}</td>
                            <td class="text-center"><a href="https://maps.google.com/?q=${deli_t.lat},${deli_t.lon}" target="_blank"><i class="menu-icon tf-icons bx bx-map"></i></a></td>
                            <td class="text-center"><a href="tel:${deli_t.cus_tel}">${deli_t.cus_tel}</a></td>
                            <td class="text-center"><span class="badge rounded-pill bg-warning" onclick="alert('${deli_t.sale_user}');">${deli_t.sale_user}</span></td>
                        `;

                        table_body.appendChild(newRow);

                                    });
                                } else {
                                       updateProgressBar(data);
                                    table_head = document.querySelector('#main_table thead');
                                    table_body = document.querySelector('#table_branch');


                                    table_head.innerHTML = `                    
                                        <th width="5%">กระทำ</th>
                                        <th>หมายเลข</th>
                                        <th class="w-lm-200">ชื่อลูกค้า</th>
                                        <th class="w-lm-200">จำนวนเงิน</th>
                                        <th class="w-lm-300">สถานที่</th>
                                        <th>Map</th>
                                        <th>ติดต่อ</th>
                                        <th class="w-lm-200">ดำเนินการ</th>
                                        `;

                                    table_body.innerHTML = '<tr><td colspan="9" class="text-center">ไม่พบข้อมูล</td></tr>';
                                }
                            
                                })
                                .catch(function(error) {
                                    console.error('Error fetching data:', error);
                                });
                        }

    // submitCheck = (task_id) => {
    //     $("#modal_confirm_text").html(`
    //                                     ยืนยันการจัดส่ง
                                        
    //                                     <div class="mt-3 col-md-6">
    //                                         <label id="modal_pay_type_label" class="form-label" for="modal_pay_type">รูปแบบการจ่าย </label>
    //                                         <select id="modal_pay_type" class="form-select form-control-sm color-dropdown">
    //                                             <option selected>--เลือกรูปแบบการจ่าย--</option>
    //                                             <option value="0">เงินสด</option>
    //                                             <option value="1">เงินโอน</option>
    //                                             <option value="2">บัตรเครดิต</option>
    //                                         </select>
    //                                     </div>
    //                                     <div class="mt-3 col-md-6">
    //                                     <label class="form-label" for="modal_confirm_input">จำนวนเงิน</label>
    //                                     <input type="text" id="modal_confirm_input" placeholder="ระบุจำนวนเงิน" class="form-control">
    //                                     </div>
    //                                     <div class="mt-3 col-md-6">
    //                                     <label class="form-label" for="modal_confirm_file">
    //                                     หลักฐาน
    //                                     <span class="need">*</span>
    //                                     </label>
    //                                     <img id="modal_confirm_img" class="w-100" src="#" alt="">
    //                                     <input type="file" id="modal_confirm_file" accept="image/*" class="form-control" capture="camera" onclick="previewImg()"/>
    //                                     </div>
    //                                     `);
    //     $("#modal_confirm_submit").on("click", () => {
    //         if($("#modal_confirm_file").val().length == "" ){
    //             alert_snackbar("warning", "ถ่ายภาพก่อนอ้าย");
    //             setTimeout(function() {
    //                 $("#modal_confirm_file").focus();
    //             }, 300)
    //             return false
    //         }

    //         const pay_type = $("#modal_pay_type").val();
    //         const amount = $("#modal_confirm_input").val();
    //         const img = $("#modal_confirm_file")[0].files[0].name;
    //         console.log(img)
    //         submitTask(task_id, pay_type, amount, img);
    //         $("#modal_confirm_submit").off("click");
    //     });

    //     $("#modal_confirm").modal("show");
    // }

    // previewImg = () => {
    //     modal_confirm_file.onchange = evt => {
    //     const [file] = modal_confirm_file.files
    //     if (file) {
    //         modal_confirm_img.src = URL.createObjectURL(file)
    //     }
    //     }
    // }

    // getdatenow = () => {
    //     var timestamp = Date.now();
    //     var localDateTime = new Date(timestamp);
    //     localDateTime.setHours(localDateTime.getHours() + 7);
    //     var datetimeNow = localDateTime.toISOString();
    //     return datetimeNow
    // }

    // submitTask = (task_id, pay_type, amount, img) => {
    //     TimeNOW = getdatenow()
    //     fetch('../api/product?case=task_success', {
    //             method: 'POST',
    //             headers: {
    //                 'Content-Type': 'application/json'
    //             },
    //             body: JSON.stringify({
    //                 case: 'task_success',
    //                 taskID: task_id,
    //                 pay_type: pay_type,
    //                 amount: amount,
    //                 last_datetime: TimeNOW,
    //                 img: img

    //             })
    //         })
    //         .then(response => {
    //             if (!response.ok) {
    //                 throw new Error('Failed to submit task. Server responded with ' + response.status);
    //             }
    //             return response.json();
    //         })
    //         .then(json => {
    //             $("#modal_confirm").modal("hide");
    //             if (json[0].status == '0') {
    //                 alert_snackbar('error', json[0].error_message);
    //             } else {
    //                 alert_snackbar('success', "จัดส่งสำเร็จ");
    //                 setTimeout(function() {
    //                     refresh()
    //                 }, 1500);
    //             }
    //         })
    //         .catch(error => {
    //             console.error('Error submitting task:', error);
    //         });
    // }

    // $(document).on('click', '.btn-cancel-modal', () => {
    //     $("#modal_confirm").modal("hide");
    //     $("#modal_confirm_submit").off("click");
    // });
    submitCheck = (task_id) => {
    $("#modal_confirm_text").html(`
        ยืนยันการจัดส่ง

        
        <div class="card-body">
        <h1 class="text-center">${task_id}</h1>
        <form id="formAccountSettings" enctype="multipart/form-data">
        <div class="row justify-content-center">
            <div class="mt-3 col-md-9">
                <label id="modal_pay_type_label" class="form-label" for="modal_pay_type">รูปแบบการจ่าย </label>
                <select id="modal_pay_type" name="pay_type" class="form-select form-control-sm color-dropdown">
                    <option selected>--เลือกรูปแบบการจ่าย--</option>
                    <option value="0">เงินสด</option>
                    <option value="1">เงินโอน</option>
                    <option value="2">บัตรเครดิต</option>
                </select>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="mt-3 col-md-9">
                <label class="form-label" for="modal_confirm_input">จำนวนเงิน</label>
                <input type="text" id="modal_confirm_input" name="amount" placeholder="ระบุจำนวนเงิน" class="form-control">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="mt-3 col-md-9">
                <label class="form-label" for="modal_confirm_file">
                    หลักฐาน
                    <span class="need">*</span>
                </label>
                <img id="modal_confirm_img" class="w-100 rounded mb-3" src="#" alt="">
                <div class="text-center">
                <label class="form-label" for="modal_confirm_file">
                <span class="h5 border-dark rounded-pill p-2 text-center cursor-pointer" id="modal_confirm_file_label" style="color: white; background-color: skyblue">  ถ่ายภาพ  </span>
                </label>
                <input type="file" id="modal_confirm_file" name="img" accept="image/*" capture="camera" class="form-control" hidden>
                </div>
            </div>
        </div>
    </form>
    </div>
    
    `);

    $('#modal_confirm_file_label').hover(function() {
        $(this).css({"background-color": "deepskyblue" , 
        "color": "white"
    })
    }, function() {
        $(this).css({"background-color": "skyblue", 
        "color": "white" 
    })
    });

    $("#modal_confirm_file").on("change", previewImg);

    $("#modal_confirm_submit").off("click").on("click", () => {
        if ($("#modal_confirm_file").val().length == "" ){
            alert_snackbar("warning", "ถ่ายภาพก่อนอ้าย");
            setTimeout(function() {
                $("#modal_confirm_file").focus();
            }, 300)
            return false;
        }

        TimeNOW = getdatenow();
        const formElement = $('#formAccountSettings')[0]; // เลือกฟอร์มโดยใช้ jQuery
        console.log(formElement);
        const formData = new FormData(formElement);
        console.log(formData);

        formData.append('case', 'task_success');
        formData.append('last_datetime', TimeNOW);
        formData.append('task_id', task_id);
        // formData.append('pay_type', pay_type);
        // formData.append('amount', amount);
        // formData.append('file', file);

        tasklist_success(formData);

    });

    $("#modal_confirm").modal("show");
}

tasklist_success = (formData) => {
    fetch('../api/product?case=task_success', {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to submit task. Server responded with ' + response.status);
            }
            return response.json();
        })
        .then(json => {
            $("#modal_confirm").modal("hide");
            if (json['status'] == '0') {
                alert_snackbar('error', json['error_message']);
            } else {
                alert_snackbar('success', "จัดส่งสำเร็จ");
                setTimeout(function() {
                    refresh();
                }, 1500);
            }
        })
        .catch(error => {
            console.error(error);;
        });
}

previewImg = () => {
    const fileInput = document.getElementById('modal_confirm_file');
    const img = document.getElementById('modal_confirm_img');

    const [file] = fileInput.files;
    if (file) {
        img.src = URL.createObjectURL(file);
    }
}

getdatenow = () => {
    var timestamp = Date.now();
    var localDateTime = new Date(timestamp);
    localDateTime.setHours(localDateTime.getHours() + 7);
    var datetimeNow = localDateTime.toISOString();
    return datetimeNow;
}

$(document).on('click', '.btn-cancel-modal', () => {
    $("#modal_confirm").modal("hide");
    $("#modal_confirm_submit").off("click");
});

</script>