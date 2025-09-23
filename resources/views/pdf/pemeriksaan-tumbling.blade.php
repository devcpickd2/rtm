@php
    use Carbon\Carbon;
    $company   = $company   ?? 'PT. Charoen Pokphand Indonesia';
    $division  = $division  ?? 'Food Division';
    $title     = $title     ?? 'PEMERIKSAAN PROSES TUMBLING';
    $doc_code  = $doc_code  ?? 'QF 07/13';
    $tanggal   = $tanggal   ?? '________________';
    $shift     = $shift     ?? '________';
    $produk    = $produk    ?? '________________';

    // Banyaknya kolom isian per “slot” (kanan tabel besar)
    $cols = (int)($cols ?? 8);

    $data      = $data      ?? collect(); // Ensure $data is a collection
    $firstItem = $data->isNotEmpty() ? $data->first() : null;
    $thumblsData = $firstItem ? json_decode($firstItem->thumbls, true) : [];
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>{{ $title }}</title>
<style>
    @page { size: A4 landscape; margin: 10mm 10mm 12mm 10mm; }
    body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 10px; color:#000; }

    .header-top { font-size:9px; line-height:1.2; }
    .title { text-align:center; font-weight:700; font-size:13px; margin:2mm 0 3mm; }

    .meta { width:100%; margin-bottom:4px; }
    .meta td { padding:2px 0; }

    table.grid { width:100%; border-collapse:collapse; font-size:9px; }
    table.grid th, table.grid td { border:1px solid #000; padding:2px 3px; }
    table.grid td.label { width:54mm; font-weight:600; }
    table.grid td.cell  { width:auto; height:14px; text-align:center; vertical-align:top; }
    .section { background:#f5f5f5; font-weight:700; text-align:left; }

    /* Sub-seksi kiri kecil */
    .sub-label { width:54mm; padding-left:10px; font-weight:400; }

    /* Bahan ditambahkan: three sub-columns per slot */
    .triple th { text-align:center; font-weight:700; }
    .mini { font-size:9px; }

    .note { font-size:9px; margin-top:5px; }
    .catatan { font-size:9px; margin-top:6px; }
    .line { border-bottom:1px solid #000; height:14px; }

    .sign { margin-top:8mm; width:100%; }
    .sign td { text-align:center; vertical-align:bottom; }
    .sign .slot { width:50%; padding:0 12mm; }
    .sign .line-sign { border-bottom:1px solid #000; height:0; margin:10mm 0 3px; }
    .role { font-size:9px; }

    .doc-code { position: fixed; right: 10mm; bottom: 18mm; font-size:9px; }
</style>
</head>
<body>
    <div class="header-top">{{ $company }}<br>{{ $division }}</div>
    <div class="title">{{ $title }}</div>

    <table class="meta">
        <tr>
            <td>Hari/Tanggal :</td><td style="width:35%">{{ Carbon::parse($firstItem->date ?? null)->format('d/m/Y') }}</td>
            <td>Shift :</td><td style="width:10%">{{ $firstItem->shift ?? '-' }}</td>
            <td>Produk :</td><td>{{ $firstItem->nama_produk ?? '-' }}</td>
        </tr>
    </table>

    @php
        // Ensure $data is always a collection, even if empty, to allow @foreach to run
        if ($data->isEmpty()) {
            $data = collect([ (object)['thumbls' => '[]', 'catatan' => null, 'status_produksi' => 0, 'status_spv' => 0] ]);
        }
        $firstItem = $data->first(); // Re-assign firstItem after potentially creating dummy data
        $thumblsData = $firstItem ? (json_decode($firstItem->thumbls, true) ?? []) : [];
        if (empty($thumblsData)) {
            $thumblsData = [[]]; // Ensure at least one empty item to render table structure
        }
    @endphp

    <table class="grid">
        {{-- ====== HEADER SLOT KANAN (garis kolom) ====== --}}
        <tr>
            <td class="label">BATCH NO.</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">{{ $thumblsData[$c]['batch'] ?? '-' }}</td>
            @endfor
        </tr>

        {{-- ====== DEFROSTASI DAGING ====== --}}
        <tr><td colspan="{{ $cols+1 }}" class="section">DEFROSTASI DAGING</td></tr>
        <tr>
            <td class="sub-label">Hasil Pemisahan Karkas</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">{{ implode(', ', $thumblsData[$c]['hasil_tumbling'] ?? ['-']) }}</td>
            @endfor
        </tr>
        <tr>
            <td class="sub-label">Jenis Daging</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">{{ $thumblsData[$c]['daging'] ?? '-' }}</td>
            @endfor
        </tr>
        <tr>
            <td class="sub-label">Berat (kg)</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">-</td> {{-- No direct mapping --}}
            @endfor
        </tr>
        <tr>
            <td class="sub-label">Kadar Air (%)</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">-</td> {{-- No direct mapping --}}
            @endfor
        </tr>
        <tr>
            <td class="sub-label">Suhu (°C)</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">-</td> {{-- No direct mapping --}}
            @endfor
        </tr>
        <tr>
            <td class="sub-label">Keterangan</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">{{ $thumblsData[$c]['kondisi'] ?? '-' }}</td>
            @endfor
        </tr>

        {{-- ====== MARINADE ====== --}}
        <tr><td colspan="{{ $cols+1 }}" class="section">MARINADE</td></tr>
        <tr>
            <td class="sub-label">Bahan utama</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">{{ implode(', ', $thumblsData[$c]['bahan_utama'] ?? ['-']) }}</td>
            @endfor
        </tr>
        <tr>
            <td class="sub-label">Bahan minor</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">{{ implode(', ', $thumblsData[$c]['bahan_lain'] ?? ['-']) }}</td>
            @endfor
        </tr>

        {{-- ====== BAHAN YANG DITAMBAHKAN (3 sub kolom × N slot) ====== --}}
        <tr>
            <td class="sub-label">Bahan yang ditambahkan</td>
            @for($i=0;$i<$cols;$i++)
                <td class="cell mini" colspan="1">Kode</td>
            @endfor
        </tr>
        <tr>
            <td class="sub-label"></td>
            @for($i=0;$i<$cols;$i++)
                <td class="cell mini">Berat (kg)</td>
            @endfor
        </tr>
        <tr>
            <td class="sub-label"></td>
            @for($i=0;$i<$cols;$i++)
                <td class="cell mini">Sensori</td>
            @endfor
        </tr>
        {{-- Populating Bahan yang ditambahkan --}}
        @for($r=0; $r < 3; $r++) {{-- Assuming max 3 rows for bahan_lain per batch for simplicity --}}
            <tr>
                <td class="sub-label"></td>
                @for($c=0; $c < $cols; $c++)
                    @php
                        $bahanLain = $thumblsData[$c]['bahan_lain'][$r] ?? null;
                    @endphp
                    <td class="cell mini">{{ $bahanLain['kode'] ?? '-' }}</td>
                    <td class="cell mini">{{ $bahanLain['berat'] ?? '-' }}</td>
                    <td class="cell mini">-</td> {{-- No direct mapping for Sensori --}}
                @endfor
            </tr>
        @endfor


        {{-- ====== AIR (ICE) ====== --}}
        <tr><td colspan="{{ $cols+1 }}" class="section">AIR (ICE)</td></tr>
        <tr>
            <td class="sub-label">Suhu Air (°C)</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">{{ $thumblsData[$c]['suhu_air'] ?? '-' }}</td>
            @endfor
        </tr>
        <tr>
            <td class="sub-label">Suhu Produk (°C)</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">{{ $thumblsData[$c]['suhu_marinade'] ?? '-' }}</td>
            @endfor
        </tr>
        <tr>
            <td class="sub-label">Lama Pengadukan (menit)</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">{{ $thumblsData[$c]['lama_pengadukan'] ?? '-' }}</td>
            @endfor
        </tr>
        <tr>
            <td class="sub-label">Waktu Pre-rest – Setting</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">-</td> {{-- No direct mapping --}}
            @endfor
        </tr>

        {{-- ====== PARAMETER TUMBLING ====== --}}
        <tr><td colspan="{{ $cols+1 }}" class="section">PARAMETER TUMBLING</td></tr>
        <tr>
            <td class="sub-label">Waktu Total (menit)</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">{{ $thumblsData[$c]['total_time'] ?? '-' }}</td>
            @endfor
        </tr>
        <tr>
            <td class="sub-label">Kecepatan (RPM)</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">{{ $thumblsData[$c]['drum_speed'] ?? '-' }}</td>
            @endfor
        </tr>
        <tr>
            <td class="sub-label">Arah Putar</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">-</td> {{-- No direct mapping --}}
            @endfor
        </tr>

        {{-- ====== WELL - STORAGE / SELESAI TUMBLING ====== --}}
        <tr><td colspan="{{ $cols+1 }}" class="section">WELL - STORAGE / SELESAI TUMBLING</td></tr>
        <tr>
            <td class="sub-label">Berat Sisa (kg)</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">-</td> {{-- No direct mapping --}}
            @endfor
        </tr>
        <tr>
            <td class="sub-label">Suhu Produk (°C)</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">-</td> {{-- No direct mapping --}}
            @endfor
        </tr>
        <tr>
            <td class="sub-label">Keterangan</td>
            @for($c=0; $c < $cols; $c++)
                <td class="cell">{{ $thumblsData[$c]['catatan'] ?? '-' }}</td>
            @endfor
        </tr>

        {{-- ====== KONDISI ====== --}}
        <tr><td colspan="{{ $cols+1 }}" class="section">KONDISI</td></tr>
        <tr>
            <td class="sub-label">Pemeriksaan</td>
            @for($i=0;$i<$cols;$i++)
                <td class="cell">
                    QC: @if (($firstItem->status_produksi ?? 0) == 1) ✔ @elseif (($firstItem->status_produksi ?? 0) == 2) TIDAK OK @else - @endif<br>
                    PROD: @if (($firstItem->status_spv ?? 0) == 1) ✔ @elseif (($firstItem->status_spv ?? 0) == 2) TIDAK OK @else - @endif
                </td>
            @endfor
        </tr>
    </table>

    <div class="note">
        *Kondisi dagang: Aroma segar, tidak busuk, bebas dari kontaminasi benda asing
    </div>

    <div class="catatan">Catatan: {{ $firstItem->catatan ?? '-' }}</div>
    <div class="line"></div>

    <table class="sign">
        <tr>
            <td class="slot">
                Diperiksa oleh:
                <div class="line-sign"></div>
                <div class="role">QC</div>
            </td>
            <td class="slot">
                Disetujui oleh:
                <div class="line-sign"></div>
                <div class="role">PROD</div>
            </td>
        </tr>
    </table>

    <div class="doc-code">{{ $doc_code }}</div>
</body>
</html>
