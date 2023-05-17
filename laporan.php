<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$req = $dbc->prepare("SELECT * FROM pemilihan a INNER JOIN hasil b ON a.id = b.id_pemilihan");
$req->execute();

$pemilihan = $req->fetchAll();

$page_title = 'Laporan';

include './includes/header.php';
?>

<div class="col-md-12">
    <div class="page-header text-center">
        <h2>Laporan</h2>
    </div>
    <?php
    if ($pemilihan) {
    ?>
    <!-- <section class="table__header">
        .
    </section> -->
    <section class="table__body">
        <table>
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-4">Keterangan</th>
                    <th class="col-md-3">Alternatif</th>
                    <th class="col-md-2">Nilai Akhir</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for($i = 0; $i < count($pemilihan); $i++) {
                    echo '<tr>
                        <td>'.($i+1).'</td>
                        <td>'.$pemilihan[$i]['keterangan'].'</td>
                        <td>'.$pemilihan[$i]['alternatif'].'</td>
                        <td>'.$pemilihan[$i]['v'].'</td>
                        <td>
                            <a href="detail-laporan.php?id='.$pemilihan[$i]['id'].'" class="btn btn-success">Detail</a>
                            <a href="hapus-laporan.php?id='.$pemilihan[$i]['id'].'" class="btn btn-danger delete-row">Hapus</a>
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </section>
    <?php
    } else {
        echo '<div class="well well-lg text-center">
                <strong>Tidak ada data yang disimpan.</strong>
            </div>';
    }
    ?>
</div>
<script>
    // $(function() {
    //     $('.btn.btn-danger').click(function(e) {
    //         e.preventDefault();
    //         var konfirmasi = confirm('Yakin ingin dihapus?');
    //         if (konfirmasi == true) {
    //             window.location = this.href;
    //         }
    //     });
    // });

    // $(function() {
    //     $('.delete-row').click(function(e) {
    //         e.preventDefault();
    //         var konfirmasi = confirm('Yakin ingin dihapus?');
    //         if (konfirmasi == true) {
    //         var row = $(this).closest('tr'); // Ambil baris terdekat
    //         var url = $(this).attr('href'); // Simpan URL sebelum animasi dimulai
    //         row.animate(
    //             {
    //             marginLeft: '100%', // Geser ke kanan
    //             opacity: 0, // Ubah opacity menjadi 0 (sehingga menghilang)
    //             },
    //             500,
    //             function() {
    //             window.location.href = url; // Redirect setelah animasi selesai menggunakan URL yang telah disimpan
    //             }
    //         );
    //         }
    //     });
    // });

    $(function() {
        $('.delete-row').click(function(e) {
            e.preventDefault();
            var konfirmasi = confirm('Yakin ingin dihapus?');
            if (konfirmasi == true) {
            var row = $(this).closest('tr'); // Ambil baris terdekat
            var url = $(this).attr('href');
            
            // Animasi slide ke kanan
            row.slideUp(500, function() {
                window.location.href = url; // Redirect setelah animasi selesai
            });
            }
        });
    });
</script>
<?php
include './includes/footer.php';
?>
