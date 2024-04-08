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

    #product_detail_modal .card.mb-4 {
        display: none;
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
                            <input type="datetime-local" class="form-control" id="task_datetime" name="task_datetime">
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
                            <input id="task_id_update" type="hidden"> </input>
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
                            <label class="form-label" for="pay_total_update" id="pay_total_update_label">จำนวนเงินที่ได้รับ </label>
                            <input type="number" class="form-control" id="pay_total_update" name="pay_total" placeholder="ระบุจำนวนเงิน">
                            <div class="row">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>สินค้า</th>
                                            <th>จำนวน</th>
                                            <th>ประเภท</th>
                                        </tr>
                                    </thead>
                                    <tbody id="product_list_update">

                                    </tbody>
                                </table>
                            </div>
                            <button type="button" id="update_Task" class="btn btn-primary">บันทึก</button>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header">
                        <h5>เพิ่มสินค้า
                        </h5>
                        <div class="row gx-3 gy-2 align-items-center">
                            <div class="row">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>สินค้า</th>
                                            <th>จำนวน</th>
                                            <th>ประเภท</th>
                                        </tr>
                                    </thead>
                                    <tbody id="product_list_add">

                                    </tbody>
                                </table>
                            </div>
                            <button type="button" id="add_Task" class="btn btn-primary">บันทึก</button>
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
                <button type="button" class="btn btn-primary fig_task" id="toggleCardBtn" data-dismiss="modal">แก้ไขข้อมูล</button>
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

        $('#taskData').on('click', '.btn-info', btn_info);

        $('#product_detail_modal').on('click', '[aria-hidden="true"]', function() {
            $('#product_detail_modal').modal('hide');
        });

        $('#update_Task').on('click', update_task);

        $('#product_detail_modal').on('shown.bs.modal', function() {
            $('#update_Task').off('click').on('click', update_task);
            $('#add_Task').off('click').on('click', submitmoreproduct);
        });

        $('#product_detail_modal').on('click', '.fig_task', function() {
            $('.card.mb-4', $(this).closest('.modal-content')).toggle();
        });

        document.querySelector('#product_detail_modal').addEventListener('hidden.bs.modal', function(event) {
            var modalContent = event.target.querySelector('.modal-content');
            var card = modalContent.querySelector('.card.mb-4');
            card.style.display = 'none';
        });
        $('#taskData').on('click', '.btn-info',  addMoreProduct);

        $('#add_Task').on('click', submitmoreproduct);



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
                document.getElementById('task_id_update').value = json[1].task_id;
                document.getElementById('datetime_update').value = json[1].task_datetime;
                document.getElementById('pay_status_update').value = json[1].pay_status;
                document.getElementById('pay_type_update').value = json[1].pay_type;
                document.getElementById('pay_total_update').value = json[1].pay_total;

                if (json[0] && json[0].status == '1') {
                    const productTableBody = document.getElementById('productTableBody');
                    const product_list_Div_update = document.getElementById('product_list_update');
                    let total = 0;

                    // Clear existing table body and product list
                    productTableBody.innerHTML = '';
                    product_list_Div_update.innerHTML = '';

                    json.slice(1).forEach(product => {
                        if (product.product_id !== undefined && product.order_qty !== undefined && product.product_type !== undefined && product.price !== undefined) {
                            const totalPrice = product.price * product.order_qty;

                            // Create a new row for each product
                            let newRow = document.createElement("tr");
                            newRow.innerHTML = `
                        <td>${product.product_name}</td>
                        <td>${product.order_qty}</td>
                        <td>${totalPrice}</td> 
                    `;
                            productTableBody.appendChild(newRow);

                            // Create a new row for the product list update
                            let newRowUpdate = document.createElement("tr");
                            newRowUpdate.innerHTML = `
                        <td id="${product.product_id}">
                           ${product.product_name}
                        </td>
                        <td>
                            <input type="number" class="form-control" name="quantity${product.product_id}" id="${product.product_id}_update" value="${product.order_qty}">
                        </td>
                        <td>
                            <select class="form-select form-control-sm color-dropdown product_type_update">
                                <option value="pack" ${product.product_type === 'pack' ? 'selected' : ''}>Pack (แพ็ค)</option>
                                <option value="unit" ${product.product_type === 'unit' ? 'selected' : ''}>Unit (ชิ้น)</option>
                            </select>
                        </td>
                    `;
                            product_list_Div_update.appendChild(newRowUpdate);

                            // Set the product type for the current row
                            newRowUpdate.querySelector('.product_type_update').value = product.product_type;

                            total += totalPrice;
                        } else {
                            console.log('Undefined product details:', product);
                        }
                    });

                    let totalCeil = Math.ceil(total);
                    let totalRow = document.createElement("tr");
                    totalRow.innerHTML = `
                <td colspan="2" class="text-end">รวมทั้งหมด</td>
                <td>${totalCeil}</td>
            `;
                    productTableBody.appendChild(totalRow);

                    $('#product_detail_modal').modal('show');
                } else {
                    console.error('Error:', json.error_message);
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
    }



    function update_task() {
        var productsAndQuantities = [];
        document.querySelectorAll('#product_list_update tr').forEach(row => {
            var productId = row.cells[0].id; // Get product ID from the first cell
            var quantityInput = row.cells[1].querySelector('input[type="number"]'); // Get quantity from the second cell
            var quantity = quantityInput.value;
            var productType = row.cells[2].querySelector('select').value; // Get product type from the select element
            // var productTypePrice = row.cells[2].querySelector('select').selectedOptions[0].getAttribute('data-price');
            if (quantity && parseInt(quantity) !== 0) {
                productsAndQuantities.push({
                    id: productId,
                    quantity: quantity,
                    type: productType,
                });
            }
        });

        var findProduct = productsAndQuantities.map(item => item.id);
        var findQty = productsAndQuantities.map(item => item.quantity);
        var findType = productsAndQuantities.map(item => item.type);

        fetch('../api/product?case=update_task', {
                method: 'POST',
                body: JSON.stringify({
                    case: 'update_task',
                    task_id: $('#task_id_update').val(),
                    pay_status: $('#pay_status_update').val(),
                    pay_type: $('#pay_type_update').val(),
                    pay_total: $('#pay_total_update').val(),
                    task_datetime: $('#datetime_update').val(),
                    product_id: findProduct,
                    order_qty: findQty,
                    product_type: findType
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                } else {
                    return response.json();
                }
            })
            .then(function(json) {
                if (json[0].status == '0') {
                    alert_snackbar('error', json[0].error_message);
                } else {
                    alert_snackbar('success', "อัพเดทสำเร็จ");
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
    }

    function addMoreProduct() {
    var rowData = getTableRowData($(this), 'taskData');
    var task_id = rowData.task_id;

    // Fetch product data based on task_id
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
        .then(products1 => {
            // Fetch product details based on task_id
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
                .then(products2 => {
                    const product_list_Div_add = document.getElementById('product_list_add');
                    const productNames1 = products1.map(product => product.product_name);
                    const productNames2 = products2.map(product => product.product_name);
                    const commonProductNames = productNames1.filter(name => productNames2.includes(name));

                    // Remove existing product rows
                    product_list_Div_add.innerHTML = '';

                    products1.forEach(product => {
                        if (!commonProductNames.includes(product.product_name)) {
                            var newRow = document.createElement("tr");
                            newRow.innerHTML = `
                                <td id="${product.product_id}">
                                    ${product.product_name}
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="quantity${product.product_id}" id="${product.product_id}_update" value="0">
                                </td>
                                <td>
                                    <select id="product_type_update" class="form-select form-control-sm color-dropdown">
                                        <option selected>--เลือกประเภทการจ่าย--</option>
                                        <option value="pack" data-price="${product.pack_price}">Pack (แพ็ค)</option>
                                        <option value="unit" data-price="${product.unit_price}">Unit (ชิ้น)</option>
                                    </select>
                                </td>
                            `;
                            product_list_Div_add.appendChild(newRow);
                        }
                    });

                    products2.forEach(product => {
                        if (!commonProductNames.includes(product.product_name)) {
                            var newRow = document.createElement("tr");
                            newRow.innerHTML = `
                                <td id="${product.product_id}">
                                    ${product.product_name}
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="quantity${product.product_id}" id="${product.product_id}_update" value="${product.order_qty}">
                                </td>
                                <td>
                                    <select id="product_type_update" class="form-select form-control-sm color-dropdown">
                                        <option selected>--เลือกประเภทการจ่าย--</option>
                                        <option value="pack" data-price="${product.pack_price}">Pack (แพ็ค)</option>
                                        <option value="unit" data-price="${product.unit_price}">Unit (ชิ้น)</option>
                                    </select>
                                </td>
                            `;
                            product_list_Div_add.appendChild(newRow);
                        }
                    });
                })
                .catch(function(error) {
                    console.error('Error fetching product details:', error);
                });
        })
        .catch(function(error) {
            console.error('Error fetching products:', error);
        });
}

function submitmoreproduct() {
    var productsAndQuantities = [];
        document.querySelectorAll('#product_list_add tr').forEach(row => {
            var productId = row.cells[0].id; // Get product ID from the first cell
            var quantityInput = row.cells[1].querySelector('input[type="number"]'); // Get quantity from the second cell
            var quantity = quantityInput.value;
            var productType = row.cells[2].querySelector('select').value; // Get product type from the select element
            // var productTypePrice = row.cells[2].querySelector('select').selectedOptions[0].getAttribute('data-price');
            if (quantity && parseInt(quantity) !== 0) {
                productsAndQuantities.push({
                    id: productId,
                    quantity: quantity,
                    type: productType,
                });
            }
        });

        var findProduct = productsAndQuantities.map(item => item.id);
        var findQty = productsAndQuantities.map(item => item.quantity);
        var findType = productsAndQuantities.map(item => item.type);
        console.log(findProduct, findQty, findType);

        fetch('../api/product?case=more_product', {
                method: 'POST',
                body: JSON.stringify({
                    case: 'more_product',
                    task_id: $('#task_id_update').val(),
                    product_id: findProduct,
                    order_qty: findQty,
                    product_type: findType

                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                } else {
                    return response.json();
                }
            })
            .then(function(json) {
                if (json[0].status == '0') {
                    alert_snackbar('error', json[0].error_message);
                } else {
                    alert_snackbar('success', "อัพเดทสำเร็จ");
                    setTimeout(function() {
                        // location.reload();
                    }, 1500);
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
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
            var productTypePrice = row.cells[2].querySelector('select').selectedOptions[0].getAttribute('data-price');
            if (quantity && parseInt(quantity) !== 0) {
                productsAndQuantities.push({
                    id: productId,
                    quantity: quantity,
                    type: productType,
                    price: productTypePrice
                });
            }
        });

        var findProduct = productsAndQuantities.map(item => item.id);
        var findQty = productsAndQuantities.map(item => item.quantity);
        var findType = productsAndQuantities.map(item => item.type);
        var findPrice = productsAndQuantities.map(item => item.price);

        var totalPrice = 0;

        productsAndQuantities.forEach(item => {
            var productPrice = parseFloat(item.price);
            var productQuantity = parseInt(item.quantity);


            var totalPricePerProduct = productPrice * productQuantity;


            totalPrice += totalPricePerProduct;
        });

        var taskData = {
            totalPrice: totalPrice,
        };

        // ทำการ fetch เพื่อส่งข้อมูลไปยัง API
        fetch('../api/product?case=TaskProduct', {
                method: 'POST',
                body: JSON.stringify({
                    case: 'TaskProduct',
                    cus_id: cus_id,
                    Taskdatetime: $('#task_datetime').val(),
                    product: findProduct,
                    order_qty: findQty,
                    product_type: findType,
                    // price: findPrice,
                    pay_status: $('#pay_status').val(),
                    pay_type: $('#pay_type').val(),
                    pay_total: $('#pay_total').val(),
                    totalPrice: totalPrice // เพิ่มราคารวมของสินค้าในข้อมูลที่ส่งไปยัง API
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
                        // location.reload();
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
                        location.reload();
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
                // const product_list_Div_add = document.getElementById('product_list_add');

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
                    <option value="pack" data-price="${product.pack_price}">Pack (แพ็ค)</option>
                    <option value="unit" data-price="${product.unit_price}">Unit (ชิ้น)</option>
                </select>
            </td>
        `;
                        product_list_Div.appendChild(newRow);
                    });
                }

        //         if (filteredProducts.length > 0) {
        //             filteredProducts.forEach(product => {
        //                 var newRow = document.createElement("tr");
        //                 newRow.innerHTML = `
        //     <td id="${product.product_id}">
        //         <img src="../assets/img/product/${product.product_img}" alt="user-avatar" class="d-block rounded" height="70px" width="70px">${product.product_name}
        //     </td>
        //     <td>
        //         <input type="number" class="form-control" name="quantity${product.product_id}" id="${product.product_id}_update" value="0">
        //     </td>
        //     <td>
        //         <select id="product_type_update" class="form-select form-control-sm color-dropdown">
        //         <option selected>--เลือกประเภทการจ่าย--</option>
        //             <option value="pack" data-price="${product.pack_price}">Pack (แพ็ค)</option>
        //             <option value="unit" data-price="${product.unit_price}">Unit (ชิ้น)</option>
        //         </select>
        //     </td>
        // `;
        //                 product_list_Div_add.appendChild(newRow);
        //             });
        //         }

            })
            .catch(function(error) {
                console.error('Error:', error);
            })
    }



    function getTableRowData(btnElement, tableId) {
        var table = $('#' + tableId).DataTable();
        var data = table.row(btnElement.parents('tr')).data();
        return data;
    }
</script>