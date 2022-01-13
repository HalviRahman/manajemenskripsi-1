<?php
function tgl_indo($tanggal)
{
    if (isset($tanggal)) {
        $bulan = array(
            1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );
        $pecahkan = explode('-', substr($tanggal, 0, 10));
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}

function tgljam_indo($tanggal)
{
    if (isset($tanggal)) {
        $bulan = array(
            1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );
        $pecahkan = explode('-', substr($tanggal, 0, 10));
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0] . ' jam ' . (substr($tanggal, 11, 8)) . ' WIB';
    }
}

function huruf($angka)
{
    $hur = array(
        0 =>   'Nol', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan'
    );
    return $hur[$angka];
}

function bulan($angka)
{
    $angka = (int)$angka;
    $bul = array(
        1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );
    return $bul[$angka];
}

function semester($tahun, $bulan)
{
    $tahunlalu = $tahun - 1;
    $tahundepan = $tahun + 1;
    if ($bulan < 7) {
        return "Genap Tahun Akademik " . $tahunlalu . "/" . $tahun;
    } else {
        return "Ganjil Tahun Akademik " . $tahun . "/" . $tahundepan;
    }
}

function multibaris($pesan)
{
    str_replace(["\r\n", "\r", "\n"], "<br/>", $pesan);
    return $pesan;
}

?>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);
</script>


<?php
function hp($nohp)
{
    /*
    $nohp = str_replace(" ", "", $nohp);
    $nohp = str_replace("(", "", $nohp);
    $nohp = str_replace(")", "", $nohp);
    $nohp = str_replace(".", "", $nohp);
    $nohp = str_replace("-", "", $nohp);
    */
    if (substr($nohp, 0, 1) == '0') {
        $hp = '62' . substr($nohp, 1);
    }
    /*
    if (!preg_match('/[^+0-9]/', trim($nohp))) {
        if (substr(trim($nohp), 0, 2) == '+6') {
            $hp = substr(trim($nohp), 1);
        } elseif (substr(trim($nohp), 0, 1) == '0') {
            $hp = '62' . substr(trim($nohp), 1);
        } elseif (substr(trim($nohp), 0, 1) == '6') {
            $hp = trim($nohp);
        }
    }
    */
    return $hp;
}
