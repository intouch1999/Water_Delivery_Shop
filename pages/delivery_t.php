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

    #searchInput {
        border: none;
    }
</style>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-2">
        </div>
        <div class="row">
            <div class="card mb-4" id="customerDat">
                <h1>เพิ่มนัดหมาย</h1>
                <div class="input-group mb-3">
                    <datalist id="customers"></datalist>
                    <input type="text" id="searchInput" list="customers" class="form-control" style="margin-right: 10px;" placeholder="Search...">
                    <div class="input-group-append">
                        <button class="btn btn-info" id="submitButton">Submit</button>
                    </div>
                </div>
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

                    </tbody>
                </table>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูลลูกค้า</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Input fields for editing -->
                                <div class="form-group">
                                    <label for="cusIdInput">Customer ID</label>
                                    <input type="text" class="form-control" id="cusIdInput" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="cusNameInput">Name</label>
                                    <input type="text" class="form-control" id="cusNameInput" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="compTypeInput">Company Type</label>
                                    <input type="text" class="form-control" id="compTypeInput">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="cancelButton" data-dismiss="modal">ยกเลิก</button>
                                <button type="button" class="btn btn-primary" id="confirmButton">ตกลง</button>
                            </div>
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

<script>
    let timer;

    document.getElementById('searchInput').addEventListener('keyup', function(event) {
        const SearchCus = this.value.trim();

        // เช็คว่ากดปุ่ม Enter หรือไม่
        if (event.key !== 'Enter') {
            clearTimeout(timer);

            timer = setTimeout(() => {
                if (SearchCus !== '') {
                    fetch('../api/customer', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                case: 'searchcus',
                                SearchCus: SearchCus
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log(data);
                            populateDataList(data);
                        })
                        .catch(error => {
                            console.error('Error fetching delivery customer data:', error);
                        });
                }
            }, 1000);
        }
    });

    function populateDataList(data) {
        const datalist = document.getElementById('customers');
        datalist.innerHTML = '';

        if (data.length > 0 && data[0].status === 1) {
            data.forEach(customer => {
                if (customer.cus_name !== '' && customer.cus_address !== '') { // เพิ่มเงื่อนไขนี้
                    const option = document.createElement('option');
                    option.value = customer.cus_name + ' - ' + customer.cus_address;
                    datalist.appendChild(option);
                }
            });
        } else {
            const option = document.createElement('option');
            option.value = 'No customers found';
            datalist.appendChild(option);
        }
    }

    document.getElementById('submitButton').addEventListener('click', function() {
        const selectedOption = document.getElementById('searchInput').value;
        const selectedCustomer = selectedOption.split(' - ')[0];

        fetch('../api/customer', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    case: 'deli_task',
                    SearchCus: selectedCustomer
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                populateDataList(data);
                document.getElementById('searchInput').value = '';
            })
            .catch(error => {
                console.error('Error fetching delivery customer data:', error);
            });

        function populateDataList(data) {
            const customerInfoDiv = document.getElementById('customerInfo');
            customerInfoDiv.innerHTML = '';

            if (data.length > 0 && data[0].status === 1) {
                data.slice(1).forEach(customer => {
                    const customerDiv = document.createElement('div');
                    customerDiv.innerHTML = `
                    <h3>รหัสลูกค้า : ${customer.cus_id} | ชื่อลูกค้า : ${customer.cus_name}</h3>
                    <h4>ที่อยู่: ${customer.cus_address}</h4>
                    <p><input type="text"></p>
                    <p>input type</p>
                `;
                    customerInfoDiv.appendChild(customerDiv);
                });
            } else {
                const noCustomerInfoDiv = document.createElement('div');
                noCustomerInfoDiv.innerText = 'No customer information found';
                customerInfoDiv.appendChild(noCustomerInfoDiv);
            }
        }
    });

    // document.getElementById('searchInput').addEventListener('input', function() {
    //     const inputText = this.value.length > 48 ? this.value.substring(0, 48) + '...' : this.value;
    //     this.value = inputText;
    // });
</script>
<?php include("foot.php"); ?>
<footer>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Include DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</footer>
<script>
    $(document).ready(function() {
        // AJAX request to fetch customer data

        $.ajax({
            url: '../api/customer?case=select_cus_datatable',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response.error_message) {
                    // Display error message if any
                    $('#customerData').text('Error: ' + response.error_message);
                } else {
                    // Initialize DataTable with received data
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
                    // Handle edit button click event
                    $('#customerData').on('click', '.btn-edit', function() {
                        var data = table.row($(this).parents('tr')).data();
                        // Open the modal
                        $('#editModal').modal('show');

                        // Set input values in the modal
                        $('#cusIdInput').val(data.cus_id);
                        $('#cusNameInput').val(data.cus_name);
                        $('#compTypeInput').val(data.comp_type);
                    });

                    // Handle cancel button click event
                    $('#cancelButton').click(function() {
                        $('#editModal').modal('hide');
                    });

                    // Handle confirm button click event
                    $('#confirmButton').click(function() {
                        // Perform actions when confirm button is clicked
                        // For example, you can retrieve input values and perform AJAX request to update data
                        // After that, you can close the modal
                        $('#editModal').modal('hide');
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
            }
        });
    });
</script>