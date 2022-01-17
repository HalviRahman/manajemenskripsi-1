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
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0] . ' Jam ' . (substr($tanggal, 11, 8)) . ' WIB';
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

function hari($angka)
{
    $angka = (int)$angka;
    $har = array(
        1 =>   'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'
    );
    return $har[$angka];
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

function nilai($nilai)
{
    if ($nilai > 85) {
        $angka = 'A';
    } elseif ($nilai > 75) {
        $angka = 'B+';
    } elseif ($nilai > 70) {
        $angka = 'B';
    } elseif ($nilai > 65) {
        $angka = 'C+';
    } elseif ($nilai > 60) {
        $angka = 'C';
    } elseif ($nilai > 50) {
        $angka = 'D';
    } else {
        $angka = 'E';
    };
    return $angka;
}

?>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 4000);
</script>

<!-- disable button once it clicked -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#my-form").submit(function(e) {
            $("#btn-submit").attr("disabled", true);
            return true;
        });
    });
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
