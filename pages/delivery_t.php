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
                        <div class="mt-3 col-md-2 ">
                            <label class="form-label" for="cus_name">ชื่อลูกค้า </label>
                            <h3><span id="cus_name" name="cus_name"></span></h3>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="task_datetime">วันเวลาจัดส่ง </label>
                            <input type="datetime-local" class="form-control" id="datetime" name="task_datetime">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Type</th>
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
                                        <th>สินค้าที่ต้องจัดส่ง</th>
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
                                    defaultContent: '<button class="btn btn-primary btn-sm btn-edit">นัดหมาย</button>'
                                }
                            ]
                        });
                        // console.log(table);
                        // var taskDataTable;

                        $('#backButton').on('click', function() {
                            location.reload();
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
    });

    function task_button() {
        // var rowData = getTableRowData($(this));
        // var cus_id = rowData.cus_id;
        var cus_id = $(this).closest('tr').find('td:eq(0)').text().trim();
        var cus_name = $(this).closest('tr').find('td:eq(1)').text().trim();
        get_cus_id = cus_id;
        $('#DataTable').hide();
        $('#taskuserlist').show();
        $('#tasklist').show();

        $('#cus_id').text(cus_id);
        // $('#cus_id').val(cus_id);
        $('#cus_name').text(cus_name);

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
                                    data: 'product_ids'
                                },
                                {
                                    data: 'order_qty'
                                },
                                {
                                    data: 'last_datetime'
                                },
                                {
                                    data: null,
                                    defaultContent: '<button class="btn btn-primary btn-sm btn-success">จัดส่งสำเร็จ</button>'
                                }
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
    };

    function submitTask() {
        
        var productsAndQuantities = [];
        document.querySelectorAll('#product_list tr').forEach(row => {
            var productId = row.cells[0].id; // ดึงข้อมูลจากเซลล์แรก
            var quantityInput = row.cells[1].querySelector('input[type="number"]'); // ดึงข้อมูลจากเซลล์ที่สอง
            var quantity = quantityInput.value;

            if (quantity && parseInt(quantity) !== 0) {
                productsAndQuantities.push({
                    id: productId,
                    quantity: quantity
                });
            }
        });

        console.log(productsAndQuantities);

        // แยกข้อมูลสินค้าและจำนวนสินค้า
        var findProduct = productsAndQuantities.map(item => item.id);
        var findQty = productsAndQuantities.map(item => item.quantity);
        console.log(get_cus_id);

        fetch('../api/product?case=TaskProduct', {
                method: 'POST',
                body: JSON.stringify({
                    case: 'TaskProduct',
                    cus_id: get_cus_id,
                    Taskdatetime: $('#datetime').val(),
                    find_product: findProduct,
                    order_qty: findQty
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
                        window.location.href = "delivery_t.php";
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
                return response.json();

            })
            .then(products => {
                const product_list_Div = document.getElementById('product_list');

                const filteredProducts = products.filter(item => !('status' in item));
                if (filteredProducts.length > 0) {
                    filteredProducts.forEach(product => {
                        var newRow = document.createElement("tr");
                        newRow.innerHTML = `
                                        <td id="${product.product_id}">${product.product_name}</td>
                                        <td><input type="number" class="form-control" name="quantity${product.product_id}" id="quantity${product.product_id}" value="0"></td>
                                    `;

                        product_list_Div.appendChild(newRow);
                    });
                } else {
                    product_list_Div.innerHTML = '<p>No products available.</p>';
                }
            })
    }

    $(document).ready(function() {
        product_l();

        $('#customerData').on('click', '.btn-edit', task_button);
        $('#submit_Task').on('click', submitTask);
        $('#taskData').on('click', '.btn-success', tasklist_success);

    });

    function getTableRowData(btnElement) {
        var table = $('#customerData').DataTable(); // กำหนด table ภายในฟังก์ชัน
        var data = table.row(btnElement.parents('tr')).data();
        return data;
    }
</script>