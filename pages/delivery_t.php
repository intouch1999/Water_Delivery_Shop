<?php include("head.php"); ?>

<style>
    .rush-task .btn-rush-task {
        position: fixed;
        bottom: 4rem;
        left: 1.625rem;
        z-index: 999999;
        height: 45px;
        box-shadow: 0 1px 7px 1px #1dbfff;
    }

    input[type="text"]::-webkit-calendar-picker-indicator {
        display: none;
    }

    .input-group-append {
        display: flex;
        align-items: center;
        float: right;
    }

    #taskuserlist {
        display: none;
    }

    #tasklist {
        display: none;
    }

    .table {
        border-collapse: collapse;
    }

    .table,
    .table th,
    .table td {
        border: none;
    }

    .dataTable .btn {
        margin-right: 10px;
    }

    /* ปรับขนาดของตัวหนังสือในตารางให้เหมาะสม */
    #product_detail_modal table {
        font-size: 14px;
        /* ปรับขนาดตัวหนังสือในตาราง */
    }

    #product_detail_modal table td {

        overflow: hidden;
        white-space: nowrap;

    }


    /* ปรับขนาดของตารางให้เต็มหน้าจอในโหมดมือถือ */
    @media (max-width: 576px) {
        #product_detail_modal .modal-dialog {
            max-width: 100%;
            /* ทำให้ตารางเต็มหน้าจอ */
        }

        #product_detail_modal .modal-content {
            overflow-x: auto;
            /* ให้สามารถเลื่อนแนวนอนในกรณีที่ตารางมีขนาดใหญ่เกินไป */
        }
    }
</style>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row" id="DataTable">
            <div class="card mb-4">
                <h5 class="card-header">เพิ่มนัดหมาย</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="customerData" class="display responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th>รหัสลูกค้า</th>
                                    <th>ชื่อลูกค้า</th>
                                    <th>ประเภทลูกค้า</th>
                                    <th>ที่อยู่</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- datatable -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="taskuserlist">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>เพิ่มนัดหมาย
                        <button id="backButton" class="btn btn-secondary mx-2">ย้อนกลับ</button>
                        <button type="button" id="submit_Task" class="btn btn-primary">บันทึก</button>
                    </h5>
                    <div class="row gx-3 gy-2 align-items-center">
                        <div class="mt-3 col-md-2">
                            <label class="form-label" for="cus_id">รหัสลูกค้า </label>
                            <h3><span id="cus_id" name="cus_id"></span></h3>
                        </div>
                        <div class="mt-3 col-md-2">
                            <label class="form-label" for="cus_name">ชื่อลูกค้า </label>
                            <h3><span id="cus_name" name="cus_name"></span></h3>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="task_datetime">วันเวลาจัดส่ง </label>
                            <input type="datetime-local" class="form-control" id="datetime" name="task_datetime">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="pay_status">สถานะการจ่าย </label>
                        <select id="pay_status" class="form-select form-control-sm color-dropdown">
                            <option selected>--เลือกสถานะการจ่าย--</option>
                            <option value="0">ยังไม่จ่าย</option>
                            <option value="1">จ่ายแล้ว</option>
                        </select>
                        </div>
                        <div class="col-md-2">
                            <label id="pay_type_label" class="form-label" for="pay_type">ประเภทการจ่าย </label>
                            <select id="pay_type" class="form-select form-control-sm color-dropdown">
                                <option selected>--เลือกประเภทการจ่าย--</option>
                                <option value="0">เงินสด</option>
                                <option value="1">เงินโอน</option>
                                <option value="2">บัตรเครดิต</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="pay_total" id="pay_total_label">จำนวนเงิน </label>
                            <input type="number" class="form-control" id="pay_total" name="pay_total" placeholder="ระบุจำนวนเงิน">
                        </div>

                    </div>
                </div>
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>สินค้า</th>
                                <th>จำนวน</th>
                                <th>ประเภท</th>
                            </tr>
                        </thead>
                        <tbody id="product_list">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row" id="tasklist">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="display responsive nowrap" width="100%" id="taskData">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th>รหัสนัดหมาย</th>
                                        <th>รหัสลูกค้า</th>
                                        <th>วันที่นัดหมาย</th>
                                        <th>จำนวน</th>
                                        <th>จัดส่งสำเร็จเวลา</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="product_detail_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">รายการที่สั่ง</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalContent">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>อัพเดทข้อมูล
                    </h5>
                    <div class="row gx-3 gy-2 align-items-center">
                            <label class="form-label" for="task_datetime">วันเวลาจัดส่ง </label>
                            <input type="datetime-local" class="form-control" id="datetime_update" name="task_datetime">
                        <div class="col-md-5">
                            <label class="form-label" for="pay_status_update">สถานะการจ่าย </label>
                        <select id="pay_status_update" class="form-select form-control-sm color-dropdown">
                            <option selected>--เลือกสถานะการจ่าย--</option>
                            <option value="0">ยังไม่จ่าย</option>
                            <option value="1">จ่ายแล้ว</option>
                        </select>
                        </div>
                        <div class="col-md-5">
                            <label id="pay_type_update_label" class="form-label" for="pay_type_update">ประเภทการจ่าย </label>
                            <select id="pay_type_update" class="form-select form-control-sm color-dropdown">
                                <option selected>--เลือกประเภทการจ่าย--</option>
                                <option value="0">เงินสด</option>
                                <option value="1">เงินโอน</option>
                                <option value="2">บัตรเครดิต</option>
                            </select>
                        </div>
                            <label class="form-label" for="pay_total_update" id="pay_total_update_label">จำนวนเงิน </label>
                            <input type="number" class="form-control" id="pay_total_update" name="pay_total" placeholder="ระบุจำนวนเงิน">
                        <button type="button" id="update_Task" class="btn btn-primary">บันทึก</button>
                    </div>
                </div>
            </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">สินค้า</th>
                            <th scope="col">จำนวน</th>
                            <!-- <th scope="col">ราคาต่อหน่วย</th> -->
                            <th scope="col">ราคา</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <!-- Product details will be displayed here -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" aria-hidden="true" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<?php include("foot.php"); ?>
<footer>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />

    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.dataTables.css" />
    <script src="https:/cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.js"></script>
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.5.0/css/rowReorder.dataTables.css" />
            <script src="https:/cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.js"></script> -->

</footer>
<script>
    $(document).ready(function() {
        window.onload = function() {
            if (location.href.endsWith('delivery_t')) {
                customer_task();
            } else {
                product_l()
            }
        }

        $('#backButton').on('click', function() {
            location.href = 'delivery_t.php';
        });

    $('#pay_status').change(function() {
        var payStatus = $(this).val();
        if (payStatus === '1') {
            $('#pay_type').show();
            $('#pay_type_label').show();
            $('#pay_total').show();
            $('#pay_total_label').show();
        } else {
            $('#pay_type').hide();
            $('#pay_type_label').hide();
            $('#pay_total').hide();
            $('#pay_total_label').hide();
        }
    });

    $('#pay_type').hide();
    $('#pay_type_label').hide();
    $('#pay_total').hide();
    $('#pay_total_label').hide();




        $('#customerData').on('click', '.btn-edit', task_button, task());
        $('#submit_Task').on('click', submitTask);
        $('#taskData').on('click', '.btn-success', tasklist_success);
        $('#taskData').on('click', '.btn-info', btn_info)
        $('#product_detail_modal').on('click', '[aria-hidden="true"]', function() {
            $('#product_detail_modal').modal('hide');
        });

    });

    function customer_task() {
        $.ajax({
            url: '../api/customer?case=customer_task',
            type: 'GET',
            dataType: 'json',
            contentType: 'application/json',
            success: function(response) {
                console.log(response);
                try {
                    if (!response.error_message) {
                        var table = $('#customerData').DataTable({
                            responsive: true,
                            data: response.filter(function(item) {
                                return !('status' in item);
                            }),
                            columns: [{
                                    data: 'cus_id'
                                },
                                {
                                    data: 'cus_name'
                                },
                                {
                                    data: 'comp_type'
                                },
                                {
                                    data: 'cus_address'
                                },
                                {
                                    data: null,
                                    defaultContent: `<button class="btn btn-primary btn-sm btn-edit">นัดหมาย</button>`
                                }
                            ]
                        });

                    } else {
                        $('#customerData').text('Error: ' + response.error_message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
            }
        });
    }


    // function task_button() {
    //     var rowData = getTableRowData($(this) , 'customerData');
    //     var cus_id = rowData.cus_id;
    //     var cus_name = rowData.cus_name;
    //     get_cus_id = cus_id;
    //     $('#DataTable').hide();
    //     $('#taskuserlist').show();
    //     $('#tasklist').show();

    //     $('#cus_id').text(cus_id);
    //     // $('#cus_id').val(cus_id);
    //     $('#cus_name').text(cus_name);


    //     $.ajax({
    //         url: '../api/product?case=main_task',
    //         type: 'POST',
    //         dataType: 'json',
    //         contentType: 'application/json',
    //         data: JSON.stringify({
    //             case: 'main_task',
    //             cus_id: cus_id
    //         }),
    //         success: function(response) {
    //             console.log(response);
    //             try {
    //                 if (!response.error_message) {
    //                     task_list = $('#taskData').DataTable({
    //                         response: true,
    //                         data: response.filter(function(item) {
    //                             return !('status' in item);
    //                         }),
    //                         columns: [{
    //                                 data: 'task_id'
    //                             },
    //                             {
    //                                 data: 'cus_id'
    //                             },
    //                             {
    //                                 data: 'task_datetime'
    //                             },
    //                             {
    //                                 data: 'order_qty'
    //                             },
    //                             {
    //                                 data: 'last_datetime'
    //                             },
    //                             {
    //                                 data: null,
    //                                 defaultContent: `<button class="btn btn-primary btn-sm btn-success">จัดส่งสำเร็จ</button>
    //                                                     <button class="btn btn-primary btn-sm btn-info">รายละเอียด</button>`
    //                             }
    //                         ],
    //                         order: [
    //                         [0, 'desc'] 
    //                     ]
    //                     }); 

    //                 } else {
    //                     $('#taskData').text('Error: ' + response.error_message);
    //                 }
    //             } catch (error) {
    //                 console.error('Error:', error);
    //             }
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('Error: ' + error);
    //         }
    //     });
    // };

    function task_button() {
        var rowData = getTableRowData($(this), 'customerData');
        var cus_id = rowData.cus_id;
        var cus_name = rowData.cus_name;
        // get_cus_id = cus_id;
        window.location.href = "delivery_t.php?cus_id=" + cus_id + "&cus_name=" + encodeURIComponent(cus_name);
    };

    function task() {
        var urlParams = new URLSearchParams(window.location.search);
        var cus_id = urlParams.get('cus_id');
        if (cus_id) {
            // แสดง #taskuserlist และ #tasklist เมื่อมี cus_id ใน URL
            $('#DataTable').hide();
            $('#taskuserlist').show();
            $('#tasklist').show();

            // ตั้งค่าข้อมูลในหน้าเว็บด้วยข้อมูลจาก cus_id
            $('#cus_id').text(cus_id);
            // $('#cus_id').val(cus_id);
            $('#cus_name').text(urlParams.get('cus_name'));

            // เรียกใช้งาน AJAX เมื่อหน้าถูกโหลด
            $.ajax({
                url: '../api/product?case=main_task',
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({
                    case: 'main_task',
                    cus_id: cus_id
                }),
                success: function(response) {
                    console.log(response);
                    try {
                        if (!response.error_message) {
                            task_list = $('#taskData').DataTable({
                                response: true,
                                data: response.filter(function(item) {
                                    return !('status' in item);
                                }),
                                columns: [{
                                        data: 'task_id'
                                    },
                                    {
                                        data: 'cus_id'
                                    },
                                    {
                                        data: 'task_datetime'
                                    },
                                    {
                                        data: 'order_qty'
                                    },
                                    {
                                        data: 'last_datetime'
                                    },
                                    {
                                        data: null,
                                        defaultContent: `<button class="btn btn-primary btn-sm btn-success">จัดส่งสำเร็จ</button>
                                                    <button class="btn btn-primary btn-sm btn-info">รายละเอียด</button>`
                                    }
                                ],
                                order: [
                                    [0, 'desc']
                                ]
                            });

                        } else {
                            $('#taskData').text('Error: ' + response.error_message);
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + error);
                }
            });
        }
    }

    function btn_info() {
        var rowData = getTableRowData($(this), 'taskData');
        var task_id = rowData.task_id;

        fetch('../api/product?case=product_details', {
                method: 'POST',
                body: JSON.stringify({
                    case: 'product_details',
                    task_id: task_id,
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(function(json) {
                const taskDatetime = json[1].task_datetime;
                const pay_status = json[1].pay_status;
                const pay_type = json[1].pay_type;
                const pay_total = json[1].pay_total;
                document.getElementById('datetime_update').value = taskDatetime;
                const payStatusElement = document.getElementById('pay_status_update');
                const payTypeElement = document.getElementById('pay_type_update');
                const payTotalElement = document.getElementById('pay_total_update');
                
                if (pay_status === '1') {
                    payStatusElement.value = '1';
                } else {
                    payStatusElement.value = '0';
                }
                if (pay_type == '0') {
                    payTypeElement.value = '0';
                } else if (pay_type == '1') {
                    payTypeElement.value = '1';
                } else if (pay_type == '2') {
                    payTypeElement.value = '2';
                }

                payTotalElement.value = pay_total;
                // if (json[1].pay_type === '0') {
                //     document.getElementById('pay_type_update').value = '0';
                // } else if (json[1].pay_type === '1') {
                //     document.getElementById('pay_type_update').value = '1';
                // } else if (json[1].pay_type === '2') {
                //     document.getElementById('pay_type_update').value = '2';
                // }


                if (json[0].status == '1') {
                    const modalContentDiv = document.getElementById('modalContent');
                    let productTableBody = document.getElementById('productTableBody');
                    let total = 0;

                    // Clear existing table body
                    productTableBody.innerHTML = '';

                    json.slice(1).forEach(product => {
                        if (product.product_id !== undefined && product.order_qty !== undefined && product.product_type !== undefined && product.price !== undefined) {
                                const totalPrice = Math.ceil(product.price * product.order_qty); // ปัดเศษของ totalPrice

                                // Create a new row for each product
                                let newRow = document.createElement("tr");
                                newRow.innerHTML = `
                                    <td>${product.product_name}</td>
                                    <td>${product.order_qty}</td>
                                    <td>${totalPrice}</td> 
                                `;

                                // Append the new row to the table body
                                productTableBody.appendChild(newRow);

                                total += totalPrice; // บวกราคารวมของสินค้าแต่ละรายการ
                            } else {
                                console.log('Undefined product details:', product);
                            }
                        });
                        let totalCeil = Math.ceil(total); // ปัดเศษของผลรวมทั้งหมด

                        // Display total price
                        let totalRow = document.createElement("tr");
                        totalRow.innerHTML = `
                            <td colspan="2" class="text-end">รวมทั้งหมด</td>
                            <td>${totalCeil}</td>
                        `;
                        productTableBody.appendChild(totalRow);

                    // Show the modal
                    $('#product_detail_modal').modal('show');
                } else {
                    console.error('Error:', data.error_message);
                }
            })
    }

    function submitTask() {
        var urlParams = new URLSearchParams(window.location.search);
        var cus_id = urlParams.get('cus_id');
        var productsAndQuantities = [];
        document.querySelectorAll('#product_list tr').forEach(row => {
            var productId = row.cells[0].id; // Get product ID from the first cell
            var quantityInput = row.cells[1].querySelector('input[type="number"]'); // Get quantity from the second cell
            var quantity = quantityInput.value;
            var productType = row.cells[2].querySelector('select').value; // Get product type from the select element

            if (quantity && parseInt(quantity) !== 0) {
                productsAndQuantities.push({
                    id: productId,
                    quantity: quantity,
                    type: productType
                });
            }
        });

        // Extract product IDs, quantities, and types
        var findProduct = productsAndQuantities.map(item => item.id);
        var findQty = productsAndQuantities.map(item => item.quantity);
        var findType = productsAndQuantities.map(item => item.type);

        // Make AJAX request to submit task data
        fetch('../api/product?case=TaskProduct', {
                method: 'POST',
                body: JSON.stringify({
                    case: 'TaskProduct',
                    cus_id: cus_id, // Assuming get_cus_id is already defined
                    Taskdatetime: $('#datetime').val(), // Get task datetime from the datetime input
                    product: findProduct,
                    order_qty: findQty,
                    product_type: findType,
                    pay_status: $('#pay_status').val(),
                    pay_type: $('#pay_type').val(),
                    pay_total: $('#pay_total').val()
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(function(json) {
                if (json[0].status == '0') {
                    alert_snackbar('error', json[0].error_message);
                } else {
                    alert_snackbar('success', "เพิ่มนัดหมายสำเร็จ");
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
    }


    function tasklist_success() {
        var timestamp = Date.now();
        var localDateTime = new Date(timestamp);
        localDateTime.setHours(localDateTime.getHours() + 7);
        var datetimeNow = localDateTime.toISOString(); // Format: YYYY-MM-DDTHH:MM:SSZ
        var rowData = task_list.row($(this).parents('tr')).data();
        rowData.task_datetime = datetimeNow;


        fetch('../api/product?case=task_success', {
                method: 'POST',
                body: JSON.stringify({
                    case: 'task_success',
                    taskID: rowData.task_id,
                    last_datetime: datetimeNow
                }),
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(json) {
                if (json[0].status == '0') {
                    alert_snackbar('error', json[0].error_message);
                } else {
                    alert_snackbar('success', "จัดส่งสำเร็จ");
                    setTimeout(function() {
                        window.location.href = "delivery_t.php";
                    }, 1500);
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
    }

    function product_l() {
        fetch('../api/product?case=product_task_show', {
                method: 'POST',
                body: JSON.stringify({
                    case: 'product_task_show'
                }),
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(products => {
                const product_list_Div = document.getElementById('product_list');

                const filteredProducts = products.filter(item => !('status' in item));
                if (filteredProducts.length > 0) {
                    filteredProducts.forEach(product => {
                        var newRow = document.createElement("tr");
                        newRow.innerHTML = `
                        <td id="${product.product_id}">
                        <img src="../assets/img/product/${product.product_img}" alt="user-avatar" class="d-block rounded" height="70px" width="70px">${product.product_name}
                        </td>
                        <td>
                            <input type="number" class="form-control" name="quantity${product.product_id}" id="quantity${product.product_id}" value="0">
                        </td>
                        <td>
                        <select id="product_type" class="form-select form-control-sm color-dropdown">
                            <option value="pack">Pack (แพ็ค)</option>
                            <option value="unit">Unit (ชิ้น)</option>
                        </select>
                        </td>
                                    `;

                        product_list_Div.appendChild(newRow);
                    });
                } else {
                    product_list_Div.innerHTML = '<p>No products available.</p>';
                }
            })
    }

    function getTableRowData(btnElement, tableId) {
        var table = $('#' + tableId).DataTable();
        var data = table.row(btnElement.parents('tr')).data();
        return data;
    }
</script>