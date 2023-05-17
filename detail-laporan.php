<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: laporan.php');
    exit;
}

$req = $dbc->prepare("SELECT * FROM pemilihan WHERE id = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$pemilihan = $req->fetch();

$req = $dbc->prepare("SELECT * FROM alternatif WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$alternatif = $req->fetchAll();

$req = $dbc->prepare("SELECT * FROM nilai WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$nilai = $req->fetchAll();

$req = $dbc->prepare("SELECT * FROM bobot WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$bobot = $req->fetch();

$req = $dbc->prepare("SELECT * FROM bobot_normal WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$bobot_normal = $req->fetch();

$req = $dbc->prepare("SELECT * FROM matrik_r WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$r = $req->fetchAll();

$req = $dbc->prepare("SELECT * FROM matrik_y WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$y = $req->fetchAll();

$req = $dbc->prepare("SELECT * FROM nilai_ideal WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$a = $req->fetchAll();

$req = $dbc->prepare("SELECT * FROM jarak_solusi_ideal WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$d = $req->fetchAll();

$req = $dbc->prepare("SELECT * FROM ranking WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$v = $req->fetchAll();

//SAW
$req = $dbc->prepare("SELECT * FROM matrik_r_saw WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$rs = $req->fetchAll();

$req = $dbc->prepare("SELECT * FROM matrik_v_saw WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$ys = $req->fetchAll();

$req = $dbc->prepare("SELECT * FROM ranking_saw WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$vs = $req->fetchAll();

//WP
$req = $dbc->prepare("SELECT * FROM bobot_normal_w WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$bobot_normal_w = $req->fetch();

$req = $dbc->prepare("SELECT * FROM s_normal_wp WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$sw = $req->fetchAll();

$req = $dbc->prepare("SELECT * FROM ranking_wp WHERE id_pemilihan = ?");
$req->bindParam(1, $_GET['id']);
$req->execute();

$vw = $req->fetchAll();

$page_title = 'Detail Laporan';

include './includes/header.php';
?>
<div class="col-md-12">
    <div class="page-header text-center">
        <h2>Pemilihan Karyawan</h2>
        <h4><?php echo $pemilihan['keterangan']; ?></h4>
    <br>

    <?php
    include './includes/criteriatable.php';
    ?>
    <br>
    
    <section class="table__header">
        <h3>Tabel Nilai Alternatif</h3>
    </section>
    <section class="table__body">
        <table>
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-3">Alternatif</th>
                    <th class="col-md-1">C1</th>
                    <th class="col-md-1">C2</th>
                    <th class="col-md-1">C3</th>
                    <th class="col-md-1">C4</th>
                    <th class="col-md-1">C5</th>
                    <th class="col-md-1">C6</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for($i = 0; $i < count($alternatif); $i++) {
                    echo '<tr>
                            <td class="col-md-1">'.($i+1).'</td>
                            <td class="col-md-3">'.$alternatif[$i]['alternatif'].'</td>
                            <td class="col-md-1">'.$nilai[$i]['c1'].'</td>
                            <td class="col-md-1">'.$nilai[$i]['c2'].'</td>
                            <td class="col-md-1">'.$nilai[$i]['c3'].'</td>
                            <td class="col-md-1">'.$nilai[$i]['c4'].'</td>
                            <td class="col-md-1">'.$nilai[$i]['c5'].'</td>
                            <td class="col-md-1">'.$nilai[$i]['c6'].'</td>
                        </tr>';
                }
                ?>
            </tbody>
        </table>
    </section>
<br>
    <section class="table__header">
        <h3>Tabel Bobot</h3>
    </section>
    <section class="table__body">
        <table>
            <thead>
                <tr>
                    <th class="col-md-2">C1</th>
                    <th class="col-md-2">C2</th>
                    <th class="col-md-2">C3</th>
                    <th class="col-md-2">C4</th>
                    <th class="col-md-2">C5</th>
                    <th class="col-md-2">C6</th>
                </tr>
            </thead>
            <tbody>
                <?php
                echo '<tr>
                        <td class="col-md-1">'.$bobot['c1'].'</td>
                        <td class="col-md-1">'.$bobot['c2'].'</td>
                        <td class="col-md-1">'.$bobot['c3'].'</td>
                        <td class="col-md-1">'.$bobot['c4'].'</td>
                        <td class="col-md-1">'.$bobot['c5'].'</td>
                        <td class="col-md-1">'.$bobot['c6'].'</td>
                    </tr>';
                ?>
            </tbody>
        </table>
    </section>
<br>
    

    <br>
    </hr> 
    </div>

    <div>
        <div>
            <h2>TOPSIS</h2>
        </div>
        <section class="table__header">
            <h3>Normalisasi Matriks R</h3>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-3">Alternatif</th>
                        <th class="col-md-1">C1</th>
                        <th class="col-md-1">C2</th>
                        <th class="col-md-1">C3</th>
                        <th class="col-md-1">C4</th>
                        <th class="col-md-1">C5</th>
                        <th class="col-md-1">C6</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for($i = 0; $i < count($alternatif); $i++) {
                        echo '<tr>
                                <td class="col-md-1">'.($i+1).'</td>
                                <td class="col-md-3">'.$alternatif[$i]['alternatif'].'</td>
                                <td class="col-md-1">'.$r[$i]['c1'].'</td>
                                <td class="col-md-1">'.$r[$i]['c2'].'</td>
                                <td class="col-md-1">'.$r[$i]['c3'].'</td>
                                <td class="col-md-1">'.$r[$i]['c4'].'</td>
                                <td class="col-md-1">'.$r[$i]['c5'].'</td>
                                <td class="col-md-1">'.$r[$i]['c6'].'</td>
                            </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>
<br>
        <section class="table__header">
            <h3>Normalisasi Matriks Y</h3>        
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-3">Alternatif</th>
                        <th class="col-md-1">C1</th>
                        <th class="col-md-1">C2</th>
                        <th class="col-md-1">C3</th>
                        <th class="col-md-1">C4</th>
                        <th class="col-md-1">C5</th>
                        <th class="col-md-1">C6</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for($i = 0; $i < count($alternatif); $i++) {
                        echo '<tr>
                                <td class="col-md-1">'.($i+1).'</td>
                                <td class="col-md-3">'.$alternatif[$i]['alternatif'].'</td>
                                <td class="col-md-1">'.$y[$i]['c1'].'</td>
                                <td class="col-md-1">'.$y[$i]['c2'].'</td>
                                <td class="col-md-1">'.$y[$i]['c3'].'</td>
                                <td class="col-md-1">'.$y[$i]['c4'].'</td>
                                <td class="col-md-1">'.$y[$i]['c5'].'</td>
                                <td class="col-md-1">'.$y[$i]['c6'].'</td>
                            </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>
<br>
        <section class="table__header">
            <h3>Nilai Ideal</h3>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th class="col-md-3">Y</th>
                        <th class="col-md-1">C1</th>
                        <th class="col-md-1">C2</th>
                        <th class="col-md-1">C3</th>
                        <th class="col-md-1">C4</th>
                        <th class="col-md-1">C5</th>
                        <th class="col-md-1">C6</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($a as $ideal => $y) {
                        echo '<tr>
                                <td class="col-md-2">'.ucfirst($y['ideal']).'</td>
                                <td class="col-md-1">'.$y['c1'].'</td>
                                <td class="col-md-1">'.$y['c2'].'</td>
                                <td class="col-md-1">'.$y['c3'].'</td>
                                <td class="col-md-1">'.$y['c4'].'</td>
                                <td class="col-md-1">'.$y['c5'].'</td>
                                <td class="col-md-1">'.$y['c6'].'</td>
                            </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>
<br>
        <section class="table__header">
            <h3>Jarak Solusi Ideal</h3>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-5">Alternatif</th>
                        <th class="col-md-3">Positif</th>
                        <th class="col-md-3">Negatif</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($alternatif); $i++) {
                        echo '<tr>
                                <td class="col-md-1">'.($i+1).'</td>
                                <td class="col-md-5">'.$alternatif[$i]['alternatif'].'</td>
                                <td class="col-md-3">'.$d[$i]['positif'].'</td>
                                <td class="col-md-3">'.$d[$i]['negatif'].'</td>
                            </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>
<br>
        <section class="table__header">
            <h3>Tabel Perankingan</h3>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-3">Alternatif</th>
                        <th class="col-md-1">V</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for($i = 0; $i < count($alternatif); $i++) {
                        echo '<tr>
                                <td class="col-md-1">'.($i+1).'</td>
                                <td class="col-md-10">'.$alternatif[$i]['alternatif'].'</td>
                                <td class="col-md-1">'.$v[$i]['v'].'</td>
                            </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <?php
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
        ?>
<br>        
        <section class="table__header">
            <h3>Tabel Hasil Akhir</h3>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th class="col-md-3">Alternatif</th>
                        <th class="col-md-1">V</th>
                        <th class="col-md-1">Rank</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for($i = 0; $i < count($hasiltopsis); $i++) {
                        echo '<tr>
                                <td class="col-md-3">'.$hasiltopsis[$i]['alternatif'].'</td>
                                <td class="col-md-1">'.$hasiltopsis[$i]['v'].'</td>
                                <td class="col-md-1">'.($i+1).'</td>
                            </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>
        </hr>
    </div>
    <br>
    

    <!-- bagian saw -->
    <div>
        <div>
            <h2>SAW</h2>
        </div>
        <section class="table__header">
        <h3>Tabel Bobot Normal</h3>
    </section>
    <section class="table__body">
        <table>
            <thead>
                <tr>
                    <th class="col-md-2">C1</th>
                    <th class="col-md-2">C2</th>
                    <th class="col-md-2">C3</th>
                    <th class="col-md-2">C4</th>
                    <th class="col-md-2">C5</th>
                    <th class="col-md-2">C6</th>
                </tr>
            </thead>
            <tbody>
                <?php
                echo '<tr>
                        <td class="col-md-1">'.$bobot_normal['c1'].'</td>
                        <td class="col-md-1">'.$bobot_normal['c2'].'</td>
                        <td class="col-md-1">'.$bobot_normal['c3'].'</td>
                        <td class="col-md-1">'.$bobot_normal['c4'].'</td>
                        <td class="col-md-1">'.$bobot_normal['c5'].'</td>
                        <td class="col-md-1">'.$bobot_normal['c6'].'</td>
                    </tr>';
                ?>
            </tbody>
        </table>
    </section>
    <br>
        <section class="table__header">
            <h3>Normalisasi Matriks R</h3>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-3">Alternatif</th>
                        <th class="col-md-1">C1</th>
                        <th class="col-md-1">C2</th>
                        <th class="col-md-1">C3</th>
                        <th class="col-md-1">C4</th>
                        <th class="col-md-1">C5</th>
                        <th class="col-md-1">C6</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for($i = 0; $i < count($alternatif); $i++) {
                        echo '<tr>
                                <td class="col-md-1">'.($i+1).'</td>
                                <td class="col-md-3">'.$alternatif[$i]['alternatif'].'</td>
                                <td class="col-md-1">'.$rs[$i]['c1'].'</td>
                                <td class="col-md-1">'.$rs[$i]['c2'].'</td>
                                <td class="col-md-1">'.$rs[$i]['c3'].'</td>
                                <td class="col-md-1">'.$rs[$i]['c4'].'</td>
                                <td class="col-md-1">'.$rs[$i]['c5'].'</td>
                                <td class="col-md-1">'.$rs[$i]['c6'].'</td>
                            </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>
<br>        
        <section class="table__header">
            <h3>Normalisasi Matriks V</h3>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-3">Alternatif</th>
                        <th class="col-md-1">C1</th>
                        <th class="col-md-1">C2</th>
                        <th class="col-md-1">C3</th>
                        <th class="col-md-1">C4</th>
                        <th class="col-md-1">C5</th>
                        <th class="col-md-1">C6</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for($i = 0; $i < count($alternatif); $i++) {
                        echo '<tr>
                                <td class="col-md-1">'.($i+1).'</td>
                                <td class="col-md-3">'.$alternatif[$i]['alternatif'].'</td>
                                <td class="col-md-1">'.$ys[$i]['c1'].'</td>
                                <td class="col-md-1">'.$ys[$i]['c2'].'</td>
                                <td class="col-md-1">'.$ys[$i]['c3'].'</td>
                                <td class="col-md-1">'.$ys[$i]['c4'].'</td>
                                <td class="col-md-1">'.$ys[$i]['c5'].'</td>
                                <td class="col-md-1">'.$ys[$i]['c6'].'</td>
                            </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>
<br>        
        <section class="table__header">
            <h3>Tabel Perankingan</h3>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-3">Alternatif</th>
                        <th class="col-md-1">V</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for($i = 0; $i < count($alternatif); $i++) {
                        echo '<tr>
                                <td class="col-md-1">'.($i+1).'</td>
                                <td class="col-md-10">'.$alternatif[$i]['alternatif'].'</td>
                                <td class="col-md-1">'.$vs[$i]['vs'].'</td>
                            </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <?php
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
        ?>
<br>
        <section class="table__header">
            <h3>Tabel Hasil Akhir</h3>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th class="col-md-3">Alternatif</th>
                        <th class="col-md-1">V</th>
                        <th class="col-md-1">Rank</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for($i = 0; $i < count($hasilsaw); $i++) {
                        echo '<tr>
                                <td class="col-md-3">'.$hasilsaw[$i]['alternatif'].'</td>
                                <td class="col-md-1">'.$hasilsaw[$i]['vs'].'</td>
                                <td class="col-md-1">'.($i+1).'</td>
                            </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>
        </hr>
    </div>
    <br>

    <!-- bagian wp -->
    <div>
        <div>
            <h2>WP</h2>
        </div>
        <section class="table__header">
            <h3>Tabel W Normal</h3>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th class="col-md-2">C1</th>
                        <th class="col-md-2">C2</th>
                        <th class="col-md-2">C3</th>
                        <th class="col-md-2">C4</th>
                        <th class="col-md-2">C5</th>
                        <th class="col-md-2">C6</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    echo '<tr>
                            <td class="col-md-1">'.$bobot_normal_w['c1'].'</td>
                            <td class="col-md-1">'.$bobot_normal_w['c2'].'</td>
                            <td class="col-md-1">'.$bobot_normal_w['c3'].'</td>
                            <td class="col-md-1">'.$bobot_normal_w['c4'].'</td>
                            <td class="col-md-1">'.$bobot_normal_w['c5'].'</td>
                            <td class="col-md-1">'.$bobot_normal_w['c6'].'</td>
                        </tr>';
                    ?>
                </tbody>
            </table>
        </section>
<br>
        <section class="table__header">
            <h3>Tabel V</h3>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-3">Alternatif</th>
                        <th class="col-md-1">V</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for($i = 0; $i < count($alternatif); $i++) {
                            echo '<tr>
                                    <td class="col-md-1">'.($i+1).'</td>
                                    <td class="col-md-10">'.$alternatif[$i]['alternatif'].'</td>
                                    <td class="col-md-1">'.$vw[$i]['vw'].'</td>
                                </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>
        <?php
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
        ?>
<br>
        <section class="table__header">
            <h3>Tabel Hasil Akhir</h3>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th class="col-md-3">Alternatif</th>
                        <th class="col-md-1">V</th>
                        <th class="col-md-1">Rank</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for($i = 0; $i < count($hasilwp); $i++) {
                        echo '<tr>
                                <td class="col-md-3">'.$hasilwp[$i]['alternatif'].'</td>
                                <td class="col-md-1">'.$hasilwp[$i]['vw'].'</td>
                                <td class="col-md-1">'.($i+1).'</td>
                            </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>
<hr>

    </div>

</div>
<?php
include './includes/footer.php';
?>
