<?php
  session_start();
  require 'classes/PHPExcel.php';
  require 'dbconfig.php';

  $check= $_SESSION['username'];
  $check1=$_SESSION['password'];
  if($check != true && $check1 != true)
  {
    // $messg = 'Invalid Username and Password';
    // echo "$messg";
    header("Location: login.php");
  }

  $sql = 'SELECT * FROM employee';
  $statement = $conn->prepare($sql);
  $statement->execute();
  $people = $statement->fetchAll(PDO::FETCH_OBJ);

  if(isset($_POST['btnExport'])){
      $objExcel = new PHPExcel;
      $objExcel->setActiveSheetIndex(0);
      $sheet = $objExcel->getActiveSheet()->setTitle('10A1');

      $rowCount = 1;
      $sheet->setCellValue('A'.$rowCount, 'Id');
      $sheet->setCellValue('B'.$rowCount, 'Tên');
      $sheet->setCellValue('C'.$rowCount, 'Giới tính');
      $sheet->setCellValue('D'.$rowCount, 'SĐT');
      $sheet->setCellValue('E'.$rowCount, 'Chức vụ');
      $sheet->setCellValue('F'.$rowCount, 'Ngày sinh');
      $sheet->setCellValue('G'.$rowCount, 'Email');
      $sheet->setCellValue('H'.$rowCount, 'Địa chỉ');
      $sheet->setCellValue('I'.$rowCount, 'Lương');

      foreach($people as $person):
        $rowCount++;
        $sheet->setCellValue('A'.$rowCount, $person->id);
        $sheet->setCellValue('B'.$rowCount, $person->ten);
        $sheet->setCellValue('c'.$rowCount, $person->gioi_tinh);
        $sheet->setCellValue('D'.$rowCount, $person->sdt);
        $sheet->setCellValue('E'.$rowCount, $person->chuc_vu);
        $sheet->setCellValue('F'.$rowCount, $person->ngay_sinh);
        $sheet->setCellValue('G'.$rowCount, $person->email);
        $sheet->setCellValue('H'.$rowCount, $person->dia_chi);
        $sheet->setCellValue('I'.$rowCount, $person->luong);
      endforeach;

      $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
      $filename = 'nhanvien.xlsx';
      $objWriter->save($filename);
      
      header('Content-Disposition: attachment; filename="' .$filename. '"');
      header('Content-Type: application/vn.openxmlformatsofficedocument.spreadsheetml.sheet');
      header('Content-Length: ' .filesize($filename));
      header('Content-Transfer-Encoding: binary');
      header('Cache-Control: must-revalidate');
      header('Pragma: no-cache');
      readfile($filename);
      return;
  }
  
?>

<?php 
    include('includes/header.php');
    include('includes/navbar.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <form method="post"><button name="btnExport" type="submit" class="btn btn-success">Xuất ra file
                    excel</button></form>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 align="center" class="m-0 font-weight-bold text-primary">Danh sách nhân viên</h4>
        </div>
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>ID</th>
                        <th>TÊN NV</th>
                        <th>GIỚI TÍNH</th>
                        <th>SĐT</th>
                        <th>CHỨC VỤ</th>
                        <th>NGÀY SINH</th>
                        <th>EMAIL</th>
                        <th>ĐỊA CHỈ</th>
                        <th>LƯƠNG</th>
                        <th>CHỨC NĂNG</th>
                    </tr>
                    <?php foreach($people as $person): ?>
                    <tr>
                        <td><?= $person->id; ?></td>
                        <td><?= $person->ten; ?></td>
                        <td><?= $person->gioi_tinh; ?></td>
                        <td><?= $person->sdt; ?></td>
                        <td><?= $person->chuc_vu; ?></td>
                        <td><?= $person->ngay_sinh; ?></td>
                        <td><?= $person->email; ?></td>
                        <td><?= $person->dia_chi; ?></td>
                        <td><?= $person->luong; ?> vnđ</td>
                        <td>
                            <a href="update.php?id=<?= $person->id ?>" class="btn btn-info">Update</a>
                            <a onclick="return confirm('Bạn có chắc chắn xóa nhân viên?')"
                                href="delete.php?id=<?= $person->id ?>" class='btn btn-danger'>Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>

            </div>
        </div>
    </div>

    <?php 
  include('includes/scripts.php');
  include('includes/footer.php');
?>