<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    // ดึงข้อมูลจากฟอร์ม ชุดที่ 1
    $name1 = htmlspecialchars($_GET['fname1']);
    $lname1 = htmlspecialchars($_GET['lname1']);
    $phone1 = htmlspecialchars($_GET['phone1']);
    $address1 = htmlspecialchars($_GET['address1']);
    $province1 = htmlspecialchars($_GET['province1']);
    $tambon1 = htmlspecialchars($_GET['tambon1']);
    $sub1 = htmlspecialchars($_GET['sub1']);
    $post1 = htmlspecialchars($_GET['post1']);
    $date1 = htmlspecialchars($_GET['date1']);

    // ดึงข้อมูลจากฟอร์ม ชุดที่ 2
    $name2 = htmlspecialchars($_GET['fname2']);
    $lname2 = htmlspecialchars($_GET['lname2']);
    $phone2 = htmlspecialchars($_GET['phone2']);
    $address2 = htmlspecialchars($_GET['address2']);
    $province2 = htmlspecialchars($_GET['province2']);
    $tambon2 = htmlspecialchars($_GET['tambon2']);
    $sub2 = htmlspecialchars($_GET['sub2']);
    $post2 = htmlspecialchars($_GET['post2']);

    // โหลดข้อมูล JSON จากไฟล์
    $provincesJson = file_get_contents('data/thai_provinces.json');
    $districtsJson = file_get_contents('data/thai_amphures.json');
    $subdistrictsJson = file_get_contents('data/thai_tambons.json');

    if ($provincesJson === false || $districtsJson === false || $subdistrictsJson === false) {
        die("ไม่สามารถโหลดข้อมูลจากไฟล์ JSON ได้");
    }

    $provinces = json_decode($provincesJson, true);
    $districts = json_decode($districtsJson, true);
    $subdistricts = json_decode($subdistrictsJson, true);

    if ($provinces === null || $districts === null || $subdistricts === null) {
        die("เกิดข้อผิดพลาดในการแปลง JSON");
    }

    // ฟังก์ชันเพื่อหาชื่อจังหวัดจาก ID
    function getProvinceName($provinceId, $provinces) {
        foreach ($provinces as $province) {
            if (isset($province['id']) && $province['id'] == $provinceId) {
                return isset($province['name_th']) ? $province['name_th'] : 'ไม่พบข้อมูลจังหวัด';
            }
        }
        return 'ไม่พบข้อมูลจังหวัด';
    }

    // ฟังก์ชันเพื่อหาชื่ออำเภอจาก ID
    function getDistrictName($districtId, $districts) {
        foreach ($districts as $district) {
            if (isset($district['id']) && $district['id'] == $districtId) {
                return isset($district['name_th']) ? $district['name_th'] : 'ไม่พบข้อมูลอำเภอ';
            }
        }
        return 'ไม่พบข้อมูลอำเภอ';
    }

    // ฟังก์ชันเพื่อหาชื่อตำบลจาก ID
    function getSubdistrictName($subdistrictId, $subdistricts) {
        foreach ($subdistricts as $subdistrict) {
            if (isset($subdistrict['id']) && $subdistrict['id'] == $subdistrictId) {
                return isset($subdistrict['name_th']) ? $subdistrict['name_th'] : 'ไม่พบข้อมูลตำบล';
            }
        }
        return 'ไม่พบข้อมูลตำบล';
    }

    // แปลง province1, tambon1, sub1 จาก id เป็นชื่อ
    $provinceName1 = getProvinceName($province1, $provinces);
    $districtName1 = getDistrictName($tambon1, $districts);
    $subdistrictName1 = getSubdistrictName($sub1, $subdistricts);

    // แปลง province2, tambon2, sub2 จาก id เป็นชื่อ
    $provinceName2 = getProvinceName($province2, $provinces);
    $districtName2 = getDistrictName($tambon2, $districts);
    $subdistrictName2 = getSubdistrictName($sub2, $subdistricts);

    // เริ่มต้นการแสดงผลแบบจ่าหน้าซองจดหมาย
    echo "<div class='letter-container'>";

    // ข้อมูลชุดที่ 2 (ที่อยู่ผู้ส่ง)
    echo "<div class='sender'>";
    echo "<h2 class='eiei'>ข้อมูลผู้ส่ง</h2>";
    echo "<p><strong>ชื่อ:</strong> $name2 $lname2</p>";
    echo "<p><strong>ที่อยู่:</strong> $address2, $subdistrictName2, $districtName2, $provinceName2 $post2</p>";
    echo "<p><strong>โทรศัพท์:</strong> $phone2</p>";
    echo "</div>";

    // ข้อมูลชุดที่ 1 (ที่อยู่ของผู้รับ)
    echo "<div class='recipient'>";
    echo "<h2>ข้อมูลผู้รับ</h2>";
    echo "<p><strong>ชื่อ:</strong> $name1 $lname1</p>";
    echo "<p><strong>ที่อยู่:</strong> $address1, $subdistrictName1, $districtName1, $provinceName1 $post1</p>";
    echo "<p><strong>โทรศัพท์:</strong> $phone1</p>";
    echo "<p><strong>วันที่:</strong> $date1</p>";
    echo "</div>";

    echo "</div>";
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
    }

    .letter-container {
        width: 70%;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 400px; /* ปรับความสูงตามต้องการ */
    }

    .sender, .recipient {
        margin-bottom: 30px;
        flex: 1;
    }

    h2 {
        text-align: right;
        color: #007BFF; /* สีหัวข้อ */
    }
    .eiei {
        text-align: left;
        color: #007BFF; /* สีหัวข้อ */
    }

    p {
        margin: 5px 0;
        font-size: 14px;
    }

    .recipient {
        text-align: right;
        border-top: 2px dashed #000;
        padding-top: 20px;
    }

    .sender {
        text-align: left;
    }
</style>