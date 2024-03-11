<?php include("head.php"); ?>
<head>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Include DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>


<style>
  .rush-task .btn-rush-task{
    position: fixed;
    bottom: 4rem;
    left: 1.625rem;
    z-index: 999999;
    height:45px;
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

    #searchInput{
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
            <div class="card mb-4">
              <h1>เพิ่มนัดหมาย</h1>
              <div class="input-group mb-3">
                <datalist id="customers"></datalist>
                <input type="text" id="searchInput" list="customers" class="form-control" style="margin-right: 10px;" placeholder="Search...">
                <div class="input-group-append">
                    <button class="btn btn-info" id="submitButton">Submit</button>
                </div>
            </div>
            <table id="customerData" class="display">
    <thead>
        <tr>
            <th>Customer ID</th>
            <th>Name</th>
            <th>Company Type</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>

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
                $('#customerData').DataTable({
                    data: response,
                    columns: [
                        { data: 'cus_id' },
                        { data: 'cus_name' },
                        { data: 'comp_type' },
                        { data: 'cus_address' }
                    ]
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Error: ' + error);
        }
    });
});







</script>
<?php include("foot.php"); ?>
