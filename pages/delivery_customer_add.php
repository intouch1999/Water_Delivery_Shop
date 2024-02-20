<?php include("head.php"); ?>
<style>
  #map {
  height: 40vh;
  }

  #description {
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
  }

  #infowindow-content .title {
    font-weight: bold;
  }

  #infowindow-content {
    display: none;
  }

  #map #infowindow-content {
    display: inline;
  }

  .pac-card {
    background-color: #fff;
    border: 0;
    border-radius: 2px;
    box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
    margin: 10px;
    padding: 0 0.5em;
    font: 400 18px Roboto, Arial, sans-serif;
    overflow: hidden;
    font-family: Roboto;
    padding: 0;
  }

  #pac-container {
    padding-bottom: 12px;
    margin-right: 12px;
  }

  .pac-controls {
    display: inline-block;
    padding: 5px 11px;
  }

  .pac-controls label {
    font-family: Roboto;
    font-size: 13px;
    font-weight: 300;
  }

  #pac-input {
    background-color: #fff; 
    font-size: 15px;
    margin-left: 12px;
    padding: 0 11px 0 13px;
    border-radius:6px;
    border:1px solid gray; 
    text-overflow: ellipsis;
    width: 60vw;
  }

  #pac-input:focus {
    border-color: #4d90fe;
  }

  #title {
    color: #fff;
    background-color: #4d90fe;
    font-size: 25px;
    font-weight: 500;
    padding: 6px 12px;
  }

  .need{
    color:red;
  }

  .branch_main{
    font-size:12px !important;
    color:#566a7f;
  }
  input[type="checkbox"] {
  /* CSS styles here */
  width: 18px;
  height: 18px;
  /* Other styles */
}
</style>
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> 

    <div class="row">
      <div class="col-md-12"> 
        <div class="card mb-4">
          <h5 class="card-header" id="cus_text_banner">เพิ่มข้อมูลลูกค้าใหม่</h5>
          <!-- Account -->
          <hr class="my-0" />
          <div class="card-body"> 
            <div class="row">
          <h6>ระบุสถานที่ในการจัดส่ง<span class="need">*</span></h6>
          <div class="pac-card" id="pac-card">
          <div style="display:none">
            <div id="title">Autocomplete search</div>
            <div id="type-selector" class="pac-controls">
              <input
                type="radio"
                name="type"
                id="changetype-all"
                checked="checked"
              />
              <label for="changetype-all">All</label>

              <input type="radio" name="type" id="changetype-establishment" />
              <label for="changetype-establishment">establishment</label>

              <input type="radio" name="type" id="changetype-address" />
              <label for="changetype-address">address</label>

              <input type="radio" name="type" id="changetype-geocode" />
              <label for="changetype-geocode">geocode</label>

              <input type="radio" name="type" id="changetype-cities" />
              <label for="changetype-cities">(cities)</label>

              <input type="radio" name="type" id="changetype-regions" />
              <label for="changetype-regions">(regions)</label>
            </div>
            <br />
            <div id="strict-bounds-selector" class="pac-controls">
              <input type="checkbox" id="use-location-bias" value="" checked />
              <label for="use-location-bias">Bias to map viewport</label>

              <input type="checkbox" id="use-strict-bounds" value="" />
              <label for="use-strict-bounds">Strict bounds</label>
            </div>
          </div>
          <div id="pac-container" style="margin-top:10px">
            <input id="pac-input" type="text" placeholder="ระบุสถานที่" />
          </div>
        </div>
        <div id="map"></div>
        <div id="infowindow-content">
          <span id="place-name" class="title"></span><br />
          <span id="place-address"></span>
        </div>
        </div>
        <div class="row mt-3">
          <h6>ระบุสถานที่ในการจัดส่ง</h6>
        </div>
        <div class="row">
          <div class="mb-3 col-md-3">
            <label for="inp_deli_cus_name" class="form-label"><i class="menu-icon tf-icons bx bxs-user-badge"></i> ชื่อลูกค้า<span class="need">*</span></label>
            <input class="form-control" type="text" id="inp_deli_cus_name" name="inp_deli_cus_name" autocomplete="off" />
          </div>
          <div class="mb-3 col-md-3">
            <label for="inp_comp_type" class="form-label"><i class="menu-icon tf-icons bx bx-category-alt"></i> ประเภทลูกค้า<span class="need">*</span></label>
            <select id="inp_comp_type" name="comp_type" class="select2 form-select">
              <option value="general">ลูกค้าทั่วไป</option>
              <option value="company">นิติบุคคล</option>
            </select>
          </div> 
          <div class="mb-3 col-md-3">
            <label for="inp_deli_cus_tel" class="form-label"><i class="menu-icon tf-icons bx bxs-phone"></i> เบอร์ติดต่อ</label>
            <input class="form-control" type="text" name="deli_cus_tel" id="inp_deli_cus_tel"  autocomplete="off"/>
          </div>
          <div class="mb-3 col-md-3">
            <label for="inp_deli_cus_contact" class="form-label"><i class="menu-icon tf-icons bx bxs-phone"></i>ช่องทางติดต่อ(อื่นๆ)</label>
            <input class="form-control" type="text" name="deli_cus_contact" id="inp_deli_cus_contact"  autocomplete="off"/>
          </div>
          <div class="mb-3 col-md-12">
            <label for="inp_deli_cus_address" class="form-label"><i class="menu-icon tf-icons bx bx-home-alt"></i> ที่อยู่ลูกค้า<span class="need">*</span></label>
            <input class="form-control" type="text" name="deli_cus_address" id="inp_deli_cus_address"  autocomplete="off"/>
          </div>
        </div>
        <div class="row mt-3">
          <h6>ข้อมูลออกใบแจ้งหนี้/ใบเสร็จ</h6>
        </div>
        <div class="row">
          <div class="mb-3 col-md-12">
            <label for="inp_tax_cus_name" class="form-label">ข้อมูลชื่อลูกค้า</label>
            <input class="form-control" type="text" id="inp_tax_cus_name" name="tax_cus_name" autocomplete="off" />
          </div>
          <div class="mb-3 col-md-2">
          <label for="branch_main" class="form-label"> สำนักงานใหญ่</label>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="chk_branch_main" checked="">
              <label class="form-check-label branch_main" for="branch_main"> สำนักงานใหญ่ </label>
            </div>
          </div>
          <div class="mb-3 col-md-5">
            <label for="inp_tax_cus_branch" class="form-label"> ชื่อสาขา</label>
            <input class="form-control" type="text" id="inp_tax_cus_branch" name="tax_cus_branch" value="สำนักงานใหญ่" autocomplete="off" readonly/>
          </div> 
          <div class="mb-3 col-md-5">
            <label for="inp_tax_cus_id" class="form-label">เลขที่ประจำตัวผู้เสียภาษี</label>
            <input class="form-control" type="text" id="inp_tax_cus_id" name="tax_cus_id" autocomplete="off" />
          </div>
          <div class="mb-3 col-md-9">
            <label for="inp_tax_cus_addr" class="form-label"> ข้อมูลที่อยู่</label>
            <textarea class="form-control" type="text" id="inp_tax_cus_addr" name="tax_cus_addr" autocomplete="off"></textarea>
          </div> 
          
          <div class="mb-3 col-md-3">
            <label for="inp_tax_cus_postcode" class="form-label">รหัสไปรษณีย์</label>
            <input class="form-control" type="text" id="inp_tax_cus_postcode" name="tax_cus_postcode" autocomplete="off" />
          </div> 
        </div>
        <div class="mt-2">
          <button type="button" class="btn btn-primary me-2" id="btn_action" onclick="add_new_customer()">บันทึกข้อมูล</button>
        </div>
        </div>
        </div>
    

    </div>
  </div>
  <!-- / Content -->
  <?php include("foot.php"); ?> 
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEa-HpS69cEZLOlpPSFNXQjEP3ER0BlTo&callback=initMap&libraries=places&v=weekly&language=th"   defer ></script>
  <script>
    let pub_latitude,pub_longitude,pub_address;
    let map,marker;

    function initMap() {
      
      map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 13.7563, lng: 100.5018 }, // Centered in Bangkok, Thailand
        zoom: 13,
        mapTypeControl: false,
      });

      marker = new google.maps.Marker({
        map,
        anchorPoint: new google.maps.Point(0, -29),
        visible: false, // Initially, the marker is not visible
      });

      // Add a click event listener to the map to place a marker
      map.addListener("click", (event) => {
        placeMarker(event.latLng, map, marker);
      });

      const card = document.getElementById("pac-card");
      const input = document.getElementById("pac-input");
      const biasInputElement = document.getElementById("use-location-bias");
      const strictBoundsInputElement = document.getElementById("use-strict-bounds");
      const options = {
        fields: ["formatted_address", "geometry", "name"],
        strictBounds: false,
      };

      

      map.controls[google.maps.ControlPosition.TOP_LEFT].push(card);

      const autocomplete = new google.maps.places.Autocomplete(input, options);

      // Bind the map's bounds (viewport) property to the autocomplete object,
      // so that the autocomplete requests use the current map bounds for the
      // bounds option in the request.
      autocomplete.bindTo("bounds", map);

      const infowindow = new google.maps.InfoWindow();
      const infowindowContent = document.getElementById("infowindow-content");

      infowindow.setContent(infowindowContent);

      autocomplete.addListener("place_changed", () => {
        infowindow.close();
        marker.setVisible(false);

        const place = autocomplete.getPlace();

        if (!place.geometry || !place.geometry.location) {
          // User entered the name of a Place that was not suggested and
          // pressed the Enter key, or the Place Details request failed.
          window.alert("No details available for input: '" + place.name + "'");
          return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
          map.fitBounds(place.geometry.viewport);
        } else {
          map.setCenter(place.geometry.location);
          map.setZoom(17);
        }

        // Update the existing marker's position
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
        infowindowContent.children["place-name"].textContent = place.name;
        //infowindowContent.children["place-address"].textContent = place.formatted_address + "<button type='btn btn-sm btn-primary' onclick=\"select_location('"+place.formatted_address+"')\">เลือก</button>";
        infowindowContent.children["place-address"].innerHTML = place.formatted_address + '<a href="javascript:void(0)" onclick="copy_text(\''+place.formatted_address+'\')"> คัดลอก</a>';
        //$("#place-address").html(place.formatted_address +  '<a href="javascript:void(0)" onclick="copy_text(\''+place.formatted_address+'\')"> คัดลอก</a>');
        infowindow.open(map, marker);
        const latitude = place.geometry.location.lat();
        const longitude = place.geometry.location.lng();
        pub_latitude = latitude;
        pub_longitude = longitude;
      });

      // ... Rest of your code ...

      // Function to place a marker on the map at a specified location
      function placeMarker(location, map, marker) {
        marker.setPosition(location);
        marker.setVisible(true);

        const latitude = location.lat();
        const longitude = location.lng();

        pub_latitude = latitude;
        pub_longitude = longitude; 
      }

      



    }

    window.initMap = initMap;

    function placeMarker_edit(latitude, longitude, map, marker) {
      if (map) { // Check if the map is defined
            const location = new google.maps.LatLng(latitude, longitude);
            marker.setPosition(location);
            marker.setVisible(true);
            pub_latitude = latitude;
            pub_longitude = longitude;

            // Focus the map on the new location
            map.setCenter(location);
          } else {
            console.error('Map is not yet initialized.');
          }
      }

    /*

    //check current location
    // Check if Geolocation is available in the browser
    if ("geolocation" in navigator) {
      // Use the Geolocation API to get the current position
      navigator.geolocation.getCurrentPosition(function(position) {
        // Extract latitude and longitude from the position object
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;

        // Log the latitude and longitude to the console
        console.log("Latitude: " + latitude);
        console.log("Longitude: " + longitude);
      }, function(error) {
        // Handle any errors that occur during geolocation
        if (error.code === error.PERMISSION_DENIED) {
          // User denied access to their location
          alert_snackbar("warning","กรุณาอนุญาตการติดตามตำแหน่งของท่าน.");
        } else {
          // Other geolocation errors
          console.error("Error getting geolocation:", error);
        }
      });
    } else {
      // Geolocation is not available in this browser
      console.error("Geolocation is not available in your browser");
    }

    setInterval(function() {
      console.log("[1]" + pub_latitude + "[2]" + pub_longitude);
    }, 1500);
    */
   
    function copy_text(textToCopy) {
      try {
        navigator.clipboard.writeText(textToCopy).then(function() {
          alert_snackbar("success", "คัดลอกที่อยู่แล้ว");
        }).catch(function(err) {
          console.error("Failed to copy text: " + err);
        });
      } catch (err) {
        console.error("Clipboard API is not supported: " + err);
      }
    }



      function add_new_customer() {
        var deli_cus_tel = $('#inp_deli_cus_tel').val();
        var deli_cus_name = $('#inp_deli_cus_name').val();
        var deli_cus_address = $('#inp_deli_cus_address').val();
        var deli_contract = $('#inp_deli_contract').val();
        var comp_type = $('#inp_comp_type').val();
      
      // เช็คแผนที่
      if(pub_latitude == undefined && pub_longitude == undefined){
        alert_snackbar('warning', 'ระบุตำแหน่งลูกค้าจากแผนที่');
        return false;
      }
      // เช็คชื่อ
      if(deli_cus_name.length<2){
        alert_snackbar('warning', 'ระบุชื่อลูกค้า');
        setTimeout(function () {
          $('#inp_deli_cus_name').focus();
        }, 300);
        return false;
      }
      // เช็คที่อยู่
      if(deli_cus_address.length<4){
        alert_snackbar('warning', 'ระบุที่อยู่ลูกค้า');
        setTimeout(function () {
          $('#inp_deli_cus_address').focus();
        }, 300);
        return false;
      }
      
        $("#modal_confirm_text").html("ยืนยันการเพิ่มข้อมูลลูกค้าหรือไม่ ?")
        $("#modal_confirm_submit").attr("onclick","submit_confirm_add();");
        $("#modal_confirm").modal("show");
    }


    let temp_branch_name = "";
    function submit_confirm_add(){
      //check box 
      let check_main_branch;
        if (document.getElementById("chk_branch_main").checked) {
            // Checkbox is checked, set the value to 1
            check_main_branch = 1;
        } else {
            // Checkbox is unchecked, set the value to 0
            check_main_branch = 0;
        }
      //send
      fetch('../api/customer?deli_add_customer', {
          method: 'POST',
          body: JSON.stringify({
          case: 'deli_add_customer',
          lat: pub_latitude,
          long: pub_longitude,
          deli_cus_name: $('#inp_deli_cus_name').val(),
          deli_cus_address: $('#inp_deli_cus_address').val(),
          comp_type: $('#inp_comp_type').val(),
          deli_cus_tel: $('#inp_deli_cus_tel').val(),
          deli_cus_contact: $('#inp_deli_cus_contact').val(),
          tax_cus_name: $('#inp_tax_cus_name').val(),
          tax_main_branch: check_main_branch,
          tax_cus_branch: $('#inp_tax_cus_branch').val(),
          tax_cus_id: $('#inp_tax_cus_id').val(),
          tax_cus_addr: $('#inp_tax_cus_addr').val(),
          tax_cus_postcode: $('#inp_tax_cus_postcode').val()
        })
        })
        .then(function (response) {
            fetch_status = response.status;
            return response.json();
        }) 
        .then(function (json) {
          $("#modal_confirm").modal("hide");
          if(json[0].status==1){
            alert_snackbar("success","เพิ่มข้อมูลเสร็จสิ้น กำลังกลับไปยังหน้าหลัก");
            setTimeout(function(){
              window.location.href = "delivery_customer";
            },1500);
          }else{
          alert_snackbar("danger","พบข้อผิดพลาด : "+json[0].error_message);
          }
        })
        .catch(error => console.error(error));
    }

    <?php if(isset($_POST['cus_id'])){ 
      echo "chk_edit_customer('{$_POST['cus_id']}')";
    } ?>

    function chk_edit_customer(cus_id){
      $("#cus_text_banner").html("แก้ไขข้อมูลลูกค้า");
      $("#btn_action").html("ยืนยันแก้ไข").removeClass("btn-primary").addClass("btn-warning").attr("onclick","edit_customer('"+cus_id+"')");

      fetch('../api/customer?deli_edit_customer', {
          method: 'POST',
          body: JSON.stringify({
          case: 'deli_edit_customer',
          cus_id: cus_id
        })
        })
        .then(function (response) {
            fetch_status = response.status;
            return response.json();
        }) 
        .then(function (json) {
            //่json[0].cus_id
            $("#inp_deli_cus_name").val(json[0].cus_name);
            $("#inp_comp_type").val(json[0].comp_type);
            $("#inp_deli_cus_tel").val(json[0].cus_tel);
            $("#inp_deli_cus_contact").val(json[0].cus_contact);
            $("#inp_deli_cus_address").val(json[0].cus_address);  

            $("#inp_tax_cus_name").val(json[0].tax_cus_name);             
            $("#inp_tax_cus_branch").val(json[0].tax_cus_branch);         
            $("#inp_tax_cus_id").val(json[0].tax_cus_id);         
            $("#inp_tax_cus_addr").val(json[0].tax_cus_addr);         
            $("#inp_tax_cus_postcode").val(json[0].tax_cus_postcode);     
            
            //
            if(parseInt(json[0].tax_main_branch)==1){
              $('#inp_tax_cus_branch').prop('readonly', true);
              $("#chk_branch_main").prop("checked", true);
            }else{
              $('#inp_tax_cus_branch').prop('readonly', false);
              $("#chk_branch_main").prop("checked", false);
              temp_branch_name = json[0].tax_cus_branch;
            } 
            
            placeMarker_edit(json[0].lat, json[0].lon, map, marker);
            
        })
        .catch(error => console.error(error));
    }

    function edit_customer(cus_id){
      var deli_cus_tel = $('#inp_deli_cus_tel').val();
        var deli_cus_name = $('#inp_deli_cus_name').val();
        var deli_cus_address = $('#inp_deli_cus_address').val();
        var comp_type = $('#inp_comp_type').val();
      // เช็คแผนที่
        /*
      if(pub_latitude == undefined && pub_longitude == undefined){
        alert_snackbar('warning', 'ระบุตำแหน่งลูกค้าจากแผนที่');
        return false;
      }
      */
      // เช็คชื่อ
      if(deli_cus_name.length<2){
        alert_snackbar('warning', 'ระบุชื่อลูกค้า');
        setTimeout(function () {
          $('#inp_deli_cus_name').focus();
        }, 300);
        return false;
      }
      // เช็คที่อยู่
      if(deli_cus_address.length<4){
        alert_snackbar('warning', 'ระบุที่อยู่ลูกค้า');
        setTimeout(function () {
          $('#inp_deli_cus_address').focus();
        }, 300);
        return false;
      }
      
        
        $("#modal_confirm_text").html("ยืนยันการแก้ไขข้อมูลลูกค้าหรือไม่ ?")
        $("#modal_confirm_submit").attr("onclick","submit_confirm_edit('"+cus_id+"');");
        $("#modal_confirm").modal("show");
    }

    function submit_confirm_edit(cus_id){
      //check box 
      let check_main_branch;
        if (document.getElementById("chk_branch_main").checked) {
            // Checkbox is checked, set the value to 1
            check_main_branch = 1;
        } else {
            // Checkbox is unchecked, set the value to 0
            check_main_branch = 0;
        }
      fetch('../api/customer?deli_edit_customer_submit', {
          method: 'POST',
          body: JSON.stringify({
          case: 'deli_edit_customer_submit',
          cus_id:cus_id,
          lat: pub_latitude,
          long: pub_longitude,
          deli_cus_name: $('#inp_deli_cus_name').val(),
          deli_cus_address: $('#inp_deli_cus_address').val(),
          comp_type: $('#inp_comp_type').val(),
          deli_cus_tel: $('#inp_deli_cus_tel').val(),
          deli_cus_contact: $('#inp_deli_cus_contact').val(),
          tax_cus_name: $('#inp_tax_cus_name').val(),
          tax_main_branch: check_main_branch,
          tax_cus_branch: $('#inp_tax_cus_branch').val(),
          tax_cus_id: $('#inp_tax_cus_id').val(),
          tax_cus_addr: $('#inp_tax_cus_addr').val(),
          tax_cus_postcode: $('#inp_tax_cus_postcode').val() 
        })
        })
        .then(function (response) {
            fetch_status = response.status;
            return response.json();
        }) 
        .then(function (json) {
          $("#modal_confirm").modal("hide");
          if(json[0].status==1){
            alert_snackbar("success","แก้ไขข้อมูลเสร็จสิ้น กำลังกลับไปยังหน้าหลัก");
            setTimeout(function(){
              window.location.href = "delivery_customer";
            },1500);
          }else{
          alert_snackbar("danger","พบข้อผิดพลาด : "+json[0].error_message);
          }
        })
        .catch(error => console.error(error));
    }

    

    $(document).ready(function() {
    // Attach a change event listener to the checkbox
    $('#chk_branch_main').change(function() {
      if (this.checked) {
        // Checkbox is checked
        $('#inp_tax_cus_branch').prop('readonly', true).val('สำนักงานใหญ่');
      } else {
        // Checkbox is unchecked
        $('#inp_tax_cus_branch').prop('readonly', false).val(temp_branch_name);
      }
    });
  });


    </script>
