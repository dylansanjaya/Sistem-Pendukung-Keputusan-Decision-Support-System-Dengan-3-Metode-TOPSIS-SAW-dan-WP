<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if(!isset($_SESSION['matrik-r-saw'])) {
    header('Location: matrik-r-saw.php');
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

    $req = $dbc->prepare("SELECT * FROM matrik_r_saw WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $matrik_r_saw = $req->fetchAll();

    $req = $dbc->prepare("SELECT * FROM bobot_normal WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $bobot_normal = $req->fetch();    
}

$vs = array(
    array(),
    array(),
    array(),
    array(),
    array(),
    array()
);

for ($i = 0; $i < count($alternatif); $i++) {
    $vs[0][] = round($matrik_r_saw[$i]['c1']*$bobot_normal['c1'], 4);
    $vs[1][] = round($matrik_r_saw[$i]['c2']*$bobot_normal['c2'], 4);
    $vs[2][] = round($matrik_r_saw[$i]['c3']*$bobot_normal['c3'], 4);
    $vs[3][] = round($matrik_r_saw[$i]['c4']*$bobot_normal['c4'], 4);
    $vs[4][] = round($matrik_r_saw[$i]['c5']*$bobot_normal['c5'], 4);
    $vs[5][] = round($matrik_r_saw[$i]['c6']*$bobot_normal['c6'], 4);
}

$status = "matrik-v-saw";
try {
    $dbc->beginTransaction();

    $dbc->exec("DELETE FROM matrik_v_saw WHERE id_pemilihan = $_SESSION[id]");

    $req = $dbc->prepare("INSERT INTO matrik_v_saw VALUES(:id, :c1, :c2, :c3, :c4, :c5, :c6)");
    $req->bindValue(':id', $_SESSION['id']);

    for ($i = 0; $i<count($alternatif); $i++) {
        $req->bindValue(':c1', $vs[0][$i]);
        $req->bindValue(':c2', $vs[1][$i]);
        $req->bindValue(':c3', $vs[2][$i]);
        $req->bindValue(':c4', $vs[3][$i]);
        $req->bindValue(':c5', $vs[4][$i]);
        $req->bindValue(':c6', $vs[5][$i]);
        $req->execute();
    }

    $req = $dbc->prepare("UPDATE pemilihan SET status = ? WHERE id = ?");
    $req->bindParam(1, $status);
    $req->bindParam(2, $_SESSION['id']);
    $req->execute();

    $dbc->commit();

    $_SESSION['matrik-v-saw'] = true;
    header('Location: vektor-s-wp.php');
    exit;
} catch (PDOException $e) {
    $dbc->rollback();
}