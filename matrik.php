<!DOCTYPE html>
<html lang="en">
<?php
require "layout/head.php";
require "include/conn.php";
?>

<body>
  <div id="app">
    <?php require "layout/sidebar.php"; ?>
    <div id="main">
      <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
          <i class="bi bi-justify fs-3"></i>
        </a>
      </header>
      <div class="page-heading">
        <h3>Matrik</h3>
      </div>
      <div class="page-content">
        <section class="row">
          <div class="col-12">
            <div class="card">

              <div class="card-header">
                <h4 class="card-title">Matriks Keputusan (X) &amp; Ternormalisasi (R)</h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <p class="card-text">Melakukan perhitungan normalisasi untuk mendapatkan matriks nilai ternormalisasi (R), dengan ketentuan :
                    Untuk normalisai nilai, jika faktor/attribute kriteria bertipe cost maka digunakan rumusan:
                    Rij = ( min{Xij} / Xij)
                    sedangkan jika faktor/attribute kriteria bertipe benefit maka digunakan rumusan:
                    Rij = ( Xij/max{Xij} )</p>
                </div>
                <button type="button" class="btn btn-outline-success btn-sm m-2" data-bs-toggle="modal" data-bs-target="#inlineForm">
                  Isi Nilai Alternatif
                </button>
                <div class="table-responsive">
                  <table class="table table-striped mb-0">
                    <caption>
                      Matrik Keputusan(X)
                    </caption>
                    <tr>
                      <th rowspan='2'>Alternatif</th>
                      <th colspan='10'>Kriteria</th>
                    </tr>
                    <tr>
                      <th>C1</th>
                      <th>C2</th>
                      <th>C3</th>
                      <th>C4</th>
                      <th>C5</th>
                      <th>C6</th>
                      <th>C7</th>
                      <th>C8</th>
                      <th>C9</th>
                      <th>C10</th>

                      <th colspan="2"></th>
                    </tr>
                    <?php
                    $sql = "SELECT
          a.id_alternatif,
          b.nama_alternatif,
          SUM(IF(a.id_kriteria=1,a.nilai,0)) AS C1,
          SUM(IF(a.id_kriteria=2,a.nilai,0)) AS C2,
          SUM(IF(a.id_kriteria=3,a.nilai,0)) AS C3,
          SUM(IF(a.id_kriteria=4,a.nilai,0)) AS C4,
          SUM(IF(a.id_kriteria=5,a.nilai,0)) AS C5,
          SUM(IF(a.id_kriteria=6,a.nilai,0)) AS C6,
          SUM(IF(a.id_kriteria=7,a.nilai,0)) AS C7,
          SUM(IF(a.id_kriteria=8,a.nilai,0)) AS C8,
          SUM(IF(a.id_kriteria=9,a.nilai,0)) AS C9,
          SUM(IF(a.id_kriteria=10,a.nilai,0)) AS C10
          
        FROM
          nilai_evaluasi a
          JOIN 
          alternatif b 
          USING(id_alternatif)
        GROUP BY a.id_alternatif
        ORDER BY a.id_alternatif";
                    $result = $db->query($sql);
                    $X = array(1 => array(), 2 => array(), 3 => array(), 4 => array(), 5 => array(), 6 => array(), 7 => array(), 8 => array(), 9 => array(), 10 => array(), 11 => array());
                    while ($row = $result->fetch_object()) {
                      array_push($X[1], round($row->C1, 2));
                      array_push($X[2], round($row->C2, 2));
                      array_push($X[3], round($row->C3, 2));
                      array_push($X[4], round($row->C4, 2));
                      array_push($X[5], round($row->C5, 2));
                      array_push($X[6], round($row->C6, 2));
                      array_push($X[7], round($row->C7, 2));
                      array_push($X[8], round($row->C8, 2));
                      array_push($X[9], round($row->C9, 2));
                      array_push($X[10], round($row->C10, 2));


                      echo "<tr class='center'>
  <th>A<sub>{$row->id_alternatif}</sub> {$row->nama_alternatif}</th>
  <td>" . round($row->C1, 2)  . "</td>
  <td>" . round($row->C2, 2) . "</td>
  <td>" . round($row->C3, 2) . "</td>
  <td>" . round($row->C4, 2) . "</td>
  <td>" . round($row->C5, 2) . "</td>
  <td>" . round($row->C6, 2) . "</td>
  <td>" . round($row->C7, 2) . "</td>
  <td>" . round($row->C8, 2) . "</td>
  <td>" . round($row->C9, 2) . "</td>
  <td>" . round($row->C10, 2) . "</td>
  <td>
  <a href='keputusan-hapus.php?id={$row->id_alternatif}' class='btn btn-danger btn-sm'>Hapus</a>
  </td>
  </tr>\n";
                    }
                    $total_C1 = array_sum($X[1]);
                    $total_C2 = array_sum($X[2]);
                    $total_C3 = array_sum($X[3]);
                    $total_C4 = array_sum($X[4]);
                    $total_C5 = array_sum($X[5]);
                    $total_C6 = array_sum($X[6]);
                    $total_C7 = array_sum($X[7]);
                    $total_C8 = array_sum($X[8]);
                    $total_C9 = array_sum($X[9]);
                    $total_C10 = array_sum($X[10]);

                    echo "
  <tr class='center'>
  <th>Total</th>
  <td>" . array_sum($X[1]) . "</td>
  <td>" . array_sum($X[2]) . "</td>
  <td>" . array_sum($X[3]) . "</td>
  <td>" . array_sum($X[4]) . "</td>
  <td>" . array_sum($X[5]) . "</td>
  <td>" . array_sum($X[6]) . "</td>
  <td>" . array_sum($X[7]) . "</td>
  <td>" . array_sum($X[8]) . "</td>
  <td>" . array_sum($X[9]) . "</td>
  <td>" . array_sum($X[10]) . "</td>

  </tr>\n";
                    $result->free();

                    ?>
                  </table><br><br>

                  <table class="table table-striped mb-0">
                    <caption>
                      Normalisasi Matrik X
                    </caption>
                    <tr>
                      <th rowspan='2'>Alternatif</th>
                      <th colspan='10'>Kriteria</th>
                    </tr>
                    <tr>
                      <th>C1</th>
                      <th>C2</th>
                      <th>C3</th>
                      <th>C4</th>
                      <th>C5</th>
                      <th>C6</th>
                      <th>C7</th>
                      <th>C8</th>
                      <th>C9</th>
                      <th>C10</th>
                      <th colspan="2"></th>
                    </tr>
                    <?php
                    $sql = "SELECT
          a.id_alternatif,
          b.nama_alternatif,
          SUM(IF(a.id_kriteria=1,a.nilai,0)) AS C1,
          SUM(IF(a.id_kriteria=2,a.nilai,0)) AS C2,
          SUM(IF(a.id_kriteria=3,a.nilai,0)) AS C3,
          SUM(IF(a.id_kriteria=4,a.nilai,0)) AS C4,
          SUM(IF(a.id_kriteria=5,a.nilai,0)) AS C5,
          SUM(IF(a.id_kriteria=6,a.nilai,0)) AS C6,
          SUM(IF(a.id_kriteria=7,a.nilai,0)) AS C7,
          SUM(IF(a.id_kriteria=8,a.nilai,0)) AS C8,
          SUM(IF(a.id_kriteria=9,a.nilai,0)) AS C9,
          SUM(IF(a.id_kriteria=10,a.nilai,0)) AS C10

        FROM
          nilai_evaluasi a
          JOIN 
          alternatif b 
          USING(id_alternatif)
        GROUP BY a.id_alternatif
        ORDER BY a.id_alternatif";
                    $result = $db->query($sql);
                    $X = array(1 => array(), 2 => array(), 3 => array(), 4 => array(), 5 => array(), 6 => array(), 7 => array(), 8 => array(), 9 => array(), 10 => array());
                    while ($row = $result->fetch_object()) {
                      array_push($X[1], round($row->C1, 2));
                      array_push($X[2], round($row->C2, 2));
                      array_push($X[3], round($row->C3, 2));
                      array_push($X[4], round($row->C4, 2));
                      array_push($X[5], round($row->C5, 2));
                      array_push($X[6], round($row->C6, 2));
                      array_push($X[7], round($row->C7, 2));
                      array_push($X[8], round($row->C8, 2));
                      array_push($X[9], round($row->C9, 2));
                      array_push($X[10], round($row->C10, 2));
                      $normalisasi_C1 = round(($row->C1 / $total_C1), 3);
                      $normalisasi_C2 = round(($row->C2 / $total_C2), 3);
                      $normalisasi_C3 = round(($row->C3 / $total_C3), 3);
                      $normalisasi_C4 = round(($row->C4 / $total_C4), 3);
                      $normalisasi_C5 = round(($row->C5 / $total_C5), 3);
                      $normalisasi_C6 = round(($row->C6 / $total_C6), 3);
                      $normalisasi_C7 = round(($row->C7 / $total_C7), 3);
                      $normalisasi_C8 = round(($row->C8 / $total_C8), 3);
                      $normalisasi_C9 = round(($row->C9 / $total_C9), 3);
                      $normalisasi_C10 = round(($row->C10 / $total_C10), 3);
                      echo "<tr class='center'>
  <th>A<sub>{$row->id_alternatif}</sub> {$row->nama_alternatif}</th>
  <td>" . $normalisasi_C1  . "</td>
  <td>" . $normalisasi_C2  . "</td>
  <td>" . $normalisasi_C3  . "</td>
  <td>" . $normalisasi_C4  . "</td>
  <td>" . $normalisasi_C5  . "</td>
  <td>" . $normalisasi_C6  . "</td>
  <td>" . $normalisasi_C7  . "</td>
  <td>" . $normalisasi_C8  . "</td>
  <td>" . $normalisasi_C9  . "</td>
  <td>" . $normalisasi_C10  . "</td>
  
  </tr>\n";
                    }
                    $result->free();

                    ?>
                  </table><br><br>





                  <table class="table table-striped mb-0">
                    <caption>
                      Matriks Keputusan Berbobot Yang Ternormalisasi
                    </caption>
                    <tr>
                      <th rowspan='2'>Alternatif</th>
                      <th colspan='10'>Kriteria</th>
                    </tr>
                    <tr>
                      <th>C1</th>
                      <th>C2</th>
                      <th>C3</th>
                      <th>C4</th>
                      <th>C5</th>
                      <th>C6</th>
                      <th>C7</th>
                      <th>C8</th>
                      <th>C9</th>
                      <th>C10</th>
                      <th colspan="2"></th>
                    </tr>
                    <?php
                    $sql = "SELECT
          a.id_alternatif,
          b.nama_alternatif,
          SUM(IF(a.id_kriteria=1,a.nilai,0)) AS C1,
          SUM(IF(a.id_kriteria=2,a.nilai,0)) AS C2,
          SUM(IF(a.id_kriteria=3,a.nilai,0)) AS C3,
          SUM(IF(a.id_kriteria=4,a.nilai,0)) AS C4,
          SUM(IF(a.id_kriteria=5,a.nilai,0)) AS C5,
          SUM(IF(a.id_kriteria=6,a.nilai,0)) AS C6,
          SUM(IF(a.id_kriteria=7,a.nilai,0)) AS C7,
          SUM(IF(a.id_kriteria=8,a.nilai,0)) AS C8,
          SUM(IF(a.id_kriteria=9,a.nilai,0)) AS C9,
          SUM(IF(a.id_kriteria=10,a.nilai,0)) AS C10
        FROM
          nilai_evaluasi a
          JOIN 
          alternatif b 
          USING(id_alternatif)
        GROUP BY a.id_alternatif
        ORDER BY a.id_alternatif";
                    $result = $db->query($sql);
                    $sql2 = "SELECT
          bobot_kriteria as bobot,
          Sum(if(id_kriteria = 1, bobot_kriteria, 0)) as B1,
          sum(if(id_kriteria = 2, bobot_kriteria, 0)) as B2,
          sum(if(id_kriteria = 3, bobot_kriteria, 0)) as B3,
          sum(if(id_kriteria = 4, bobot_kriteria, 0)) as B4,
          sum(if(id_kriteria = 5, bobot_kriteria, 0)) as B5,
          sum(if(id_kriteria = 6, bobot_kriteria, 0)) as B6,
          sum(if(id_kriteria = 7, bobot_kriteria, 0)) as B7,
          sum(if(id_kriteria = 8, bobot_kriteria, 0)) as B8,
          sum(if(id_kriteria = 9, bobot_kriteria, 0)) as B9,
          sum(if(id_kriteria = 10, bobot_kriteria, 0)) as B10
        FROM
          kriteria";
                    $result2 = $db->query($sql2);
                    while ($bobot_kriteria = $result2->fetch_object()) {
                      $bobot_C1 = round($bobot_kriteria->B1, 2);
                      $bobot_C2 = round($bobot_kriteria->B2, 2);
                      $bobot_C3 = round($bobot_kriteria->B3, 2);
                      $bobot_C4 = round($bobot_kriteria->B4, 2);
                      $bobot_C5 = round($bobot_kriteria->B5, 2);
                      $bobot_C6 = round($bobot_kriteria->B6, 2);
                      $bobot_C7 = round($bobot_kriteria->B7, 2);
                      $bobot_C8 = round($bobot_kriteria->B8, 2);
                      $bobot_C9 = round($bobot_kriteria->B9, 2);
                      $bobot_C10 = round($bobot_kriteria->B10, 2);
                    }
                    $X = array(1 => array(), 2 => array(), 3 => array(), 4 => array(), 5 => array(), 6 => array(), 7 => array(), 8 => array(), 9 => array(), 10 => array());
                    while ($row = $result->fetch_object()) {
                      array_push($X[1], round($row->C1, 2));
                      array_push($X[2], round($row->C2, 2));
                      array_push($X[3], round($row->C3, 2));
                      array_push($X[4], round($row->C4, 2));
                      array_push($X[5], round($row->C5, 2));
                      array_push($X[6], round($row->C6, 2));
                      array_push($X[7], round($row->C7, 2));
                      array_push($X[8], round($row->C8, 2));
                      array_push($X[9], round($row->C9, 2));
                      array_push($X[10], round($row->C10, 2));
                      $normalisasi_C1 = round(($row->C1 / $total_C1), 3);
                      $normalisasi_C2 = round(($row->C2 / $total_C2), 3);
                      $normalisasi_C3 = round(($row->C3 / $total_C3), 3);
                      $normalisasi_C4 = round(($row->C4 / $total_C4), 3);
                      $normalisasi_C5 = round(($row->C5 / $total_C5), 3);
                      $normalisasi_C6 = round(($row->C6 / $total_C6), 3);
                      $normalisasi_C7 = round(($row->C7 / $total_C7), 3);
                      $normalisasi_C8 = round(($row->C8 / $total_C8), 3);
                      $normalisasi_C9 = round(($row->C9 / $total_C9), 3);
                      $normalisasi_C10 = round(($row->C10 / $total_C10), 3);
                      $bobot_ternormalisasi_C1 = round(($normalisasi_C1 * $bobot_C1), 3);
                      $bobot_ternormalisasi_C2 = round(($normalisasi_C2 * $bobot_C2), 3);
                      $bobot_ternormalisasi_C3 = round(($normalisasi_C3 * $bobot_C3), 3);
                      $bobot_ternormalisasi_C4 = round(($normalisasi_C4 * $bobot_C4), 3);
                      $bobot_ternormalisasi_C5 = round(($normalisasi_C5 * $bobot_C5), 3);
                      $bobot_ternormalisasi_C6 = round(($normalisasi_C6 * $bobot_C6), 3);
                      $bobot_ternormalisasi_C7 = round(($normalisasi_C7 * $bobot_C7), 3);
                      $bobot_ternormalisasi_C8 = round(($normalisasi_C8 * $bobot_C8), 3);
                      $bobot_ternormalisasi_C9 = round(($normalisasi_C9 * $bobot_C9), 3);
                      $bobot_ternormalisasi_C10 = round(($normalisasi_C10 * $bobot_C10), 3);
                      echo "<tr class='center'>
  <th>A<sub>{$row->id_alternatif}</sub> {$row->nama_alternatif}</th>
  <td>" . $bobot_ternormalisasi_C1 . "</td>
  <td>" . $bobot_ternormalisasi_C2 . "</td>
  <td>" . $bobot_ternormalisasi_C3 . "</td>
  <td>" . $bobot_ternormalisasi_C4 . "</td>
  <td>" . $bobot_ternormalisasi_C5 . "</td>
  <td>" . $bobot_ternormalisasi_C6 . "</td>
  <td>" . $bobot_ternormalisasi_C7 . "</td>
  <td>" . $bobot_ternormalisasi_C8 . "</td>
  <td>" . $bobot_ternormalisasi_C9 . "</td>
  <td>" . $bobot_ternormalisasi_C10 . "</td>
  
  
  </tr>\n";
                    }
                    $result->free();

                    ?>
                  </table><br><br>


                  <table class="table table-striped mb-0">
                    <caption>
                      Perhitungan memaksimalkan
                    </caption>
                    <tr>
                      <th colspan='2'>S+i = C2 + C3 + C4 + C5 + C6 + C7 + C8 + C9 + C10</th>
                      <th colspan='2'>Si = C1</th>
                    </tr>
                    <?php
                    $sql = "SELECT
          a.id_alternatif,
          b.nama_alternatif,
          SUM(IF(a.id_kriteria=1,a.nilai,0)) AS C1,
          SUM(IF(a.id_kriteria=2,a.nilai,0)) AS C2,
          SUM(IF(a.id_kriteria=3,a.nilai,0)) AS C3,
          SUM(IF(a.id_kriteria=4,a.nilai,0)) AS C4,
          SUM(IF(a.id_kriteria=5,a.nilai,0)) AS C5,
          SUM(IF(a.id_kriteria=6,a.nilai,0)) AS C6,
          SUM(IF(a.id_kriteria=7,a.nilai,0)) AS C7,
          SUM(IF(a.id_kriteria=8,a.nilai,0)) AS C8,
          SUM(IF(a.id_kriteria=9,a.nilai,0)) AS C9,
          SUM(IF(a.id_kriteria=10,a.nilai,0)) AS C10
        FROM
          nilai_evaluasi a
          JOIN 
          alternatif b 
          USING(id_alternatif)
        GROUP BY a.id_alternatif
        ORDER BY a.id_alternatif";
                    $result = $db->query($sql);
                    $sql2 = "SELECT
          bobot_kriteria as bobot,
          Sum(if(id_kriteria = 1, bobot_kriteria, 0)) as B1,
          sum(if(id_kriteria = 2, bobot_kriteria, 0)) as B2,
          sum(if(id_kriteria = 3, bobot_kriteria, 0)) as B3,
          sum(if(id_kriteria = 4, bobot_kriteria, 0)) as B4,
          sum(if(id_kriteria = 5, bobot_kriteria, 0)) as B5,
          sum(if(id_kriteria = 6, bobot_kriteria, 0)) as B6,
          sum(if(id_kriteria = 7, bobot_kriteria, 0)) as B7,
          sum(if(id_kriteria = 8, bobot_kriteria, 0)) as B8,
          sum(if(id_kriteria = 9, bobot_kriteria, 0)) as B9,
          sum(if(id_kriteria = 10, bobot_kriteria, 0)) as B10
        FROM
          kriteria";
                    $result2 = $db->query($sql2);
                    while ($bobot_kriteria = $result2->fetch_object()) {
                      $bobot_C1 = round($bobot_kriteria->B1, 2);
                      $bobot_C2 = round($bobot_kriteria->B2, 2);
                      $bobot_C3 = round($bobot_kriteria->B3, 2);
                      $bobot_C4 = round($bobot_kriteria->B4, 2);
                      $bobot_C5 = round($bobot_kriteria->B5, 2);
                      $bobot_C6 = round($bobot_kriteria->B6, 2);
                      $bobot_C7 = round($bobot_kriteria->B7, 2);
                      $bobot_C8 = round($bobot_kriteria->B8, 2);
                      $bobot_C9 = round($bobot_kriteria->B9, 2);
                      $bobot_C10 = round($bobot_kriteria->B10, 2);
                    }
                    $X = array(1 => array(), 2 => array(), 3 => array(), 4 => array(), 5 => array(), 6 => array(), 7 => array(), 8 => array(), 9 => array(), 10 => array());
                    $array_cost = array();
                    $array_benefit = array();
                    while ($row = $result->fetch_object()) {
                      array_push($X[1], round($row->C1, 2));
                      array_push($X[2], round($row->C2, 2));
                      array_push($X[3], round($row->C3, 2));
                      array_push($X[4], round($row->C4, 2));
                      array_push($X[5], round($row->C5, 2));
                      array_push($X[6], round($row->C6, 2));
                      array_push($X[7], round($row->C7, 2));
                      array_push($X[8], round($row->C8, 2));
                      array_push($X[9], round($row->C9, 2));
                      array_push($X[10], round($row->C10, 2));
                      $normalisasi_C1 = round(($row->C1 / $total_C1), 3);
                      $normalisasi_C2 = round(($row->C2 / $total_C2), 3);
                      $normalisasi_C3 = round(($row->C3 / $total_C3), 3);
                      $normalisasi_C4 = round(($row->C4 / $total_C4), 3);
                      $normalisasi_C5 = round(($row->C5 / $total_C5), 3);
                      $normalisasi_C6 = round(($row->C6 / $total_C6), 3);
                      $normalisasi_C7 = round(($row->C7 / $total_C7), 3);
                      $normalisasi_C8 = round(($row->C8 / $total_C8), 3);
                      $normalisasi_C9 = round(($row->C9 / $total_C9), 3);
                      $normalisasi_C10 = round(($row->C10 / $total_C10), 3);
                      $bobot_ternormalisasi_C1 = round(($normalisasi_C1 * $bobot_C1), 3);
                      $bobot_ternormalisasi_C2 = round(($normalisasi_C2 * $bobot_C2), 3);
                      $bobot_ternormalisasi_C3 = round(($normalisasi_C3 * $bobot_C3), 3);
                      $bobot_ternormalisasi_C4 = round(($normalisasi_C4 * $bobot_C4), 3);
                      $bobot_ternormalisasi_C5 = round(($normalisasi_C5 * $bobot_C5), 3);
                      $bobot_ternormalisasi_C6 = round(($normalisasi_C6 * $bobot_C6), 3);
                      $bobot_ternormalisasi_C7 = round(($normalisasi_C7 * $bobot_C7), 3);
                      $bobot_ternormalisasi_C8 = round(($normalisasi_C8 * $bobot_C8), 3);
                      $bobot_ternormalisasi_C9 = round(($normalisasi_C9 * $bobot_C9), 3);
                      $bobot_ternormalisasi_C10 = round(($normalisasi_C10 * $bobot_C10), 3);
                      $benefit = $bobot_ternormalisasi_C1 + $bobot_ternormalisasi_C2 + $bobot_ternormalisasi_C3 + $bobot_ternormalisasi_C4 +  $bobot_ternormalisasi_C7 + $bobot_ternormalisasi_C8 + $bobot_ternormalisasi_C9 + $bobot_ternormalisasi_C10;
                      $cost = $bobot_ternormalisasi_C5 + $bobot_ternormalisasi_C6 + $bobot_ternormalisasi_C9;
                      array_push($array_cost, $cost);
                      $total_cost = round(array_sum($array_cost), 2);
                      array_push($array_benefit, $benefit);
                      $total_benefit = round(array_sum($array_benefit), 2);
                      echo "<tr class='center'>
  <th>S<sub>{$row->id_alternatif}</sub></th>
  <td>" . $benefit . "</td>
  <th>S<sub>{$row->id_alternatif}</sub></th>
  <td>" . $cost . "</td>

  
  
  
  </tr>\n";
                    }
                    echo "
  <tr class='center'>
  <th>Total</th>
  <td>" . $total_benefit . "</td>
  <th>Total</th>
  <td>" . $total_cost . "</td>
  
  </tr>\n";
                    $result->free();

                    ?>
                  </table><br><br>


                  <table class="table table-striped mb-0">
                    <caption>
                      Perhitungan bobot relatif tiap alternatif
                    </caption>
                    <tr>
                      <th colspan='2'>1/Si</th>

                      <?php
                      $sql = "SELECT
          a.id_alternatif,
          b.nama_alternatif,
          SUM(IF(a.id_kriteria=1,a.nilai,0)) AS C1,
          SUM(IF(a.id_kriteria=2,a.nilai,0)) AS C2,
          SUM(IF(a.id_kriteria=3,a.nilai,0)) AS C3,
          SUM(IF(a.id_kriteria=4,a.nilai,0)) AS C4,
          SUM(IF(a.id_kriteria=5,a.nilai,0)) AS C5,
          SUM(IF(a.id_kriteria=6,a.nilai,0)) AS C6,
          SUM(IF(a.id_kriteria=7,a.nilai,0)) AS C7,
          SUM(IF(a.id_kriteria=8,a.nilai,0)) AS C8,
          SUM(IF(a.id_kriteria=9,a.nilai,0)) AS C9,
          SUM(IF(a.id_kriteria=10,a.nilai,0)) AS C10
        FROM
          nilai_evaluasi a
          JOIN 
          alternatif b 
          USING(id_alternatif)
        GROUP BY a.id_alternatif
        ORDER BY a.id_alternatif";
                      $result = $db->query($sql);
                      $sql2 = "SELECT
          bobot_kriteria as bobot,
          Sum(if(id_kriteria = 1, bobot_kriteria, 0)) as B1,
          sum(if(id_kriteria = 2, bobot_kriteria, 0)) as B2,
          sum(if(id_kriteria = 3, bobot_kriteria, 0)) as B3,
          sum(if(id_kriteria = 4, bobot_kriteria, 0)) as B4,
          sum(if(id_kriteria = 5, bobot_kriteria, 0)) as B5,
          sum(if(id_kriteria = 6, bobot_kriteria, 0)) as B6,
          sum(if(id_kriteria = 7, bobot_kriteria, 0)) as B7,
          sum(if(id_kriteria = 8, bobot_kriteria, 0)) as B8,
          sum(if(id_kriteria = 9, bobot_kriteria, 0)) as B9,
          sum(if(id_kriteria = 10, bobot_kriteria, 0)) as B10
        FROM
          kriteria";
                      $result2 = $db->query($sql2);
                      while ($bobot_kriteria = $result2->fetch_object()) {
                        $bobot_C1 = round($bobot_kriteria->B1, 2);
                        $bobot_C2 = round($bobot_kriteria->B2, 2);
                        $bobot_C3 = round($bobot_kriteria->B3, 2);
                        $bobot_C4 = round($bobot_kriteria->B4, 2);
                        $bobot_C5 = round($bobot_kriteria->B5, 2);
                        $bobot_C6 = round($bobot_kriteria->B6, 2);
                        $bobot_C7 = round($bobot_kriteria->B7, 2);
                        $bobot_C8 = round($bobot_kriteria->B8, 2);
                        $bobot_C9 = round($bobot_kriteria->B9, 2);
                        $bobot_C10 = round($bobot_kriteria->B10, 2);
                      }
                      $X = array(1 => array(), 2 => array(), 3 => array(), 4 => array(), 5 => array(), 6 => array(), 7 => array(), 8 => array(), 9 => array(), 10 => array());
                      $array_cost = array();
                      $array_benefit = array();
                      $array_relatif = array();
                      $array_maxq = array();

                      while ($row = $result->fetch_object()) {
                        array_push($X[1], round($row->C1, 2));
                        array_push($X[2], round($row->C2, 2));
                        array_push($X[3], round($row->C3, 2));
                        array_push($X[4], round($row->C4, 2));
                        array_push($X[5], round($row->C5, 2));
                        array_push($X[6], round($row->C6, 2));
                        array_push($X[7], round($row->C7, 2));
                        array_push($X[8], round($row->C8, 2));
                        array_push($X[9], round($row->C9, 2));
                        array_push($X[10], round($row->C10, 2));
                        $normalisasi_C1 = round(($row->C1 / $total_C1), 3);
                        $normalisasi_C2 = round(($row->C2 / $total_C2), 3);
                        $normalisasi_C3 = round(($row->C3 / $total_C3), 3);
                        $normalisasi_C4 = round(($row->C4 / $total_C4), 3);
                        $normalisasi_C5 = round(($row->C5 / $total_C5), 3);
                        $normalisasi_C6 = round(($row->C6 / $total_C6), 3);
                        $normalisasi_C7 = round(($row->C7 / $total_C7), 3);
                        $normalisasi_C8 = round(($row->C8 / $total_C8), 3);
                        $normalisasi_C9 = round(($row->C9 / $total_C9), 3);
                        $normalisasi_C10 = round(($row->C10 / $total_C10), 3);
                        $bobot_ternormalisasi_C1 = round(($normalisasi_C1 * $bobot_C1), 3);
                        $bobot_ternormalisasi_C2 = round(($normalisasi_C2 * $bobot_C2), 3);
                        $bobot_ternormalisasi_C3 = round(($normalisasi_C3 * $bobot_C3), 3);
                        $bobot_ternormalisasi_C4 = round(($normalisasi_C4 * $bobot_C4), 3);
                        $bobot_ternormalisasi_C5 = round(($normalisasi_C5 * $bobot_C5), 3);
                        $bobot_ternormalisasi_C6 = round(($normalisasi_C6 * $bobot_C6), 3);
                        $bobot_ternormalisasi_C7 = round(($normalisasi_C7 * $bobot_C7), 3);
                        $bobot_ternormalisasi_C8 = round(($normalisasi_C8 * $bobot_C8), 3);
                        $bobot_ternormalisasi_C9 = round(($normalisasi_C9 * $bobot_C9), 3);
                        $bobot_ternormalisasi_C10 = round(($normalisasi_C10 * $bobot_C10), 3);
                        $benefit = $bobot_ternormalisasi_C1 + $bobot_ternormalisasi_C2 + $bobot_ternormalisasi_C3 + $bobot_ternormalisasi_C4 +  $bobot_ternormalisasi_C7 + $bobot_ternormalisasi_C8 + $bobot_ternormalisasi_C9 + $bobot_ternormalisasi_C10;
                        $cost = $bobot_ternormalisasi_C5 + $bobot_ternormalisasi_C6 + $bobot_ternormalisasi_C9;
                        array_push($array_cost, $cost);
                        $total_cost = round(array_sum($array_cost), 3);
                        array_push($array_benefit, $benefit);
                        $total_benefit = round(array_sum($array_benefit), 3);
                        $bobot_relatif = round((1 / $bobot_ternormalisasi_C1), 3);
                        array_push($array_relatif, $bobot_relatif);
                        $total_relatif = round(array_sum($array_relatif), 3);
                        // $relatif2 = round(($bobot_ternormalisasi_C1*212.436), 3);

                        // $relatif3 = round($benefit+(0.300/$relatif2), 3);
                        // array_push($array_maxq, $relatif3);
                        // $maxq = max($array_maxq);
                        echo "<tr class='center'>
  <th>S<sub>{$row->id_alternatif}</sub></th>
  <td>" . $bobot_relatif . "</td>
  
  
  </tr>\n";
                      }
                      $getTotal_relatif = $total_relatif;
                      $getTotal_cost = $total_cost;


                      echo "
  <tr class='center'>
  <th>Total</th>
  <td>" . $total_relatif . "</td>
  
  
  </tr>\n";
                      $result->free();

                      ?>
                  </table><br><br>


                  <table class="table table-striped mb-0">
                    <caption>
                      Perhitungan bobot relatif tiap alternatif
                    </caption>
                    <tr>
                      <th colspan='2'>Si * total 1/Si</th>
                      <th colspan='2'>Bobot Relatif</th>
                    </tr>
                    <?php
                    $sql = "SELECT
          a.id_alternatif,
          b.nama_alternatif,
          SUM(IF(a.id_kriteria=1,a.nilai,0)) AS C1,
          SUM(IF(a.id_kriteria=2,a.nilai,0)) AS C2,
          SUM(IF(a.id_kriteria=3,a.nilai,0)) AS C3,
          SUM(IF(a.id_kriteria=4,a.nilai,0)) AS C4,
          SUM(IF(a.id_kriteria=5,a.nilai,0)) AS C5,
          SUM(IF(a.id_kriteria=6,a.nilai,0)) AS C6,
          SUM(IF(a.id_kriteria=7,a.nilai,0)) AS C7,
          SUM(IF(a.id_kriteria=8,a.nilai,0)) AS C8,
          SUM(IF(a.id_kriteria=9,a.nilai,0)) AS C9,
          SUM(IF(a.id_kriteria=10,a.nilai,0)) AS C10
        FROM
          nilai_evaluasi a
          JOIN 
          alternatif b 
          USING(id_alternatif)
        GROUP BY a.id_alternatif
        ORDER BY a.id_alternatif";
                    $result = $db->query($sql);
                    $sql2 = "SELECT
          bobot_kriteria as bobot,
          Sum(if(id_kriteria = 1, bobot_kriteria, 0)) as B1,
          sum(if(id_kriteria = 2, bobot_kriteria, 0)) as B2,
          sum(if(id_kriteria = 3, bobot_kriteria, 0)) as B3,
          sum(if(id_kriteria = 4, bobot_kriteria, 0)) as B4,
          sum(if(id_kriteria = 5, bobot_kriteria, 0)) as B5,
          sum(if(id_kriteria = 6, bobot_kriteria, 0)) as B6,
          sum(if(id_kriteria = 7, bobot_kriteria, 0)) as B7,
          sum(if(id_kriteria = 8, bobot_kriteria, 0)) as B8,
          sum(if(id_kriteria = 9, bobot_kriteria, 0)) as B9,
          sum(if(id_kriteria = 10, bobot_kriteria, 0)) as B10
        FROM
          kriteria";
                    $result2 = $db->query($sql2);
                    while ($bobot_kriteria = $result2->fetch_object()) {
                      $bobot_C1 = round($bobot_kriteria->B1, 2);
                      $bobot_C2 = round($bobot_kriteria->B2, 2);
                      $bobot_C3 = round($bobot_kriteria->B3, 2);
                      $bobot_C4 = round($bobot_kriteria->B4, 2);
                      $bobot_C5 = round($bobot_kriteria->B5, 2);
                      $bobot_C6 = round($bobot_kriteria->B6, 2);
                      $bobot_C7 = round($bobot_kriteria->B7, 2);
                      $bobot_C8 = round($bobot_kriteria->B8, 2);
                      $bobot_C9 = round($bobot_kriteria->B9, 2);
                      $bobot_C10 = round($bobot_kriteria->B10, 2);
                    }
                    $X = array(1 => array(), 2 => array(), 3 => array(), 4 => array(), 5 => array(), 6 => array(), 7 => array(), 8 => array(), 9 => array(), 10 => array());
                    $array_cost = array();
                    $array_benefit = array();
                    $array_relatif = array();
                    $array_maxq = array();

                    while ($row = $result->fetch_object()) {
                      array_push($X[1], round($row->C1, 2));
                      array_push($X[2], round($row->C2, 2));
                      array_push($X[3], round($row->C3, 2));
                      array_push($X[4], round($row->C4, 2));
                      array_push($X[5], round($row->C5, 2));
                      array_push($X[6], round($row->C6, 2));
                      array_push($X[7], round($row->C7, 2));
                      array_push($X[8], round($row->C8, 2));
                      array_push($X[9], round($row->C9, 2));
                      array_push($X[10], round($row->C10, 2));
                      $normalisasi_C1 = round(($row->C1 / $total_C1), 3);
                      $normalisasi_C2 = round(($row->C2 / $total_C2), 3);
                      $normalisasi_C3 = round(($row->C3 / $total_C3), 3);
                      $normalisasi_C4 = round(($row->C4 / $total_C4), 3);
                      $normalisasi_C5 = round(($row->C5 / $total_C5), 3);
                      $normalisasi_C6 = round(($row->C6 / $total_C6), 3);
                      $normalisasi_C7 = round(($row->C7 / $total_C7), 3);
                      $normalisasi_C8 = round(($row->C8 / $total_C8), 3);
                      $normalisasi_C9 = round(($row->C9 / $total_C9), 3);
                      $normalisasi_C10 = round(($row->C10 / $total_C10), 3);
                      $bobot_ternormalisasi_C1 = round(($normalisasi_C1 * $bobot_C1), 3);
                      $bobot_ternormalisasi_C2 = round(($normalisasi_C2 * $bobot_C2), 3);
                      $bobot_ternormalisasi_C3 = round(($normalisasi_C3 * $bobot_C3), 3);
                      $bobot_ternormalisasi_C4 = round(($normalisasi_C4 * $bobot_C4), 3);
                      $bobot_ternormalisasi_C5 = round(($normalisasi_C5 * $bobot_C5), 3);
                      $bobot_ternormalisasi_C6 = round(($normalisasi_C6 * $bobot_C6), 3);
                      $bobot_ternormalisasi_C7 = round(($normalisasi_C7 * $bobot_C7), 3);
                      $bobot_ternormalisasi_C8 = round(($normalisasi_C8 * $bobot_C8), 3);
                      $bobot_ternormalisasi_C9 = round(($normalisasi_C9 * $bobot_C9), 3);
                      $bobot_ternormalisasi_C10 = round(($normalisasi_C10 * $bobot_C10), 3);
                      $benefit = $bobot_ternormalisasi_C1 + $bobot_ternormalisasi_C2 + $bobot_ternormalisasi_C3 + $bobot_ternormalisasi_C4 +  $bobot_ternormalisasi_C7 + $bobot_ternormalisasi_C8 + $bobot_ternormalisasi_C9 + $bobot_ternormalisasi_C10;
                      $cost = $bobot_ternormalisasi_C5 + $bobot_ternormalisasi_C6 + $bobot_ternormalisasi_C9;
                      array_push($array_cost, $cost);
                      $total_cost = round(array_sum($array_cost), 3);
                      array_push($array_benefit, $benefit);
                      $total_benefit = round(array_sum($array_benefit), 3);
                      $bobot_relatif = round((1 / $bobot_ternormalisasi_C1), 3);
                      array_push($array_relatif, $bobot_relatif);
                      $total_relatif = round(array_sum($array_relatif), 3);
                      $relatif2 = round(($bobot_ternormalisasi_C1 * $getTotal_relatif), 3);

                      $relatif3 = round($benefit + ($getTotal_cost / $relatif2), 3);
                      array_push($array_maxq, $relatif3);
                      $maxq = max($array_maxq);
                      echo "<tr class='center'>
  
  <th>S<sub>{$row->id_alternatif}</sub></th>
  <td>" . $relatif2 . "</td>
  <th>Q<sub>{$row->id_alternatif}</sub></th>
  <td>" . $relatif3 . "</td>
  
  </tr>\n";
                    }


                    $getMaxq = $maxq;
                    echo "
  <tr class='center'>
  <th></th>
  <td></td>
  <th>Max Q<sub>i</sub></th>
  <td>" . $maxq .  "</td>
  
  </tr>\n";
                    $result->free();

                    ?>
                  </table><br><br>


                  <table class="table table-striped mb-0">
                    <caption>
                      Perhitungan utilitas kuantitatif
                    </caption>
                    <tr>
                      <th colspan='2'>Utilitas Kuantitatif</th>
                    </tr>
                    <?php
                    $sql = "SELECT
         a.id_alternatif,
          b.nama_alternatif,
          SUM(IF(a.id_kriteria=1,a.nilai,0)) AS C1,
          SUM(IF(a.id_kriteria=2,a.nilai,0)) AS C2,
          SUM(IF(a.id_kriteria=3,a.nilai,0)) AS C3,
          SUM(IF(a.id_kriteria=4,a.nilai,0)) AS C4,
          SUM(IF(a.id_kriteria=5,a.nilai,0)) AS C5,
          SUM(IF(a.id_kriteria=6,a.nilai,0)) AS C6,
          SUM(IF(a.id_kriteria=7,a.nilai,0)) AS C7,
          SUM(IF(a.id_kriteria=8,a.nilai,0)) AS C8,
          SUM(IF(a.id_kriteria=9,a.nilai,0)) AS C9,
          SUM(IF(a.id_kriteria=10,a.nilai,0)) AS C10
          FROM
          nilai_evaluasi a
          JOIN 
          alternatif b 
          USING(id_alternatif)
        GROUP BY a.id_alternatif
        ORDER BY a.id_alternatif";
                    $result = $db->query($sql);
                    $sql2 = "SELECT
          bobot_kriteria as bobot,
          Sum(if(id_kriteria = 1, bobot_kriteria, 0)) as B1,
          sum(if(id_kriteria = 2, bobot_kriteria, 0)) as B2,
          sum(if(id_kriteria = 3, bobot_kriteria, 0)) as B3,
          sum(if(id_kriteria = 4, bobot_kriteria, 0)) as B4,
          sum(if(id_kriteria = 5, bobot_kriteria, 0)) as B5,
          sum(if(id_kriteria = 6, bobot_kriteria, 0)) as B6,
          sum(if(id_kriteria = 7, bobot_kriteria, 0)) as B7,
          sum(if(id_kriteria = 8, bobot_kriteria, 0)) as B8,
          sum(if(id_kriteria = 9, bobot_kriteria, 0)) as B9,
          sum(if(id_kriteria = 10, bobot_kriteria, 0)) as B10
        FROM
          kriteria";
                    $result2 = $db->query($sql2);
                    while ($bobot_kriteria = $result2->fetch_object()) {
                      $bobot_C1 = round($bobot_kriteria->B1, 2);
                      $bobot_C2 = round($bobot_kriteria->B2, 2);
                      $bobot_C3 = round($bobot_kriteria->B3, 2);
                      $bobot_C4 = round($bobot_kriteria->B4, 2);
                      $bobot_C5 = round($bobot_kriteria->B5, 2);
                      $bobot_C6 = round($bobot_kriteria->B6, 2);
                      $bobot_C7 = round($bobot_kriteria->B7, 2);
                      $bobot_C8 = round($bobot_kriteria->B8, 2);
                      $bobot_C9 = round($bobot_kriteria->B9, 2);
                      $bobot_C10 = round($bobot_kriteria->B10, 2);
                    }
                    $X = array(1 => array(), 2 => array(), 3 => array(), 4 => array(), 5 => array(), 6 => array(), 7 => array(), 8 => array(), 9 => array(), 10 => array());
                    $array_cost = array();
                    $array_benefit = array();
                    $array_relatif = array();
                    $array_maxq = array();

                    while ($row = $result->fetch_object()) {
                      array_push($X[1], round($row->C1, 2));
                      array_push($X[2], round($row->C2, 2));
                      array_push($X[3], round($row->C3, 2));
                      array_push($X[4], round($row->C4, 2));
                      array_push($X[5], round($row->C5, 2));
                      array_push($X[6], round($row->C6, 2));
                      array_push($X[7], round($row->C7, 2));
                      array_push($X[8], round($row->C8, 2));
                      array_push($X[9], round($row->C9, 2));
                      array_push($X[10], round($row->C10, 2));
                      $normalisasi_C1 = round(($row->C1 / $total_C1), 3);
                      $normalisasi_C2 = round(($row->C2 / $total_C2), 3);
                      $normalisasi_C3 = round(($row->C3 / $total_C3), 3);
                      $normalisasi_C4 = round(($row->C4 / $total_C4), 3);
                      $normalisasi_C5 = round(($row->C5 / $total_C5), 3);
                      $normalisasi_C6 = round(($row->C6 / $total_C6), 3);
                      $normalisasi_C7 = round(($row->C7 / $total_C7), 3);
                      $normalisasi_C8 = round(($row->C8 / $total_C8), 3);
                      $normalisasi_C9 = round(($row->C9 / $total_C9), 3);
                      $normalisasi_C10 = round(($row->C10 / $total_C10), 3);
                      $bobot_ternormalisasi_C1 = round(($normalisasi_C1 * $bobot_C1), 3);
                      $bobot_ternormalisasi_C2 = round(($normalisasi_C2 * $bobot_C2), 3);
                      $bobot_ternormalisasi_C3 = round(($normalisasi_C3 * $bobot_C3), 3);
                      $bobot_ternormalisasi_C4 = round(($normalisasi_C4 * $bobot_C4), 3);
                      $bobot_ternormalisasi_C5 = round(($normalisasi_C5 * $bobot_C5), 3);
                      $bobot_ternormalisasi_C6 = round(($normalisasi_C6 * $bobot_C6), 3);
                      $bobot_ternormalisasi_C7 = round(($normalisasi_C7 * $bobot_C7), 3);
                      $bobot_ternormalisasi_C8 = round(($normalisasi_C8 * $bobot_C8), 3);
                      $bobot_ternormalisasi_C9 = round(($normalisasi_C9 * $bobot_C9), 3);
                      $bobot_ternormalisasi_C10 = round(($normalisasi_C10 * $bobot_C10), 3);
                      $benefit = $bobot_ternormalisasi_C1 + $bobot_ternormalisasi_C2 + $bobot_ternormalisasi_C3 + $bobot_ternormalisasi_C4 +  $bobot_ternormalisasi_C7 + $bobot_ternormalisasi_C8 + $bobot_ternormalisasi_C9 + $bobot_ternormalisasi_C10;
                      $cost = $bobot_ternormalisasi_C5 + $bobot_ternormalisasi_C6 + $bobot_ternormalisasi_C9;
                      array_push($array_cost, $cost);
                      $total_cost = round(array_sum($array_cost), 3);
                      array_push($array_benefit, $benefit);
                      $total_benefit = round(array_sum($array_benefit), 3);
                      $bobot_relatif = round((1 / $bobot_ternormalisasi_C1), 3);
                      array_push($array_relatif, $bobot_relatif);
                      $total_relatif = round(array_sum($array_relatif), 3);
                      $relatif2 = round(($bobot_ternormalisasi_C1 * 212.436), 3);
                      $relatif3 = round($benefit + (0.300 / $relatif2), 3);
                      array_push($array_maxq, $relatif3);
                      $maxq = max($array_maxq);

                      $utilitas = round(($relatif3 / $getMaxq), 3);
                      echo "<tr class='center'>
  
  <th>U<sub>{$row->id_alternatif}</sub></th>
  <td>" . $utilitas . "</td>
  
  </tr>\n";
                    }



                    $result->free();

                    ?>
                  </table><br><br>

                  <!--

<table class="table table-striped mb-0">
    <caption>
        Matrik Ternormalisasi (R)
    </caption>
    <tr>
        <th rowspan='2'>Alternatif</th>
        <th colspan='4'>Kriteria</th>
    </tr>
    <tr>
        <th>C1</th>
        <th>C2</th>
        <th>C3</th>
        <th>C4</th>
    </tr>
    <?php
    $sql = "SELECT
          a.id_alternatif,
          SUM(
            IF(
              a.id_kriteria=1,
              IF(
                  b.attribute='benefit', a.nilai/" . max($X[1]) . ", " . min($X[1]) . "/a.nilai
              ) ,0
            ) 
          ) AS C1,
          SUM(
            IF(
              a.id_kriteria=1,
              IF(
                  b.attribute='benefit', a.nilai/" . max($X[2]) . ", " . min($X[2]) . "/a.nilai
              ) ,0
            ) 
          ) AS C2,
          SUM(
            IF(
              a.id_kriteria=1,
              IF(
                  b.attribute='benefit', a.nilai/" . max($X[3]) . ", " . min($X[3]) . "/a.nilai
              ) ,0
            ) 
          ) AS C3,
          SUM(
            IF(
              a.id_kriteria=1,
              IF(
                  b.attribute='benefit', a.nilai/" . max($X[3]) . ", " . min($X[3]) . "/a.nilai
              ) ,0
            ) 
          ) AS C4
          /*
          SUM(
            IF(
              a.id_kriteria=2,
              IF(
                b.attribute='benefit',
                a.nilai/" . max($X[2]) . ",
                " . min($X[2]) . "/a.nilai)
               ,0)
             ) AS C2,
          SUM(
            IF(
              a.id_kriteria=3,
              IF(
                b.attribute='benefit',
                a.nilai/" . max($X[3]) . ",
                " . min($X[3]) . "/a.nilai)
               ,0)
             ) AS C3,
          SUM(
            IF(
              a.id_kriteria=4,
              IF(
                b.attribute='benefit',
                a.nilai/" . max($X[4]) . ",
                " . min($X[4]) . "/a.nilai)
               ,0)
             ) AS C4,
             SUM(
              IF(
                a.id_kriteria=5,
                IF(
                  b.attribute='benefit',
                  a.nilai/" . max($X[5]) . ",
                  " . min($X[5]) . "/a.nilai)
                 ,0)
               ) AS C5,
               SUM(
                IF(
                  a.id_kriteria=6,
                  IF(
                    b.attribute='benefit',
                    a.nilai/" . max($X[6]) . ",
                    " . min($X[6]) . "/a.nilai)
                   ,0)
                 ) AS C6,
                 SUM(
                  IF(
                    a.id_kriteria=7,
                    IF(
                      b.attribute='benefit',
                      a.nilai/" . max($X[7]) . ",
                      " . min($X[7]) . "/a.nilai)
                     ,0)
                    ) AS C7,
                    SUM(
                      IF(
                        a.id_kriteria=8,
                        IF(
                          b.attribute='benefit',
                          a.nilai/" . max($X[8]) . ",
                          " . min($X[8]) . "/a.nilai)
                         ,0)
                        ) AS C8,
                        SUM(
                          IF(
                            a.id_kriteria=9,
                            IF(
                              b.attribute='benefit',
                              a.nilai/" . max($X[9]) . ",
                              " . min($X[9]) . "/a.nilai)
                             ,0)
                            ) AS C9,
                            SUM(
                              IF(
                                a.id_kriteria=10,
                                IF(
                                  b.attribute='benefit',
                                  a.nilai/" . max($X[10]) . ",
                                  " . min($X[10]) . "/a.nilai)
                                 ,0)
                                ) AS C10,
                                
                  
        FROM
          nilai_evaluasi a
          JOIN kriteria b USING(id_kriteria)
        GROUP BY a.id_alternatif
        ORDER BY a.id_alternatif
       ";
    $result = $db->query($sql);
    $R = array();
    while ($row = $result->fetch_object()) {
      $R[$row->id_alternatif] = array($row->C1, $row->C2, $row->C3, $row->C4, $row->C5, $row->C6, $row->C7, $row->C8, $row->C9, $row->C10);
      echo "<tr class='center'>
            <th>A{$row->id_alternative}</th>
            <td>" . round($row->C1, 2) . "</td>
            <td>" . round($row->C2, 2) . "</td>
            <td>" . round($row->C3, 2) . "</td>
            <td>" . round($row->C4, 2) . "</td>
            <td>" . round($row->C5, 2) . "</td>
            <td>" . round($row->C6, 2) . "</td>
            <td>" . round($row->C7, 2) . "</td>
            <td>" . round($row->C8, 2) . "</td>
            <td>" . round($row->C9, 2) . "</td>
            <td>" . round($row->C10, 2) . "</td>
          </tr>\n";
    }
    ?>
</table>



<br><br>


<table class="table table-striped mb-0">
    <caption>
        Matrik Ternormalisasi (R) Coba
    </caption>
    <tr>
        <th rowspan='2'>Alternatif</th>
        <th colspan='4'>Kriteria</th>
    </tr>
    <tr>
        <th>C1</th>
        <th>C2</th>
        <th>C3</th>
        <th>C4</th>
    </tr>
    <?php
    $sql = "SELECT
          a.id_alternatif,
          SUM(
            IF(
              a.id_kriteria=1,
              IF(
                  b.attribute='benefit', a.nilai/" . max($X[1]) . ", " . min($X[1]) . "/a.nilai
              ) ,0
            ) 
          ) AS C1,
          SUM(
            IF(
              a.id_kriteria=1,
              IF(
                  b.attribute='benefit', a.nilai/" . max($X[2]) . ", " . min($X[2]) . "/a.nilai
              ) ,0
            ) 
          ) AS C2,
          SUM(
            IF(
              a.id_kriteria=1,
              IF(
                  b.attribute='benefit', a.nilai/" . max($X[3]) . ", " . min($X[3]) . "/a.nilai
              ) ,0
            ) 
          ) AS C3,
          SUM(
            IF(
              a.id_criteria=1,
              IF(
                  b.attribute='benefit', a.nilai/" . max($X[3]) . ", " . min($X[3]) . "/a.nilai
              ) ,0
            ) 
          ) AS C4
          SUM(
            IF(
              a.id_criteria=1,
              IF(
                  b.attribute='benefit', a.nilai/" . max($X[3]) . ", " . min($X[3]) . "/a.nilai
              ) ,0
            ) 
          ) AS C4
          SUM(
            IF(
              a.id_kriteria=1,
              IF(
                  b.attribute='benefit', a.nilai/" . max($X[3]) . ", " . min($X[3]) . "/a.nilai
              ) ,0
            ) 
          ) AS C4
        FROM
          saw_evaluations a
          JOIN 
          saw_criterias b 
          USING(id_criteria)
        GROUP BY a.id_alternatif
        ORDER BY a.id_alternatif
       ";
    $result = $db->query($sql);
    $R = array();
    while ($row = $result->fetch_object()) {
      $R[$row->id_alternatif] = array($row->C1, $row->C2, $row->C3, $row->C4, $row->C5, $row->C6, $row->C7, $row->C8, $row->C9, $row->C10);
      echo "<tr class='center'>
            <th>A{$row->id_alternatif}</th>
            <td>" . $total_C1 . "</td>
            <td>" . round($row->C2, 2) . "</td>
            <td>" . round($row->C3, 2) . "</td>
            <td>" . round($row->C4, 2) . "</td>
            <td>" . round($row->C5, 2) . "</td>
            <td>" . round($row->C6, 2) . "</td>
            <td>" . round($row->C7, 2) . "</td>
            <td>" . round($row->C8, 2) . "</td>
            <td>" . round($row->C9, 2) . "</td>
            <td>" . round($row->C10, 2) . "</td>
          </tr>\n";
    }
    ?>
</table>

-->

                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <div class="page-content">
        <section class="row">
          <div class="col-12">
            <div class="card">

              <div class="card-header">
                <h4 class="card-title">Hasil Perhitungan</h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <p class="card-text">
                    Setelah didapatkan nilai 𝑈𝑖 kemudian
                    hasil pemilihan sepeda motor akan
                    diurutkan dari
                    nilai 𝑈𝑖 terbesar sampai dengan
                    nilai 𝑈𝑖 terkecil. Pengguna dapat
                    melihat sepeda motor yang
                    direkomendasikan oleh metode
                    COPRAS.
                  </p>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped mb-0">
                    <caption>
                      Nilai 𝑈𝑖 yang lebih besar
                      mengindikasikan bahwa alternatif lebih
                      terpilih. Hasil
                      rekomendasi dari pemilihan kriteria
                      merk Honda, jenis skuter, tranmisi
                      matic dan pengereman
                      single cakram.
                    </caption>
                    <tr>
                      <th>ID</th>
                      <th>Nama</th>
                      <th>Harga</th>
                      <th>BBM</th>
                      <th>CC</th>
                      <th>Tahun</th>
                      <th>Nilai</th>

                    </tr>
                    <?php
                    $sql = "SELECT
                              a.id_alternatif,
                              b.nama_alternatif,
                              SUM(IF(a.id_kriteria=1,a.nilai,0)) AS C1,
                              SUM(IF(a.id_kriteria=2,a.nilai,0)) AS C2,
                              SUM(IF(a.id_kriteria=3,a.nilai,0)) AS C3,
                              SUM(IF(a.id_kriteria=4,a.nilai,0)) AS C4
                              SUM(IF(a.id_kriteria=5,a.nilai,0)) AS C5
                              SUM(IF(a.id_kriteria=6,a.nilai,0)) AS C6
                              SUM(IF(a.id_kriteria=7,a.nilai,0)) AS C7
                              SUM(IF(a.id_kriteria=8,a.nilai,0)) AS C8
                              SUM(IF(a.id_kriteria=9,a.nilai,0)) AS C9
                              SUM(IF(a.id_kriteria=10,a.nilai,0)) AS C10

                              FROM
                              nilai_evaluasi a
                              JOIN 
                              alternatif b 
                              USING(id_alternatif)
                              GROUP BY a.id_alternatif
                              ORDER BY a.id_alternatif";
                    $result = $db->query($sql);
                    $sql2 = "SELECT
                              bobot_kriteria as bobot,
                              Sum(if(id_kriteria = 1, bobot_kriteria, 0)) as B1,
          sum(if(id_kriteria = 2, bobot_kriteria, 0)) as B2,
          sum(if(id_kriteria = 3, bobot_kriteria, 0)) as B3,
          sum(if(id_kriteria = 4, bobot_kriteria, 0)) as B4,
          sum(if(id_kriteria = 5, bobot_kriteria, 0)) as B5,
          sum(if(id_kriteria = 6, bobot_kriteria, 0)) as B6,
          sum(if(id_kriteria = 7, bobot_kriteria, 0)) as B7,
          sum(if(id_kriteria = 8, bobot_kriteria, 0)) as B8,
          sum(if(id_kriteria = 9, bobot_kriteria, 0)) as B9,
          sum(if(id_kriteria = 10, bobot_kriteria, 0)) as B10
                              FROM
                              kriteria";
                    $result2 = $db->query($sql2);
                    while ($bobot_kriteria = $result2->fetch_object()) {
                      $bobot_C1 = round($bobot_kriteria->B1, 2);
                      $bobot_C2 = round($bobot_kriteria->B2, 2);
                      $bobot_C3 = round($bobot_kriteria->B3, 2);
                      $bobot_C4 = round($bobot_kriteria->B4, 2);
                      $bobot_C5 = round($bobot_kriteria->B5, 2);
                      $bobot_C6 = round($bobot_kriteria->B6, 2);
                      $bobot_C7 = round($bobot_kriteria->B7, 2);
                      $bobot_C8 = round($bobot_kriteria->B8, 2);
                      $bobot_C9 = round($bobot_kriteria->B9, 2);
                      $bobot_C10 = round($bobot_kriteria->B10, 2);
                    }
                    $X = array(1 => array(), 2 => array(), 3 => array(), 4 => array(), 5 => array(), 6 => array(), 7 => array(), 8 => array(), 9 => array(), 10 => array());
                    $array_cost = array();
                    $array_benefit = array();
                    $array_relatif = array();
                    $array_maxq = array();

                    while ($row = $result->fetch_object()) {
                      array_push($X[1], round($row->C1, 2));
                      array_push($X[2], round($row->C2, 2));
                      array_push($X[3], round($row->C3, 2));
                      array_push($X[4], round($row->C4, 2));
                      array_push($X[5], round($row->C5, 2));
                      array_push($X[6], round($row->C6, 2));
                      array_push($X[7], round($row->C7, 2));
                      array_push($X[8], round($row->C8, 2));
                      array_push($X[9], round($row->C9, 2));
                      array_push($X[10], round($row->C10, 2));
                      $normalisasi_C1 = round(($row->C1 / $total_C1), 3);
                      $normalisasi_C2 = round(($row->C2 / $total_C2), 3);
                      $normalisasi_C3 = round(($row->C3 / $total_C3), 3);
                      $normalisasi_C4 = round(($row->C4 / $total_C4), 3);
                      $normalisasi_C5 = round(($row->C5 / $total_C5), 3);
                      $normalisasi_C6 = round(($row->C6 / $total_C6), 3);
                      $normalisasi_C7 = round(($row->C7 / $total_C7), 3);
                      $normalisasi_C8 = round(($row->C8 / $total_C8), 3);
                      $normalisasi_C9 = round(($row->C9 / $total_C9), 3);
                      $normalisasi_C10 = round(($row->C10 / $total_C10), 3);
                      $bobot_ternormalisasi_C1 = round(($normalisasi_C1 * $bobot_C1), 3);
                      $bobot_ternormalisasi_C2 = round(($normalisasi_C2 * $bobot_C2), 3);
                      $bobot_ternormalisasi_C3 = round(($normalisasi_C3 * $bobot_C3), 3);
                      $bobot_ternormalisasi_C4 = round(($normalisasi_C4 * $bobot_C4), 3);
                      $bobot_ternormalisasi_C5 = round(($normalisasi_C5 * $bobot_C5), 3);
                      $bobot_ternormalisasi_C6 = round(($normalisasi_C6 * $bobot_C6), 3);
                      $bobot_ternormalisasi_C7 = round(($normalisasi_C7 * $bobot_C7), 3);
                      $bobot_ternormalisasi_C8 = round(($normalisasi_C8 * $bobot_C8), 3);
                      $bobot_ternormalisasi_C9 = round(($normalisasi_C9 * $bobot_C9), 3);
                      $bobot_ternormalisasi_C10 = round(($normalisasi_C10 * $bobot_C10), 3);
                      $benefit = $bobot_ternormalisasi_C1 + $bobot_ternormalisasi_C2 + $bobot_ternormalisasi_C3 + $bobot_ternormalisasi_C4 +  $bobot_ternormalisasi_C7 + $bobot_ternormalisasi_C8 + $bobot_ternormalisasi_C9 + $bobot_ternormalisasi_C10;
                      $cost = $bobot_ternormalisasi_C5 + $bobot_ternormalisasi_C6 + $bobot_ternormalisasi_C9;
                      array_push($array_cost, $cost);
                      $total_cost = round(array_sum($array_cost), 3);
                      array_push($array_benefit, $benefit);
                      $total_benefit = round(array_sum($array_benefit), 3);
                      $bobot_relatif = round((1 / $bobot_ternormalisasi_C1), 3);
                      array_push($array_relatif, $bobot_relatif);
                      $total_relatif = round(array_sum($array_relatif), 3);
                      $relatif2 = round(($bobot_ternormalisasi_C1 * 212.436), 3);
                      $relatif3 = round($benefit + (0.300 / $relatif2), 3);
                      array_push($array_maxq, $relatif3);
                      $maxq = max($array_maxq);

                      $utilitas = round(($relatif3 / $getMaxq), 3);
                      echo "<tr class='center'>
                            
                            <th>{$row->id_alternatif}</th>
                            <td>{$row->name}</td>
                            <td>{$row->C1}</td>
                            <td>{$row->C2}</td>
                            <td>{$row->C3}</td>
                            <td>{$row->C4}</td>
                            <td>{$row->C5}</td>
                            <td>{$row->C6}</td>
                            <td>{$row->C7}</td>
                            <td>{$row->C8}</td>
                            <td>{$row->C9}</td>
                            <td>{$row->C10}</td>

                            <td>" . $utilitas . "</td>
                            
                            </tr>\n";
                    }
                    $result->free();
                    ?>
                  </table><br><br>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php require "layout/footer.php"; ?>
    </div>
  </div>

  <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel33">Isi Nilai Kandidat </h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <form action="matrik-simpan.php" method="POST">
          <div class="modal-body">
            <label>Name: </label>
            <div class="form-group">
              <select class="form-control form-select" name="id_alternatif">
                <?php
                $sql = 'SELECT id_alternatif,name FROM alternatif';
                $result = $db->query($sql);
                $i = 0;
                while ($row = $result->fetch_object()) {
                  echo '<option value="' . $row->id_alternatif . '">' . $row->nama_alternatif . '</option>';
                }
                $result->free();
                ?>
              </select>
            </div>
          </div>
          <div class="modal-body">
            <label>Criteria: </label>
            <div class="form-group">
              <select class="form-control form-select" name="id_kriteria">
                <?php
                $sql = 'SELECT * FROM kriteria';
                $result = $db->query($sql);
                $i = 0;
                while ($row = $result->fetch_object()) {
                  echo '<option value="' . $row->id_kriteria . '">' . $row->kriteria . '</option>';
                }
                $result->free();
                ?>
              </select>
            </div>
          </div>
          <div class="modal-body">
            <label>Value: </label>
            <div class="form-group">
              <input type="text" name="nilai" placeholder="value..." class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Close</span>
            </button>
            <button type="submit" name="submit" class="btn btn-primary ml-1">
              <i class="bx bx-check d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Simpan</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php require "layout/js.php"; ?>
</body>

</html>