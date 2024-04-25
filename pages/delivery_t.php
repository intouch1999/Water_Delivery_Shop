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

    #product_detail_modal table {
        font-size: 14px;
    }

    #product_detail_modal table td {
        overflow: hidden;
        white-space: wrap;
    }

    @media (max-width: 576px) {
        #product_detail_modal .modal-dialog {
            max-width: 100%;
        }

        #product_detail_modal .modal-content {
            overflow-x: auto;
        }
    }

    #product_detail_modal .card.mb-4 {
        display: none;
    }

    #product_detail_modal .card.mb-2 {
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
                        <button type="button" id="submit_Task" class="btn btn-primary" onclick="task_check();">บันทึก</button>
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
                            <label id="pay_type_label" class="form-label" for="pay_type">รูปแบบการจ่าย </label>
                            <select id="pay_type" class="form-select form-control-sm color-dropdown">
                                <option selected>--เลือกรูปแบบการจ่าย--</option>
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
                                <!-- <th>ประเภท</th> -->
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
                                        <th>จัดส่งสำเร็จ</th>
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
<div class="modal top fade" id="product_detail_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
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
                            <div class="col-md">
                                <label class="form-label" for="pay_status_update">สถานะการจ่าย </label>
                                <select id="pay_status_update" class="form-select form-control-sm color-dropdown">
                                    <option selected>--เลือกสถานะการจ่าย--</option>
                                    <option value="0">ยังไม่จ่าย</option>
                                    <option value="1">จ่ายแล้ว</option>
                                </select>
                            </div>
                            <div class="col-md">
                                <label id="pay_type_update_label" class="form-label" for="pay_type_update">รูปแบบการจ่าย </label>
                                <select id="pay_type_update" class="form-select form-control-sm color-dropdown">
                                    <option selected>--เลือกรูปแบบการจ่าย--</option>
                                    <option value="0">เงินสด</option>
                                    <option value="1">เงินโอน</option>
                                    <option value="2">บัตรเครดิต</option>
                                </select>
                            </div>
                            <label class="form-label" for="pay_total_update" id="pay_total_update_label">จำนวนเงินที่ได้รับ </label>
                            <input type="number" class="form-control" id="pay_total_update" name="pay_total" placeholder="ระบุจำนวนเงิน">
                            <h5>รายการที่สั่ง
                            </h5>
                            <div id="product_list_update">

                            </div>
                            <button type="button" id="update_Task" class="btn btn-primary" onclick="update_check()">บันทึก</button>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header">
                        <h5>เพิ่มสินค้า
                        </h5>
                        <div id="product_list_add">

                        </div>
                        <div class="row gx-3 gy-2 align-items-center">
                            <button type="button" id="add_Task" class="btn btn-primary" onclick="add_check()">บันทึก</button>
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
                <button type="button" class="btn btn-primary add_task" id="toggleCardadd" data-dismiss="modal">เพิ่มสินค้า</button>
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

        // $('#submit_Task').on('click', submitTask);

        // $('#taskData').on('click', '.btn-success', tasklist_success);


        $('#product_detail_modal').on('click', '[aria-hidden="true"]', function() {
            $('#product_detail_modal').modal('hide');
        });

        // $('#update_Task').on('click', update_task);

        $('#product_detail_modal').on('shown.bs.modal', function() {
            // $('#update_Task').off('click').on('click', update_task);
            // $('#add_Task').off('click').on('click', submitmoreproduct);
        });

        $('#product_detail_modal').on('click', '.fig_task', function() {
            $('.card.mb-4', $(this).closest('.modal-content')).toggle();
        });
        $('#product_detail_modal').on('click', '.add_task', function() {
            $('.card.mb-2', $(this).closest('.modal-content')).toggle();
        })

        document.querySelector('#product_detail_modal').addEventListener('hidden.bs.modal', function(event) {
            var modalContent = event.target.querySelector('.modal-content');
            var card_mb_2 = modalContent.querySelector('.card.mb-2');
            if (card_mb_2) {
                card_mb_2.style.display = 'none';
            }
            var card_mb_4 = modalContent.querySelector('.card.mb-4');
            if (card_mb_4) {
                card_mb_4.style.display = 'none';
            }
        });

        $('#taskData').on('click', '.btn-info', update_show);
        // $('#taskData').on('click', '.btn-info', addMoreProduct);

        // $('#add_Task').on('click', submitmoreproduct);

        // $('#taskData').on('click', '.btn-info', function() {
        //     var rowData = getTableRowData($(this), 'taskData');
        //     var task_id = rowData.task_id;
        //     console.log(task_id);

        //     fetchProductDetails(task_id)
        //         .then(productDetails => {
        //             btn_info(productDetails);
        //         })
        //         .catch(error => {
        //             console.error('Error fetching product details:', error);
        //         });
        // });


    });

    function task_check() {

        if ($("#task_datetime").val().length == "") {
            alert_snackbar("warning", "กรุณาระบุวันที่");
            setTimeout(function() {
                $("#task_datetime" + i).focus();
            }, 300);
            return false;
        }
        if ($("#pay_status").val().length > 1) {
            alert_snackbar("warning", "กรุณาระบุสถานะการจ่าย");
            setTimeout(function() {
                $("#pay_status").focus();
            }, 300);
            return false;
        }
        if ($("#pay_status").val() === "1" && $("#pay_type").val().length > 1) {
            alert_snackbar("warning", "กรุณาระบุรูปแบบการจ่าย");
            setTimeout(function() {
                $("#pay_total").focus();
            }, 300);
            return false;
        }
        if ($("#pay_status").val() === "1" && $("#pay_total").val().length == "") {
            alert_snackbar("warning", "กรุณาระบุจำนวนเงินที่จ่าย");
            setTimeout(function() {
                $("#pay_total").focus();
            }, 300);
            return false;
        }

        let foundOne = false;
        const quantityInputs = document.querySelectorAll('#product_list input[type="number"]');

        quantityInputs.forEach(input => {
            if (parseInt(input.value) > 0) {
                foundOne = true;
            }
        });

        if (!foundOne) {
            alert_snackbar("warning", "กรุณาระบุจำนวนสินค้าอย่างน้อย 1 รายการ");
            return false;
        }


        $("#modal_confirm_text").html("ยืนยันการนัดหมาย")
        $("#modal_confirm_submit").attr("onclick", "confirm_task();");
        $("#modal_confirm").modal("show");
    }

    function update_check() {

        let foundOne = false;
        const quantityInputs = document.querySelectorAll('#product_list_update input[type="number"]');
        const productTypes = document.querySelectorAll('#product_list_update select');
        console.log(quantityInputs, productTypes);

        quantityInputs.forEach(input => {
            if (parseInt(input.value) > 0) {
                foundOne = true;
            }
        });

        if (!foundOne) {
            alert_snackbar("warning", "กรุณาระบุจำนวนสินค้าอย่างน้อย 1 รายการ");
            return false;
        }

        $("#modal_confirm_text").html("ยืนยันการแก้ไข")
        $("#modal_confirm_submit").attr("onclick", "update_task();");
        $("#modal_confirm").modal("show");
    }

    function add_check() {

        let foundOne = false;
        const quantityInputs = document.querySelectorAll('#product_list_add input[type="number"]');
        const productTypes = document.querySelectorAll('#product_list_add select');
        console.log(quantityInputs, productTypes);

        quantityInputs.forEach(input => {
            if (parseInt(input.value) > 0) {
                foundOne = true;
            }
        });

        if (!foundOne) {
            alert_snackbar("warning", "กรุณาระบุจำนวนสินค้าอย่างน้อย 1 รายการ");
            return false;
        }

        $("#modal_confirm_text").html("ยืนยันการแก้ไข")
        $("#modal_confirm_submit").attr("onclick", "submitmoreproduct();");
        $("#modal_confirm").modal("show");
    }

    function confirm_check() {
        $('#taskData').on('click', '.btn-success', function() {
            var rowData = getTableRowData($(this), 'taskData');
            var task_id = rowData.task_id;

            $("#modal_confirm_text").html("ยืนยันการจัดส่ง");
            $("#modal_confirm_submit").on("click", function() {
                tasklist_success(task_id);
            });

            $("#modal_confirm").modal("show");
        });
    }

    function cancel_check() {
        $('#taskData').on('click', '.btn-danger', function() {
            var rowData = getTableRowData($(this), 'taskData');
            var task_id = rowData.task_id;

            $("#modal_confirm_text").html("ยืนยันการยกเลิก");
            $("#modal_confirm_submit").on("click", function() {
                tasklist_cancel(task_id);
            });

            $("#modal_confirm").modal("show");
        })
    }


    function confirm_task() {
        var urlParams = new URLSearchParams(window.location.search);
        var cus_id = urlParams.get('cus_id');
        var productsAndQuantities = [];
        document.querySelectorAll('#product_list tr').forEach(row => {
            var productId = row.cells[0].id; 
            var quantityInput = row.cells[1].querySelector('input[type="number"]');
            var quantity = quantityInput.value;
            var productPrice = row.cells[0].querySelector('img').getAttribute('data-price');
            if (quantity && parseInt(quantity) !== 0) {
                productsAndQuantities.push({
                    id: productId,
                    quantity: quantity,
                    price: productPrice
                });
            }
        });

        var findProduct = productsAndQuantities.map(item => item.id);
        var findQty = productsAndQuantities.map(item => item.quantity);
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
                $("#modal_confirm").modal("hide");
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

    function update_task() {
        var productsAndQuantities = [];
        document.querySelectorAll('#product_list_update .product_update').forEach(product => {
            var productId = product.querySelector(".product_id_update").value;
            var quantity = product.querySelector('.product_qty_update').value;
            if (quantity !== "" && parseInt(quantity) >= 0) {
    productsAndQuantities.push({
        id: productId,
        quantity: quantity,
    });
}

        });

        var findProduct = productsAndQuantities.map(item => item.id);
        var findQty = productsAndQuantities.map(item => item.quantity);

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
                    order_true: findQty,
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
                $("#modal_confirm").modal("hide");
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

    function submitmoreproduct() {
        var productsAndQuantities = [];
        document.querySelectorAll('#product_list_add .product_add').forEach(product => {
            var productId = product.querySelector(".product_id_add").value;
            var quantity = product.querySelector('.product_qty_add').value;
            if (quantity && parseInt(quantity) !== 0) {
                productsAndQuantities.push({
                    id: productId,
                    quantity: quantity,
                });
            }
        });

        var findProduct = productsAndQuantities.map(item => item.id);
        var findQty = productsAndQuantities.map(item => item.quantity);

        fetch('../api/product?case=more_product', {
                method: 'POST',
                body: JSON.stringify({
                    case: 'more_product',
                    task_id: $('#task_id_update').val(),
                    product_id: findProduct,
                    order_true: findQty,
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
                $("#modal_confirm").modal("hide");
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

    function task_button() {
        var rowData = getTableRowData($(this), 'customerData');
        var cus_id = rowData.cus_id;
        var cus_name = rowData.cus_name;
        // get_cus_id = cus_id;
        window.location.href = "delivery_t.php?tasklist&cus_id=" + encodeURIComponent(cus_id) + "&cus_name=" + encodeURIComponent(cus_name);
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
                                        data: 'task_datetime',
                                        render: function(data, type, row) {
                                            // Format the date and time
                                            var date = new Date(data);
                                            var formattedDateTime = date.toLocaleTimeString('en-GB', {
                                                hour: '2-digit',
                                                minute: '2-digit'
                                            }) + ' ' + date.toLocaleDateString('en-GB', {
                                                day: '2-digit',
                                                month: '2-digit',
                                                year: 'numeric'
                                            });
                                            return formattedDateTime;
                                        }
                                    },
                                    // {
                                    //     data: 'order_qty'
                                    // },
                                    {
                                        data: 'last_datetime',
                                        render: function(data) {
                                        // Check if the date is valid
                                        if (data !== '0000-00-00 00:00:00') {
                                            // Split date and time
                                            var parts = data.split(' ');
                                            var datePart = parts[0];
                                            var timePart = parts[1];

                                            // Split date into year, month, and day
                                            var dateParts = datePart.split('-');
                                            var year = dateParts[0];
                                            var month = dateParts[1];
                                            var day = dateParts[2];

                                            // Split time into hours and minutes
                                            var timeParts = timePart.split(':');
                                            var hours = timeParts[0];
                                            var minutes = timeParts[1];

                                            // Format the date and time
                                            var formattedDateTime = hours + ':' + minutes + ' ' + day + '/' + month + '/' + year;
                                            
                                            return formattedDateTime;
                                        } else {
                                            // Return '0000-00-00 00:00:00' for invalid date
                                            return 'ยังไม่ได้จัดส่ง';
                                        }
                                    }
                                    },
                                    {
                                        data: null,
                                        defaultContent: `<button class="btn btn-primary btn-sm btn-success" onclick="confirm_check()">จัดส่งสำเร็จ</button>
                                                        <button class="btn btn-primary btn-sm btn-danger" onclick="cancel_check()">ยกเลิก</button>
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

    // Function to fetch product data based on task_id
    function fetchProductTaskShow(task_id) {
        return fetch('../api/product?case=product_task_show', {
                method: 'POST',
                body: JSON.stringify({
                    case: 'product_task_show'
                }),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            });
    }

    // Function to fetch product details based on task_id
    function fetchProductDetails(task_id) {
        return fetch('../api/product?case=product_details', {
                method: 'POST',
                body: JSON.stringify({
                    case: 'product_details',
                    task_id: task_id,
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            });
    }

//     async function addMoreProduct() {
//     try {
//         const rowData = getTableRowData($(this), 'taskData');
//         const task_id = rowData.task_id;

//         const [products1, products2] = await Promise.all([fetchProductTaskShow(task_id), fetchProductDetails(task_id)]);

//         const product_list_Div_add = document.getElementById('product_list_add');
//         const productNames1 = products1.filter(product => product.product_name !== undefined).map(product => product.product_name);
//         const productNames2 = products2.filter(product => product.product_name !== undefined).map(product => product.product_name);

//         const commonProductNames = productNames1.filter(name => productNames2.includes(name));
//         console.log(productNames1);
//         console.log("productNames2" + productNames2);
//         // Remove existing product rows
//         product_list_Div_add.innerHTML = '';

//         [...products1, ...products2].forEach(product => {
//             if (!commonProductNames.includes(product.product_name)) {
//                 var newRow = createProductRow(product);
//                 product_list_Div_add.appendChild(newRow);
//             }
//         });

//     } catch (error) {
//         console.error('Error adding more product:', error);
//     }
// }

async function addMoreProduct(rowData) {
    try {
        // const rowData = getTableRowData($(this), 'taskData');
        const task_id = rowData.task_id;

        const [products1, products2] = await Promise.all([fetchProductTaskShow(task_id), fetchProductDetails(task_id)]);

        const product_list_Div_add = document.getElementById('product_list_add');

        const unaddedProducts = [];

        products1.forEach(product1 => {
            if (product1.product_active === 1) {
                let isAdded = false;
                products2.forEach(product2 => {
                    if (product1.product_id === product2.product_id) {
                        isAdded = true;
                    }
                });
                if (!isAdded) {
                    unaddedProducts.push(product1);
                }
            }
        });

        products2.forEach(product2 => {
            if (product2.product_active === 1) {
                let isAdded = false;
                products1.forEach(product1 => {
                    if (product2.product_id === product1.product_id) {
                        isAdded = true;
                    }
                });
                if (!isAdded) {
                    unaddedProducts.push(product2);
                }
            }
        });

        product_list_Div_add.innerHTML = '';

        unaddedProducts.forEach(product => {
            var newRow = createProductRow(product);
            product_list_Div_add.appendChild(newRow);
        });

    } catch (error) {
        console.error('Error adding more product:', error);
    }
}

    function createProductRow(product) {
        var newRow = document.createElement("div");
        newRow.classList.add("row", "justify-content-end" , "product_add"); 
        newRow.innerHTML = `
                        <input id="product_id_add" type="hidden" class="product_id_add" value="${product.product_id}">
                                        <div class="col-md-9">
                                        <label for="product_name_add" class="form-label"></label>
                                            <p>${product.product_name}</p>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                        <label for="product_qty_adde" class="form-label">จํานวน</label>
                                        <input type="number" class="form-control product_qty_add" name="quantity${product.product_id}" id="product_qty_add" value="${product.QTY || 0}">
                                        </div>

                        `;
        return newRow;
    }

    function update_show() {
        var rowData = getTableRowData($(this), 'taskData');
        console.log(rowData);
        var task_id = rowData.task_id;

        fetchProductDetails(task_id)
            .then(json => {

                if (json[0] && json[0].status == '1') {
                    const productTableBody = document.getElementById('productTableBody');
                    const product_list_Div_update = document.getElementById("product_list_update");
                    let total = 0;

                    // Clear existing table body and product list
                    productTableBody.innerHTML = '';
                    product_list_Div_update.innerHTML = '';

                    json.slice(1).forEach(product => {

                        document.getElementById('task_id_update').value = task_id;                                
                        document.getElementById('datetime_update').value = product.task_datetime;
                        document.getElementById('pay_status_update').value = product.pay_status;
                        document.getElementById('pay_type_update').value = product.pay_type;
                        document.getElementById('pay_total_update').value = product.pay_total;
                        if (product.product_id !== undefined && product.QTY !== undefined) {
                            const totalPrice = product.pack_price * product.QTY;

                            // Create a new row for each product
                            let resule = document.createElement("tr");
                            resule.innerHTML = `
                            <td>${product.product_name}</td>
                            <td>${product.QTY}</td>
                            <td>${totalPrice.toFixed(2)}</td> 
                            `;
                            productTableBody.appendChild(resule);

                            let update = document.createElement("div");
                            update.classList.add("row", "justify-content-end" , "product_update"); // Add classes for Bootstrap styling
                            update.innerHTML = `
                                        <input id="product_id_update" class="product_id_update" type="hidden" value="${product.product_id}">
                                        <div class="col-md-9">
                                        <label for="product_name_update" class="form-label"></label>
                                            <p>${product.product_name}</p>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                        <label for="product_qty_update" class="form-label">จํานวน</label>
                                        <input type="number" class="form-control product_qty_update" name="quantity${product.product_id}" id="product_qty_update" value="${product.QTY}">
                                        </div>
                        `;

                            product_list_update.appendChild(update);

                            total += totalPrice;
                        } else {

                        }

                    });
                    let totalCeil = Math.ceil(total);
                    let totalRow = document.createElement("tr");
                    totalRow.innerHTML = `
                    <td colspan="2" class="text-end">รวมทั้งหมด</td>
                    <td>${totalCeil}</td>
                `;

                $('#toggleCardadd').click(function() {
                    addMoreProduct(rowData);
                    // console.log('Row data:', rowData); // Pass rowData to addMoreProduct function
                });
                    productTableBody.appendChild(totalRow);
                    $('#product_detail_modal').modal('show');
                } else {
                    console.error('Error:', json.error_message);
                }
            })
            .catch(error => {
                console.error('Error fetching product details:', error);
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
                <img src="../assets/img/product/${product.product_img}" data-price="${product.pack_price}" alt="user-avatar" class="d-block rounded" height="70px" width="70px" >${product.product_name}
            </td>
            <td>
                <input type="number" class="form-control" name="quantity_${product.product_id}" id="quantity_${product.product_id}" placeholder="0">
            </td>
        `;
                        product_list_Div.appendChild(newRow);
                    });
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
            })
    }

    function tasklist_success(task_id) {
        var timestamp = Date.now();
        var localDateTime = new Date(timestamp);
        localDateTime.setHours(localDateTime.getHours() + 7);
        var datetimeNow = localDateTime.toISOString(); // Format: YYYY-MM-DDTHH:MM:SSZ

        fetch('../api/product?case=task_success', {
                method: 'POST',
                body: JSON.stringify({
                    case: 'task_success',
                    taskID: task_id,
                    last_datetime: datetimeNow
                }),
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(json) {
                $("#modal_confirm").modal("hide");
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

    function tasklist_cancel(task_id) {
        var timestamp = Date.now();
        var localDateTime = new Date(timestamp);
        localDateTime.setHours(localDateTime.getHours() + 7);
        var datetimeNow = localDateTime.toISOString(); // Format: YYYY-MM-DDTHH:MM:SSZ
        fetch('../api/product?case=task_cancel', {
                method: 'POST',
                body: JSON.stringify({
                    case: 'task_cancel',
                    taskID: task_id,
                    last_datetime: datetimeNow
                }),
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(json) {
                $("#modal_confirm").modal("hide");
                if (json[0].status == '0') {
                    alert_snackbar('error', json[0].error_message);

                } else {
                    alert_snackbar('success', "ยกเลิกสำเร็จ");
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
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