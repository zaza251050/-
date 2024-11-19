<?php
require_once('config.php');

// กำหนดค่าเริ่มต้นสำหรับตัวแปรทั้งหมด
$name1 = $lname1 = $phone1 = $address1 = $province1 = $tambon1 = $sub1 = $post1 = $date1 = '';
$name2 = $lname2 = $phone2 = $address2 = $province2 = $tambon2 = $sub2 = $post2 = $date2 = '';

// ดึงข้อมูลที่ต้องการแก้ไขจากฐานข้อมูล
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // ดึงข้อมูลจากฐานข้อมูล
        $select_stmt = $dbcon->prepare("SELECT * FROM `post` WHERE id = :id");
        $select_stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // แสดงข้อมูลในฟอร์ม
            $name1 = $row['sender_firstname'];
            $lname1 = $row['sender_lastname'];
            $phone1 = $row['sender_phone'];
            $address1 = $row['sender_address'];
            $province1 = $row['sender_province'];
            $tambon1 = $row['sender_amphoe'];
            $sub1 = $row['sender_subdistrict'];
            $post1 = $row['sender_postcode'];
            $date1 = $row['sender_date'];

            $name2 = $row['reciever_firstname'];
            $lname2 = $row['receiver_lastname'];
            $phone2 = $row['receiver_phone'];
            $address2 = $row['receiver_address'];
            $province2 = $row['receiver_province'];
            $tambon2 = $row['receiver_amphoe'];
            $sub2 = $row['receiver_subdistrict'];
            $post2 = $row['receiver_postcode'];
            $date2 = $row['receiver_date'];
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// ตรวจสอบเมื่อมีการส่งฟอร์มเพื่ออัปเดตข้อมูล
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $fname1 = $_POST['fname1'];
    $lname1 = $_POST['lname1'];
    $phone1 = $_POST['phone1'];
    $address1 = $_POST['address1'];
    $province1 = $_POST['province1'];
    $tambon1 = $_POST['tambon1'];
    $sub1 = $_POST['sub1'];
    $post1 = $_POST['post1'];
    $date1 = $_POST['date1'];

    $fname2 = $_POST['fname2'];
    $lname2 = $_POST['lname2'];
    $phone2 = $_POST['phone2'];
    $address2 = $_POST['address2'];
    $province2 = $_POST['province2'];
    $tambon2 = $_POST['tambon2'];
    $sub2 = $_POST['sub2'];
    $post2 = $_POST['post2'];
    $date2 = $_POST['date2'];

    try {
        // อัปเดตข้อมูลในฐานข้อมูล
        $update_stmt = $dbcon->prepare("UPDATE `post` SET
            sender_firstname = :fname1,
            sender_lastname = :lname1,
            sender_phone = :phone1,
            sender_address = :address1,
            sender_province = :province1,
            sender_amphoe = :tambon1,
            sender_subdistrict = :sub1,
            sender_postcode = :post1,
            sender_date = :date1,
            reciever_firstname = :fname2,
            receiver_lastname = :lname2,
            receiver_phone = :phone2,
            receiver_address = :address2,
            receiver_province = :province2,
            receiver_amphoe = :tambon2,
            receiver_subdistrict = :sub2,
            receiver_postcode = :post2,
            receiver_date = :date2
            WHERE id = :id");

        // Binding parameters
        $update_stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $update_stmt->bindParam(':fname1', $fname1);
        $update_stmt->bindParam(':lname1', $lname1);
        $update_stmt->bindParam(':phone1', $phone1);
        $update_stmt->bindParam(':address1', $address1);
        $update_stmt->bindParam(':province1', $province1);
        $update_stmt->bindParam(':tambon1', $tambon1);
        $update_stmt->bindParam(':sub1', $sub1);
        $update_stmt->bindParam(':post1', $post1);
        $update_stmt->bindParam(':date1', $date1);
        $update_stmt->bindParam(':fname2', $fname2);
        $update_stmt->bindParam(':lname2', $lname2);
        $update_stmt->bindParam(':phone2', $phone2);
        $update_stmt->bindParam(':address2', $address2);
        $update_stmt->bindParam(':province2', $province2);
        $update_stmt->bindParam(':tambon2', $tambon2);
        $update_stmt->bindParam(':sub2', $sub2);
        $update_stmt->bindParam(':post2', $post2);
        $update_stmt->bindParam(':date2', $date2);

        if ($update_stmt->execute()) {
            echo "<script>alert('ข้อมูลถูกอัปเดตเรียบร้อยแล้ว!'); window.location.href='select.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล');</script>";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูล</title>
</head>
<body>

<h2>แก้ไขข้อมูลผู้ส่งและผู้รับ</h2>

<form class="row g-3 needs-validation" method="POST" action="update.php?id=<?php echo $id; ?>" novalidate>
    <h1>ผู้ส่ง</h1>
    <div class="col-md-4">
        <label for="validationCustom01" class="form-label">ชื่อจริง</label>
        <input type="text" class="form-control" id="validationCustom01" value="<?php echo $name1; ?>" required name="fname1">
        <div class="invalid-feedback">Please enter first name</div>
    </div>
    <div class="col-md-4">
        <label for="validationCustom02" class="form-label">นามสกุล</label>
        <input type="text" class="form-control" id="validationCustom02" value="<?php echo $lname1; ?>" required name="lname1">
        <div class="invalid-feedback">Please enter last name</div>
    </div>
    <div class="col-md-4">
        <label for="validationCustom02" class="form-label">เบอร์โทร</label>
        <input type="text" class="form-control" id="validationCustom02" value="<?php echo $phone1; ?>" required name="phone1">
        <div class="invalid-feedback">Please enter phone</div>
    </div>
    <div class="col-md-3">
        <label for="validationCustom03" class="form-label">บ้านเลขที่และหมู่</label>
        <input type="text" class="form-control" id="validationCustom03" value="<?php echo $address1; ?>" required name="address1">
        <div class="invalid-feedback">Please enter address</div>
    </div>
    <div class="col-md-3">
    <label for="sender-province">จังหวัด (Sender):</label>
  <select id="sender-province" name="sender_province" onchange="updateAmphoe('sender')" required>
    <option value="<?php echo $province1; ?>"><?php echo $province1; ?></option>
    <!-- ตัวเลือกอื่นๆ จะถูกเพิ่มจากการดึงข้อมูลจังหวัด -->
  </select>
  
  <label for="sender-amphoe">อำเภอ (Sender):</label>
  <select id="sender-amphoe" name="sender_amphoe" onchange="updateTambon('sender')" required>
    <option value="<?php echo $tambon1; ?>"><?php echo $tambon1; ?></option>
    <!-- ตัวเลือกอำเภอจะถูกเพิ่มจากการดึงข้อมูล -->
  </select>
  
  <label for="sender-subdistrict">ตำบล (Sender):</label>
  <select id="sender-subdistrict" name="sender_subdistrict" required>
    <option value="<?php echo $sub1; ?>"><?php echo $sub1; ?></option>
    <!-- ตัวเลือกตำบลจะถูกเพิ่มจากการดึงข้อมูล -->
  </select>
    </div>
    <div class="col-md-4">
        <label for="validationCustom02" class="form-label">รหัสไปรษณีย์</label>
        <input type="text" class="form-control" id="validationCustom02" value="<?php echo $post1; ?>" required name="post1">
        <div class="invalid-feedback">Please enter post code</div>
    </div>
    <div class="col-md-4">
        <label for="validationCustom02" class="form-label">วันที่</label>
        <input type="date" class="form-control" id="validationCustom02" value="<?php echo $date1; ?>" required name="date1">
        <div class="invalid-feedback">Please enter date</div>
    </div>

    <h1>ผู้รับ</h1>
    <div class="col-md-4">
        <label for="validationCustom01" class="form-label">ชื่อจริง</label>
        <input type="text" class="form-control" id="validationCustom01" value="<?php echo $name2; ?>" required name="fname2">
        <div class="invalid-feedback">Please enter first name</div>
    </div>
    <div class="col-md-4">
        <label for="validationCustom02" class="form-label">นามสกุล</label>
        <input type="text" class="form-control" id="validationCustom02" value="<?php echo $lname2; ?>" required name="lname2">
        <div class="invalid-feedback">Please enter last name</div>
    </div>
    <div class="col-md-4">
        <label for="validationCustom02" class="form-label">เบอร์โทร</label>
        <input type="text" class="form-control" id="validationCustom02" value="<?php echo $phone2; ?>" required name="phone2">
        <div class="invalid-feedback">Please enter phone</div>
    </div>
    <div class="col-md-3">
        <label for="validationCustom03" class="form-label">บ้านเลขที่และหมู่</label>
        <input type="text" class="form-control" id="validationCustom03" value="<?php echo $address2; ?>" required name="address2">
        <div class="invalid-feedback">Please enter address</div>
    </div>
    <div class="col-md-3">
    <label for="receiver-province">จังหวัด (Receiver):</label>
  <select id="receiver-province" name="receiver_province" onchange="updateAmphoe('receiver')" required>
    <option value="<?php echo $province2; ?>"><?php echo $province2; ?></option>
    <!-- ตัวเลือกจังหวัดจะถูกเพิ่มจากการดึงข้อมูล -->
  </select>
  
  <label for="receiver-amphoe">อำเภอ (Receiver):</label>
  <select id="receiver-amphoe" name="receiver_amphoe" onchange="updateTambon('receiver')" required>
    <option value="<?php echo $tambon2; ?>"><?php echo $tambon2; ?></option>
    <!-- ตัวเลือกอำเภอจะถูกเพิ่มจากการดึงข้อมูล -->
  </select>
  
  <label for="receiver-subdistrict">ตำบล (Receiver):</label>
  <select id="receiver-subdistrict" name="receiver_subdistrict" required>
    <option value="<?php echo $sub2; ?>"><?php echo $sub2; ?></option>
    <!-- ตัวเลือกตำบลจะถูกเพิ่มจากการดึงข้อมูล -->
  </select>
    </div>
    <div class="col-md-4">
        <label for="validationCustom02" class="form-label">รหัสไปรษณีย์</label>
        <input type="text" class="form-control" id="validationCustom02" value="<?php echo $post2; ?>" required name="post2">
        <div class="invalid-feedback">Please enter post code</div>
    </div>
    <div class="col-md-4">
        <label for="validationCustom02" class="form-label">วันที่</label>
        <input type="date" class="form-control" id="validationCustom02" value="<?php echo $date2; ?>" required name="date2">
        <div class="invalid-feedback">Please enter date</div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">บันทึก</button>
        <a href="show.php" class="btn btn-secondary">ยกเลิก</a>
    </div>
</form>

<script>
  let provincesData = {};
  fetch("https://raw.githubusercontent.com/kongvut/thai-province-data/master/api_province.json")
    .then(response => response.json())
    .then(data => {
      provincesData = data;
      populateProvinces('sender');
      populateProvinces('receiver');
    })
    .catch(error => console.error("Error loading province data:", error));

  function populateProvinces(formIdPrefix) {
    const provinceSelect = document.getElementById(`${formIdPrefix}-province`);
    provincesData.forEach(province => {
      let option = document.createElement("option");
      option.value = province.id;
      option.textContent = province.name_th;
      provinceSelect.appendChild(option);
    });
  }

  function updateAmphoe(formIdPrefix) {
    const provinceId = document.getElementById(`${formIdPrefix}-province`).value;
    const amphoeSelect = document.getElementById(`${formIdPrefix}-amphoe`);
    const subdistrictSelect = document.getElementById(`${formIdPrefix}-subdistrict`);
    amphoeSelect.innerHTML = "<option value=''>-- เลือกอำเภอ --</option>";
    subdistrictSelect.innerHTML = "<option value=''>-- เลือกตำบล --</option>";
    subdistrictSelect.disabled = true;

    if (!provinceId) {
      amphoeSelect.disabled = true;
      return;
    }
    amphoeSelect.disabled = false;
    fetch("https://raw.githubusercontent.com/kongvut/thai-province-data/master/api_amphure.json")
      .then(response => response.json())
      .then(data => {
        const amphoes = data.filter(amphoe => amphoe.province_id == provinceId);
        amphoes.forEach(amphoe => {
          let option = document.createElement("option");
          option.value = amphoe.id;
          option.textContent = amphoe.name_th;
          amphoeSelect.appendChild(option);
        });
      })
      .catch(error => console.error("Error loading amphoe data:", error));
  }

  function updateTambon(formIdPrefix) {
    const amphoeId = document.getElementById(`${formIdPrefix}-amphoe`).value;
    const subdistrictSelect = document.getElementById(`${formIdPrefix}-subdistrict`);
    subdistrictSelect.innerHTML = "<option value=''>-- เลือกตำบล --</option>";

    if (!amphoeId) {
      subdistrictSelect.disabled = true;
      return;
    }
    subdistrictSelect.disabled = false;
    fetch("https://raw.githubusercontent.com/kongvut/thai-province-data/master/api_tambon.json")
      .then(response => response.json())
      .then(data => {
        const tambons = data.filter(tambon => tambon.amphure_id == amphoeId);
        tambons.forEach(tambon => {
          let option = document.createElement("option");
          option.value = tambon.id;
          option.textContent = tambon.name_th;
          subdistrictSelect.appendChild(option);
        });
      })
      .catch(error => console.error("Error loading tambon data:", error));
  }
</script>
</body>
</html>

<?php

?>