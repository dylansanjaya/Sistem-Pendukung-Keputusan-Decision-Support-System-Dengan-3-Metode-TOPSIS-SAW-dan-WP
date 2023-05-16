<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if(!isset($_SESSION['nilai-v-wp'])) {
    header('Location: nilai-v-wp.php');
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

    //TOPSIS
    $req = $dbc->prepare("SELECT * FROM ranking WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $v = $req->fetchAll();

    $hasiltopsis = array();

    for($i = 0; $i < count($alternatif); $i++) {
        $hasiltopsis[] = array(
            "alternatif" => $alternatif[$i]['alternatif'],
            "v" => $v[$i]['v']
        );
    }

    usort($hasiltopsis, function($a, $b) {
        return $a['v'] < $b['v'];
    });

    $status = "selesaitopsis";
    try {
        $dbc->beginTransaction();

        $dbc->exec("DELETE FROM hasil WHERE id_pemilihan = $_SESSION[id]");

        $req = $dbc->prepare("INSERT INTO hasil VALUES(:id, :alternatif, :v)");
        $req->bindValue(':id', $_SESSION['id']);
        $req->bindValue(':alternatif', $hasiltopsis[0]['alternatif']);
        $req->bindValue(':v', $hasiltopsis[0]['v']);
        $req->execute();

        $req = $dbc->prepare("UPDATE pemilihan SET status = ? WHERE id = ?");
        $req->bindParam(1, $status);
        $req->bindParam(2, $_SESSION['id']);
        $req->execute();

        $dbc->commit();
    } catch (PDOException $e) {
        $dbc->rollback();
    }

    // SAW
    $req = $dbc->prepare("SELECT * FROM ranking_saw WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $vs = $req->fetchAll();

    $hasilsaw = array();

    for($i = 0; $i < count($alternatif); $i++) {
        $hasilsaw[] = array(
            "alternatif" => $alternatif[$i]['alternatif'],
            "vs" => $vs[$i]['vs']
        );
    }

    usort($hasilsaw, function($a, $b) {
        return $a['vs'] < $b['vs'];
    });

    $status = "selesaisaw";
    try {
        $dbc->beginTransaction();

        $dbc->exec("DELETE FROM hasil_saw WHERE id_pemilihan = $_SESSION[id]");
        
        $req = $dbc->prepare("INSERT INTO hasil_saw VALUES(:id, :alternatif, :vs)");
        $req->bindValue(':id', $_SESSION['id']);
        $req->bindValue(':alternatif', $hasilsaw[0]['alternatif']);
        $req->bindValue(':vs', $hasilsaw[0]['vs']);
        $req->execute();

        $req = $dbc->prepare("UPDATE pemilihan SET status = ? WHERE id = ?");
        $req->bindParam(1, $status);
        $req->bindParam(2, $_SESSION['id']);
        $req->execute();

        $dbc->commit();
    } catch (PDOException $e) {
        $dbc->rollback();
    }

    //WP
    $req = $dbc->prepare("SELECT * FROM ranking_wp WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $vw = $req->fetchAll();

    $hasilwp = array();

    for($i = 0; $i < count($alternatif); $i++) {
        $hasilwp[] = array(
            "alternatif" => $alternatif[$i]['alternatif'],
            "vw" => $vw[$i]['vw']
        );
    }

    usort($hasilwp, function($a, $b) {
        return $a['vw'] < $b['vw'];
    });

    $status = "selesaiwp";
    try{
        $dbc->beginTransaction();

        $dbc->exec("DELETE FROM hasil_wp WHERE id_pemilihan = $_SESSION[id]");

        $req = $dbc->prepare("INSERT INTO hasil_wp VALUES(:id, :alternatif, :vw)");
        $req->bindValue(':id', $_SESSION['id']);
        $req->bindValue(':alternatif', $hasilwp[0]['alternatif']);
        $req->bindValue(':vw', $hasilwp[0]['vw']);
        $req->execute();

        $req = $dbc->prepare("UPDATE pemilihan SET status = ? WHERE id = ?");
        $req->bindParam(1, $status);
        $req->bindParam(2, $_SESSION['id']);
        $req->execute();

        $dbc->commit();
    } catch (PDOException $e) {
        $dbc->rollback();
    }

//UNSET SESSION

    //General
    unset($_SESSION['id']);
    unset($_SESSION['alternatif']);
    unset($_SESSION['nilai-alternatif']);
    unset($_SESSION['bobot']);

    //TOPSIS
    unset($_SESSION['matrik-r']);
    unset($_SESSION['matrik-y']);
    unset($_SESSION['nilai-ideal']);
    unset($_SESSION['jarak-solusi-ideal']);
    unset($_SESSION['ranking']);

    //SAW
    unset($_SESSION['normalisasi-w']);
    unset($_SESSION['matrik-r-saw']);
    unset($_SESSION['matrik-v-saw']);
    unset($_SESSION['ranking-saw']);

    //WP
    unset($_SESSION['normalisasi-w-wp']);
    unset($_SESSION['normalisasi-s-wp']);
    unset($_SESSION['nilai-v-wp']);
}
$page_title = 'Hasil';  

include './includes/header.php';
?>
<div class="col-md-8 col-md-offset-2">
    <div class="page-header text-center">
        <h1>Pemilihan Karyawan</h1>
        <h4><?php echo $pemilihan['keterangan']; ?></h4>
    </div>
   
    <!-- TOPSIS -->
    <h3>Hasil TOPSIS</h3>
    <div class="well well-lg text-center">
        <strong><?php echo $hasiltopsis[0]['alternatif']; ?> sebagai alternatif terbaik.</strong>
    </div>
   
    <table class="table table-bordered">
        <tr>
            <th class="col-md-4">Alternatif</th>
            <th class="col-md-2">V</th>
            <th class="col-md-1">Rank</th>
        </tr>
        <?php
        for($i = 0; $i < count($hasiltopsis); $i++) {
            echo '<tr>
                    <td class="col-md-4">'.$hasiltopsis[$i]['alternatif'].'</td>
                    <td class="col-md-2">'.$hasiltopsis[$i]['v'].'</td>
                    <td class="col-md-2">'.($i+1).'</td>
                </tr>';
        }
        ?>
    </table>
    
    <!-- SAW -->
    <h3>Hasil SAW</h3>
    <div class="well well-lg text-center">
        <strong><?php echo $hasilsaw[0]['alternatif']; ?> sebagai alternatif terbaik.</strong>
    </div>
   
    <table class="table table-bordered">
        <tr>
            <th class="col-md-4">Alternatif</th>
            <th class="col-md-2">V</th>
            <th class="col-md-1">Rank</th>
        </tr>
        <?php
        for($i = 0; $i < count($hasilsaw); $i++) {
            echo '<tr>
                    <td class="col-md-4">'.$hasilsaw[$i]['alternatif'].'</td>
                    <td class="col-md-2">'.$hasilsaw[$i]['vs'].'</td>
                    <td class="col-md-2">'.($i+1).'</td>
                </tr>';
        }
        ?>
    </table>  

    <!-- WP -->
    <h3>Hasil WP</h3>
    <div class="well well-lg text-center">
        <strong><?php echo $hasilwp[0]['alternatif']; ?> sebagai alternatif terbaik.</strong>
    </div>
   
    <table class="table table-bordered">
        <tr>
            <th class="col-md-4">Alternatif</th>
            <th class="col-md-2">V</th>
            <th class="col-md-1">Rank</th>
        </tr>
        <?php
        for($i = 0; $i < count($hasilwp); $i++) {
            echo '<tr>
                    <td class="col-md-4">'.$hasilwp[$i]['alternatif'].'</td>
                    <td class="col-md-2">'.$hasilwp[$i]['vw'].'</td>
                    <td class="col-md-2">'.($i+1).'</td>
                </tr>';
        }
        ?>
    </table>

    <!-- tombol laporan -->
    <br>
        <div class="row">
            <div class="text-right">
                <a class="btn btn-primary" href="laporan.php">Laporan</a>
            </div>
    <br>
</div>
<?php
include './includes/footer.php';
?>
