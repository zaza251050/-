<?php
    include('config.php');
    $firstname_a = $_GET['firstname_a'];
    $lastname_a = $_GET['lastname_a'];
    $phonenumber_a = $_GET['phonenumber_a'];
    $name_a = $_GET['name_a'];
    $province_a = $_GET['province_a'];
    $district_a = $_GET['district_a'];
    $Subdistrict_a = $_GET['Subdistrict_a'];
    $s_a = $_GET['s_a'];
    $o_a = $_GET['o_a'];
    $firstname_b = $_GET['firstname_b'];
    $lastname_b = $_GET['lastname_b'];
    $phonenumber_b = $_GET['phonenumber_b'];
    $name_b = $_GET['name_b'];
    $province_b = $_GET['province_b'];
    $district_b = $_GET['district_b'];
    $Subdistrict_b = $_GET['Subdistrict_b'];
    $s_b = $_GET['s_b'];
    $o_b = $_GET['O_b'];
    $sql ="INSERT INTO post office_as(firstname_a,lastname_a,phonenumber_a,name_a,province_a,district_a,Subdistrict_a,s_a,o_a,firstname_b,lastname_b,phonenumber_b,name_b,province_b,district_b,Subdistrict_b,s_b,o_b')
     VALUES(:firstname_a, :lastname_a, :phonenumber_a, :name_a, :province_a, :district_a, :Subdistrict_a, :s_a, :o_a, :firstname_b, :lastname_b, :phonenumber_b, :name_b, :province_b, :district_b, :Subdistrict_b, :s_b, :o_b)";
    $query = $dbcon->prepare($sql);
    $query->bindParam(':firstname_a', $firstname_a, PDO::PARAM_STR);
    $query->bindParam(':lastname_a', $lastname_a, PDO::PARAM_STR);
    $query->bindParam(':phonenumber_a', $phonenumber_a, PDO::PARAM_STR);
    $query->bindParam(':name_a', $name_a, PDO::PARAM_STR);
    $query->bindParam(':province_a', $province_a, PDO::PARAM_STR);
    $query->bindParam(':Subdistrict_a', $Subdistrict_a, PDO::PARAM_STR);
    $query->bindParam(':s_a', $s_a, PDO::PARAM_STR);
    $query->bindParam(':o_a', $o_a, PDO::PARAM_STR);
    $query->bindParam(':firstname_b', $firstname_b, PDO::PARAM_STR);
    $query->bindParam(':lastname_b', $lastname_b, PDO::PARAM_STR);
    $query->bindParam(':phonenumber_b', $phonenumber_b, PDO::PARAM_STR);
    $query->bindParam(':name_b', $name_b, PDO::PARAM_STR);
    $query->bindParam(':province_b', $province_b, PDO::PARAM_STR);
    $query->bindParam(':Subdistrict_a', $Subdistrict_a, PDO::PARAM_STR);
    $query->bindParam(':unit', $unit, PDO::PARAM_STR);
    $query->bindParam(':price', $price, PDO::PARAM_STR);
    $query->bindParam(':unit', $unit, PDO::PARAM_STR);
    $query->bindParam(':price', $price, PDO::PARAM_STR);
      
      $result = $query->execute ();
      if ($result) {
          echo "<script>
                    alert('เพิ่มข้อมูลเรียบร้อย');
                    window.location='select.php';
                </script>";
      } else {
          echo "<script>alert('มีบางอย่างผิดพลาด');</script>";
      
      }