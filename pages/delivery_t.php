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

    #cusINFO {
        display: flex;
        justify-content: center;
    }

    #cusINFO h3 {
        margin: 0 30px;
    }

    #productInfo {
        display: none;

    }

    #SaveBut {
        margin-right: 10px;
    }

    #taskuserlist {
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
                                <!-- datatavle -->
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
                        <button id="backButton" class="btn btn-secondary">ย้อนกลับ</button>
                    </h5>
                    <input type="hidden" id="task_id" name="task_id">
                    <input type="hidden" id="cus_id" name="cus_id" value="${data.cus_id}" readonly>
                    <input type="hidden" id="task_datetime" name="task_datetime">
                    <input type="hidden" id="pay_datetime" name="pay_datetime">
                    <div class="row gx-3 gy-2 align-items-center">
                        <div class="col-md-3">
                            <label class="form-label" for="task_datetime">วันเวลาจัดส่ง </label>
                            <input type="datetime-local" class="form-control" id="datetime" name="task_datetime">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="inp_search_product">สินค้า</label>
                            <input type="text" class="form-control" list="data_product_list" name="inp_search_product" id="find_product" placeholder="ระบุชื่อ หรือ รหัสสินค้า">
                        </div>
                        <datalist id="data_product_list"></datalist>
                        <div class="col-md-1">
                            <label class="form-label" for="product_qty">จำนวน</label>
                            <input type="number" class="form-control" id="product_qty" placeholder="จำนวน">
                        </div>
                        <!-- <div class="form-group">
                            <label for="pay_status">Pay Status</label>
                            <select class="form-control" id="pay_status" name="pay_status">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="pay_type">Pay Type</label>
                            <input type="text" class="form-control" id="pay_type" name="pay_type">
                        </div>
                        <div class="form-group">
                            <label for="pay_total">Pay Total</label>
                            <input type="number" class="form-control" id="pay_total" name="pay_total">
                        </div>

                    <div id="compINFO" class="form-group mt-3">
                        <button id="SaveBut" class="btn btn-primary">ตกลง</button>
                        <button id="backButton" class="btn btn-secondary">ยกเลิก</button>
                    </div> -->

                        <div class="col-md-2">
                            <label class="form-label" for="submit_Task">&nbsp;</label>
                            <button type="button" id="submit_Task" class="btn btn-primary d-block">บันทึก</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="display responsive nowrap" width="100%" id="taskData">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>รหัสนัดหมาย</th>
                                    <th>รหัสลูกค้า</th>
                                    <th>วันที่นัดหมาย</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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

            </footer>>
            <script>

                $(document).ready(function() {

                    $.ajax({
                        url: '../api/customer?case=select_cus_datatable',
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
                                    var taskDataTable;

                                    $('#backButton').on('click', function() {
                                        location.reload();
                                    });

                                    $('#customerData').on('click', '.btn-edit', function() {
                                        var data = table.row($(this).parents('tr')).data();
                                        var cus_id = data.cus_id;
                                        $('#DataTable').hide();
                                        $('#taskuserlist').show();

                                        $('#cus_id').val(cus_id);

                                        if ($.fn.DataTable.isDataTable('#taskData')) {
                                            taskDataTable.destroy();
                                        }

                                        $.ajax({
                                            url: '../api/product?case=TaskShow',
                                            type: 'POST',
                                            dataType: 'json',
                                            contentType: 'application/json',
                                            data: JSON.stringify({
                                                case: 'TaskShow',
                                                cus_id: cus_id
                                            }),
                                            success: function(response) {
                                            console.log(response);
                                            try {
                                                if (!response.error_message) {
                                                    taskDataTable = $('#taskData').DataTable({
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
                                                                data: null,
                                                                defaultContent: '<button class="btn btn-primary btn-sm btn-success">จัดส่งสำเร็จ</button>'
                                                            }
                                                        ]
                                                    });
                                                    $('#submit_Task').on('click', async function() {
                                                    try {
                                                        const response = await fetch('../api/product?case=TaskPro', {
                                                            method: 'POST',
                                                            body: JSON.stringify({
                                                                case: 'TaskPro',
                                                                cus_id: $('#cus_id').val(),
                                                                Taskdatetime: $('#datetime').val(),
                                                                find_product: $('#find_product').val(),
                                                                product_qty: $('#product_qty').val()
                                                            }),
                                                        });

                                                        if (!response.ok) {
                                                            throw new Error('Network response was not ok');
                                                        }

                                                        const json = await response.json();

                                                        if (json[0].status == '0') {
                                                            alert_snackbar('error', json[0].error_message);
                                                        } else {
                                                            alert_snackbar('success', "เพิ่มนัดหมายสำเร็จ");
                                                            await preload_page(); // เรียกใช้ preload_page() เมื่อเสร็จสิ้นการเพิ่มนัดหมาย
                                                        }
                                                    } catch (error) {
                                                        console.error('Error:', error);
                                                    }
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
                                    });

                                    $('#taskData').on('click', '.btn-success', function() {
                                    var rowData = taskDataTable.row($(this).parents('tr')).data();

                                    var last_datetime = new Date().toISOString(); // Format: YYYY-MM-DDTHH:MM:SSZ

                                    rowData.task_datetime = last_datetime;

                                    // taskDataTable.row($(this).parents('tr')).data(rowData).draw();

                                    fetch('../api/product?case=Tasksucc', {
                                        method: 'POST',
                                        body: JSON.stringify({
                                            case: 'Tasksucc',
                                            taskID: rowData.task_id,
                                            last_datetime: last_datetime
                                        }),
                                    })
                                    .then(function(response) {
                                        return response.json();
                                    })
                                    .then(function(json) {
                                        if(json[0].status=='0'){
                                            alert_snackbar('error',json[0].error_message);
                                        }else{
                                            alert_snackbar('success',"จัดส่งสำเร็จ");
                                        
			                            }
                                    })
                                    .catch(function(error) {
                                        console.error('Error:', error);
                                    });
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
                $(document).ready(function() {
                    const inpSearchProduct = $("#find_product");
                    const dataProductList = $("#data_product_list");
                    let debounceTimeout;

                    inpSearchProduct.on("keyup", function() {
                        dataProductList.empty();
                        clearTimeout(debounceTimeout);

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
                                                .val(item.product_id)
                                                .text(item.product_id + " | " + item.product_name);
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

                    // This event listener updates the input field value when an option is selected
                    inpSearchProduct.on("change", function() {
                        const selectedOption = $(this).val().split('|')[0].trim(); // Extract product_id
                        inpSearchProduct.val(selectedOption); // Set input value to product_id
                    });
                });
            </script>