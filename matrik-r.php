<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if(!isset($_SESSION['bobot'])) {
    header('Location: bobot.php');
    exit;
} else {
    $req = $dbc->prepare("SELECT * FROM pemilihan WHERE id = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $pemilihan = $req->fetch();

    $req = $dbc->prepare("SELECT * FROM alternatif WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $alternatif = $req->fetchAll();

    $req = $dbc->prepare("SELECT * FROM nilai WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $nilaiAlternatif = $req->fetchAll();
}

$r = array(
    array(),
    array(),
    array(),
    array(),
    array(),
    array()
);

$x = array();

$tempNilaiAlternatif = array(
    "c1" => array(),
    "c2" => array(),
    "c3" => array(),
    "c4" => array(),
    "c5" => array(),
    "c6" => array()
);

for ($i = 0; $i < count($alternatif); $i++) {
    $tempNilaiAlternatif['c1'][] = $nilaiAlternatif[$i]['c1'];
    $tempNilaiAlternatif['c2'][] = $nilaiAlternatif[$i]['c2'];
    $tempNilaiAlternatif['c3'][] = $nilaiAlternatif[$i]['c3'];
    $tempNilaiAlternatif['c4'][] = $nilaiAlternatif[$i]['c4'];
    $tempNilaiAlternatif['c5'][] = $nilaiAlternatif[$i]['c5'];
    $tempNilaiAlternatif['c6'][] = $nilaiAlternatif[$i]['c6'];
}

foreach ($tempNilaiAlternatif as $nilai) {
    $sum = array_reduce($nilai, function($carry, $nilaiKriteria) {
            $carry += $nilaiKriteria*$nilaiKriteria;

            return $carry;
        });
    $x[] = round(sqrt($sum), 4);
}

for ($i = 0; $i < count($alternatif); $i++) {
    $r[0][] = round($nilaiAlternatif[$i]['c1']/$x[0], 4);
    $r[1][] = round($nilaiAlternatif[$i]['c2']/$x[1], 4);
    $r[2][] = round($nilaiAlternatif[$i]['c3']/$x[2], 4);
    $r[3][] = round($nilaiAlternatif[$i]['c4']/$x[3], 4);
    $r[4][] = round($nilaiAlternatif[$i]['c5']/$x[4], 4);
    $r[5][] = round($nilaiAlternatif[$i]['c6']/$x[5], 4);
}

$status = "matrik-r";
try {
    $dbc->beginTransaction();

    $dbc->exec("DELETE FROM matrik_r WHERE id_pemilihan = $_SESSION[id]");

    $req = $dbc->prepare("INSERT INTO matrik_r VALUES(:id, :c1, :c2, :c3, :c4, :c5, :c6)");
    $req->bindValue(':id', $_SESSION['id']);

    for ($i = 0; $i<count($alternatif); $i++) {
        $req->bindValue(':c1', $r[0][$i]);
        $req->bindValue(':c2', $r[1][$i]);
        $req->bindValue(':c3', $r[2][$i]);
        $req->bindValue(':c4', $r[3][$i]);
        $req->bindValue(':c5', $r[4][$i]);
        $req->bindValue(':c6', $r[5][$i]);
        $req->execute();
    }

    $req = $dbc->prepare("UPDATE pemilihan SET status = ? WHERE id = ?");
    $req->bindParam(1, $status);
    $req->bindParam(2, $_SESSION['id']);
    $req->execute();

    $dbc->commit();

    $_SESSION['matrik-r'] = true;
} catch (PDOException $e) {
    $dbc->rollback();
}

    // edit input matrik y
    if(!isset($_SESSION['matrik-r'])) {
        header('Location: matrik-r.php');
        exit;
    } else {
        $req = $dbc->prepare("SELECT * FROM pemilihan WHERE id = ?");
        $req->bindParam(1, $_SESSION['id']);
        $req->execute();
    
        $pemilihan = $req->fetch();
    
        $req = $dbc->prepare("SELECT * FROM alternatif WHERE id_pemilihan = ?");
        $req->bindParam(1, $_SESSION['id']);
        $req->execute();
    
        $alternatif = $req->fetchAll();
    
        $req = $dbc->prepare("SELECT * FROM matrik_r WHERE id_pemilihan = ?");
        $req->bindParam(1, $_SESSION['id']);
        $req->execute();
    
        $matrik_r = $req->fetchAll();
    
        $req = $dbc->prepare("SELECT * FROM bobot WHERE id_pemilihan = ?");
        $req->bindParam(1, $_SESSION['id']);
        $req->execute();
    
        $bobot = $req->fetch();
    }
    
    $y = array(
        array(),
        array(),
        array(),
        array(),
        array(),
        array()
    );
    
    for ($i = 0; $i < count($alternatif); $i++) {
        $y[0][] = round($matrik_r[$i]['c1']*$bobot['c1'], 4);
        $y[1][] = round($matrik_r[$i]['c2']*$bobot['c2'], 4);
        $y[2][] = round($matrik_r[$i]['c3']*$bobot['c3'], 4);
        $y[3][] = round($matrik_r[$i]['c4']*$bobot['c4'], 4);
        $y[4][] = round($matrik_r[$i]['c5']*$bobot['c5'], 4);
        $y[5][] = round($matrik_r[$i]['c6']*$bobot['c6'], 4);
    }
    
    
    $status = "matrik-y";
    try {
        $dbc->beginTransaction();
    
        $dbc->exec("DELETE FROM matrik_y WHERE id_pemilihan = $_SESSION[id]");
    
        $req = $dbc->prepare("INSERT INTO matrik_y VALUES(:id, :c1, :c2, :c3, :c4, :c5, :c6)");
        $req->bindValue(':id', $_SESSION['id']);
    
        for ($i = 0; $i<count($alternatif); $i++) {
            $req->bindValue(':c1', $y[0][$i]);
            $req->bindValue(':c2', $y[1][$i]);
            $req->bindValue(':c3', $y[2][$i]);
            $req->bindValue(':c4', $y[3][$i]);
            $req->bindValue(':c5', $y[4][$i]);
            $req->bindValue(':c6', $y[5][$i]);
            $req->execute();
        }
    
        $req = $dbc->prepare("UPDATE pemilihan SET status = ? WHERE id = ?");
        $req->bindParam(1, $status);
        $req->bindParam(2, $_SESSION['id']);
        $req->execute();
    
        $dbc->commit();
    
        $_SESSION['matrik-y'] = true;
    } catch (PDOException $e) {
        $dbc->rollback();
    }
    // edit input matrik y

    // edit input nilai ideal
    if(!isset($_SESSION['matrik-y'])) {
        header('Location: matrik-y.php');
        exit;
    } else {
        $req = $dbc->prepare("SELECT * FROM pemilihan WHERE id = ?");
        $req->bindParam(1, $_SESSION['id']);
        $req->execute();
    
        $pemilihan = $req->fetch();
    
        $req = $dbc->prepare("SELECT * FROM matrik_y WHERE id_pemilihan = ?");
        $req->bindParam(1, $_SESSION['id']);
        $req->execute();
    
        $matrik_y = $req->fetchAll();
    }
    
    $a = array();
    
    $tempMatrikY = array(
        "c1" => array(),
        "c2" => array(),
        "c3" => array(),
        "c4" => array(),
        "c5" => array(),
        "c6" => array()
    );
    
    for ($i = 0; $i < count($matrik_y); $i++) {
        $tempMatrikY['c1'][] = $matrik_y[$i]['c1'];
        $tempMatrikY['c2'][] = $matrik_y[$i]['c2'];
        $tempMatrikY['c3'][] = $matrik_y[$i]['c3'];
        $tempMatrikY['c4'][] = $matrik_y[$i]['c4'];
        $tempMatrikY['c5'][] = $matrik_y[$i]['c5'];
        $tempMatrikY['c6'][] = $matrik_y[$i]['c6'];
    }
    
    $a['positif'][] = max($tempMatrikY['c1']);
    $a['positif'][] = max($tempMatrikY['c2']);
    $a['positif'][] = max($tempMatrikY['c3']);
    $a['positif'][] = min($tempMatrikY['c4']);
    $a['positif'][] = min($tempMatrikY['c5']);
    $a['positif'][] = min($tempMatrikY['c6']);
    
    $a['negatif'][] = min($tempMatrikY['c1']);
    $a['negatif'][] = min($tempMatrikY['c2']);
    $a['negatif'][] = min($tempMatrikY['c3']);
    $a['negatif'][] = max($tempMatrikY['c4']);
    $a['negatif'][] = max($tempMatrikY['c5']);
    $a['negatif'][] = max($tempMatrikY['c6']);
    
    $status = "nilai-ideal";
    try {
        $dbc->beginTransaction();
    
        $dbc->exec("DELETE FROM nilai_ideal WHERE id_pemilihan = $_SESSION[id]");
    
        $req = $dbc->prepare("INSERT INTO nilai_ideal VALUES(:id, :ideal, :c1, :c2, :c3, :c4, :c5, :c6)");
        $req->bindValue(':id', $_SESSION['id']);
    
        foreach ($a as $ideal => $y) {
            $req->bindValue(':ideal', $ideal);
            $req->bindValue(':c1', $y[0]);
            $req->bindValue(':c2', $y[1]);
            $req->bindValue(':c3', $y[2]);
            $req->bindValue(':c4', $y[3]);
            $req->bindValue(':c5', $y[4]);
            $req->bindValue(':c6', $y[5]);
            $req->execute();
        }
    
        $req = $dbc->prepare("UPDATE pemilihan SET status = ? WHERE id = ?");
        $req->bindParam(1, $status);
        $req->bindParam(2, $_SESSION['id']);
        $req->execute();
    
        $dbc->commit();
    
        $_SESSION['nilai-ideal'] = true;
    } catch (PDOException $e) {
        $dbc->rollback();
    }
    // edit input nilai ideal

    // edit input jarak solusi ideal
    // edit input jarak solusi ideal
$page_title = 'Matrik R';

include './includes/header.php';
?>

<div class="col-md-12">
    <div class="page-header text-center">
        <h1>Pemilihan Karyawan</h1>
        <h4><?php echo $pemilihan['keterangan']; ?></h4>
    </div>
    <h3>Normalisasi Matriks R</h3>
    <table class="table table-bordered">
        <tr>
            <td class="col-md-1">No</td>
            <th class="col-md-3">Alternatif</th>
            <th class="col-md-1">C1</th>
            <th class="col-md-1">C2</th>
            <th class="col-md-1">C3</th>
            <th class="col-md-1">C4</th>
            <th class="col-md-1">C5</th>
            <th class="col-md-1">C6</th>
        </tr>
        <?php
        for($i = 0; $i < count($alternatif); $i++) {
            echo '<tr>
                    <td class="col-md-1">'.($i+1).'</td>
                    <td class="col-md-3">'.$alternatif[$i]['alternatif'].'</td>
                    <td class="col-md-1">'.$r[0][$i].'</td>
                    <td class="col-md-1">'.$r[1][$i].'</td>
                    <td class="col-md-1">'.$r[2][$i].'</td>
                    <td class="col-md-1">'.$r[3][$i].'</td>
                    <td class="col-md-1">'.$r[4][$i].'</td>
                    <td class="col-md-1">'.$r[5][$i].'</td>
                </tr>';
        }
        ?>
    </table>
    <br/>

    <!-- edit input matrik y!!! -->
    <h3>Normalisasi Matriks Y</h3>
    <table class="table table-bordered">
        <tr>
            <td class="col-md-1">No</td>
            <th class="col-md-3">Alternatif</th>
            <th class="col-md-1">C1</th>
            <th class="col-md-1">C2</th>
            <th class="col-md-1">C3</th>
            <th class="col-md-1">C4</th>
            <th class="col-md-1">C5</th>
            <th class="col-md-1">C6</th>
        </tr>
        <?php
        for($i = 0; $i < count($alternatif); $i++) {
            echo '<tr>
                    <td class="col-md-1">'.($i+1).'</td>
                    <td class="col-md-3">'.$alternatif[$i]['alternatif'].'</td>
                    <td class="col-md-1">'.$y[0][$i].'</td>
                    <td class="col-md-1">'.$y[1][$i].'</td>
                    <td class="col-md-1">'.$y[2][$i].'</td>
                    <td class="col-md-1">'.$y[3][$i].'</td>
                    <td class="col-md-1">'.$y[4][$i].'</td>
                    <td class="col-md-1">'.$y[5][$i].'</td>
                </tr>';
        }
        ?>
    </table>
    <br>
    <!-- edit input matrik y -->

    <!-- edit input nilai ideal -->
    <h3>Nilai Ideal</h3>
    <table class="table table-bordered">
        <tr>
            <th class="col-md-3">Y</th>
            <th class="col-md-1">C1</th>
            <th class="col-md-1">C2</th>
            <th class="col-md-1">C3</th>
            <th class="col-md-1">C4</th>
            <th class="col-md-1">C5</th>
            <th class="col-md-1">C6</th>
        </tr>
        <?php

        foreach ($a as $ideal => $y) {
            echo '<tr>
                    <td class="col-md-2">'.ucfirst($ideal).'</td>
                    <td class="col-md-1">'.$y[0].'</td>
                    <td class="col-md-1">'.$y[1].'</td>
                    <td class="col-md-1">'.$y[2].'</td>
                    <td class="col-md-1">'.$y[3].'</td>
                    <td class="col-md-1">'.$y[4].'</td>
                    <td class="col-md-1">'.$y[5].'</td>
                </tr>';
        }
        ?>
    </table>
    <br/>
    <!-- edit input nilai ideal -->

    <!-- edit input solusi ideal -->
    <!-- edit input solusi ideal -->
    <div class="row">
        <div class="col-md-6 text-left">
            <a class="btn btn-primary" href="bobot.php">&laquo; Bobot</a>
        </div>
        <div class="text-right">
            <a class="btn btn-primary" href="matrik-y.php">Matrik Y &raquo;</a>
        </div>
    </div>
</div>

<?php
include './includes/footer.php';
?>
