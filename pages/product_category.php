<?php include("head.php"); ?>
<style>
#card_content{
  min-height:70vh;
}
.btn_add{
  color:white !important;
}
#table_type { 
  overflow: hidden; /* Hide the overflow content */
}
</style>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="card mb-4">
                    <h5 class="card-header">เพิ่มหมวดหมู่สินค้าใหม่</h5>
                    <div class="card-body">
                    <div class="row gx-3 gy-2 align-items-center">
                        <div class="col-md-4">
                            <label class="form-label" for="inp_cat_name">หมวดหมู่</label>
                            <input type="text" class="form-control" name="inp_cat_name" id="inp_cat_name" placeholder="ระบุหมวดหมู่เช่น เครื่องดื่ม,อาหารแห้ง,อาหารสด เป็นต้น">
                            <span id="warning_cat_name"></span>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="submit_cat">&nbsp;</label>
                            <button type="button" id="submit_cat" class="btn btn-primary d-block" onclick="cat_submit()">บันทึก</button>
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap mt-3">
                            <table class="table" id="table_cat">
                                <thead>
                                <tr class="text-nowrap">
                                    <th width="30%">หมวดหมู่</th> 
                                    <th width="30%">แก้ไข</th> 
                                    <th>ลบ</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>เพิ่มประเภทสินค้า</h5>
                        <p>เพิ่มประเภทสินค้าตามหมวดหมู่ต่าง ๆ</p>
                        <div class="row gx-3 gy-2 align-items-center">
                            <div class="col-md-4">
                            <label class="form-label" for="select_cat">หมวดหมู่</label>
                            <select id="select_cat" class="form-select form-control-sm color-dropdown">
                            </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="inp_cat_sub_name">ประเภท</label>
                                <input type="text" class="form-control" name="inp_cat_sub_name" id="inp_cat_sub_name" placeholder="ระบุประเภทสินค้าของหมวดหมู่ที่เลือก">
                                <span id="warning_cat_sub_name"></span>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="submit_cat">&nbsp;</label>
                                <button type="button" id="submit_cat_sub" class="btn btn-primary d-block" onclick="cat_sub_submit()">บันทึก</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table" id="table_sub_cat">
                            <thead>
                            <tr class="text-nowrap">
                                <th>หมวดหมู่</th>
                                <th>ประเภท</th>
                                <th>แก้ไข</th>
                                <th>ลบ</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    </div>
            </div>
            <!-- / Content -->
            <!-- modal edit -->
            <!-- Modal -->
          <div class="modal fade" id="modal_edit" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog">
              <form class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="backDropModalTitle">เปลี่ยนแปลงข้อมูล</h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col mb-3" id="modal_edit_content"> 
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    ยกเลิก
                  </button>
                  <button type="button" id="modal_edit_submit" class="btn btn-primary">ยืนยัน</button>
                </div>
              </form>
            </div>
          </div> 
<?php include("foot.php"); ?>
<script>
    
 
    window.onload = function() {
        preload_page();
	}

    async function preload_page(){
        await chk_category();
        await chk_sub_category();
    }

    function chk_category(){
        return new Promise((resolve) => { 
            fetch('../api/category?chk_category', {
            method: 'POST',
            body: JSON.stringify({
            case: 'chk_category'
            })
            })
            .then(function (response) {
                fetch_status = response.status;
                return response.json();
            }) 
            .then(function (json) {
                $('#table_cat tbody').empty();
                $('#select_cat').empty();
                json.forEach(function(j){ 
                    if (typeof j.cat_name !== 'undefined') {  
                        let optionElement = $('<option>').attr('value', j.cat_id).text(j.cat_name);
                        $('#select_cat').append(optionElement);
                        let table_cat_detail;
                        if(parseInt(j.sub_category_count)==0){
                        table_cat_detail = '<tr><td>'+j.cat_name+'</td><td><button class="btn btn-sm btn-warning text-center" onclick="edit_cat(\''+j.cat_id+'\',\''+j.cat_name+'\',\'หมวดหมู่\')"><i class="menu-icon tf-icons bx bx-edit-alt" ></i></button></td><td><button onclick="del_cat(\''+j.cat_id+'\',\''+j.cat_name+'\')" class="btn btn-sm btn-danger text-center"><i class="menu-icon tf-icons bx bx-trash" ></i></button></td></tr>';
                        }else{
                        table_cat_detail = '<tr><td>'+j.cat_name+'</td><td><button class="btn btn-sm btn-warning text-center" onclick="edit_cat(\''+j.cat_id+'\',\''+j.cat_name+'\',\'หมวดหมู่\')"><i class="menu-icon tf-icons bx bx-edit-alt" ></i></button></td><td><font color="silver">ไม่สามารถลบได้เนื่องจากมีประเภทสินค้าที่ใช้หมวดหมู่นี้</font></td></tr>';
                        }
                        $('#table_cat tbody').append(table_cat_detail);
                    }  
                });
                resolve("done");
            })
            .catch(error => console.error(error));
        });
    }

    function chk_sub_category(){
        return new Promise((resolve) => { 
            fetch('../api/category?chk_sub_category', {
            method: 'POST',
            body: JSON.stringify({
            case: 'chk_sub_category'
            })
            })
            .then(function (response) {
                fetch_status = response.status;
                return response.json();
            }) 
            .then(function (json) {
                $('#table_sub_cat tbody').empty();
                json.forEach(function(j){ 
                    if (typeof j.cat_sub_name !== 'undefined') {  
                        //let optionElement = $('<option>').attr('value', j.cat_id).text(j.cat_name);
                        //$('#select_cat').append(optionElement);
                        let table_cat_sub_detail; 
                        if(parseInt(j.product_count)==0){
                        table_cat_detail = '<tr><td>'+j.cat_name+'</td><td>'+j.cat_sub_name+'</td><td><button class="btn btn-sm btn-warning text-center" onclick="edit_cat(\''+j.cat_sub_id+'\',\''+j.cat_sub_name+'\',\'ประเภท\')"><i class="menu-icon tf-icons bx bx-edit-alt" ></i></button></td><td><button class="btn btn-sm btn-danger text-center" onclick="del_sub_cat(\''+j.cat_sub_id+'\',\''+j.cat_sub_name+'\')"><i class="menu-icon tf-icons bx bx-trash" ></i></button></td></tr>';
                        }else{
                        table_cat_detail = '<tr><td>'+j.cat_name+'</td><td>'+j.cat_sub_name+'</td><td><button class="btn btn-sm btn-warning text-center" onclick="edit_cat(\''+j.cat_sub_id+'\',\''+j.cat_sub_name+'\',\'ประเภท\')"><i class="menu-icon tf-icons bx bx-edit-alt" ></i></button></td><td><font color="silver">ไม่สามารถลบได้เนื่องจากมีสินค้าที่ใช้ประเภทนี้</font></td></tr>';
                        }
                        $('#table_sub_cat tbody').append(table_cat_detail);
                    }  
                });
                resolve("done");
            })
            .catch(error => console.error(error));
        });
    }

    function cat_submit(){
		let cat_name = $("#inp_cat_name").val(); 
		if(cat_name.length==0){ 
            $("#warning_cat_name").html('<font color="red">กรุณาระบุหมวดหมู่สินค้า</font>'); 
        }else if(cat_name.length>2){
            $("#warning_cat_name").html(''); 
			fetch('../api/category?add_category', {
			      method: 'POST',
			      body: JSON.stringify({
			       case: 'add_category',
			       cat_name:cat_name
			    })
			    })
			    .then(function (response) {
			        fetch_status = response.status;
			        return response.json();
			    }) 
			    .then(function (json) {
			        if(json[0].status=='0'){
                        alert_snackbar('error',json[0].error_message);
			        }else{
                        alert_snackbar('success',"เพิ่มหมวดหมู่ใหม่เรียบร้อยแล้ว");
			        	chk_category();
			        }
			    })
			    .catch(error => console.error(error));
		}
	}

    function del_cat(cat_id,val){
        $("#modal_confirm_text").html("ต้องการ<b>ลบรายการ</b>หมวดหมู่ <b>\""+val+"\"</b>  ใช่หรือไม่")
        $("#modal_confirm_submit").attr("onclick","submit_del_cat('"+cat_id+"');");
        $("#modal_confirm").modal("show");
    }

    function submit_del_cat(cat_id){
        fetch('../api/category?del_category', {
            method: 'POST',
            body: JSON.stringify({
            case: 'del_category',
            cat_id:cat_id
        })
        })
        .then(function (response) {
            fetch_status = response.status;
            return response.json();
        }) 
        .then(function (json) {
            if(json[0].status=='0'){
                alert_snackbar('error',json[0].error_message)
            }else{
                alert_snackbar('success',"ลบหมวดหมู่เรียบร้อยแล้ว");
                chk_category();
            }
            $("#modal_confirm").modal("hide");
        })
        .catch(error => console.error(error));
    }


    function cat_sub_submit(){
		let cat_sub_name = $("#inp_cat_sub_name").val(); 
        let select_cat_id = $("#select_cat").val(); 

        if(select_cat_id.length==0){
            $("#warning_cat_sub_name").html('<font color="red">กรุณาระบุประเภทสินค้า</font>'); 
        }else if(cat_sub_name.length==0){ 
            $("#warning_cat_sub_name").html('<font color="red">กรุณาระบุประเภทสินค้า</font>'); 
        }else if(cat_sub_name.length>2){
            $("#warning_cat_sub_name").html(''); 
			fetch('../api/category?add_sub_category', {
			      method: 'POST',
			      body: JSON.stringify({
			       case: 'add_sub_category',
			       cat_sub_name:cat_sub_name,
                   cat_id:select_cat_id
			    })
			    })
			    .then(function (response) {
			        fetch_status = response.status;
			        return response.json();
			    }) 
			    .then(function (json) {
			        if(json[0].status=='0'){
                        alert_snackbar('error',json[0].error_message);
			        }else{
                        alert_snackbar('success',"เพิ่มประเภทใหม่เรียบร้อยแล้ว");
			        	preload_page();
			        }
			    })
			    .catch(error => console.error(error));
		}
	}
    
    function del_sub_cat(cat_sub_id,val){
        $("#modal_confirm_text").html("ต้องการ<b>ลบรายการ</b>ประเภท <b>\""+val+"\"</b>  ใช่หรือไม่")
        $("#modal_confirm_submit").attr("onclick","submit_del_cat_sub('"+cat_sub_id+"');");
        $("#modal_confirm").modal("show");
    }

    function submit_del_cat_sub(cat_sub_id){
        fetch('../api/category?del_sub_category', {
            method: 'POST',
            body: JSON.stringify({
            case: 'del_sub_category',
            cat_sub_id:cat_sub_id
        })
        })
        .then(function (response) {
            fetch_status = response.status;
            return response.json();
        }) 
        .then(function (json) {
            if(json[0].status=='0'){
                alert_snackbar('error',json[0].error_message)
            }else{
                alert_snackbar('success',"ลบประเภทเรียบร้อยแล้ว");
                preload_page();
            }
            $("#modal_confirm").modal("hide");
        })
        .catch(error => console.error(error));
    }

    function edit_cat(id,val,type){
        $("#modal_edit_content").html("ต้องการเปลี่ยนแปลง"+type+" <b>\""+val+"\" </b>? <br><br>กรุณาระบุข้อความที่ต้องการเปลี่ยนแล้วกดยืนยัน <br><input class='form-control form-control-sm' id='inp_change_cat' value=\""+val+"\"><span id='warning_edit'></span>");
        $("#modal_edit_submit").attr("onclick","submit_change_cat('"+id+"','"+type+"')");
        $("#modal_edit").modal("show");
    }

    function submit_change_cat(id,type){
        let val_change = $("#inp_change_cat").val();
        if(val_change.length==0){
            $("#warning_edit").html('<font color="red">กรุณาระบุข้อความ</font>'); 
            return false;
        }

        fetch('../api/category?change_category', {
            method: 'POST',
            body: JSON.stringify({
            case: 'change_category',
            id:id,
            type:type,
            val:val_change
        })
        })
        .then(function (response) {
            fetch_status = response.status;
            return response.json();
        }) 
        .then(function (json) {
            if(json[0].status=='0'){
                alert_snackbar('error',json[0].error_message)
            }else{
                preload_page();
            }
            $("#modal_edit").modal("hide");
        })
        .catch(error => console.error(error));
    }

</script>