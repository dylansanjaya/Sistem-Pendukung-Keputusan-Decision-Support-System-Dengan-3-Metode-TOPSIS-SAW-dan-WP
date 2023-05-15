<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if(!isset($_SESSION['normalisasi-w'])) {
    header('Location: normalisasi-w.php');
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

$rs = array(
    array(),
    array(),
    array(),
    array(),
    array(),
    array()
);

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

// for ($i = 0; $i < count($alternatif); $i++) {
//     $r[0][] = round($nilaiAlternatif[$i]['c1']/max($nilaiAlternatif[$i]['c1']), 4);
//     $r[1][] = round($nilaiAlternatif[$i]['c2']/max($nilaiAlternatif[$i]['c2']), 4);
//     $r[2][] = round($nilaiAlternatif[$i]['c3']/max($nilaiAlternatif[$i]['c3']), 4);
//     $r[3][] = round(min($nilaiAlternatif[$i]['c4'])/$nilaiAlternatif[$i]['c4'], 4);
//     $r[4][] = round(min($nilaiAlternatif[$i]['c5'])/$nilaiAlternatif[$i]['c5'], 4);
//     $r[5][] = round(min($nilaiAlternatif[$i]['c6'])/$nilaiAlternatif[$i]['c6'], 4);
// }

for ($i = 0; $i < count($alternatif); $i++) {
    $rs[0][] = round($nilaiAlternatif[$i]['c1'] / max(array_column($nilaiAlternatif, 'c1')), 4);
    $rs[1][] = round($nilaiAlternatif[$i]['c2'] / max(array_column($nilaiAlternatif, 'c2')), 4);
    $rs[2][] = round($nilaiAlternatif[$i]['c3'] / max(array_column($nilaiAlternatif, 'c3')), 4);
    $rs[3][] = round(min(array_column($nilaiAlternatif, 'c4')) / $nilaiAlternatif[$i]['c4'], 4);
    $rs[4][] = round(min(array_column($nilaiAlternatif, 'c5')) / $nilaiAlternatif[$i]['c5'], 4);
    $rs[5][] = round(min(array_column($nilaiAlternatif, 'c6')) / $nilaiAlternatif[$i]['c6'], 4);
}

$status = "matrik-r-saw";
try {
    $dbc->beginTransaction();

    //tabel matrik_r_saw belum dibikin 
    $dbc->exec("DELETE FROM matrik_r_saw WHERE id_pemilihan = $_SESSION[id]");

    $req = $dbc->prepare("INSERT INTO matrik_r_saw VALUES(:id, :c1, :c2, :c3, :c4, :c5, :c6)");
    $req->bindValue(':id', $_SESSION['id']);

    for ($i = 0; $i<count($alternatif); $i++) {
        $req->bindValue(':c1', $rs[0][$i]);
        $req->bindValue(':c2', $rs[1][$i]);
        $req->bindValue(':c3', $rs[2][$i]);
        $req->bindValue(':c4', $rs[3][$i]);
        $req->bindValue(':c5', $rs[4][$i]);
        $req->bindValue(':c6', $rs[5][$i]);
        $req->execute();
    }

    $req = $dbc->prepare("UPDATE pemilihan SET status = ? WHERE id = ?");
    $req->bindParam(1, $status);
    $req->bindParam(2, $_SESSION['id']);
    $req->execute();

    $dbc->commit();

    $_SESSION['matrik-r-saw'] = true;
    header('Location: matrik-v-saw.php');
    exit;
} catch (PDOException $e) {
    $dbc->rollback();
}

