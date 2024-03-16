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
</style>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="card mb-4">
                <h1>เพิ่มนัดหมาย</h1>

                <div class="card-body">

                    <div id="productInfo"></div>
                    <div id="customerInfo"></div>

                    <div id="DataTable" class="table-responsive text-nowrap">
                        <table id="customerData" class="display">
                            <thead>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>Name</th>
                                    <th>Company Type</th>
                                    <th>Address</th>
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
    </div>
</div>
<div class="rush-task">
    <button class="btn btn-info btn-rush-task"><i class="menu-icon tf-icons bx bx-message-square-add"></i></button>
</div>

<?php include("foot.php"); ?>
<footer>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Include DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

</footer>>
<script>
    $(document).ready(function() {

        $.ajax({
            url: '../api/customer?case=select_cus_datatable',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                try {
                    if (!response.error_message) {
                        var table = $('#customerData').DataTable({
                            response: true,
                            data: response,
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
                                    defaultContent: '<button class="btn btn-primary btn-sm btn-edit">แก้ไข</button>'
                                }
                            ]
                        });
                        console.log(table);
                        $('#customerData').on('click', '.btn-edit', function() {
                            var data = table.row($(this).parents('tr')).data();
                            $('#DataTable').hide();

                            populateDataList(data);
                            $('#productInfo').show();
                            $('#appointmentForm').show();
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

    // $(document).ready(function() {
    //     function fetchProductData() {
    //         fetch('../api/product?case=show_product', {
    //                 method: 'POST',
    //                 body: JSON.stringify({
    //                     case: 'show_product'
    //                 })
    //             })
    //             .then(function(response) {
    //                 if (!response.ok) {
    //                     throw new Error('Network response was not ok');
    //                 } else {
    //                     return response.json();
    //                 }
    //             })
    //             .then(function(products) {
    //                 console.log(products);

    //                 $('#productInfo').html('');

    //                 products.forEach(function(product) {
    //                     $('#productInfo').append('<p>สินค้า: ' + product.product_id + ' - ' + product.product_name + '</p>')
    //                         .append('<img src="../assets/img/product/' + product.product_img + '" width="100" height="100">')
    //                         .append('<input type="number" id="quantity' + product.product_id + '">');

    //                 });
    //             })
    //             .catch(function(error) {
    //                 console.error('Error during fetch operation:', error);
    //             });
    //     }

    //     fetchProductData();

    // });    
    function populateDataList(data) {
    // fetch('../api/product?case=show_product', {
    //     method: 'POST',
    //     body: JSON.stringify({
    //         case: 'show_product'
    //     })
    // })
    // .then(function(response) {
    //     if (!response.ok) {
    //         throw new Error('Network response was not ok');
    //     }
    //     return response.json();
    // })
    // .then(function(products) {
    //     console.log(products);

    //     $('#productInfo').html('');

    //     products.forEach(function(product) {
    //         if (product.status !== 1) { // ตรวจสอบว่าสถานะของสินค้าไม่เท่ากับ 1 ก่อนที่จะแสดงข้อมูลสินค้า
    //             $('#productInfo').append(`<div class="card-body mb-4" style="width: 18rem;">
    //                                         <p>สินค้า: ${product.product_id} - ${product.product_name}</p>
    //                                         <input type="hidden" id="product_id" name="product_id" value="${product.product_id}">
    //                                         <img src="../assets/img/product/${product.product_img}" width="100" height="100">
    //                                         <input type="number" id="quantity" value="0">
    //                                     </div>`)
    //         }
    //     });
    // })
    // .catch(function(error) {
    //     console.error('Error during fetch operation:', error);
    // });

    // ต่อไปคุณสามารถทำส่วนของการแสดงผลข้อมูลลูกค้าได้ตามปกติ
    $('#customerInfo').html('');

    const customerInfoHTML = ` 
                    <div id="customerInfo">    
                    <form id="appointmentForm">
                        <input type="hidden" id="task_id" name="task_id" >
                        <input type="hidden" id="cus_id" name="cus_id" value="${data.cus_id}" readonly>
                        <input type="hidden" id="task_datetime" name="task_datetime">
                        <input type="hidden" id="pay_datetime" name="pay_datetime">
                        <div class="form-group">
                            <label for="task_datetime">Task Date and Time</label>
                            <input type="datetime-local" class="form-control" id="datetime" name="task_datetime">
                        </div>
                        <div class="form-group">
                            <label for="product_id">product_id</label>
                        <input type="text" id="product_id" name="product_id">
                        </div>
                        <div class="form-group">
                            <label for="pay_status">Pay Status</label>
                            <select class="form-control" id="pay_status" name="pay_status">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pay_type">Pay Type</label>
                            <input type="text" class="form-control" id="pay_type" name="pay_type">
                        </div>
                        <div class="form-group">
                            <label for="pay_total">Pay Total</label>
                            <input type="number" class="form-control" id="pay_total" name="pay_total">
                        </div>
                    </form>

                    <div id="compINFO" class="form-group mt-3">
                        <button id="SaveBut" class="btn btn-primary">ตกลง</button>
                        <button id="backButton" class="btn btn-secondary">ยกเลิก</button>
                    </div>
                </div>
                
                                `;

    $('#customerInfo').append(customerInfoHTML);

    // Add click event listener to the back button
    $('#backButton').on('click', function() {

        $('#DataTable').show();

        $('#customerInfo').html('');
        $('#productInfo').html('');
    });
    $('#SaveBut').on('click', function() {
        fetch('../api/product?case=TaskPro', {
                method: 'POST',
                body: JSON.stringify({
                    case: 'TaskPro',
                    cus_id: $('#cus_id').val(),
                    Taskdatetime: $('#datetime').val(),
                    product_id: $('#product_id').val(),
                }),
            }).then(function(response) {
                try {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Network response was not ok');
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            })
            .then(function(data) {
                $('#DataTable').show();

                $('#customerInfo').html('');
                $('#productInfo').html('');
            })
            .catch(error => {
                // Handle fetch error
                console.error('Error:', error);
            })
    });

}
</script>