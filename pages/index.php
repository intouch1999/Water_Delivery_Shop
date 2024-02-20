<?php include("head.php"); ?>

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sivanat Store

    <div class="row">
      <div class="col-md-12"> 
        <div class="card mb-4">
          <h5 class="card-header">นัดหมายการส่งน้ำ</h5>
          <!-- Account -->
          <hr class="my-0" />
          <div class="card-body">
          <div id="calendar"></div>
          </div>
          <!-- /Account -->
        </div>
        <div class="card">
          <h5 class="card-header">Facebook Page</h5>
          <div class="card-body">
          <div class="row">
          <div class="fb-page" data-href="https://www.facebook.com/profile.php?id=100068738153790" data-width="500" data-height="400" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- / Content -->
  <?php include("foot.php"); ?>
  <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0" nonce="YourNonceValue"></script>
  <script>
    $(document).ready(function() {
      $('#calendar').evoCalendar({
  'theme': 'Midnight Blue',
  'language': 'en',
  'todayHighlight': true,
  'format': 'dd/MM/yyyy', // This line sets the date format to dd/mm/yyyy
  calendarEvents: [
    {
      id: 'bHay68s', // Event's ID (required)
      name: "เฮียกูล (13:00)", // Event name (required)
      date: "September/16/2023 16:00", // Event date (required)
      type: "meeting", // Event type (required)
    },{
      id: 'bHay68s', // Event's ID (required)
      name: "เจ๊หน่อย (17:00)", // Event name (required)
      date: "September/16/2023 16:00", // Event date (required)
      type: "holiday", // Event type (required)
    },{
      id: 'bHay68s', // Event's ID (required)
      name: "เฮียแบงค์ (16:00)", // Event name (required)
      date: "September/17/2023 16:00", // Event date (required)
      type: "holiday", // Event type (required)
    },
  ]
});
    })
  </script>